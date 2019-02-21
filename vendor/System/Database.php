<?php 

namespace System;

use PDO;
use PDOException;

class Database
{
	/**
	 * Application Object
	 * 
	 * @var \System\Application
	 */
	private $app;

	/**
	 * PDO Connection
	 * 
	 * @var \PDO
	 */
	private static $connectionDb;

	/**
	 * Table name
	 * 
	 * @var string
	 */
	private $table;

	/**
	 * Data Container that eill be stored in database
	 * 
	 * @var array
	 */
	private $data = [];

	/**
	 * Bindings Container used in bindValue()
	 * 
	 * @var array
	 */
	private $bindings = [];

	/**
	 * Last Insert ID after insert query
	 * 
	 * @var int
	 */
	private $lastId;

	/**
	 * Wheres clause container
	 * 
	 * @var array
	 */
	private $wheres = [];


	/**
	 * Determine which column(s) will be selected
	 * 
	 * @var array
	 */
	private $selects = [];

	/**
	 * Limit the number of returned records
	 * 
	 * @var int
	 */
	private $limit;

	/**
	 * Start Getting records from this offset
	 * 
	 * @var int
	 */
	private $offset;

	/**
	 * Total Rows
	 * 
	 * @var int
	 */
	private $rows = 0;

	/**
	 * Container for join clause
	 * 
	 * @var array
	 */
	private $joins = [];

	/**
	 * Order the records
	 * 
	 * @var array
	 */
	private $orderBy = [];

	/**
	 * Constructor
	 * 
	 * @param \System\Application $app 
	 */
	public function __construct(Application $app)
	{
		$this->app = $app;

		if (! $this->isConnected()) {
			$this->connect();
		}
	}
	/**
	 * Determine if there is any connection to database
	 * 
	 * @return boolean
	 */
	private function isConnected(): bool
	{
		return static::$connectionDb instanceof PDO;
	}

