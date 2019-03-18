<?php

namespace App\Controllers;

use System\Controller;

class NotFoundController extends Controller
{
	public function index()
	{
		$settingsModel = $this->load->model('Settings');
		$settingsModel->loadAll();

		$data = [];
        
        //Set $data if the Blog is disabled
        if ($settingsModel->get('site_status') === 'Désactivé') {
        	$data['title'] = 'Site is disabled';
            $data['site_close_msg'] = html_entity_decode($settingsModel->get('site_close_msg'));
            $data['site_status'] = $settingsModel->get('site_status');
            $data['site_email'] = $settingsModel->get('site_email');		
        }

        return $this->view->render('not-found', $data);
	}
}