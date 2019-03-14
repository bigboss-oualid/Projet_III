<?php

namespace App\Controllers\Admin;

use System\Controller;

class ChaptersController extends Controller
{
	/**
	 * Display Chapters List
	 * 
	 * @return mixed
	 */
	public function index()
	{
		$this->html->setTitle('Chapitres');

		$data['chapters'] = $this->load->model('Chapters')->all();
		$data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;
		$view = $this->view->render('admin/chapters/list', $data);
	
		return $this->adminLayout->render($view);
	}

	/**
	 * Open Chapters From
	 *
	 * @return string
	 */
	public function add(): string
	{
		return $this->form();
	}

	/**
	 * Submit for creating new Chapter
	 *
	 * @return string|json
	 */
	public function submit()
	{
		if ($this->isValid()) {
			//No error in form validation
			$message = $this->load->model('Chapters')->create();

			$json['success'] = $message;

			 $json['redirectTo'] = $this->url->link('/admin/chapters');
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
		$chaptersModel = $this->load->model('Chapters');

		if(! $chaptersModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}

		$chapter = $chaptersModel->get($id);

		return $this->form($chapter);
	}

	/**
	 * Delete chapter
	 *
	 * @param int $id
	 * 
	 * @return string|json
	 */
	public function delete(int $id): string
	{
		$chaptersModel = $this->load->model('Chapters');

		if(! $chaptersModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}
		$chapter = $chaptersModel->get($id);
		
		$chaptersModel->delete($id);

		$json['success'] = 'le chapitre <b>' . ucfirst($chapter->name) . '</b> a été supprimé avec succès';

		return $this->json($json);
	}

	/**
	 * Save the given chapter
	 *
	 * @param int $id
	 * 
	 * @return string|json
	 */
	public function save(int $id)
	{
		if ($this->isValid($id)) {
			//No error in form validation
			$message = $this->load->model('Chapters')->update($id);

			$json['success'] = $message;

			 $json['redirectTo'] = $this->url->link('/admin/chapters');
		} else {
			//Errors in form validation
			$json['errors'] = $this->validator->detachMessages();
		}
		return $this->json($json);
	}


	/**
	 * Creat the form
	 *
	 * @param \stdClass $chapter
	 *
	 * @return string
	 */
	private function form($chapter = null): string
	{	
		if ($chapter) {
			//Editing form
			$data['target'] = 'edit-chapter-' . $chapter->id ;

			$data['action'] = $this->url->link('/admin/chapters/save/'. $chapter->id);

			$data['heading'] = 'Modifier le chapitre ' . $chapter->name;
		} else {
			//Adding form
			$data['target'] = 'add-chapter-form';
			
			$data['action'] = $this->url->link('/admin/chapters/submit/');

			$data['heading'] = 'Nouveau chapitre';
		}


		$data['name'] = $chapter ? $chapter->name : null;
		$data['status'] = $chapter ? $chapter->status : null;

		$data['submit'] = $chapter ? 'Modifier' : 'Ajouter';

		return $this->view->render('admin/chapters/form', $data);
	}

	/**
	 * Validate the form
	 *
	 * @return boolean
	 */
	public function isValid(int $id = null): bool
	{
		$this->validator->required('name', 'le nom du chapitre est nécessaire.');
		
		$this->validator->unique('name', ['chapters', 'name', 'id', $id], 'le nom du chapitre est déjà pris veuillez choisir un autre nom.');

		return $this->validator->passes();
	}

}