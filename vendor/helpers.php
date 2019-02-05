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