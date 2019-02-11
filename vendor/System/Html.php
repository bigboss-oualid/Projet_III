<?php 

namespace System;

class Html
{
	/**
	 * Application Object
	 * 
	 * @var \System\Application
	 */
	protected $app;

	/**
	 * Html Title
	 * 
	 * @var string
	 */
	private $title;
	
	/**
	 * Html Description
	 * 
	 * @var string
	 */
	private $description;

	/**
	 * Html Keywords
	 * 
	 * @var string
	 */
	
	private $keywords;

	/**
	 * Constructor
	 * 
	 * @param \System\Application $app 
	 */
	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	/**
	 * Set Title
	 * 
	 * @param string $title
	 *
	 * @return void
	 */
	public function setTitle(string $title): void
	{
		$this->title = $title;
	}



	/**
	 * Get Title
	 * 
	 * @return string Title
	 */
	public function title(): string
	{
		return $this->title;
	}

	/**
	 * Set Description
	 * 
	 * @param string $description 
	 *
	 * @return void
	 */
	public function setDescription(string $description): void
	{
		$this->description = $description;
	}

	/**
	 * Get Description
	 * 
	 * @return string 
	 */
	public function description(): string
	{
		return $this->description;
	}

	/**
	 * Set Keywords
	 * 
	 * @param string $keywords
	 * 
	 * @return void
	 */
	public function setKeywords(string $keywords): void
	{
		$this->keywords = $keywords;
	}

	/**
	 * Get Keywords
	 * 
	 * @return string 
	 */
	public function Keywords(): string
	{
		return $this->Keywords;
	}


} 