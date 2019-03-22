<?php

namespace App\Controllers\Admin;

use System\Controller;

class SettingsController extends Controller
{
    /**
    * Display Settings Form
    *
    * @return mixed
    */
    public function index()
    {
        $this->html->setTitle('Paramétrage');

        $data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;
        $data['errors']  = $this->session->has('errors') ? $this->session->pull('errors') : null;

        $episodesModel = $this->load->model('Episodes')->totalEnabled();
        $data['total_episodes'] = $episodesModel->total_episodes;

        $settingsModel = $this->load->model('Settings');

        $settingsModel->loadAll();

        $data['action'] = $this->url->link('/admin/settings/save');

        $data['site_name'] = ucfirst($this->request->post('site_name')) ?: ucfirst($settingsModel->get('site_name'));
        $data['site_email'] = $this->request->post('site_email') ?: $settingsModel->get('site_email');
        $data['comments_status'] = $this->request->post('comments_status') ?: $settingsModel->get('comments_status');
        $data['site_status'] = $this->request->post('site_status') ?: $settingsModel->get('site_status');
        $data['site_close_msg'] = $this->request->post('site_close_msg') ?: $settingsModel->get('site_close_msg');
        $data['episodes_in_home'] = $this->request->post('episodes_in_home') ?: $settingsModel->get('episodes_in_home');

        $view = $this->view->render('admin/settings/form', $data);

        return $this->adminLayout->render($view);
    }

    /**
    * Submit for creating new settings
    *
    * @return string
    */
    public function save()
    {
        if ($this->isValid()) {
            //No errors in form validation
            $this->load->model('Settings')->updateSettings();

            $this->session->set('success', 'la configuration a été modifié avec succes');

            $this->url->redirectTo('/admin/settings');
        } else {
            //errors in form validation exist
            $this->session->set('errors', $this->validator->detachMessages());
            return $this->index();
        }
    }

     /**
     * Validate the form
     *
     * @param int $id
     * 
     * @return bool
     */
    private function isValid(int $id = null): bool
    {
        $this->validator->required('site_name', 'le nom est obligatoire');
        $this->validator->required('site_email', 'l\'email est obligatoire');
        
        if($this->app->request->post('site_status') === 'Désactivé') {
            
            $this->validator->required('site_close_msg', 'Pour désactivé le site il faut laisser un message de fermuture, qui contient au moins 20 lettres afin d\'informer les visiteurs ')->minLen('site_close_msg',20, '"<strong>Le message de fermeture</strong>" doit contenir au moins 20 caractères');
        }

        return $this->validator->passes();
    }
}