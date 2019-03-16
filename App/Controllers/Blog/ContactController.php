<?php

namespace App\Controllers\Blog;

use System\Controller;

class ContactController extends Controller
{
     /**
     * Display Contact Page
     *
     * @return mixed
     */
    public function index()
    {
        $this->blogLayout->title('Contatez-moi');
        $loginModel = $this->load->model('Login');

        //show name & email from logged user
        if ( $loginModel->isLogged()) { 
            $user = $loginModel->user();

            $data['name'] = ucfirst($user->last_name) .' '. $user->first_name;
            $data['email'] = $user->email;

            $view = $this->view->render('blog/users/contact-me', $data);
            
        } else {
            // Not logged
            $view = $this->view->render('blog/users/contact-me');
        }

        // Disable sidebar from page
        $this->blogLayout->disable('sidebar');

        return $this->blogLayout->render($view);
    }

    /**
    * Submit for Sending a message
    *
    * @return string | json
    */
    public function submit()
    {
        $json = [];

        if ($this->isValid()) {

             $loginModel = $this->load->model('Login');

            if ($loginModel->isLogged()) { 
                $user = $loginModel->user();
                // Post the users id for the logged user
                $this->request->setPost('user_id', $user->id);
                $this->request->setPost('name', $user->last_name);
            } else {
                $this->request->setPost('user_id', 0);
            }

            $json['success'] = $this->load->model('Contacts')->create();

            $json['redirectTo'] = $this->url->link('/');
        } else {
            
            $json['errors'] = $this->validator->detachMessages();
        }

        return $this->json($json);
    }

     /**
     * Validate the form
     *
     * @param int $id
     * 
     * @return bool
     */
    private function isValid()
    {
        $this->validator->required('name', 'Pénom est nécessaire.');
        $this->validator->required('email','Adresse email est nécessaire');
        $this->validator->required('subject','Sujet est nécessaire');
        $this->validator->required('message','Message est nécessaire');

        if($this->app->request->post('phone')) {
            $this->validator->validatePhoneNumber('phone', 10, 14);
        }

        return $this->validator->passes();
    }
}