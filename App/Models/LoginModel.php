<?php

namespace App\Models;

use System\Model;

class LoginModel extends Model
{
	/**
	 * Database table name
	 *
	 * @var string
	 */
	protected $table = 'users';
	
	/**
	 * Logged in User
	 * 
	 * @ \stdClass
	 */
	private $user;

	/**
	 * Determine if the given login data is valid 
	 *
	 * @param string $email
	 * @param string $password
	 *
	 * @return boolean
	 */
	public function isValidLogin(string $email, string $password): bool
	{
		$user = $this->select('users.*','ug.name AS `user_group`')
	                    ->from($this->table)
	                    ->join('LEFT JOIN users_groups ug On users.users_group_id=ug.id')
	                    ->where('email=?', $email)->fetch($this->table);

		if (! $user) return false;
		
		$this->user = $user;

		return password_verify($password, $user->password);
	}

	/**
	 * Get Logged in User data
	 *
	 * @return \stdClass
	 */
	public function user()
	{
		return $this->user;
	}

	/**
	 * Determine whether the user is logged in
	 *
	 * @return boolean
	 */
	public function isLogged(): bool
	{
		if ($this->cookie->has('login')) {
			$code = $this->cookie->get('login');
		} elseif($this->session->has('login')) {
			$code = $this->session->get('login');
		} else {
			$code = '';
		}

		$user = $this->select('users.*','ug.name AS `user_group`')
	                 ->from($this->table)
	                 ->join('LEFT JOIN users_groups ug On users.users_group_id=ug.id')
					 ->where('code=?' ,$code)->fetch($this->table);

		if (! $user) {
			return false;
		}

		$this->user = $user;

		return true;
	}
}