<?php

namespace App\Controllers\Blog;

use System\Controller;

class ProfileController extends Controller
{
	/**
     * Display profile Page
     *
     * @return mixed
     */
    public function index()
    {
        $loginModel = $this->load->model('Login');

        $loginModel->isLogged();

        //Avoid register page if it's logged
        if (isset($loginModel)) {
            if (! $loginModel->isLogged()) {
                return $this->url->redirectTo('/');
            }
        }

        $data['user'] = $loginModel->user();

        $this->blogLayout->title('Administrer votre compte');

        $view = $this->view->render('blog/users/profile', $data);

        //Disable sidebar
        $this->blogLayout->disable('sidebar');

        return $this->blogLayout->render($view);
    }

	/**
    * Modify the given user by ID
    *
    * @return string
    */
    public function save()
    {
    	$loginModel = $this->load->model('Login');
        $loginModel->isLogged();

        //Get the current user object from the login Model in order to get the right id
		$user = $loginModel->user();
        if ($this->isValid($user->id)) {			
            //No errors in form validation
            $message = $this->load->model('Users')->update($user->id, $user->users_group_id);

             $json['success'] = $message;

            $json['redirectTo'] = $this->url->link('/profile');
        } else {
            //Errors are founded in form validation
            $json['errors'] = $this->validator->detachMessages();
        }

        return $this->json($json);
    }

	/**
	 * Validate the form
	 * 
	 * @param int $id user already exist
	 *
	 * @return boolean
	 */
	public function isValid(int $id = null): bool
	{
		$this->validator->required('first_name', 'Le pénom est nécessaire.');
		$this->validator->required('last_name', 'Le nom est nécessaire.');
		$this->validator->required('email')->email('email');
		$this->validator->unique('email', ['users', 'email', 'id', $id ], 'Cet adresse Email est déjà utilisé pour un autre compte');
		if ($this->request->post('password')) {
			$this->validator->required('password')->minLen('password',8)->match('password', 'confirm_password', 'les deux mots de passe doivent être identiques');
		}
		
		$this->validator->image('image');
	

		return $this->validator->passes();
	}

}