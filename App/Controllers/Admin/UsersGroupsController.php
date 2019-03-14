<?php

namespace App\Controllers\Admin;

use System\Controller;

class UsersGroupsController extends Controller
{
	/**
	 * Display Users groups List
	 * 
	 * @return mixed
	 */
	public function index()
	{
		$this->html->setTitle('Groupes d\'utilisateurs');

		$data['users_groups'] = $this->load->model('UsersGroups')->all();
		$data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;

		$view = $this->view->render('admin/users-groups/list', $data);
	
		return $this->adminLayout->render($view);
	}

	/**
	 * Open Users groups From
	 *
	 * @return string
	 */
	public function add(): string
	{
		return $this->form();
	}

	/**
	 * Submit for creating new Users Groups
	 *
	 * @return string|json
	 */
	public function submit()
	{	
		$json = [];

		if ($this->isValid()) {
			//No error in form validation
			$message = $this->load->model('UsersGroups')->create();

			$json['success'] = $message;

			 $json['redirectTo'] = $this->url->link('/admin/users-groups');
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
		$usersGroupsModel = $this->load->model('UsersGroups');

		if(! $usersGroupsModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}

		$usersGroup = $usersGroupsModel->get($id);

		return $this->form($usersGroup);
	}

	/**
	 * Delete users group
	 *
	 * @param int $id
	 * 
	 * @return string|json
	 */
	public function delete(int $id): string
	{
		$usersGroupsModel = $this->load->model('UsersGroups');

		if(! $usersGroupsModel->exists($id) or $id == 1) {
			return $this->url->redirectTo('/404');
		}
		$usersGroup = $usersGroupsModel->get($id);
		
		$usersGroupsModel->delete($id);

		$json['success'] = 'Le groupe <b>' . ucfirst($usersGroup->name) . '</b> a été supprimé avec succès';

		return $this->json($json);
	}

	/**
	 * Save the given users group
	 *
	 * @param int $id
	 * 
	 * @return string|json
	 */
	public function save(int $id)
	{
		if ($this->isValid($id)) {
			//No error in form validation
			$message = $this->load->model('UsersGroups')->update($id);

			$json['success'] = $message;

			 $json['redirectTo'] = $this->url->link('/admin/users-groups');
		} else {
			//Errors in form validation
			$json['errors'] = $this->validator->detachMessages();
		}
		return $this->json($json);
	}


	/**
	 * Creat the form
	 *
	 * @param \stdClass $usersGroup
	 *
	 * @return string
	 */
	private function form($usersGroup = null): string
	{	
		if ($usersGroup) {
			//Editing form
			$data['target'] = 'edit-users-group-' . $usersGroup->id ;

			$data['action'] = $this->url->link('/admin/users-groups/save/'. $usersGroup->id);

			$data['heading'] = 'Modifier le groupe ' . $usersGroup->name;
		} else {
			//Adding form
			$data['target'] = 'add-users-group-form';
			
			$data['action'] = $this->url->link('/admin/users-groups/submit/');

			$data['heading'] = 'Nouveau groupe d\'utilisateur';
		}


		$data['name'] = $usersGroup ? $usersGroup->name : null;
		$data['users_group_pages'] = $usersGroup ? $usersGroup->pages : [];

		$data['submit'] = $usersGroup ? 'Modifier' : 'Ajouter';

		$data['pages'] = $this->getPermissionPages();

		return $this->view->render('admin/users-groups/form', $data);
	}

	/**
	 * Get all permission pages
	 *
	 * @return array
	 */
	private function getPermissionPages()
	{
		$permissions = [];

		foreach ($this->route->routes() as $route ) {

			if (strpos($route['url'], '/admin') === 0) {
				$permissions[] = $route['url'];
			} 
		}
		
		return $permissions;

	}

	/**
	 * Validate the form
	 *
	 * @return boolean
	 */
	public function isValid(int $id = null): bool
	{
		$this->validator->required('name', 'Le nom de la groupe est nécessaire.');

		$this->validator->unique('name', ['users_groups', 'name', 'id', $id ], 'Le nom de la groupe choisi est déjà utilisé');

		return $this->validator->passes();
	}

}