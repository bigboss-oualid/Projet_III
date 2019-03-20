<?php

namespace App\Controllers\Blog;

use System\Controller;

class RegisterController extends Controller
{
     /**
     * Display Registration Page
     *
     * @return mixed
     */
    public function index()
    {
        $this->blogLayout->title('Inscription');

        $loginModel = $this->load->model('Login');

        //Avoid register page if it's logged
        if (isset($loginModel)) {
            if ($loginModel->isLogged()) {
                return $this->url->redirectTo('/');
            }
        }

        $this->blogLayout->title('Crée un nouveau compte');

        $view = $this->view->render('blog/users/register');

        //Disable sidebar
        $this->blogLayout->disable('sidebar');

        return $this->blogLayout->render($view);
    }

    /**
    * Submit for creating new user
    *
    * @return string | json
    */
    public function submit()
    {
        $json = [];

        //No errors in form validation
        if ($this->isValid()) {

            // set the users_group_id manually: can be added in SETTINGS            $this->request->setPost('users_group_id', 0);

            $this->load->model('Users')->create();

            $json['success'] = 'Votre compte a été crée avec success';

            $json['redirectTo'] = $this->url->link('/');
        } else {
            //Errors are founded in form validation
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
        $this->validator->required('first_name', 'Le pénom est nécessaire.');
        $this->validator->required('last_name', 'Le nom est nécessaire.');
        $this->validator->required('password','Le mot de passe est nécessaire')->minLen('password', 8)->match('password', 'confirm_password', 'les deux mots de passe doivent être identiques');
        $this->validator->required('email')->email('email');
        $this->validator->unique('email', ['users', 'email']);
        $this->validator->requiredFile('image')->image('image');

        return $this->validator->passes();
    }
}