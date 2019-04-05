<?php

namespace App\Controllers\Admin;

use System\Controller;

class CommentsController extends Controller
{
	/**
	 * Display Comments List
	 *
	 * @param int $id episode ID
	 * 
	 * @return mixed
	 */
	public function index(int $id = null)
	{
		$this->html->setTitle('Commentaires');

		$commentsModel = $this->load->model('Comments');

		$view = '' ; 

		if ($id) {
			$episodesModel = $this->load->model('Episodes');
			$data['episode'] = $episodesModel->getEpisode($id);

			$data['comments'] = $commentsModel->all($id);
			$reported_comments = $commentsModel->allReported($id);
			$reported_comments_number = $commentsModel->rows($id);

			$disabled_comments = $commentsModel->allDisabled($id);
			$disabled_comments_number = $commentsModel->rows($id);

			$data['delete_reported'] = urlHtml('/admin/comments/delete/reported/episode/' . $id);
	        $data['delete_disabled'] = urlHtml('/admin/comments/delete/disabled/episode/' . $id);

			if (! $data['comments']) {
				$data['empty'] = 'la Liste des commentaires pour cet épisode est vide.';
				$view = $this->view->render('admin/comments/list', $data);
	        } else {
	        	$data['message'] = getMessage($reported_comments_number, 'Commentaires signalé');
        		$data['warning'] = getMessage($disabled_comments_number,'Commentaires non validé');

				$view = $this->view->render('admin/comments/list', $data);
	        }
			
		}else {
			$data['comments'] = $commentsModel->all();
			$reported_comments = $commentsModel->allReported();
			$reported_comments_number = $commentsModel->rows();

			$disabled_comments = $commentsModel->allDisabled();
			$disabled_comments_number = $commentsModel->rows();

			$data['message'] = getMessage($reported_comments_number, 'Commentaires signalé');
        	$data['warning'] = getMessage($disabled_comments_number,'Commentaires non validé');

	        $data['delete_reported'] = urlHtml('/admin/comments/delete/reported');
	        $data['delete_disabled'] = urlHtml('/admin/comments/delete/disabled');

	        $view = $this->view->render('admin/comments/list', $data);
		}

	        return $this->adminLayout->render($view);
	}

	/**
	 * Delete comment or more &returned message
	 *
	 * @param mixed   $key
	 * @param int    $episodeId
	 * 
	 * @return string|json
	 */
	public function delete($key, int $episodeId = null): string
	{
		$commentsModel = $this->load->model('Comments');
		$json = [];

		if (is_numeric($key)) {
			if(! $commentsModel->exists($key)) {
				return $this->url->redirectTo('/404');
			}

			$comment = $commentsModel->get($key);

			$commentsModel->delete($key);

			$json['success'] = 'Le commentaire ID: <b>[ ' . $key . ' ]</b> a été supprimé avec succès';

		} elseif($key === 'reported') {

			$commentsModel->delete($key, $episodeId);
			$json['success'] = 'Tous les commentaires signalés ont été supprimé avec succès';
			//Redirect to the penultimate page
			$json['redirectTo'] = $this->request->referer();	

		} elseif($key === 'disabled') {
			
			$commentsModel->delete($key, $episodeId);
			$json['success'] = 'Tous les commentaires non validés ont été supprimé avec succès';
			//Redirect to the penultimate page
			$json['redirectTo'] = $this->request->referer();			
		}
		
		return $this->json($json);
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
	 * Display edit form
	 *
	 * @param int id
	 * 
	 * @return string
	 */
	public function edit(int $id): string
	{

		$commentsModel = $this->load->model('Comments');

		if(! $commentsModel->exists($id)) {
			return $this->url->redirectTo('/404');
		}

		$comment = $commentsModel->getComment($id);

		return $this->form($comment);
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
		$message = $this->load->model('Comments')->update($id);

		$json['success'] = $message;

		//Redirect to the penultimate page
		$json['redirectTo'] = $this->request->referer();
		
		return $this->json($json);
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
			$message = $this->load->model('Comments')->create();

			$json['success'] = $message;

			$json['redirectTo'] = $this->url->link('/admin/episodes/comments');
		} else {
			//Errors in form validation
			$json['errors'] = $this->validator->detachMessages();
		}
		return $this->json($json);
	}


	/**
	 * Create the form
	 *
	 * @param \stdClass $comment
	 *
	 * @return string
	 */
	private function form($comment = null): string
	{

		$data['submit'] = $comment ? 'Modifier' : 'Ajouter';

		if ($this->user->id == 1) {
			$data['user'] = $this->user->id;			
		}

		if (!$comment) {
			//Adding form
			$data['episodesWithChapters'] = $this->load->model('Episodes')->getEpisodesWithChapter();

			$data['chapter'] = '';

			$data['target'] = 'add-comment-form';
			
			$data['action'] = $this->url->link('/admin/comments/submit/');

			$data['heading'] = 'Nouveau commentaire';

			return $this->view->render('admin/comments/form-new-comment', $data);
			
		} else {
			//Editing form
			$data['target'] = 'edit-comment-' . $comment->id ;

			$data['action'] = $this->url->link('/admin/comments/save/'. $comment->id);

			$data['heading'] = 'Modifier un commentaire sur "' . $comment->chapter. '/'.$comment->episode.'"' ;
		}

		$comment = (array) $comment;

		$data['user_last_name']   = array_get($comment, 'last_name');
		$data['user_first_name']  = array_get($comment, 'first_name');
		$data['chapter'] 		  = array_get($comment, 'chapter');
		$data['episode'] 		  = array_get($comment, 'episode');
		$data['comment']     	  = array_get($comment, 'comment');
		$data['status']      	  = array_get($comment, 'status', 'Activé');
		$data['email']            = array_get($comment, 'email');
		$data['created']          = array_get($comment, 'created');
		$data['usersIp']          = array_get($comment, 'ip');
		$data['id']          	  = array_get($comment, 'id');

		$reported = array_get($comment, 'reported');
		if ($reported == 1) {
			$data['reported']        = $reported . ' fois signalé';
		}elseif ($reported > 1) {
			$data['reported']        = $reported . ' fois signalés';
		} else {
			$data['reported']        = '';
		}

		return $this->view->render('admin/comments/form', $data);
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
		$this->validator->required('details','vous ne pouvez pas crée un commentaire sans contenu')->minLen('details', 5, 'Entrer au moin 5 caractères');

		return $this->validator->passes();
	}

	/**
	 * Display Comments List
	 * 
	 * @return mixed
	 */
	public function allReported()
	{
		$this->html->setTitle('Commentaires signalés');

		$commentsModel = $this->load->model('Comments');

		$data['comments'] = $commentsModel->allReported();
		$data['reported_comments_number'] = $commentsModel->rows();

	    $view = $this->view->render('admin/comments/list', $data);

	    return $this->adminLayout->render($view);

	}

	/**
	 * Display Comments List
	 * 
	 * @return mixed
	 */
	public function allDisabled()
	{
		$this->html->setTitle('Commentaires en attente');

		$commentsModel = $this->load->model('Comments');

		$data['comments'] = $commentsModel->allDisabled();
		$data['reported_comments_number'] = $commentsModel->rows();

	    $view = $this->view->render('admin/comments/list', $data);

	    return $this->adminLayout->render($view);
	}

}