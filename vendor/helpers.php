<?php

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
		var_dump($var);
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