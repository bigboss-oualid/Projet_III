<?php

namespace App\Controllers\Admin\Common;

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

		$data['user'] = $this->load->model('Login')->user();

		return $this->view->render('admin/common/header', $data);
	}
}