<?php

namespace App\Controllers\Blog;

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
        $settings = $this->settings;
        
        //Blog is disabled block the all blog's pages  
        if ($settings->get('site_status')  === 'Désactivé') {

            return $this->url->redirectTo('/disabled');
        }
    }
}