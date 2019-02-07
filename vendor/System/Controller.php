<?php 

namespace System;

abstract class Controller
{
	/**
	 * Application Object
	 * 
	 * @var \System\Application
	 */
	protected $app;
	
	/**
	 * Constructor
	 * 
	 * @param \System\Application $app 
	 */
	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	/**
	 * Call shared Application bjects dynamically
	 *
	 * ´@param string  $key
	 * @return mixed
	 */
	public function __get(string $key)
	{
		return $this->app->get($key);
	}

} 