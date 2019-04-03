<?php

namespace App\Controllers\Blog;

use System\Controller;

class AboutMeController extends Controller
{
	public function index()
	{
		$this->blogLayout->title('Apropos de moi');

        $view = $this->view->render('blog/about-me');

        // Disable sidebar from page
        $this->blogLayout->disable('sidebar');

        return $this->blogLayout->render($view);		
	}
}