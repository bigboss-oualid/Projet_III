<?php

namespace App\Models;

use System\Model;

class ContactsModel extends Model
{

	/**
	 * Create new contact record then send success message back
	 *
	 * @return string
	 */
	public function create(): string
	{
		$this->data('user_id', $this->request->post('user_id'))
			 ->data('name', ucfirst($this->request->post('name')))
			 ->data('phone', $this->request->post('phone'))
			 ->data('email', $this->request->post('email'))
			 ->data('subject', $this->request->post('subject'))
			 ->data('message', $this->request->post('message'))
			 ->data('status', $this->request->post('Activé'))
			 ->insert($this->table);

		$successMessage = 'Votre message a été envoyé avec succes. je vous répondrai dés que possible';
		return $successMessage;
	}

	/**
     * Count all contacts without reponse
     *
     * @return array
     */
    public function newContacts()
    {
        //count Contacts
        return $this->select('COUNT(id) AS `new_contacts`')
        			->from('contacts')
        			->where('replied_by="0"')
        			->fetch();
    }

	/**
     * Get latest contacts 
     *
     * @return array
     */
    public function latest()
    {
        //Get the latest added episodes
        return $this->select('c.*', 'u.email AS `user_email`', 'u.first_name', 'u.last_name', 'users_group_id')
                    ->select('(SELECT COUNT(c.id) FROM contacts c WHERE c.replied_by = 0) AS new_contact')
                    ->from('contacts c')
                    ->join('LEFT JOIN users u ON c.replied_by=u.id')
                    ->where('c.status != ?', 'Désactivé')
                    ->orderBy('c.replied_at')
                    ->fetchAll();
    }

    /**
	 * Disabled contact by ID to remove it from admin list
	 *
	 * @param int $episodeId
	 * 
	 * @return void
	 */
	public function disabled(int $id): void
	{
		$this->data('status', 'Désactivé')->where('id = ?', $id)->update('contacts');	
	}

	/**
	 * Update the given contact restore replied message and send email
	 *
	 * @param int $id
	 *
	 * @return string
	 */
	public function update(int $id): string
	{
		$user = $this->user;
		$replied_by =  $user->id;

		$siteMail = $this->settings->get('site_email');

		$contactsModel = $this->load->model('Contacts');
		$contact = $contactsModel->get($id);		

		//Sending Mail can be change later with SMTP method sending
		$to      = $contact->email;
		$subject = 'Répondre à ' . $contact->subject;
		$reply   = _escape($this->request->post('details'));
		$headers = 'From:' . $siteMail . "\r\n" . 'Reply-To:' . $contact->email . "\r\n" . 'X-Mailer: PHP/' . phpversion();

		//mail($to, $subject, $reply, $headers);

		$this->data('reply', $reply)
			 ->data('replied_by', $replied_by)
			 ->data('replied_at',  $now = time())
			 ->where('id=?', $id)
			 ->update('contacts');

		$successMessage = 'L\'email est envoyé a <b>'.$contact->name.'</b>, et il est enregistré avec succès.';
		
		return $successMessage;
	}
}