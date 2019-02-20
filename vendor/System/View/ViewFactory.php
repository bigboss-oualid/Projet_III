<?php

namespace System\View;

use System\Application;

class ViewFactory
{	
	/**
	 * Application Object
	 * 
	 * @var \System\Application
	 */
	private $app;
	
	/**
	 * Constructor
	 *
	 * @param \System\Application $app
	 */
	function __construct(Application $app)
	{
		$this->app = $app;
	}

	/**
	 * Render the given view path with the passed variables and generate 
	 * new View Object for it
	 * 
	 * @param  string $viewPath
	 * @param  array  $data Passed variable to view 
	 * 
	 * @return \System\View\ViewInterface                
	 */
	public function render(string $viewPath, array $data = []): ViewInterface
	{
		return new View($this->app->file, $viewPath, $data);
	}
}