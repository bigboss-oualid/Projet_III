<?php

namespace System\Http;

class Request
{
	/**
	 * Url
	 * 
	 * @var string
	 */
	private $url;

	/**
	 * Base Url
	 * 
	 * @var string
	 */
	private $baseUrl;

	/**
	 * Prepare Url and save it in the properety $baseUrl
	 * 
	 * @return void
	 */
	public function prepareUrl(): void
	{
		//pre($_SERVER); //Get information about the server
		$script = dirname($this->server('SCRIPT_NAME'));
		$requestUri = $this->server('REQUEST_URI');
		
		//save the first part from link before '?', in the variable $requestUri
		if(strpos($requestUri, '?') !== false) {
			list($requestUri, $queryString) = explode('?', $requestUri);
		}
		$this->url = preg_replace('#^' . $script . '#', '', $requestUri);

		$this->baseUrl = $this->server('REQUEST_SCHEME') . '://' . $this->server('HTTP_HOST') . $script . '/';
	}

	/**
	 * Get only relative url (clean url)
	 * 
	 * @return string
	 */
	public function url():string
	{
		return $this->url;
	}

	/**
	 * Get value from _POST by the given parameter
	 * 
	 * @param  string $parameter 
	 * @param  mixed  $default
	 * @return mixed           
	 */
	public function post(string $parameter, $default = null)
	{
		return array_get($_POST, $parameter, $default);
	}
	
	/**
	 * Get value from _GET by the given parameter
	 * 
	 * @param  string  $parameter 
	 * @param  mixed   $default
	 * @return mixed           
	 */
	public function get(string $parameter, $default = null)
	{
		return array_get($_GET, $parameter, $default);
	}

	/**
	 * Get full base Url of the script
	 * 
	 * @return string
	 */
	public function baseUrl(): string
	{
		return $this->baseUrl;
	}

	/**
	 * Get current Request Method
	 * 
	 * @return string
	 */
	public function method(): string
	{
		return $this->server('REQUEST_METHOD');
	}

	/**
	 * Get value from _SERVER by the given key
	 * 
	 * @param  string $key
	 * @param  mixed $default 
	 * @return mixed
	 */
	public function server(string $key, $default = null)
	{
		return array_get($_SERVER, $key, $default);
	}
}