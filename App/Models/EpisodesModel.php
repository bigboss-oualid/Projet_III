<?php

namespace App\Models;

use System\Model;

class EpisodesModel extends Model
{
	/**
	 * Get all episodes
	 *
	 * @return array
	 */
	public function all(): array
	{
		return $this->select('e.*', 'c.name AS `chapter`', 'u.first_name', 'u.last_name')
					->select('(SELECT COUNT(co.id) FROM comments co WHERE co.episode_id=e.id) AS total_comments')
				    ->from('episodes e')
				    ->join('LEFT JOIN chapters c ON e.chapter_id=c.id')
				    ->join('LEFT JOIN users u ON e.user_id=u.id')
				    ->fetchAll();
	}

	/**
     * Get all the most watched episodes with the name of the chapter
     *
     * @param int $limit
     *
     * @return array
     */
	public function getMoreViewed(int $limit): array
	{
		return $this->select('e.*', 'ch.name AS `chapter`', 'ch.status AS `id_chapter`')
					->from('episodes e')
					->join('LEFT JOIN chapters ch ON e.chapter_id=ch.id')
					->where('e.status=? AND ch.status=? AND e.views >?' , 'Activé','Activé', '0')
					->orderBy('e.views', 'DESC')
					->limit( $limit)
	                ->fetchAll();
	}

	 /**
     * Count all Activited episodes
     *
<<<<<<< HEAD
     * @return stdClass
=======
     * @return array
>>>>>>> feature/admin
     */
    public function totalEnabled()
    {
        //Count episodes
        return $this->select('COUNT(id) AS `total_episodes`')
        			->from('episodes')
        			->where('status="Activé"')
        			->fetch();
    }

	 /**
     * Get latest episodes
     *
<<<<<<< HEAD
     * @param string $limit
     *
     * @return array
     */
    public function latest(int $limit = 0): array
=======
     * @return array
     */
    public function latest(int $limit = 0)
>>>>>>> feature/admin
    {
        //Get the latest added episodes
        return $this->select('e.*', 'c.name AS `chapter`', 'u.first_name', 'u.last_name')
                    ->select('(SELECT COUNT(co.id) FROM comments co WHERE co.episode_id=e.id AND co.status="Activé") AS total_comments')
                    ->select('(SELECT COUNT(e.id) FROM episodes e WHERE e.status="Activé") AS total_episodes')
                    ->from('episodes e')
                    ->join('LEFT JOIN chapters c ON e.chapter_id=c.id')
                    ->join('LEFT JOIN users u ON e.user_id=u.id')
                    ->where('e.status=?', 'Activé')
                    ->orderBy('e.id', 'DESC')
                    ->limit($limit)
                    ->fetchAll();
    }

	/**
	 * Create new episode record, then send success message back
	 *
	 * @return string
	 */
	public function create(): string
	{

		$image = $this->uploadImage();

		if ($image) {
			$this->data('image', $image);
		}

<<<<<<< HEAD
		$user =  $this->user;
=======
		/*$user =  $this->user;
>>>>>>> feature/admin

		if ($user->id >= 0) {
			$user_id = $user->id; 
		} else {
			$user_id = 0;
<<<<<<< HEAD
		}
=======
		}*/
>>>>>>> feature/admin
		
		$title = ucfirst($this->request->post('title'));

		$data = $this->data('title', $title)
					 ->data('user_id', $user_id)
					 ->data('details', $this->request->post('details'))
					 ->data('chapter_id', $this->request->post('chapter_id'))
					 ->data('tags', ucfirst($this->request->post('tags')))
					 ->data('status', ucfirst($this->request->post('status')))
					 ->data('related_episodes', implode(',', array_filter((array) $this->request->post('related_episodes'), 'is_numeric')))
					 ->data('created', $now = time())
					 ->insert('episodes');

		$successMessage = 'Une nouvelle épisode avec le titre <strong>' . $title .'</trong> a été créé avec succès.';
		return $successMessage;
	}

	/**
	 * Upload episode Image
	 *
	 * @return string
	 */
	public function uploadImage(): string
	{
		$image = $this->request->file('image');

		if (! $image->exists()) {
			return '';
		}
		return $image->moveTo($this->app->file->toPublic('uploads/images/episodes'));
	}

	/**
	 * Update number of Views of episode
	 *
	 * @param int $id
	 * @param int $oldViews
	 * @param int $newViews
	 *
	 * @return void
	 */
	public function updateViews(int $id, int $newViews, int $oldViews): void
	{
		if ($newViews > $oldViews) {
			$this->data('views', $newViews)
				 ->where('id=?', $id)
				 ->update('episodes');
		}
	}

