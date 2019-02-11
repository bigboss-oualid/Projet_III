<?php

use System\Application;

if (! function_exists('pre')) {
	/**
	 * Visualize the given variable in browser
	 *
	 * @param mixed $var
	 * @return void
	 */
	function pre($var): void
	{
		echo '<pre>';
//		var_dump($var);
		print_r($var);
		echo '</pre>';
	}
}

if(! function_exists('array_get')) {
	/**
	 * Get the value from the given array for the given key if found otherwise 
	 * get the defaultvalue
	 * 
	 * @param  array        $array
	 * @param  string|int   $key
	 * @param  mixed        $default
	 * @return mixed
	 */
	function array_get(array $array, $key, $default = null)
	{
		return isset($array[$key]) ? $array[$key] : $default;
	}
}

if(! function_exists('_escape')) {
	/**
	 * Escape the given value
	 * 
	 * @param  string | null  $value
	 * 
	 * @return string
	 */
	function _escape(string $value = null): string
	{
		return htmlspecialchars($value);
	}
}

if(! function_exists('assets')) {
	/**
	 * Generate full path for the given path in public directory
	 * 
	 * @param  string  $path
	 * 
	 * @return string
	 */
	function assets(string $path): string
	{
		$app = Application::getInstance();

		return $app->url->link('public/' . $path);
	}
}

if(! function_exists('urlHtm')) {
	/**
	 * Generate full path for the given path
	 * 
	 * @param  string  $path
	 * 
	 * @return string
	 */
	function urlHtml(string $path): string
	{
		$app = Application::getInstance();

		return $app->url->link($path);
	}
}