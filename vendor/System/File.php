<?php

namespace System;

class File
{

	/**
	 * place the default Directory Separator from operating system
	 *
	 * @const string
	 */
	const DS = DIRECTORY_SEPARATOR;

	/**
	 * Root Path
	 * 
	 * @var string
	 */
	private $root;

	/**
	 *Constructor
	 * 
	 * @param string $root 
	 */
	public function __construct(string $root)
	{
		$this->root = $root;
	}

	/**
	 * Determine wether the given file path exists
	 * 
	 * @param  string $file
	 * @return bool
	 */
	public function exists(string $file): bool
	{
		return file_exists($file);
	}

	/**
	 * require the given file
	 * 
	 * @param  string $file
	 * @return void
	 */
	public function require(string $file): void
	{
		require $file;
	}

	/**
	 * Generate full path to the given path in vendor folder
	 * 
	 * @param  string $path 
	 * @return string
	 */
	public function toVendor(string $path): string
	{
		return $this->to('vendor/' . $path);
	}

	/**
	 * Generate full path to the given path and separate the folders with the default DS of operating system
	 * 
	 * @param  string $path 
	 * @return string
	 */
	public function to(string $path): string
	{
		return $this->root . static::DS . str_replace(['/', '\\'], static::DS, $path);
	}
}