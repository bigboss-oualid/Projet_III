<?php

namespace App\Models;

use System\Model;

class SearchModel extends Model
{
	/**
	 * Get result of search in episodes or Chapters
	 *
	 * @return array
	 */
	public function search(array $searchTermBits): array
	{
        $where = implode(' AND ', $searchTermBits);

       return  $this->select('e.* ',  'c.name AS `chapter`')
                    ->from('episodes e')
                    ->join('LEFT JOIN chapters c ON e.chapter_id=c.id')
                    ->where('e.status = "Activé" AND '. $where)
                    ->fetchAll();
	}

}
