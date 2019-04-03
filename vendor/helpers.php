<?php

use System\Application;

if (! function_exists('pre')) {
	/**
	 * Visualize the given variable in browser and exit the application 
	 *
	 * @param mixed   $var default exit the pallicaion or send 0 to continue
	 * @param mixed $stop
	 * 
	 * @return void
	 */
	function pre($var, $stop = 1): void
	{
		echo '<pre>';
		var_dump($var);
		print_r($var);
		echo '</pre>';

		if ($stop){
			die();	
		} 
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
	 * 
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

if(! function_exists('urlHtml')) {
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

if (! function_exists('read_more')) {
    /**
    * Cut the given string and get the given number of words from it
    *
    * @param string $string
    * @param int $words_number
    * 
    * @return string
    */
    function read_more(string $string, int $words_number): string
    {
        // Remove any empty values in the exploded array
        $words_in_string = array_filter(explode(' ' , $string));

        if (count($words_in_string) <= $words_number) {
        	//return the whole string
            return $string;
        }

        $cutedContent = implode(' ', array_slice($words_in_string, 0, $words_number));

        return $cutedContent . '...';

    }
}

if (! function_exists('seo')) {
     /**
     * Remove any unwanted characters from the given string
     * and replace it with -
     *
     * @param string $string
     * 
     * @return string
     */
    function seo(string $string): string
    {
        // remove any white spaces from the beginning & the end of the given string
        $string = trim($string);

        // replace any non alphabe or numeric characters and dashes with white space
        $string = preg_replace('#[^\w]#', ' ' , $string);

        // replace any multi white spaces with just one white space
        $string = preg_replace('#[\s]+#', ' ', $string);

        $string = str_replace(' ', '-', $string);

        // make all letters in small case letters & trim any dashes
        return trim(strtolower($string), '-');
    }
}


if (! function_exists('getMessage')) {

     /**
	 * Get message for how much comment are reported or disabled
	 *
	 * @param int $number
	 * @param string $type
	 *
	 * @return string  message
	 */
	function getMessage(int $number, string $type): string
	{
		$message = ''; 
		
			if ($number > 0 AND $number < 2 ) {
        		$message= '<span class="news-dash badge">'. $number .'</span><span> ' .$type . '  </span>' ;
        	}elseif ($number > 1) {
        		$message = '<span class="news-dash badge">'. $number .'</span><span> ' .$type . 's  </span>' ;
        	}

		return $message;
	}
}
