<?php

namespace App\Controllers\Blog\Common;

use System\Controller;

class SidebarController extends Controller
{
	/**
	 * retrun sidebar for index page
	 * 
	 *  @return string
	 */
    public function index(): string
    {
    	//Get all enabled chapters 
        $data['chapters'] = $this->load->model('Chapters')->getEnabledChaptersWithEpisodesNumber();
        
        //Get the 5 more viewed episodes
        $data['popular_episodes'] = $this->load->model('Episodes')->getMoreViewed(5);

        return $this->view->render('blog/common/sidebar', $data);
    }
}