	/**
	 * Connect to database
	 * 
	 * @return void 
	 */
	private function connect(): void
	{
		$parameterBd = $this->app->file->call('config.php');

		$connectionData = array_get($parameterBd, 'db');

		extract($connectionData);

		try {
			static::$connectionDb = new PDO('mysql:host=' . $server . ';dbname=' . $dbname, $dbuser, $dbpass);
			static::$connectionDb->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			static::$connectionDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			static::$connectionDb->exec('SET NAMES utf8');
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	/**
	 * Get Database Connection object PDO Object
	 * 
	 * @return \PDO
	 */
	public function connectionDb(): PDO
	{
		return static::$connectionDb;
	}

	/**
	 * Set the table name
	 * 
	 * @param string $table
	 * 
	 * @return $this
	 */
	public function table(string $table)
	{
		$this->table = $table;

		return $this;
	}

	/**
	 * Set the table name
	 * 
	 * @param string $table
	 * 
	 * @return $this
	 */
	public function from(string $table)
	{
		$this->table($table);

		return $this;
	}

	/**
	 * Get the last insert id
	 * @return int
	 */
	public function lastId(): int
	{
		return $this->lastId;
	}

	/**
	 * Set the Data that will be stored in the database table
	 * 
	 * @param mixed $key
	 * @param mixed $value
	 * 
	 * @return $this
	 */
	public function data($key, $value = null)
	{	
		if (is_array($key)) {
			$this->data = array_merge($this->data, $key);

			$this->addToBindings($key);
		}else {
			$this->data[$key] = $value;

			$this->addToBindings($value);
		}


		return $this;
	}
	/**
	 * Insert Data to database
	 *
	 * @param string $table
	 *
	 * @return $this
	 */
	public function insert(string $table = null)
	{
		if($table) {
			$this->table($table);
		}

		$sql = 'INSERT INTO ' . $this->table . ' SET ';

		$sql .= $this->setFields();

		$this->query($sql, $this->bindings);

		$this->lastId = $this->connectionDb()->lastInsertId();

		$this->reset();

		return $this;
	}

	/**
	 * Update Data in database
	 *
	 * @param string $table
	 *
	 * @return $this
	 */
	public function update(string $table = null)
	{
		if($table) {
			$this->table($table);
		}

		$sql = 'UPDATE ' . $this->table . ' SET ';

		$sql .= $this->setFields();

		if ($this->wheres) {
			$sql .= ' WHERE ' . implode(' ', $this->wheres);
		}

		$this->query($sql, $this->bindings);
		
		$this->reset();

		return $this;
	}

	/**
	 * delete Data in database
	 *
	 * @param string $table
	 *
	 * @return $this
	 */
	public function delete(string $table = null)
	{
		if($table) {
			$this->table($table);
		}

		$sql = 'DELETE FROM ' . $this->table . ' ';

		if ($this->wheres) {
			$sql .= ' WHERE ' . implode(' ', $this->wheres);
		}

		$this->query($sql, $this->bindings);

		$this->reset();

		return $this;
	}

	/**
	 * Set Select clause
	 * 
	 * @param string $select
	 * 
	 * @return $this
	 */
	public function select(...$select)
	{
		$this->selects = array_merge($this->selects, $select);

		return $this;
	}

	/**
	 * Set Join clauses
	 * 
	 * @param string $join
	 * 
	 * @return $this
	 */
	public function join(string $join)
	{
		$this->joins[] = $join;

		return $this;
	}

	/**
	 * Set Order By clause
	 * 
	 * @param string $orderBy default value = 'ASC'
	 * @param string $sort
	 * 
	 * @return $this
	 */
	public function orderBy(string $orderBy, string $sort = 'ASC')
	{
		$this->orderBy = [$orderBy, $sort];

		return $this;
	}

	/**
	 * Set Limit & Offset
	 * 
	 * @param int $Limit
	 * @param int $offset 
	 * 
	 * @return $this
	 */
	public function Limit(int $limit, int $offset = 0)
	{
		$this->limit = $limit;
		$this->offset = $offset;

		return $this;
	}

	/**
	 * Fetch Table
	 * This will return only one record
	 *
	 * @param string $table
	 *
	 * @return \stdClass | null
	 */
	public function fetch($table = null)
	{
		if($table) {
			$this->table($table);
		}
		$sql = $this->fetchStatment();

		$result = $this->query($sql, $this->bindings)->fetch();

		$this->reset();

		return $result;
	}

	/**
	 * Fetch All Records from Table
	 *
	 * @param string $table
	 *
	 * @return array
	 */
	public function fetchAll(string $table = null)
	{
		if($table) {
			$this->table($table);
		}
		$sql = $this->fetchStatment();

		$query = $this->query($sql, $this->bindings);

		$results = $query->fetchAll();

		$this->rows = $query->rowCount();

		$this->reset();

		return $results;
	}

	/**
	 * Get total rows after fetch all statment
	 * 
	 * @return int
	 */
	public function rows()
	{
		return $this->rows;
	}

	/**
	 * Prepare select Statment
	 *
	 * @return string
	 */
	private function fetchStatment()
	{
		$sql = 'SELECT ';

		if($this->selects) {
			$sql .= implode(',' , $this->selects);
		} else {
			$sql .= '*';
		}
		$sql .= ' FROM ' . $this->table . ' ';

		if($this->joins) {
			$sql .= implode(' ' , $this->joins);
		}

		if($this->wheres) {
			$sql .= ' WHERE ' . implode(' ' , $this->wheres) . ' ';
		}

		if($this->limit) {
			$sql .= ' LIMIT ' . $this->limit;
		}

		if($this->offset) {
			$sql .= ' OFFSET ' . $this->offset;
		}

		if($this->orderBy) {
			$sql .= ' ORDER BY ' . implode(' ' , $this->orderBy);
		}

		return $sql;
	}

	/**
	 * Set the Flieds for insert and update
	 *
	 * @return string
	 */
	private function setFields(): string
	{
		$sql  = '';

		foreach (array_keys($this->data) as $key) {
			$sql .= '`' . $key . '` = ? , ';
		}
		$sql = rtrim($sql, ', ');

		return $sql;
	}

	/**
	 * Add new where clause
	 * 
	 * @param  array
	 * 
	 * @return $this
	 */
	public function where(...$bindings)
	{	
		$sql = array_shift($bindings);

		$this->addToBindings($bindings);

		$this->wheres[] = $sql;

		return $this;
	}
	
	/**
	 * Execute the given sql statment
	 *
	 * @param mixed
	 * @return \PDOStatment
	 */
	public function query(...$bindings)
	{
		$sql = array_shift($bindings);

		//if i send bindings as one array ex:query('SELECT * FROM posts WHERE id > ? AND id < ?', [1,5]); 
		if (count($bindings) == 1 AND is_array($bindings[0])) {
			$bindings = $bindings[0];
		}

		try {
			$query = $this->connectionDb()->prepare($sql);

			foreach ($bindings as $key => $value) {
				$query->bindValue($key + 1, _escape($value));
			}
			$query->execute();

			return $query;
			
		} catch (PDOException $e) {
			echo $sql;

			pre($this->bindings,0);

			die($e->getMessage());
		}
	}

	/**
	 * Add teh given value to bindings
	 * 
	 * @param mixed $value
	 *
	 * @return void
	 */
	private function addToBindings($value): void
	{
		if (is_array($value)) {
			$this->bindings = array_merge($this->bindings, array_values($value));	
		} else {
			$this->bindings[] = $value;
		}
	}

	private function reset(): void
	{
		$this->table = null;
		$this->limit = null;
		$this->offset = null;
		$this->data = [];
		$this->bindings = [];
		$this->wheres = [];
		$this->joins = [];
		$this->selects = [];
		$this->orderBy = [];
	}
}
