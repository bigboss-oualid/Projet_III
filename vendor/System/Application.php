<?php

namespace System;

use Closure;

class Application
{

	/**
	 * Save Object or mixed data
	 * 
	 * @var array
	 */
	private $container = [];

	/**
	 * Application Object
	 * 
	 * @var \System\Application
	 */
	private static $instance;

	/**
	 * Constructor
	 * 
	 * @param \System\File $file 
	 */
	private function __construct(File $file)
	{
		$this->share('file', $file);

		$this->registerClasses();

		$this->loadHelpers();
	}

	/**
	 * Get Application Instance
	 *
	 * @param \System\File $file 
	 * 
	 * @return \System\Application
	 */
	public static function getInstance(File $file = null)
	{
		if (is_null(static::$instance)) {
			static::$instance = new static($file);
		}
		return static::$instance;
	}


	/**
	 * run the Application leads to a session start
	 * 
	 * @return void
	 */
	public function run(): void
	{
		$this->session->start();

		$this->request->prepareUrl();

		$this->file->call('App/index.php');

		list($controller, $method, $arguments) = $this->route->getProperRoute();

		if($this->route->hasCallsFirst()){
			$this->route->callFirstCalls();
		}

		$output = (string) $this->load->action($controller, $method, $arguments);

		$this->response->setOutput($output);

		$this->response->send();
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
	 * Load Class through autoloading
	 * 
	 * @param  string  $class 
	 * 
	 * @return void
	 */
	public function load(string $class): void
	{
		//get the class from App folder 
		if (strpos($class, 'App') === 0) {
			$file = $class . '.php';
		}else{
			// get the class from vendor folder
			$file = 'vendor/' . $class . '.php';
		}

		if ($this->file->exists($file)) {
				$this->file->call($file);
			}
	}

	/**
	 * Load Helpers File
	 * 
	 * @return void
	 */
	private function loadHelpers(): void
	{
		$this->file->call('vendor/helpers.php');
	}

	/**
	 * Get all core classes with its aliases
	 * 
	 * @return array ['Alias' => '\\Path...\\file']
	 */
	private function coreClasses(): array
	{
		return [
			'request'     => 'System\\Http\\Request',
			'response'	  => 'System\\Http\\Response',	
			'session'     => 'System\\Session',
			'route'       => 'System\\Route',
			'load'        => 'System\\Loader',
			'cookie'      => 'System\\Cookie',
			'html'        => 'System\\Html',
			'view'        => 'System\\View\\ViewFactory',
			'db'          => 'System\\Database',
			'url'         => 'System\\Url',
			'validator'   => 'System\\Validation',
			'pagination'  => 'System\\Pagination',
		];
	}

	/**
	 * Determine if the given key is an alias to core class
	 *  
	 * @param  string  $alias
	 * 
	 * @return bool  
	 */
	private function isCoreAlias(string $alias): bool
	{
		$coreClasses = $this->coreClasses();

		return isset($coreClasses[$alias]);
	}

	/**
	 * Creat new object for the core class based on the given alias, and pass the Application to his constructor
	 * 
	 * @param  string $alias
	 * 
	 * @return mixed 
	 */
	private function createNewCoreObject(string $alias)
	{
		$coreClasses = $this->coreClasses();
		$object = $coreClasses[$alias];

		return new $object($this);
	}

	/**
	 * Share the given key|value (files) through the Application
	 * 
	 * @param  string $key
	 * @param  mixed $value
	 * 
	 * @return mixed 
	 */
	public function share(string $key, $value)
	{	
		if($value instanceof Closure) {
			$value = call_user_func($value, $this);
		}
		$this->container[$key] = $value;
	}

	/**
	 * Determine if the given key is shared through Application means is it saved in the $container[$key] ?
	 * 
	 * @param  string $key
	 * 
	 * @return bool 
	 */
	public function isSharing(string $key): bool
	{
		return isset($this->container[$key]);
	}

	/**
	 * Get the shared value of the property
	 * 
	 * @param  string $key
	 * 
	 * @return mixed      
	 */
	public function get(string $key)
	{
		if(! $this->isSharing($key)) {
			if ($this->isCoreAlias($key)) {
				$this->share($key, $this->createNewCoreObject($key));
			} else {
				die('<b>' . $key . '</b> not found in application Container, look the coreClasses() function for more details');
			}
		}
		return $this->container[$key];
	}

	/**
	 * Get shared value dynamically when the property doesn't exist in this file 
	 * 
	 * @param  string $key
	 * 
	 * @return mixed
	 */
	public function __get(string $key)
	{
		return $this->get($key);
	}
}