<?php 

namespace System;

abstract class Model
{
	/**
	 * Application Object
	 * 
	 * @var \System\Application
	 */
	protected $app;

	/**
	 * Table name
	 * 
	 * @var string
	 */
	protected $table;
	
	/**
	 * Constructor
	 * 
	 * @param \System\Application $app 
	 */
	public function __construct(Application $app)
	{
		$this->app = $app;

		$this->table = $this->table();

	}

	/**
	 * Get the name of table
	 * 
	 * @return string
	 */
	protected function table(): string
	{
		if (is_null($this->table)) 
		{
			$parts = explode('\\', get_class($this));
			$class_name = end($parts);
			
			return $this->table = strtolower(str_replace('Model', '', $class_name));
		}
	}

	/**
	 * Call shared Application objects dynamically
	 *
	 * ´@param string  $key
	 * @return mixed
	 */
	public function __get(string $key)
	{
		return $this->app->get($key);
	}

	/**
	 * Call Database methods dynamically
	 * 
	 * @param  string $method 
	 * @param  array  $args   
	 * @return mixed
	 */
	public function __call(string $method, array $args)
	{
		return call_user_func_array([$this->app->db, $method], $args);
	}

	/**
	 * Get all Model Records
	 * 
	 * @return array
	 */
	public function all(): array
	{
		return $this->fetchAll($this->table);
	}

	/**
	 * Get Record by Id
	 * 
	 * @param  int    $id 
	 * @return \stdClass | null
	 */
	public function get(int $id)
	{
		return $this->where('id = ?', $id)->fetch($this->table);
	}

} 