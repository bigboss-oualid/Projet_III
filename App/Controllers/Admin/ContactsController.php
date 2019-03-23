<?php

namespace App\Controllers\Admin;

use System\Controller;

class ContactsController extends Controller
{
	/**
	 * Display Contacts mails
	 * 
	 * @return mixed
	 */
	public function index()
	{
		$this->html->setTitle('Contacts');

		$data['contacts'] = $this->load->model('Contacts')->latest();
		$data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;
		$data['users_group_id'] = $this->user->users_group_id;
		
		$view = $this->view->render('admin/contacts/list', $data);
	
		return $this->adminLayout->render($view);
	}

	/**
	 * Reply contact
	 *
	 * @param int $id
	 * 
	 * @return string|json
	 */
	public function reply(int $id)
	{	
		$contactsModel = $this->load->model('Contacts');

		if(! $contactsModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}

		$contact = $contactsModel->get($id);

		return $this->form($contact);
	}

	/**
	 * Create the form
	 *
	 * @param \stdClass $contact
	 *
	 * @return string
	 */
	private function form($contact): string
	{	
		//Prepare reply form
		$data['target'] = 'reply-contact-' . $contact->id ;

		$data['action'] = $this->url->link('/admin/contacts/send/'. $contact->id);

		$data['heading'] = 'Répondre à '. $contact->name;
		
		$contact = (array) $contact;

		$name = array_get($contact, 'name');
		$message = array_get($contact, 'message');

		//Prepare details
		if ($reply = array_get($contact, 'reply')) {
			$userModel = $this->load->model('Users');

			$repliedUser = $userModel->get(array_get($contact, 'replied_by'));

			$replied_by = $repliedUser->last_name;
			$replied_at = date('d-m-Y',array_get($contact, 'replied_at'));

			$data['details']  = html_entity_decode($this->getDetails($message, $name, $reply,  $replied_by,  $replied_at));
		} else {
			$data['details']  = $message;
		}
		
		$data['user_id']  = array_get($contact, 'user_id');
		$data['name']     = array_get($contact, 'name');
		$data['email']    = array_get($contact, 'email');
		$data['phone']    = array_get($contact, 'phone');
		$data['subject']  = array_get($contact, 'subject');

		$data['created'] = '';

		if (! empty($contact['created'])) {
			$data['created'] = date('d-m-Y', $contact['created']);
		}

		return $this->view->render('admin/contacts/form', $data);
	}

	/**
	 * Submit for answring contact
	 *
	 * @param int $id contact 
	 *
	 * @return string|json
	 */
	public function send(int $id)
	{	
		$json = [];

		if ($this->isValid()) {
			//No error in form validation
			$json['success'] = $message = $this->load->model('Contacts')->update($id);

			 $json['redirectTo'] = $this->url->link('/admin/contacts');
		} else {
			//Errors in form validation
			$json['errors'] = $this->validator->detachMessages();
		}
		return $this->json($json);
	}

	/**
	 * Disabled contacts
	 *
	 * @param int $id
	 * 
	 * @return string|json
	 */
	public function disabled(int $id): string
	{
		$contactsModel = $this->load->model('Contacts');

		if(! $contactsModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}
		$contact = $contactsModel->get($id);
		
		$contactsModel->disabled($id);

		$json['success'] = 'le message de <b>Mr. ' . ucfirst($contact->name) . '</b> a été enlevé de la liste avec succès';

		return $this->json($json);
	}

	/**
	 * Validate the form
	 * 
	 * @param int $id user already exist
	 *
	 * @return boolean
	 */
	public function isValid(int $id = null): bool
	{
		$this->validator->required('details', 'Vous ne pouvez pas envoyer un e-mail vide');

		return $this->validator->passes();
	}

	
	/**
	 * Prepare details field for the form
	 *
	 * @param string          $message
	 * @param string          $sendedFrom
	 * @param string|null     $reply
	 * @param string|null     $repliedBy
	 * @param string|null     $repliedAt
	 *
	 * @return string
	 */
	private function getDetails($message, string $sendedFrom, string  $reply = null, string $repliedBy = null, string $repliedAt = null)
	{
		if (isset($reply)) {
			$details = '<h3>Envoyé :</h3><blockquote>' .  html_entity_decode($reply) . '<small class="pull-right">Envoyer par: ' . $repliedBy .' </small><br><small class="pull-right">le: ' . $repliedAt .' </small><br></blockquote>';
		}
		$details  .='<h3>Reçu :</h3><blockquote>' . html_entity_decode($message) . '<small class="pull-right">Envoyer par: ' . $sendedFrom .' </small><br></blockquote>';

		return $details;
	}
}