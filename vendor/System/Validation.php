<?php 

namespace System;

class Validation
{
	/**
	 * Application Object
	 *
	 * @var \System\Application;
	 */
	private $app;

	/**
	 * Errors container
	 *
	 * @var array
	 */
	private $errors = [];

	/**
	 * Constructor
	 *
	 * @param  \System\Application $app
	 *
	 * @param Application $app
	 */
	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	/**
	 * Detrmine if the given input is not empty
	 *
	 * @param string $inputName
	 * @param string $customErrorMessage
	 *
	 * @return $this
	 */
	public function required(string $inputName, string $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName)) {
			return $this;
		}

		$inputValue = $this->value($inputName);

		if ($inputValue === '') {
			$message = $customErrorMessage ?: sprintf('%s est requis', ucfirst($inputName));
			$this->addError($inputName, $message);
		}

		return $this;
	}

	/**
	 * Detrmine if the given input must be float
	 *
	 * @param string $inputName
	 * @param string $customErrorMessage
	 *
	 * @return $this
	 */
	public function float(string $inputName, string $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName)) {
			return $this;
		}

		$inputValue = $this->value($inputName);

		if (! is_float($inputValue)) {
			$message = $customErrorMessage ?: sprintf('%s accepte uniquement des nombres décimaux', ucfirst($inputName));
			$this->addError($inputName, $message);
		}

		return $this;		
	}

	/**
	 * Detrmine if the given input is valid Email
	 *
	 * @param string $inputName
	 * @param string $customErrorMessage
	 *
	 * @return $this
	 */
	public function email(string $inputName, string $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName)) {
			return $this;
		}

		$inputValue = $this->value($inputName);

		if (! filter_var($inputValue, FILTER_VALIDATE_EMAIL)) {
			$message = $customErrorMessage ?: sprintf('%s n\'est pas une adresse email valide', ucfirst($inputName));
			$this->addError($inputName, $message);
		}

		return $this;
	}

	/**
	 * Detrmine if The given input should be at least the given $length
	 *
	 * @param string      $inputName
	 * @param int         $length
	 * @param string|null $customErrorMessage
	 *
	 * @return $this
	 */
	public function minLen(string $inputName, int $length, string $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName)) {
			return $this;
		}

		$inputValue = $this->value($inputName);

		if ( strlen($inputValue) < $length) {
			$message = $customErrorMessage ?: sprintf('%s doit être de %d  caractères au minimum ', ucfirst($inputName), $length);
			$this->addError($inputName, $message);
		}

		return $this;
	}

	/**
	 * Detrmine if The given input should be at most the given $length 
	 *
	 * @param string      $inputName
	 * @param int         $length
	 * @param string|null $customErrorMessage
	 *
	 * @return $this
	 */
	public function maxLen(string $inputName, int $length, string $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName)) {
			return $this;
		}

		$inputValue = $this->value($inputName);

		if ( strlen($inputValue) > $length) {
			$message = $customErrorMessage ?: sprintf('%s doit être de %d  caractères au maximum', ucfirst($inputName), $length);
			$this->addError($inputName, $message);
		}

		return $this;
	}

	/**
	 * Detrmine if The first input value matches the second input value
	 *
	 * @param string      $firstInput
	 * @param string      $secondInput
	 * 
	 * @param string|null $customErrorMessage
	 *
	 * @return $this
	 */
	public function match(string $firstInput, string $secondInput, string $customErrorMessage = null)
	{
		$firstInputValue = $this->value($firstInput);
		$secondInputValue = $this->value($secondInput);

		if ($firstInputValue != $secondInputValue) {
			$message = $customErrorMessage ?: sprintf('%s doit être identique au %s', ucfirst($secondInput), $firstInput);
			$this->addError($secondInput, $message);
		}
		return $this;
	}

	/**
	 * Determine if the given input is unique in database
	 *
	 * @param string      $inputName
	 * @param array       $databaseData
	 * @param string|null $customErrorMessage
	 *
	 * @return $this
	 */
	public function unique(string $inputName, array $databaseData, string $customErrorMessage = null)
	{
		if ($this->hasErrors($inputName)) {
			return $this;
		}

		$inputValue = $this->value($inputName);

		$table = null;
		$column = null;
		$exceptionColumn = null;
		$exceptionColumnValue = null;

		//Email exist in the DB throw Error
		if ( count($databaseData) == 2) {
			list($table, $column) = $databaseData;
		}
		// email exist make exception and continue
		elseif ( count($databaseData) == 4) {
			list($table, $column, $exceptionColumn, $exceptionColumnValue) = $databaseData;
		}

		if ( $exceptionColumn AND $exceptionColumnValue) {
			$result = $this->app->db->select($column)
									->from($table)
									->where($column . ' = ? AND ' . $exceptionColumn . ' != ?', $inputValue, $exceptionColumnValue)
									->fetch();
		} else {
			$result = $this->app->db->select($column)
									->from($table)
									->where($column . ' = ?', $inputValue)
									->fetch();
		}

		if($result) {
			$message = $customErrorMessage ?: sprintf('%s existe déjà', ucfirst($inputName));
			$this->addError($inputName, $message);
		}
		return $this;
	}

	/**
	 * Add custom message
	 * 
	 * @param string $message
	 *
	 * @return $this
	 */
	public function message(string $message) 
	{
		$this->errors[] = $message;

		return $this;
	}

	/**
	 * Validate all the inputs
	 *
	 * @return $this
	 */
	public function validate()
	{

		return $this;
	}

	/**
	 * Determine if there are any invalid inputs
	 *
	 * @return boolean
	 */
	public function fails(): bool
	{
		return ! empty($this->errors);
	}

	/**
	 * Determine if all inputs are valid
	 *
	 * @return boolean
	 */
	public function passes(): bool
	{
		return empty($this->errors);
	}

	/**
	 * Get all errors message for all inputs
	 *
	 * @return array
	 */
	public function getMessages(): array
	{
		return $this->errors;
	}


	/**
	 * Get the value for the given input name
	 *
	 * @param string $input
	 * 
	 * @return mixed
	 */
	private function value(string $input)
	{
		return $this->app->request->post($input);
	}

	/**
	 * Add input error
	 *
	 * @param string $inputName
	 * @param string $errorMessage
	 * 
	 * @return void
	 */
	private function addError(string $inputName, string $errorMessage): void
	{
		$this->errors[$inputName] = $errorMessage;
	}

	/**
	 * Determine if the given input has previous errors
	 *
	 * @param string $inputName
	 * 
	 * @return boolean
	 */
	private function hasErrors(string $inputName): bool
	{
		return array_key_exists($inputName, $this->errors);
	}

	/**
	 * The given input must be uploaded
	 *
	 * @param string      $inputName
	 * @param string|null $customErrorMessage
	 *
	 * @return $this
	 */
	public function requiredFile(string $inputName, string $customErrorMessage = null)
	{
		return $this;
	}

	/**
	 * the input must be valid image
	 *
	 * @param string      $inputName
	 * @param string|null $customErrorMessage
	 *
	 * @return $this
	 */
	public function image(string $inputName, string $customErrorMessage = null)
	{
		return $this;
	}

}