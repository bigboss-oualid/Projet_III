<?php

namespace App\Controllers\Blog\Common;

use System\Controller;

class FooterController extends Controller
{
	/**
	 * retrun footer for index page
	 * 
	 *  @return string
	 */
    public function index(): string
    {
        $data['user'] = $this->load->model('Login')->user();

        return $this->view->render('blog/common/footer', $data);
    }
}