	/**
	 * Update the given episodes record and send success message back
	 *
	 * @param int $id
	 *
	 * @return string
	 */
	public function update(int $id, $views = null)
	{
		$image = $this->uploadImage();

		if ($image) {
			$this->data('image', $image);
		}

		$title = ucfirst($this->request->post('title'));

		$this->data('title', $title)
			 ->data('details', $this->request->post('details'))
			 ->data('chapter_id', $this->request->post('chapter_id'))
			 ->data('tags', ucfirst($this->request->post('tags')))
			 ->data('status', ucfirst($this->request->post('status')))
			 ->data('related_episodes', implode(',', array_filter((array) $this->request->post('related_episodes'), 'is_numeric')))
			 ->where('id=?', $id)
			 ->update('episodes');

		$successMessage = 'L\'épisode "<strong>' . $title .'</trong>"" a été modifiée avec succès.';
		return $successMessage;
	}

	 /**
     * Add New Comment to the given episode
     *
     * @param int $episodeId
     * @param string $comment
     * @param string $email
     * @param mixed $userId   		ID or IP
     * 
     * @return void
     */
    public function addNewComment(int $id, string $comment, string $email, $userId): void
    {
    	$status = $this->settings->get('comments_status');

    	//Comment is added from logged user
    	if (is_numeric($userId)) {
         	$this->data('episode_id', $id)
	             ->data('comment', $comment)
	             ->data('email', $email)
	             ->data('status', 'Activé')
	             ->data('created', time())
	             ->data('user_id', $userId)
	             ->insert('comments');
        } else {
        	//Comment is added from Visitor
         	$this->data('episode_id', $id)
	             ->data('comment', $comment)
	             ->data('email', $email)
	             ->data('status', $status)
	             ->data('created', time())
	             ->data('ip', $userId)
	             ->insert('comments');

             }
    }

	 /**
     * Get episode With its comments
     *
     * @param int $id
     * 
     * @return mixed
     */
    public function getEpisodeWithComments(int $id)
    {
        $episode = $this->select('e.*', 'c.name AS `chapter`', 'u.first_name', 'u.last_name', 'u.image AS userImage')
	                    ->from('episodes e')
	                    ->join('LEFT JOIN chapters c ON e.chapter_id=c.id')
	                    ->join('LEFT JOIN users u ON e.user_id=u.id')
	                    ->where('e.id=? AND e.status=?', $id, 'Activé')
	                    ->fetch();

        if (! $episode) return null;

        //Get writer of the comment & comments themselves of one episode
        $episode->comments = $this->select('c.*', 'u.first_name', 'u.last_name', 'u.id AS userID','u.image AS userImage')
	                              ->from('comments c')
	                              ->join('LEFT JOIN users u ON c.user_id=u.id')
	                              ->where('c.episode_id=? AND c.status=?', $id, 'Activé')
	                              ->fetchAll();

        return $episode;
    }

    /**
     * Get only one episode with the corresponding chapter
     *
     * @param int $id
     *
     * @return stdClass
     */
<<<<<<< HEAD
	public function getEpisode(int $id, $link = null)
=======
	public function getEpisode(int $id)
>>>>>>> feature/admin
	{
		return $this->select('e.*', 'ch.name AS `chapter`')
					->from('episodes e')
					->join('LEFT JOIN chapters ch ON e.chapter_id=ch.id')
	                ->where('e.id=?', $id)
	                ->fetch();
	}

	/**
<<<<<<< HEAD
     * Get next or last episode
     * 
     * @param int $id
     *
     * @return stdClass
     */
	public function getPaginationEpisode(int $id, $link, $chapter_id)
	{
		$where  = ($link == 'previous')? ' chapter_id=? AND id<? AND status=? ' : ' chapter_id=? AND id>? AND status=? ';
		$order = ($link == 'previous')? ' DESC ' : 'ASC';

		return $this->select('id, title')
					->from('episodes')
	                ->where($where,  $chapter_id,  $id, 'Activé')
	                ->orderBy('id', $order)
	                ->limit(1)
	                ->fetch();
	}

	/**
=======
>>>>>>> feature/admin
     * Get all episodes with the corresponding name of its chapter
     *
     * @return array
     */
	public function getEpisodesWithChapter(): array
	{
		return $this->select('e.*', 'ch.name AS `chapter`', 'ch.status AS `id_chapter`')
					->from('episodes e')
					->join('LEFT JOIN chapters ch ON e.chapter_id=ch.id')
					->where('e.status=? AND ch.status=?' , 'Activé','Activé')
					->orderBy('chapter')
	                ->fetchAll();
	}
}