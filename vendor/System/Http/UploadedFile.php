<?php

namespace System\Http;

use System\File;

class UploadedFile
{
	/**
	 * Application Object
	 *
	 * @var \System\Application
	 */
	private $app;

	/**
	 * The uploaded File Data given from _FILES variable
	 *
	 * @var array
	 */
	private $file = [];

	/**
	 * Uploaded File name (With extension)
	 *
	 * @var string
	 */
	private $fileName;

	/**
	 * The uploaded File name (Without extension)
	 *
	 * @var string
	 */
	private $nameOnly;

	/**
	 * The Uploaded File extension
	 *
	 * @var string
	 */
	private $extension;

	/**
	 * The Uploaded File Mime Type
	 *
	 * @var string
	 */
	private $mimeType;

	/**
	 * The uploaded Temp File path
	 *
	 * @var string
	 */
	private $tempFile;

	/**
	 * The Uploaded File size in bytes
	 *
	 * @var int
	 */
	private $size;

	/**
	 * Get the uploaded file Error
	 *
	 * @var int
	 */
	private $error;

	/**
	 * the allowed image extensions
	 *
	 * @var array
	 */
	private $allowedImageExtensions = [];

	/**
	 * Constructor
	 *
	 * @param string   $input
	 */
	public function __construct(string  $input)
	{
		$this->getFileInfo($input);
		$this->setAllowedExtensions();
	}

	/**
	 * Prepare and get uploaded file info
	 *
	 * @param string $input
	 * 
	 * @return void
	 */
	private function getFileInfo(string $input): void
	{
		if (empty($_FILES[$input])) {
			return;
		}

		$file = $_FILES[$input];

		$this->error = $file['error'];

		//if the file is not uploaded stop script if not continue and store the file
		if ($this->error != UPLOAD_ERR_OK) {
			return;
		}

		$this->file = $file;

		$this->fileName = $this->file['name'];

		$fineNameInfo = pathinfo($this->fileName);

		$this->nameOnly = $fineNameInfo['filename'];

		$this->extension = strtolower($fineNameInfo['extension']);

		$this->mimeType = $this->file['type'];

		$this->tempFile = $this->file['tmp_name'];

		$this->size = $this->file['size'];
	}

	/**
	 * Get the allowed extensions fron the file Config.php
	 *
	 * @return void
	 */
	private function setAllowedExtensions(): void
	{
		$data = require './config.php';

		$imageExtensions = array_get($data, 'image_extensions');

		$this->allowedImageExtensions = $imageExtensions;

	}

	/**
	 * Get the file name of the uploaded file
	 *
	 * @return string
	 */
	public function getFileName(): string
	{
		return $this->fileName;
	}

	/**
	 * Get the file name (Without extention)
	 *
	 * @return string
	 */
	public function getNameOnly(): string
	{
		return $this->nameOnly;
	}

	/**
	 * Get the file extension
	 *
	 * @return string
	 */
	public function getExtension(): string
	{
		return $this->extension;
	}

	/**
	 * Get the file Mime type
	 *
	 * @return void
	 */
	public function getMimeType(): string
	{
		return $this->mimeType;
	}

	/**
	 * Get the file Size
	 *
	 * @return string
	 */
	public function getFileSize(): string
	{
		return $this->size;
	}

	/**
	 * Determine whether the file is uploaded
	 *
	 * @return boolean
	 */
	public function exists(): bool
	{
		return ! empty($this->file);
	}

	/**
	 * Move the uploaded file to the given destination
	 *
	 * @param  string 	   $target
	 * @param  string|null $fileName
	 * @return string
	 */
	public function moveTo(string $target, string $newFileName = null): string
	{
		//choose random name for the file
		$fileName = $newFileName ?: 'image_' .sha1(mt_rand()); //length of the image name = 46 char 
		$fileName .= '.' . $this->extension;

		//Create Directory if it doesn't exist
		if (! is_dir($target)) {
			mkdir($target, 0777, true);
		}

		$uploadedFilePath = rtrim($target, '/') . '/' . $fileName;

		move_uploaded_file($this->tempFile, $uploadedFilePath);

		return $fileName;
	}

	/**
	 * Determine whether the uploaded file is image
	 *
	 * @return boolean
	 */
	public function isImage(): bool
	{	
		return strpos($this->mimeType, 'image/') === 0 AND 
			in_array($this->extension, $this->allowedImageExtensions);
	}
}