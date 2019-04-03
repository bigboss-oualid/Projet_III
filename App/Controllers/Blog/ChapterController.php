<?php

namespace App\Controllers\Blog;

use System\Controller;

class ChapterController extends Controller
{
     /**
     * Display Chapter Page
     *
     * @param string name
     * @param int $id
     * 
     * @return mixed
     */
    public function index($title, $id)
    {
        $chapter = $this->load->model('Chapters')->getChapterWithEpisodes($id);

        if (! $chapter) {
            return $this->url->redirectTo('/404');
        }

        $this->html->setTitle($chapter->name);

        if ($chapter->episodes) {
            $chapter->episodes = array_chunk($chapter->episodes, 2);
        } else {
            if ($this->pagination->page() != 1) {
                //redirect to the first page of the chapter
                return $this->url->redirectTo("/chapter/$title/$id");
            }
        }

        $data['chapter'] = $chapter;

        $episodeController = $this->load->controller('Blog/Episode');

        // pass the $episode variable to $episode_box variable in the view file
        // in order that the anonymous function call the box method from controller,
        // when it it will be called 
        // then it will pass to it the "$episode" variable to be used in the episode-box view
        $data['episode_box'] = function ($episode) use ($episodeController) {
            return $episodeController->box($episode);
        };

        $data['url'] = $this->url->link('/chapter/' . seo($chapter->name) . '/' . $chapter->id . '?page=');

        $data['pagination'] = $this->pagination->paginate();

        $view = $this->view->render('blog/chapter', $data);

        return $this->blogLayout->render($view);
    }
}