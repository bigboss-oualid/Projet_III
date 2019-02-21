<?php

namespace System\View;

use System\File;

class View implements ViewInterface
{
	/**
	 * File Object
	 * 
	 * @var \System\File
	 */
	private $file;

	/**
	 * Store variables that will be passed to view
	 * 
	 * @var array
	 */
	private $data = [];

	/**
	 * View Path
	 * 
	 * @var string
	 */
	private $viewPath;

	/**
	 * The Output from the view file
	 * 
	 * @var string
	 */
	private $output;

	/**
	 * Constructor
	 * 
	 * @param \System\File   $file
	 * @param string $viewPath 
	 * @param array  $data 
	 */
	function __construct(File $file, string $viewPath, array $data)
	{
		$this->file = $file;

		$this->preparePath($viewPath);

		$this->data = $data;
	}

	/**
	 * Prepare the full path for the view
	 * 
	 * @param  string $viewPath 
	 * 
	 * @return void         
	 */
	private  function preparePath(string $viewPath): void
	{
		$relativeViewPath = 'App/Views/' . $viewPath . '.php';

		$this->viewPath = $this->file->to($relativeViewPath);

		if (! $this->viewFileExists($relativeViewPath)) {
			die('<b>' . $viewPath . ' View</b> does not exists in Views directory');
		}
	}

	/**
	 * Determine if the view path exists in the view directory
	 *
	 * @param string $view
	 * @return boolean
	 */
	private function viewFileExists(string $viewPath): bool
	{
		return $this->file->exists($viewPath);
	}

	/**
	 *{@inheritDoc}
	 */
	public function getOutput(): string
	{
		if (is_null($this->output)) {
			ob_start();

			 extract($this->data);

			require $this->viewPath;

			$this->output = ob_get_clean();
		}

		return $this->output;
	}

	/**
	 *{@inheritDoc}
	 */
	public function __toString(): string
	{
		return $this->getOutput();
	}
}