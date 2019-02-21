<?php

namespace System\View;

interface ViewInterface
{
	/**
	 * Generate the output of the view path and get it
	 * 
	 * @return string
	 */
	public function getOutput(): string;

	/**
	 * convert the "System\View\View" object to string in printing
	 * i.e echo $object
	 *  
	 * @return 
	 */
	public function __toString(): string;

}