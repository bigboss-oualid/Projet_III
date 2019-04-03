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
     * Cookies Path
     *
     * @var string
     */
    private $path = '/';

     /**
     * Constructor
     *
     * @param \System\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        /**
         *Get the path through the variable SCRIPT_NAME from $_SERVER, 
         *Remove the file 'index.php' from path to get only the directory of the script name
         */
        $this->path = dirname($this->app->request->server('SCRIPT_NAME')) ?: '/';
    }

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
        //Romove the key from cookies if $hours = -1
        $expireTime = $hours == -1 ? -1 : time() + $hours * 3600;

        //change the sixth parameter to true if SSL will be used
        setcookie($key, $value, $expireTime, $this->path, '', false, true);
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
		return array_get($_COOKIE, $key, $default);
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
		$this->set($key, null, -1);

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
		foreach (array_keys($this->all()) as $key) {
			$this->remove($key);
		}

		unset($_COOKIE);
	}
}

