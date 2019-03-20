<?php

namespace App\Controllers\Admin;

use System\Controller;

class AccessController extends Controller
{
    /**
    * Check User Permissions to access admin pages
    *
    * @return void
    */
    public function index()
    {
        
        $loginModel = $this->load->model('Login');

        $ignoredPages = ['/admin/login', '/admin/login/submit'];
                         
        $currentRoute = $this->route->getCurrentRouteUrl();

        //Not logged in & not requesting login page
        if (($isNotLogged =  ! $loginModel->isLogged()) AND ! in_array($currentRoute , $ignoredPages)) {
            // Redirect him to login page
            return $this->url->redirectTo('/admin/login');
        }

        // Not logged in & requesting login page
        // OR is logged in successfully &  requesting admin page
        if ($isNotLogged) {
            return false;
        }

        $user = $loginModel->user();

        $usersGroupsModel = $this->load->model('UsersGroups');



        $usersGroup = $usersGroupsModel->get($user->users_group_id);

        // user's blog try to access admin page or No permissions to access an admin page
        if ((! $usersGroup) || (! in_array($currentRoute, $usersGroup->pages)) )  {
             //Redirected to 404 page
            //may create access-denied page
            return $this->url->redirectTo('/404');
        }
    }
}