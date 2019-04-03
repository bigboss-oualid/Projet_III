<?php

namespace App\Controllers\Blog\Common;

use System\Controller;

class HeaderController extends Controller
{
	/**
	 * Retrun header for index page
	 * 
	 *  @return string
	 */
    public function index(): string
    {
        $data['title'] = $this->html->title();

        $loginModel = $this->load->model('Login');

        $data['user'] = $loginModel->isLogged() ? $loginModel->user() : null;

        $data['chapters'] = $this->load->model('Chapters')->getEnabledChaptersWithEpisodesNumber();

        return $this->view->render('blog/common/header', $data)->getOutput();
    }
}