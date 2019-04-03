<?php

namespace App\Controllers\Blog;

use System\Controller;

class EpisodeController extends Controller
{
     /**
     * Display Episode Page
     *
     * @param string name
     * @param int $id
     * 
     * @return mixed
     */
    public function index(string $title, int $id)
    {
        $data['success'] = $this->session->has('success') ? $this->session->pull('success') : null;
        $data['errors'] = $this->session->has('errors') ? $this->session->pull('errors') : null;

        $modelEpisode = $this->load->model('Episodes');

        $episode =  $modelEpisode->getEpisodeWithComments($id);

        // Set data if the episode exist 
        if ($episode) {
            $this->html->setTitle($episode->title);
            $data['nextEpisode'] = $modelEpisode->getPaginationEpisode($id, 'next', $episode->chapter_id);
            $data['previousEpisode'] = $modelEpisode->getPaginationEpisode($id, 'previous', $episode->chapter_id);
        }


        //Set view's number with session
        if(! $this->session->has('view_' .  $episode->id) ) {

            $this->session->set('view_' .  $episode->id, 1);
            $old_views = $episode->views;
            //Increment View
            $new_views = abs( $old_views ) + 1;
            $modelEpisode->updateViews( $episode->id, $new_views, $old_views);
        }
        
        $loginModel = $this->load->model('Login');
        $this->blogLayout->disable('sidebar');

        if (! $episode) {
            return $this->url->redirectTo('/404');
        }



        $data['episode'] = $episode;
        $data['login'] = $loginModel->isLogged();

        $data['related_episodes'] = $this->getRelatedEpisodes($episode);

        $data['user'] = $loginModel->user();

        $view = $this->view->render('blog/episode', $data);

        return $this->blogLayout->render($view);
    }

    /**
     * Get all Related Episodes for one episode
     *
     * @param stdClass $episode
     *
     * @return array
     */
    private function getRelatedEpisodes($episode): array
    {
        $modelEpisode = $this->load->model('Episodes');
        //Get related episodes ID
        if ($episode->related_episodes) {
            //separate id
            $episodesIds = explode(",", $episode->related_episodes);

            $relatedEpisodes = [];
            //Store related episodes
            foreach ($episodesIds as $episodeId) {
                $episode = $modelEpisode->getEpisode((int)$episodeId);
                
                if ($episode->status == 'Activé') {
                    $relatedEpisodes[] = $episode;
                }
            }

            return $relatedEpisodes;
        }
        return [];
    }

     /**
     * Add New Comment to the given episode
     *
     * @param string $title
     * @param int $id
     * 
     * @return mixed 
     */
    public function addComment(string $title, int $id)
    {
        if ($this->isValid($id)) {

            $comment = $this->request->post('comment');

            $episodesModel = $this->load->model('Episodes');
            $loginModel = $this->load->model('Login');

            $episode = $episodesModel->get($id);
            
            //Avoid adding invalid comment
            if (! $episode OR $episode->status == 'Désactivé' OR ! $comment) {
                return $this->url->redirectTo('/404');
            }

            //logged, get info from user
            if ($loginModel->isLogged()) {
                $user = $loginModel->user();
                $episodesModel->addNewComment($id, $comment, $user->email, $user->id);

            }else {

                //Not logged, prepare infos for visitor
                $message =  'Votre commentaire est en attente de modération, pour que vos commentaires soient directement afficher veuillez vous <strong><a href="' . $this->url->link('/register') . '">s\'inscrire ?</a></strong> ';
                $ip      = $this->request->server('REMOTE_ADDR');
                $email   = $this->request->post('email');

                $episodesModel->addNewComment($id, $comment, $email, $ip);
                $this->session->set('success', $message);
            }
            return $this->url->redirectTo('/episode/' . $title . '/' . $id . '#comments');
        } else {

            $this->session->set('errors', $this->validator->detachMessages());
            return $this->url->redirectTo('/episode/' . $title . '/' . $id . '#comments');
        }
    }

    /**
    * Report comment
    *
    * @param int $id
    *
    * @return string
    */
    public function reportComment(int $id): string
    {
        $commentModel = $this->load->model('Comments');

        if(! $commentModel->exists($id)) {
            return $this->url->redirectTo('/404');
        }

        $comment = $commentModel->getComment($id);

        $episodeTitle = $comment->episode;
        $episodeId    = $comment->episode_id;

        //Get number of times that comment has been reported
        $reported = $comment->reported;

        //Increment reported value with 1
        $commentModel->update($id, $reported);

        return $this->url->redirectTo('/episode/' . seo($episodeTitle) . '/' . $episodeId . '#comments');;
    }

     /**
     * Load the episode box view for the given episode
     *
     * @param \stdClass $episode
     * 
     * @return string
     */
    public function box($episode): string
    {
        return $this->view->render('blog/episode-box', compact('episode'));
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
        $this->validator->required('comment', 'le champs commentaire est vide')->minLen('comment', 6, 'Le commentaire doit être composé de 6 caractères au minimum');

        $loginModel = $this->load->model('Login');

        if (! $loginModel->isLogged()) {
            $this->validator->required('email', 'Vous devez laisser votre adresse e-mail ou <strong><a href="' . $this->url->link('/login') . '">se connecter ?</a></strong>');
        }

        return $this->validator->passes();
    }
}