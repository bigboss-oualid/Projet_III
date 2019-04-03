<?php

namespace App\Controllers\Admin;

use System\Controller;

class UsersController extends Controller
{
	/**
	 * Display Users List
	 * 
	 * @return mixed
	 */
	public function index()
	{
		$this->html->setTitle('Utilisateurs');

		$data['users'] = $this->load->model('Users')->all();

		$data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;

		$view = $this->view->render('admin/users/list', $data);
	
		return $this->adminLayout->render($view);
	}

	/**
	 * Open Users From
	 *
	 * @return string
	 */
	public function add(): string
	{
		return $this->form();
	}

	/**
	 * Submit for creating new Users
	 *
	 * @return string|json
	 */
	public function submit()
	{	
		$json = [];

		if ($this->isValid()) {
			//No error in form validation
			$message = $this->load->model('Users')->create();


			$json['success'] = $message;

			 $json['redirectTo'] = $this->url->link('/admin/users');
		} else {
			//Errors in form validation
			$json['errors'] = $this->validator->detachMessages();
		}
		return $this->json($json);
	}

	/**
	 * Save the given user by ID
	 *
	 * @param int $id
	 * 
	 * @return string|json
	 */
	public function save(int $id)
	{
		if ($this->isValid($id)) {
			//No error in form validation
			$message = $this->load->model('Users')->update($id);

			$json['success'] = $message;

			 $json['redirectTo'] = $this->url->link('/admin/users');
		} else {
			//Errors in form validation
			$json['errors'] = $this->validator->detachMessages();
		}
		return $this->json($json);
	}

	/**
	 * Display edit form
	 *
	 * @param int id
	 * 
	 * @return string
	 */
	public function edit(int $id): string
	{
		$usersModel = $this->load->model('Users');

		if(! $usersModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}

		$user = $usersModel->get($id);

		return $this->form($user);
	}

	/**
	 * Delete user
	 *
	 * @param int $id
	 * 
	 * @return string|json
	 */
	public function delete(int $id): string
	{
		$usersModel = $this->load->model('Users');

		if(! $usersModel->exists($id) or $id == 1) {
			return $this->url->redirectTo('/404');
		}
		$user = $usersModel->get($id);
		
		$usersModel->delete($id);

		$json['success'] = '<b>' . ucfirst($user->first_name) . '</b> a été supprimé avec succès';

		return $this->json($json);
	}

	/**
	 * Creat the form
	 *
	 * @param \stdClass $users
	 *
	 * @return string
	 */
	private function form($user = null): string
	{	
		if ($user) {
			//Editing form
			$data['target'] = 'edit-user-' . $user->id ;

			$data['action'] = $this->url->link('/admin/users/save/'. $user->id);

			$data['heading'] = 'Modifier l\'utilisateur: ' . $user->first_name . ' ' . $user->last_name;
		} else {
			//Adding form
			$data['target'] = 'add-user-form';
			
			$data['action'] = $this->url->link('/admin/users/submit/');

			$data['heading'] = 'Nouveau utilisateur';
		}

		$user = (array) $user;

		// Get value from array by using its key
		$data['first_name']     = array_get($user, 'first_name');
		$data['id']      		= array_get($user, 'id');
		$data['last_name']      = array_get($user, 'last_name');
		$data['status']         = array_get($user, 'status');
		$data['users_group_id'] = array_get($user, 'users_group_id');
		$data['email']          = array_get($user, 'email');
		$data['gender']         = array_get($user, 'gender');
		$data['users_group_id'] = array_get($user, 'users_group_id');

		$data['birthday'] = '';
        $data['image'] = '';

		if (! empty($user['birthday'])) {
			$data['birthday'] = date('d/m/Y', $user['birthday']);
		}
		if (! empty($user['image'])) {
			//Default path to upload user image : public/uploads/images
			$data['image'] = $this->url->link('public/uploads/images/users/' . $user['image']);
		}

	
		$data['users_groups'] = $this->load->model('UsersGroups')->all();

		$data['submit'] = $user ? 'Modifier' : 'Ajouter';

		return $this->view->render('admin/users/form', $data);
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
		$this->validator->required('first_name', 'Le pénom est nécessaire.');
		$this->validator->required('last_name', 'Le nom est nécessaire.');
		$this->validator->required('email')->email('email');
		$this->validator->unique('email', ['users', 'email', 'id', $id ], 'Cet adresse Email est déjà utilisé pour un autre compte');

		//Call methode if the id is null in order to create new user
		if (is_null($id)) {
			//password validation
			$this->validator->required('password')->minLen('password',8)->match('password', 'confirm_password', 'les deux mots de passe doivent être identiques');
			//image validation
			$this->validator->requiredFile('image')->image('image');
		} else {			
			$this->validator->image('image');
		}

		return $this->validator->passes();
	}

}