<?php

namespace App\Controllers\Admin;

use System\Controller;

class ProfileController extends Controller
{
	/**
	 * Update the given user by ID
	 *
	 * @param int $id
	 * 
	 * @return string|json
	 */
	public function update()
	{
		$json = [];

		//Get the current user object fromn the login Model in order to get the right id
		$user = $this->user;

		if ($this->isValid($user->id)) {
			//No error in form validation
			$message = $this->load->model('Users')->update($user->id, $user->users_group_id);

			$json['success'] = 'Votre profil a été modifié avec success';

			$json['redirectTo'] = $this->request->referer() ?: $this->url->link('/admin/users');
		} else {
			//Errors in form validation
			$json['errors'] = $this->validator->detachMessages();
		}
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
		$this->validator->required('first_name', 'Le pénom est nécessaire.');
		$this->validator->required('last_name', 'Le nom est nécessaire.');
		$this->validator->required('email')->email('email');
		$this->validator->unique('email', ['users', 'email', 'id', $id ], 'Cet adresse Email est déjà utilisé pour un autre compte');
		if ($this->request->post('password')) {
			$this->validator->required('password')->minLen('password',8)->match('password', 'confirm_password', 'les deux mots de passe doivent être identiques');
		}
		
		$this->validator->image('image');
	

		return $this->validator->passes();
	}

}