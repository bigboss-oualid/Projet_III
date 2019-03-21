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

		$this->table();
	}

	/**
	 * Get the name of table
	 * 
	 * @return void
	 */
	protected function table(): void
	{
		if (is_null($this->table)) 
		{
			$parts = explode('\\', get_class($this));
			$class_name = end($parts);
			
			$this->table = strtolower(str_replace('Model', '', $class_name));
		}
	}

	/**
	 * Call shared Application objects dynamically
	 *
	 * ´@param string  $key
	 * 
	 * @return mixed
	 */
	public function __get(string $key)
	{
		return $this->app->get($key);
	}

	/**
	 * Determine if the given value of the key exists in the table
	 *
	 * @param mixed $value
	 * @param string $key
	 *
	 * @return bool
	 */
	public function exists($value, string $key = 'id'): bool
	{
		return (bool) $this->select($key)->where($key . ' = ? ', $value)->fetch($this->table);
	}

	/**
	 * Delete record by ID
	 *
	 * @param int $id
	 *
	 * @return void
	 */
	public function delete(int $id): void
	{
		$this->where('id = ?', $id)->delete($this->table);
	}

	/**
	 * Call Database methods dynamically
	 * 
	 * @param  string $method 
	 * @param  array  $args 
	 *   
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
	 * 
	 * @return \stdClass | null
	 */
	public function get(int $id)
	{
		return $this->where('id = ?', $id)->fetch($this->table);
	}

} 