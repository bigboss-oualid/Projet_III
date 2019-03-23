<?php

namespace App\Models;

use System\Model;

class UsersModel extends Model
{
	/**
	 * Get all users
	 *
	 * @return array
	 */
	public function all(): array
	{
		return $this->select('u.*', 'ug.name AS `group`')
				    ->from('users u')
				    ->join('LEFT JOIN users_groups ug On u.users_group_id=ug.id')
				    ->fetchAll();
	}

	/**
	 * Create new user record then send success message back
	 *
	 * @return string
	 */
	public function create(): string
	{

		$image = $this->uploadImage();

		if ($image) {
			$this->data('image', $image);
		}

		$first_name = ucfirst($this->request->post('first_name'));
		$status = ucfirst($this->request->post('status'));
		//Replace "/" with "-" to to avoid error by converting time to timestamp
		$birthday = ($post = $this->request->post('birthday'))? strtotime(str_replace("/", "-", $post)) : 0;

		$this->data('first_name', $first_name)
			 ->data('last_name', ucfirst($this->request->post('last_name')))
			 ->data('gender', ucfirst($this->request->post('gender')))
			 ->data('status', $status)
			 ->data('email', $this->request->post('email'))
			 ->data('password', password_hash($this->request->post('password'), PASSWORD_DEFAULT))
			 ->data('birthday', $birthday)
			 ->data('users_group_id', ucfirst($this->request->post('users_group_id')))
			 ->data('ip', $this->request->server('REMOTE_ADDR'))
			 ->data('created', $now = time())
			 ->data('code', sha1($now . mt_rand()))
			 ->insert('users');

		$successMessage = 'l\`utilisateur "<strong>' . $first_name .'</trong>" a été créée avec succès .';

		return $successMessage;
	}

	/**
	 * Upload User Image
	 *
	 * @return string
	 */
	public function uploadImage(): string
	{
		$image = $this->request->file('image');

		if (! $image->exists()) {
			return '';
		}
		return $image->moveTo($this->app->file->toPublic('uploads/images/users'));
	}

	/**
	 * Update the given users record and send success message back
	 *
	 * @param int $id
	 * @param int $usersGroupId
	 *
	 * @return string
	 */
	public function update(int $id,int $usersGroupId)
	{
		$image = $this->uploadImage();

		if ($image) {
			$this->data('image', $image);
		}

		$first_name = ucfirst($this->request->post('first_name'));
		$status     = ucfirst($this->request->post('status'));
		$password   = $this->request->post('password');
		$birthday   = $this->request->post('birthday');

		if ($birthday) {
			 //to convert dd/mm/yyyy to timestamps need to replace "/" with "-" then convert
			$birthday = strtotime(str_replace("/", "-", $birthday));
			 			$this->data('birthday', $birthday);
		}

		if ($password) {
			$this->data('password', password_hash($password, PASSWORD_DEFAULT));
		}

		$data = $this->data('first_name', $first_name)
					 ->data('last_name', ucfirst($this->request->post('last_name')))
					 ->data('gender', $this->request->post('gender'))
					 ->data('status', $status)
					 ->data('email', $this->request->post('email'))
					 ->data('users_group_id', $usersGroupId)
					 ->where('id=?', $id)
					 ->update('users');

		$successMessage = 'Les données de <strong>' . $first_name .'</trong> ont été modifié avec succès.';
		return $successMessage;
	}
}