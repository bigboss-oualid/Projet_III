<?php

namespace App\Controllers\Blog;

use System\Controller;

class LoginController extends Controller
{
    /**
    * Display Login Form
    *
    * @return mixed
    */
    public function index()
    {
        $this->blogLayout->title('Login');

        $loginModel = $this->load->model('Login');

        //Disable sidebar
        $this->blogLayout->disable('sidebar');

        if ($loginModel->isLogged()) {
            return $this->url->redirectTo('/');
        }

        $data['errors'] = $this->validator->detachMessages();

        $view = $this->view->render('blog/users/login', $data);

        return $this->blogLayout->render($view);
    }

    /**
    * Submit Login form
    *
    * @return mixed
    */
    public function submit()
    {
        $json = [];

        if ($this->isValid()) {
            $loginModel = $this->load->model('Login');

            $loggedInUser = $loginModel->user();

            if ($loggedInUser->status === 'Désactivé') {

                $json['warnings'] = '<h3 class="text-center">Bonjour ' . $loggedInUser->first_name . '</h3><div class="text-center">je suis désolé de vous informer que votre Compte est désactivé en ce moment, contacter moi pour résoudre le problème <div> <a class="btn" href="'.$this->url->link('/contact-me').'"><i class="align-middle fa fa-share-square fa-2x"></i></a>';

                return $this->json($json);
            }

            if ($this->request->post('remember')) {
                // Save login data in cookie
                $this->cookie->set('login', $loggedInUser->code);
            } else {
                //Save login data in session
                $this->session->set('login', $loggedInUser->code);
            }

            $json['success']  = 'Bienvenue ' . $loggedInUser->first_name;

            $json['redirectTo'] = $this->url->link('/');

            return $this->json($json);
        } else {

            $json['errors'] = $this->validator->detachMessages();

            return $this->json($json);
        }
    }

    /**
    * Validate Login Form
    *
    * @return bool
    */
    private function isValid()
    {
        $this->validator->required('email', 'Veuillez insérer une adresse email')->email('email', 'Veuillez insérer une adresse email valide');
        $this->validator->required('password', 'Veuillez insérer votre mot de passe');

        $email = $this->request->post('email');
        $password = $this->request->post('password');
        
        //E-mail's form is correct & insered, password is insered 
        if($this->validator->passes()){ 
            $loginModel = $this->load->model('Login');
            $loggedInUser = $loginModel->isValidLogin($email, $password);

            //Ppassword or Email or both are not correct
            if (! $loggedInUser) {
                $this->validator->message('Les données de connexion ne sont pas valides');
            }
        }

        return $this->validator->passes();
    }
}