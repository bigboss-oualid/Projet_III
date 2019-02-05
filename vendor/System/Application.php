<?php

namespace System;

class Application
{

	/**
	 * save Object or mixed data
	 * @var array
	 */
	private $container = [];

	/**
	 * Constructor
	 * 
	 * @param \System\File $file 
	 */
	public function __construct(File $file)
	{
		$this->share('file', $file);

		$this->registerClasses();
		$this->loadHelpers();

		pre($this->file);
	}

	/**
	 * Register classes in spl auto load register
	 * 
	 * @return void
	 */
	private function registerClasses(): void
	{
		spl_autoload_register([$this, 'load']);
	}

	/**
	 *Load Class through autoloading
	 * 
	 * @param  string  $class 
	 * @return void
	 */
	public function load(string $class): void
	{
		//get the class from App folder 
		if (strpos($class, 'App') === 0) {
			$file = $this->file->to($class . '.php');
		}else{
			// get the class from vendor folder
			$file = $this->file->toVendor($class . '.php');
		}

		if ($this->file->exists($file)) {
				$this->file->require($file);
			}
	}

	/**
	 * Load Helpers File
	 * 
	 * @return void
	 */
	private function loadHelpers(): void
	{
		$this->file->require($this->file->toVendor('helpers.php'));
	}

	/**
	 * share the given key|value (files) through the Application
	 * 
	 * @param  string $key 
	 * @param  mixed $value 
	 * @return mixed 
	 */
	public function share(string $key, $value)
	{
		$this->container[$key] = $value;
	}

	/**
	 * Get the shared value of the property
	 * 
	 * @param  string $key
	 * @return mixed      
	 */
	private function get(string $key)
	{
		return isset($this->container[$key])? $this->container[$key] : null ;
	}

	/**
	 * Get shared value dynamically when the property doesn't exist in this file 
	 * 
	 * @param  string $key
	 * @return mixed
	 */
	public function __get(string $key)
	{
		return $this->get($key);
	}
}