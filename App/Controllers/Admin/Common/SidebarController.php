<?php

namespace App\Controllers\Admin\Common;

use System\Controller;

class SidebarController extends Controller
{	
	/**
	 * Retrun sidebar content for index page
	 *  
	 *  @return string
	 */
	public function index(): string
	{
		$usersGroupId = $this->user->users_group_id;

		//Get permissions for sidebar and store it in $data
		$data = $this->getLinkFromPermission($usersGroupId);

		//Get number of new letters
		$contacts =  $this->load->model('Contacts')->newContacts();

		//Add new contacts number to $data
		$data['number_of_new_letters'] = $contacts->new_contacts;
	
		return $this->view->render('admin/common/sidebar', $data);
	}

	/**
	 * Get permitted link from user group
	 *
	 * @param int $usersGroupId
	 *
	 * @return array
	 */
	private function getLinkFromPermission(int $usersGroupId): array
	{
		$user_group_permission = $this->load->model('UsersGroups')->get($usersGroupId);
		//pre($user_group_permission,0);
		$allowedLink = [];
		//Get only the important links
		$links = [
					'contacts'    =>'/admin/contacts',
				 	'comments'    =>'/admin/episodes/comments',
					'episodes'    =>'/admin/episodes/add',
					'chapters'    =>'/admin/chapters',
					'settings'    =>'/admin/settings',
					'profile'     =>'/admin/profile',
					'users_groups'=>'/admin/users-groups',
					'users'       =>'/admin/users',
				]   ;

		//Search in permission what link is allowed
		foreach ($user_group_permission->pages as $allowed_page)
		{
			foreach ($links as $key => $link) {
				if (strpos($allowed_page, $link ) === 0) {
				    $allowedLink[$key] = $link;
				}
			}
		}
		return $allowedLink;
	}
}