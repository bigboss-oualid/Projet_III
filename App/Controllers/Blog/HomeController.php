<?php

namespace App\Controllers\Blog;

use System\Controller;

class HomeController extends Controller
{
     /**
     * Display Home Page
     *
     * @return mixed
     */
    public function index()
    {
        $settings = $this->settings;
        
        $data['episodes'] = $this->load->model('Episodes')->latest((int)$settings->get('episodes_in_home'));

        $this->html->setTitle($this->settings->get('site_name'));

        $episodeController = $this->load->controller('Blog/Episode');

        $data['episode_box'] = function ($episode) use ($episodeController) {
            return $episodeController->box($episode);
        };

        $view = $this->view->render('blog/home', $data);

        return $this->blogLayout->render($view);
    }
}