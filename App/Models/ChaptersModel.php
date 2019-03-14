<?php

namespace App\Models;

use System\Model;

class ChaptersModel extends Model
{
	/**
	 * Create new chapter record then send success message back
	 *
	 * @return string
	 */
	public function create(): string
	{
		$nameValue = ucfirst($this->request->post('name'));
		$statusValue = ucfirst($this->request->post('status'));

		$this->data('name', $nameValue)->data('status', $statusValue)->insert($this->table);
		$successMessage = 'Le chapitre <strong>' . $nameValue .'</trong> a été créé avec success. ';
		return $successMessage;
	}

	/**
	 * Update the given chapter record and send success message back
	 *
	 * @param int $id
	 *
	 * @return string
	 */
	public function update(int $id): string
	{
		$nameValue = ucfirst($this->request->post('name'));
		$statusValue = ucfirst($this->request->post('status'));

		$this->data('name', $nameValue)
		     ->data('status', $statusValue)
		     ->where('id=?', $id)
		     ->update($this->table);

		$successMessage = 'Le chapitre numéro [<strong>' . $id . '</strong>] a été modifé avec succès ';

		return $successMessage;
	}


     /**
     * Get enabled Chapters with total number of episodes for each chapter
     *
     * @return array
     */
    public function getEnabledChaptersWithEpisodesNumber()
    {
        // Share the Chapters in the application to not call it twice in same request
        if (! $this->app->isSharing('enabled-chapters')) {
            // Get the enabled chapters
            // Add another condition that total number of episodes for each chapter
            // that should be more than zero
            $chapters = $this->select('c.id', 'c.name')
                               ->select('(SELECT COUNT(e.id) FROM episodes e WHERE e.status="Activé" AND e.chapter_id=c.id) AS total_episodes')
                               ->from('chapters c')
                               ->where('c.status=?' , 'Activé')
                               ->having('total_episodes > 0')
                               ->fetchAll();

            $this->app->share('enabled-chapters', $chapters);
        }

        return $this->app->get('enabled-chapters');
    }

     /**
     * Get chapter With episodes
     *
     * @param int $id
     * @return array
     */
    public function getChapterWithEpisodes($id)
    {
        $chapter = $this->where('id=? AND status=?', $id, 'Activé')->fetch($this->table);

        if (! $chapter) return [];

        // Get the current page
        $currentPage = $this->pagination->page();
        // Get number of items Per Page
        $limit = $this->pagination->itemsPerPage();

        // Set offset
        $offset = $limit * ($currentPage - 1);

        $chapter->episodes = $this->select('e.*', 'u.first_name', 'u.last_name')
                                ->select('(SELECT COUNT(co.id) FROM comments co WHERE co.episode_id=e.id) AS total_comments')
                                ->from('episodes e')
                                ->join('LEFT JOIN users u ON e.user_id=u.id')
                                ->where('e.chapter_id=? AND e.status=?', $id, 'Activé')
                                ->orderBy('e.id', 'DESC')
                                ->limit($limit, $offset)
                                ->fetchAll();
                                
        // Get total episodes for pagination
        $totalEpisodes = $this->select('COUNT(id) AS `total`')
                                ->from('episodes')
                                ->where('chapter_id=? AND status=?', $id, 'Activé')
                                ->orderBy('id', 'DESC')
                                ->fetch();

        if ($totalEpisodes) {
            $this->pagination->setTotalItems($totalEpisodes->total);
        }

        return $chapter;
    }
}
