<?php

namespace System;

class Cookie
{
	/**
	 * Application Object
	 * 
	 * @var \system\Application
	 */
	private $app;

	/**
	 * Set new value to cookie
	 * 
	 * @param string $key
	 * @param mixed  $value
	 * @param int    $hours As defaults 3 Month
	 *
	 * @return void
	 */
	public function set(string $key, $value, int $hours = 2160): void
	{
		//change the sixth parameter to true if you have SSL
		setcookie($key, $value, time() + ($hours * 3600), '', '', false, true);
	}

	/**
	 *  Get value from Cookies Cookie by the given key
	 *  
	 * @param  string       $key
	 * @param  mixed | null $default
	 * 
	 * @return mixed
	 */
	public function get(string $key, $default = null)
	{
		array_get($_COOKIE, $key, $default);
	}

	/**
	 * Determine if the given key exists in Cookie
	 
	 * @param  string  $key
	 * 
	 * @return boolean 
	 */
	public function has(string $key): bool
	{
		return array_key_exists($key, $_COOKIE);
	}

	/**
	 * Remove the given key from cookies
	 * 
	 * @param  string $key
	 * 
	 * @return void
	 */
	public function remove(string $key): void
	{
		setcookie($key, null, -1);

		unset($_COOKIE[$key]);
	}

	/**
	 * Get all Cookies data
	 * 
	 * @return array
	 */
	public function all(): array
	{
		return $_COOKIE;
	}

	/**
	 * Remove All Cookies
	 * 
	 * @return void
	 */
	public function destroy(): void
	{
		foreach ($array_keys($this-all()) as $key) {
			$this->remove($key);
		}

		unset($_COOKIE);
	}
}

