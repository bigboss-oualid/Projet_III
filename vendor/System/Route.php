<?php 

namespace System;

class Route
{
	/**
	 * Application Object
	 * 
	 * @var \system\Application
	 */
	private $app;

	/**
	 * Routes Container
	 * 
	 * @var array
	 */
	private $routes = [];

	/**
	 * Not found Url
	 * 
	 * @var string
	 */
	private $notFound;

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
	 * Add new Route
	 * 
	 * @param  string  $url           
	 * @param  string  $action        
	 * @param  string  $requestMethod  POST or GET  
	 * @return void             
	 */
	public function add(string $url, string $action,string $requestMethod = 'GET'): void
	{
		$route = [
			'url'        => $url,
			'pattern'    => $this->generatePattern($url),
			'action'     => $this->getAction($action),
			'method'     => strtoupper($requestMethod),
		];

		$this->routes[] = $route;
	}

	/**
	 * Generate a regex pattern for the given url
	 * 
	 * @param  string $url 
	 * @return string
	 */
	private function generatePattern(string $url): string
	{
		$pattern = '#^';

		
		$pattern .= str_replace([':text', ':id'], ['([a-zA-Z0-9-]+)', '(\d+)'], $url);

		$pattern .= '$#';

		return $pattern;
 	}

 	/**
	 * Get the proper action
	 * 
	 * @param  string $action
	 * @return string
	 */
	private function getAction(string $action): string
	{
		$action = str_replace('/', '\\', $action);

		return strpos($action, '@') !== false ? $action : $action . '@index';
	}

	/**
	 * [notFound description]
	 * @param  string $url [description]
	 * @return void
	 */
	public function notFound(string $url): void
	{
		$this->notFound = $url;
	}

	/**
	 * Get proper route
	 * 
	 * @return array
	 */
	public function getProperRoute(): array
	{
		foreach ($this->routes as $route ) {
			if ($this->isMatching($route['pattern'])) {
				$arguments = $this->getArgumentsFrom($route['pattern']);
				// controller@method
				$gool= list($controller, $method) = explode('@', $route['action']);
				return [$controller, $method, $arguments];
			}
		}
	}

	/**
	 * Determine if the given pattern matches the current request url
	 * 
	 * @param  string  $pattern
	 * @return boolean
	 */
	private function isMatching(string $pattern): bool
	{
		return preg_match($pattern, $this->app->request->url());
	}


	/**
	 * Get Arguments from the current request url based on the given pattern
	 * 
	 * @param  string $pattern
	 * @return array
	 */
	private function getArgumentsFrom(string $pattern)
	{
		preg_match($pattern, $this->app->request->url(), $matches);
		array_shift($matches);

		return $matches;
	}
}