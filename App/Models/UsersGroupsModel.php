<?php

namespace App\Models;

use System\Model;

class UsersGroupsModel extends Model
{
	/**
	 * Database Table name
	 *
	 * @var string
	 */
	protected $table = 'users_groups';

	/**
	 * Get users group
	 *
	 * @param int $id
	 *
	 * @return mixed
	 */
	public function get(int $id)
	{
		$usersGroup = parent::get($id);

		if ($usersGroup) {
			$pages = $this->select('page')->where('users_group_id = ?', $usersGroup->id)->fetchAll('users_group_permissions');

			$usersGroup->pages = [];

			if ($pages) {
				foreach ($pages as $page) {
					$usersGroup->pages[] = $page->page;
				}
			}
		}

		return $usersGroup;
	}
	
	/**
	 * Create new Users Group record then send success message back
	 *
	 * @return string
	 */
	public function create(): string
	{
		$nameValue = ucfirst($this->request->post('name'));

		$usersGroupId = $this->data('name', $nameValue)->insert($this->table)->lastId();

		$pages = $this->request->post('pages');

		if ($pages) {
			//Get selected allowed pages after remove any empty values in the array
			$pages = array_filter($pages);
			foreach ($pages as $page) {
				$this->data('users_group_id', $usersGroupId)
					 ->data('page', $page)
					 ->insert('users_group_permissions');
			}
		}
		
		$successMessage = 'Le groupe <strong>' . $nameValue .'</strong> a été créée avec succès .';
		
		return $successMessage;
	}

	/**
	 * Update the given Users Group record and send success message back
	 *
	 * @param int $id
	 *
	 * @return string
	 */
	public function update(int $id): string
	{
        $usersGroupId = $this->data('name', ucfirst($this->request->post('name')))
        					 ->where('id=?', $id)
        					 ->update($this->table);

        //Delete the alt permissions
        $this->where('users_group_id=?', $id)->delete('users_group_permissions');
        
        $pages = array_filter($this->request->post('pages'));

        //Insert the new pages
		foreach ($pages as $page) {
			$this->data('users_group_id', $id)
				 ->data('page', $page)
				 ->insert('users_group_permissions');
		}

		$successMessage = 'Le Groupe numéro [<strong>' . $id . '</strong>] a été modifé avec succès ';
		return $successMessage;
	}
}