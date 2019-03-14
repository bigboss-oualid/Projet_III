<?php

namespace App\Controllers\Admin;

use System\Controller;

class DashboardController extends Controller
{
     /**
     * Display Dashboard Page
     *
     * @return mixed
     */
    public function index()
    {
        $this->html->setTitle('Dashboard | Blog');

        $commentsModel = $this->load->model('Comments');
        
        //Get all reported comments 
        $reported_comments = $commentsModel->allReported();
        $reported_comments_number = $commentsModel->rows();

        //Get all disabled comments 
        $disabled_comments = $commentsModel->allDisabled();
        $disabled_comments_number = $commentsModel->rows();

        //Get all new contacts
        $contactsModel = $this->load->model('Contacts')->newContacts();
        $new_contacts_number = $contactsModel->new_contacts ;

        $data['first_name'] = $this->user->first_name;
        $data['users_group_id'] = $this->user->users_group_id;
        
        //Get permitted link 
        $data['permissions'] = $this->getLinkFromPermission($data['users_group_id']);

        $data['message'] = getMessage($reported_comments_number, 'Commentaires signalé');
        $data['warning'] = getMessage($disabled_comments_number,'Commentaires non publié');
        $data['news']    = getMessage($new_contacts_number, 'nouveaux contact');

         $data['reported_comments'] = $reported_comments_number;
         $data['disabled_comments'] = $disabled_comments_number;
         $data['new_contacts']      = $new_contacts_number;


        $view = $this->view->render('admin/main/dashboard', $data);

        return $this->adminLayout->render($view);
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