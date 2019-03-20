<?php

namespace App\Controllers\Blog;

use System\Controller;

class SearchController extends Controller
{
    /**
     * Display Search Page
     * 
     * @return mixed
     */
    public function index()
    {
        $this->html->setTitle('Recherche');

        $data = [];
        $data['term']      = $this->request->post('term');
    
        $data['search_in'] = ucfirst($this->request->post('select-radio'));

        if ($this->isValid()){
            $modelSearch = $this->load->model('Search');

            //Search words in chapters
            if ($data['search_in'] == 'Chapters') {
                $searchInChapters = $this->searchWords( $data['term'], 'c.name');
                $data['results'] = $modelSearch->search($searchInChapters);
            }

            //Search words in episodes
            if ($data['search_in'] == 'Episodes') {
                $searchInepisodes = $this->searchWords( $data['term'], 'e.title');
                $data['results'] = $modelSearch->search($searchInepisodes);
            }
            //Search words in episodes details
            if ($data['search_in'] == 'Details') {
                $searchInepisodes = $this->searchWords( $data['term'], 'e.details');
                $data['results'] = $modelSearch->search($searchInepisodes);
            }            

            $data['number_finded'] = count($data['results']);

         }

         //if not found show all chapters with episodes
         if (empty($data['results']) or !isset($data['results'])) {

                $modelEpisodes = $this->load->model('Episodes');
                $data['results'] = $modelEpisodes->all();
                $data['not_found'] = '0';
            }
        $data['errors'] = $this->validator->detachMessages();

        $view = $this->view->render('blog/search', $data);

        return $this->blogLayout->render($view);
    }

    /**
     * Prepare "where clause" for select statment
     *
     * @param string $search   term to be searched
     * @param string $in       where
     *
     * @return array
     */
    public function searchWords(string $search, string $in): array
    {
        $searchTerms = explode(' ', $search);
        $searchTermBits = [];
        //prepare like Clauses for searchModel
        foreach ($searchTerms as $term) {
            $term = strip_tags( trim($term));
            if (!empty($term)) {
                 $searchTermBits[] = $in . " LIKE '%$term%'";
            } 
        }
        return  $searchTermBits;
    }

     /**
     * Validate the search input
     *
     * @return boolean
     */
    public function isValid(): bool
    {
        if ($this->request->post('search') === 'search') {
             $this->validator->required('term', 'Vous devez entrer votre requête dans la barre de recherche')->minLen('term',4 , 'Le Champ de rechere doit au moins contenir 4 caractères au minimum');
        }
       
        return $this->validator->passes();
    }
}