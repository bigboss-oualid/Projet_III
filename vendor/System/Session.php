<?php

namespace System;

class Session
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
	 * @param system\Application $app
	 */
	
	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	/**
	 * Start Session
	 * 
	 * @return void
	 */
	public function start(): void
	{		
		// avoid attacks that use session identifiers in URLs more secure setting must be added later
		ini_set('session.use_only_cookies', 1);

		if(! session_id()) {
			session_start();
		}
	}

	/**
	 * Set new value to Session
	 * 
	 * @param string $key
	 * @param mixed $value
	 *
	 * @return void
	 */
	public function set(string $key, $value)
	{
		$_SESSION[$key] = $value;
	}

	/**
	 * Get value from session by the given key
	 *
	 * @param  mixed|null $default
	 * @param  mixed $key
	 * @return mixed
	 */
	public function get(string $key, $default = null)
	{
		return array_get($_SESSION, $key, $default);
	}

	/**
	 * Determine if the session has the given key
	 * 
	 * @param  string  $key
	 * @return bool
	 */
	public function has(string $key): bool
	{
		return isset($_SESSION[$key]);
	}

	/**
	 * Remove the given key from session
	 * 
	 * @param  string $key
	 * @return void
	 */
	public function remove(string $key): void
	{
		if($this->has($key)) {
			unset($_SESSION[$key]);
		}
	}

	/**
	 * Get value from session by the given key then remove it
	 * 
	 * @param  string $key
	 * @return mixed
	 */
	public function pull(string $key)
	{
		$value = $this->get($key);
		$this->remove($key);

		return $value;
	}

	/**
	 * Get all session data
	 * 
	 * @return array
	 */
	public function all(): array
	{
		return $_SESSION;
	}

	/**
	 * Destroy session
	 * 
	 * @return void
	 */
	public function destroy(): void
	{
		session_destroy();
		unset($_SESSION);
	}
}