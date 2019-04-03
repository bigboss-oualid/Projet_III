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
	 * Errors container
	 *
	 * @var array
	 */
	protected $errors = [];
	
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
	 * Encode the given value to Json
	 *
	 * @param mixed $data
	 *
	 * @return string
	 */
	public function json($data): string
	{
		return json_encode($data);
	}

	/**
	 * Call shared Application Objects dynamically
	 *
	 * @param string  $key
	 * @return mixed
	 */
	public function __get(string $key)
	{
		return $this->app->get($key);
	}
	
} 