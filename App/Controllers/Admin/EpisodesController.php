<?php

namespace App\Controllers\Admin;

use System\Controller;

class EpisodesController extends Controller
{
	/**
	 * Display Episodes List
	 * 
	 * @return mixed
	 */
	public function index()
	{
		$this->html->setTitle('Épisodes');

		$data['episodes'] = $this->load->model('Episodes')->all();
		$data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;

		$view = $this->view->render('admin/episodes/list', $data);
	
		return $this->adminLayout->render($view);
	}

	/**
	 * Open Episodes From
	 *
	 * @return string
	 */
	public function add(): string
	{
		return $this->form();
	}

	/**
	 * Submit for creating new Episodes
	 *
	 * @return string|json
	 */
	public function submit()
	{	
		$json = [];

		if ($this->isValid()) {
			//No error in form validation
			$message = $this->load->model('Episodes')->create();


			$json['success'] = $message;

			 $json['redirectTo'] = $this->url->link('/admin/episodes');
		} else {
			//Errors in form validation
			$json['errors'] = $this->validator->detachMessages();
		}
		return $this->json($json);
	}

	/**
	 * Display edit form
	 *
	 * @param int id
	 * 
	 * @return string
	 */
	public function edit(int $id): string
	{
		$episodesModel = $this->load->model('Episodes');

		if(! $episodesModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}

		$episode = $episodesModel->get($id);

		return $this->form($episode);
	}

	/**
	 * Delete episode
	 *
	 * @param int $id
	 * 
	 * @return string|json
	 */
	public function delete(int $id): string
	{
		$episodesModel = $this->load->model('Episodes');

		if(! $episodesModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}
		$episode = $episodesModel->get($id);
		
		$episodesModel->delete($id);

		$json['success'] = 'L\'épisode <b>' . ucfirst($episode->title) . '</b> a été supprimé avec succès';

		return $this->json($json);
	}

	/**
	 * Save the given episode by ID
	 *
	 * @param int $id
	 * 
	 * @return string|json
	 */
	public function save(int $id)
	{
		if ($this->isValid($id)) {
			//No error in form validation
			$message = $this->load->model('Episodes')->update($id);

			$json['success'] = $message;

			 $json['redirectTo'] = $this->url->link('/admin/episodes');
		} else {
			//Errors in form validation
			$json['errors'] = $this->validator->detachMessages();
		}
		return $this->json($json);
	}


	/**
	 * Creat the form
	 *
	 * @param \stdClass $episodes
	 *
	 * @return string
	 */
	private function form($episode = null): string
	{	
		if ($episode) {
			//Editing form
			$data['target'] = 'edit-episode-' . $episode->id ;

			$data['action'] = $this->url->link('/admin/episodes/save/'. $episode->id);

			$data['heading'] = 'Modifier l\'épisode: ' . $episode->title ;
		} else {
			//Adding form
			$data['target'] = 'add-episode-form';
			
			$data['action'] = $this->url->link('/admin/episodes/submit/');

			$data['heading'] = 'Nouvelle épisode';
		}

		$episode = (array) $episode;

		$data['title']       = array_get($episode, 'title');
		$data['chapter_id'] = array_get($episode, 'chapter_id');
		$data['status']      = array_get($episode, 'status', 'Activé');
		$data['details']     = array_get($episode, 'details');
		$data['tags']        = array_get($episode, 'tags');
		$data['id']          = array_get($episode, 'id');

		$data['image'] = '';

		if (! empty($episode['image'])) {
			//default path to upload episode image
			$data['image'] = $this->url->link('public/uploads/images/episodes' . $episode['image']);
		}

		$data['related_episodes'] = [];
		
		if (isset($episode['related_episodes'])) {
			$data['related_episodes'] = explode(',', $episode['related_episodes']);
			
		}

		$data['chapters'] = $this->load->model('Chapters')->all();

		$data['episodes'] = $this->load->model('Episodes')->all();

		$data['submit'] = $episode ? 'Modifier' : 'Ajouter';

		return $this->view->render('admin/episodes/form', $data);
	}

	/**
	 * Validate the form
	 * 
	 * @param int $id episode already exist
	 *
	 * @return boolean
	 */
	public function isValid(int $id = null): bool
	{
		$this->validator->required('title');
		$this->validator->required('details');
		$this->validator->required('tags');

		$this->validator->unique('title', ['episodes', 'title', 'id', $id ], 'le titre est déjà utilisé par une autre épisode ');

		//call methode if the id is null in order to create new episode
		if (is_null($id)) {
			//image validation
			$this->validator->requiredFile('image')->image('image');
		} else {
			$this->validator->image('image');
		}

		return $this->validator->passes();
	}

}