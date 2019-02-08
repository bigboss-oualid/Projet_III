<?php

namespace System\Http;

use System\Application;

class Response
{
	/**
	 * Application Object
	 * 
	 * @var \System\Application
	 */
	private $app;

	/**
	 * Headers container that will be send to the browser
	 * 
	 * @var array
	 */
	private $headers = [];

	/**
	 * the Content that will be sent to the browser
	 * 
	 * @var string
	 */
	private $content = '';

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
	 * Set the response output content
	 * 
	 * @param string $content 
	 */
	public function setOutput(string $content): void
	{
		$this->content = $content;
	}

	/**
	 * Add new header that will be sent to the browser
	 * 
	 * @param  $header
	 * @param  $value 
	 */
	public function setHeader($header, $value): void
	{
		$this->headers[$header] = $value;
	}

	/**
	 * Send the response Headers
	 * 
	 * @return void
	 */
	private function sendHeaders(): void
	{
		foreach ($this->headers as $header => $value) {
			header($header . ':' . $value);
		}
	}

	/**
	 * Send the response output
	 * 
	 * @return void
	 */
	private function sendOutput(): void
	{
		echo $this->content;
	}

	/**
	 * Send the response headers & content 
	 * 
	 * @return void
	 */
	public function send(): void
	{
		$this->sendHeaders();

		$this->sendOutput();
	}		
}