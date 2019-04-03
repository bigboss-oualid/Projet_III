<?php

namespace App\Controllers\Admin;

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
		/*
		//Create SUPERADMIN manually 		
		$this->db->data([
			'email'		=> 'mail@mail.com',
			'password'	=> password_hash('my_password', PASSWORD_DEFAULT),
			'created'	=> time(),
			'status'	=> 'activé',
		])->insert('users');
		*/
	
		$loginModel = $this->load->model('Login');

		if ($loginModel->isLogged()) {
			return $this->url->redirectTo('/admin');
		}
		$data['errors'] = $this->validator->detachMessages();

		return $this->view->render('admin/users/login', $data);
	}

	/**
	 * Submit Login form
	 *
	 * @return   mixed  
	 */
	public function submit()
	{
		if ($this->isValid()) {

			$loginModel = $this->load->model('Login');

			$loggedInUser = $loginModel->user();

			if ($loggedInUser->status === 'Désactivé') {
				$json = [];
				$json['warnings'] = '<h3>Bonjour ' . $loggedInUser->first_name . '</h3><div class="text-center">je suis désolé de vous informer que votre Compte est désactivé en ce moment, contacter moi pour résoudre le problème <div> <a class="btn" href="'.$this->url->link('/contact-me').'"><i class="align-middle fa fa-share-square fa-2x"></i></a>';
				return $this->json($json);
			}

			if ($this->request->post('remember')) {
				//save login data in $_COOKIE
				$this->cookie->set('login', $loggedInUser->code);
			} else {
				//save login data in $_SESSION
				$this->session->set('login', $loggedInUser->code);
			}
			
			$json = [];
			$json['success'] = 'Bienvenue ' . $loggedInUser->first_name;

			$json['redirect'] = $this->url->link('/admin');

			return $this->json($json);
		} else {
			$json = [];

			$json['errors'] = $this->validator->detachMessages();

			return $this->json($json);
		}

	}

	/**
	 * Validate Login Form
	 *
	 * @return boolean
	 */
	public function isValid(): bool
	{
		$this->validator->required('email', 'Veuillez insérer une adresse email')->email('email', 'Veuillez insérer une adresse email valide');
		$this->validator->required('password', 'Veuillez insérer votre mot de passe');

		$email = $this->request->post('email');
		$password = $this->request->post('password');

		
		//E-mail's form is correct & insered, password is insered 
		if($this->validator->passes()){	
			$loginModel = $this->load->model('Login');
			$loggedInUser = $loginModel->isValidLogin($email, $password);

			if (! $loggedInUser) {
				$this->validator->message('Les données de connexion ne sont pas valides');
			}
		}

		return $this->validator->passes();
	}
}