<?php

namespace App\Models;

use System\Model;

class CommentsModel extends Model
{
	/**
	 * Get one comment with name of chapeter and episode
	 *
	 * @param int $id 
	 *
	 * @return stdClass
	 */
	public function getComment(int $id)
	{

		return $this->select('c.*', 'e.title AS `episode`','ch.name AS `chapter`', 'u.first_name', 'u.last_name', 'c.email')
			    ->from('comments c')
			    ->join('LEFT JOIN episodes e ON c.episode_id=e.id')
			    ->join('LEFT JOIN chapters ch ON e.chapter_id=ch.id')
			    ->join('LEFT JOIN users u ON c.user_id=u.id')
			    ->where('c.id=?', $id)
			    ->fetch();
	}

	/**
	 * Get all comments 
	 *
	 * @param int $id for episode
	 *
	 * @return array
	 */
	public function all(int $id = null): array
	{
		//All comments for one episode
		if ($id) {
			return $this->select('c.*', 'e.title AS `episode`','ch.name AS `chapter`', 'u.first_name', 'u.last_name', 'c.email')
				    ->from('comments c')
				    ->join('LEFT JOIN episodes e ON c.episode_id=e.id')
				    ->join('LEFT JOIN chapters ch ON e.chapter_id=ch.id')
				    ->join('LEFT JOIN users u ON c.user_id=u.id')
				    ->where('c.episode_id=?', $id)
				    ->orderBy('c.reported', 'DESC')
				    ->fetchAll();
			
		} else {
			//All Comments
			return $this->select('c.*', 'e.title AS `episode`', 'ch.name AS `chapter`', 'u.first_name', 'u.last_name', 'c.email')
				    ->from('comments c')
				    ->join('LEFT JOIN episodes e ON c.episode_id=e.id')
				    ->join('LEFT JOIN chapters ch ON e.chapter_id=ch.id')
				    ->join('LEFT JOIN users u ON c.user_id=u.id')
				    ->orderBy('c.reported', 'DESC')
				    ->fetchAll();
		}
		
	}

	/**
	 * Get all reported comments 
	 * 
	 * @return array
	 */
	public function allReported(int $id = null): array
	{	
		//for one episode
		if ($id) {
			return $this->select('c.*', 'e.title AS `episode`', 'ch.name AS `chapter`', 'u.first_name', 'u.last_name', 'c.email')
				        ->from('comments c')
				        ->join('LEFT JOIN episodes e ON c.episode_id=e.id')
				        ->join('LEFT JOIN chapters ch ON e.chapter_id=ch.id')
				        ->join('LEFT JOIN users u ON c.user_id=u.id')
					    ->where('c.reported>? AND c.episode_id=? ','0', $id)
	                    ->orderBy('c.id', 'DESC')
					    ->fetchAll();		
		} else {
			//for all episodes
			return $this->select('c.*', 'e.title AS `episode`', 'ch.name AS `chapter`', 'u.first_name', 'u.last_name', 'c.email')
				        ->from('comments c')
				        ->join('LEFT JOIN episodes e ON c.episode_id=e.id')
				        ->join('LEFT JOIN chapters ch ON e.chapter_id=ch.id')
				        ->join('LEFT JOIN users u ON c.user_id=u.id')
					    ->where('c.reported>?', '0')
	                    ->orderBy('c.id', 'DESC')
					    ->fetchAll();	
		}
	}

	/**
	 * Get all reported comments 
	 * 
	 * @return array
	 */
	public function allDisabled(int $id = null): array
	{	
		//for one episode
		if ($id) {
			return $this->select('c.*', 'e.title AS `episode`', 'ch.name AS `chapter`', 'u.first_name', 'u.last_name', 'c.email')
				        ->from('comments c')
				        ->join('LEFT JOIN episodes e ON c.episode_id=e.id')
				        ->join('LEFT JOIN chapters ch ON e.chapter_id=ch.id')
				        ->join('LEFT JOIN users u ON c.user_id=u.id')
					    ->where('c.status=? AND c.episode_id=? ','Désactivé', $id)
	                    ->orderBy('c.id', 'DESC')
					    ->fetchAll();		
		} else {
			//for all episodes
			return $this->select('c.*', 'e.title AS `episode`', 'ch.name AS `chapter`', 'u.first_name', 'u.last_name', 'c.email')
				        ->from('comments c')
				        ->join('LEFT JOIN episodes e ON c.episode_id=e.id')
				        ->join('LEFT JOIN chapters ch ON e.chapter_id=ch.id')
				        ->join('LEFT JOIN users u ON c.user_id=u.id')
					    ->where('c.status=?','Désactivé')
	                    ->orderBy('c.id', 'DESC')
					    ->fetchAll();	
		}
	}

	/**
	 * Update the given comment record and send success message back
	 *
	 * @param int $id
	 * @param int $reported
	 *
	 * @return mixed
	 */
	public function update(int $id, int $reported = null)
	{
		//Reported comment
		if (isset($reported)) {

			$reported += 1;

			$this->data('reported', $reported)
				 ->where('id=?', $id)
				 ->update('comments');		
		}else {
			$status = $this->request->post('status');
			$reported = $this->request->post('reported');

			$this->data('reported', $reported)
				 ->data('status', $status)
				 ->where('id=?', $id)
				 ->update('comments');
		}

		$successMessage = 'La commentaire';
		if ($reported == 0) {
			$successMessage .= ' n\'est pas signalé';
		} elseif($reported >= 0) {
			$successMessage .= ' est ' . $reported. ' fois signalé, et sa';
		}

		if ($status == 'Désactive') {
			$successMessage .= ' désactivation';
		} else {
			$successMessage .= ' validation';
		}

		$successMessage .= ' à éte modifié avec succes';

		return $successMessage;
	}

	/**
	 * Delete comment by ID or all reported disabled comments
	 *
	 * @param mixed $key the row's key in the DB table
	 * @param int $episodeId
	 * 
	 * @return void
	 */
	public function delete($key, int $episodeId = null): void
	{		
		if (is_int($key)) {
			$this->where('id = ?', $key)->delete($this->table);	
		} elseif (is_string($key)) {
			if ($episodeId) {
				$this->where('episode_id=? AND ', $episodeId);
			}
			if ($key === 'reported') {
				$this->where('reported > ?', 0 )->delete($this->table);
			} elseif ($key === 'disabled') {
				$this->where('status = ?', 'Désactivé' )->delete($this->table);
			}
			
		}
	}

	/**
	 * Create new comment record then send success message back
	 *
	 * @return string
	 */
	public function create(): string
	{
		$user = $this->user;

		if ($user->users_group_id == 1 ) {
			$status = ucfirst($this->request->post('status'));
		}else {
			$status = $this->settings;
			$status = $status->get('commentaires_status');
		}

		$this->data('user_id', $user->id)
			 ->data('episode_id', $this->request->post('episode_id'))
			 ->data('comment', ucfirst($this->request->post('details')))
			 ->data('email', $user->email)
			 ->data('created', $now = time())
			 ->data('status', $status)
			 ->data('reported', 0)
			 ->data('ip', $this->request->server('REMOTE_ADDR'))
			 ->insert('comments');

		$successMessage = 'votre commentaire est ajouté avec succèss .';

		return $successMessage;
	}
}