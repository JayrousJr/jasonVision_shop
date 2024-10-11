<?php 
// session_start();
// require 'DB.php';
// require 'Session.php';

class Auth {
	private $db;
	private $table = 'auth_users';

	public function __construct() {
		$this->db = DB::get_instance();
	}

	/**
	 * Change Password
	 * @return bool If changed successful
	*************************************************************************************/
	public function change_password($current, $new, $user_id = false) {
		if ($user_id == FALSE) {
			$user_id = Session::get('user_id');
		}

		$password = $this->db->get('auth_users', $user_id);
		if (password_verify($current, $password->password)) {
			$new = password_hash($new, PASSWORD_DEFAULT);
			$data = array(
				'password' => $new
			);
			if ($this->db->update('auth_users', $data, "id='".$user_id."'")) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Check if user is banned or blocked
	 * @return bool true If is banned, false is not
	*************************************************************************************/
	public function is_banned($user_id = false) {
		$user_id = $user_id ?: $this->get_current_user_id();
		$user = $this->db->get($this->table, $user_id);

		return $user->status == 0 ? true : false;
	}

	private function get_current_user_id() {
		return Session::get('user_id');
	}
}

// $a = new Auth();
// var_dump($a->is_banned());