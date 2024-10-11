<?php 
/**
 * @package		Simple PHP Authentication functions - MP_Auth
 * @author		Husmukh HD Muhammad
 * @copyright	Copyright (c) 2019, Mpemba Inc
 * @link		https://mpembainc.com
 * @version		1.0.0
 ************************************************************************************/

/**
* Error Messages
* login_error: Print out error for login
* register_error: Print out error for registration
* change_error: Print out error for change password
*************************************************************************************/
$_SESSION['register_error'] = '';
$_SESSION['login_error'] = '';
$_SESSION['change_error'] = '';

/**
* Basic useful variables
*************************************************************************************/
$db_table = 'auth_users';

/**
* Login
* @param string|username, string|password - required
* @return boolen, true on success and false on fails.
*************************************************************************************/
function login($username, $password){
	global $conn, $db_table;
	if ($username == '' && $password == '') {
		$_SESSION['login_error'] = "All fields are required!"; 
		return FALSE;
	}
	$sql = mysqli_query($conn, "SELECT * FROM {$db_table} WHERE username = '$username'");
	if (mysqli_num_rows($sql) == 0) {
		$_SESSION['login_error'] = "Incorrect username or Password!";
		return FALSE;
	}else{
		$user = mysqli_fetch_assoc($sql);
		if (password_verify($password, $user['password'])) {
			if ($user['status'] == 0) {
				$_SESSION['login_error'] = "Your account is blocked. Contact your administrator!";	
				return FALSE;
			}
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['name'] = $user['first_name']." ".$user['last_name'];
			$_SESSION['role'] = $user['role'];
			$_SESSION['shop'] = $user['shop_id'];
			$_SESSION['dp'] = $user['img'];

			#Update last login
			$last_login = mysqli_query($conn, "UPDATE {$db_table} SET last_login = NOW() WHERE id = '".$user['id']."'");
			if ($last_login) {
				return TRUE;
			}
		}else{
			$_SESSION['login_error'] = "Incorrect username or Password!";
			return FALSE;
		}
	}
}

/**
 * Logout user
 * Destroys the session and log out user from the system.
 * @return bool If session destroy successful
*************************************************************************************/
function logout(){
	if (session_destroy()) {
		return TRUE;
	}
}

/**
 * Register user
 * @return bool If registered successful
 *************************************************************************************/
function register_user($shop, $first_name, $last_name, $email, $username, $role, $pass, $dp = false){
	global $conn, $db_table;
	#Check username existance
	if (isExist('username', $username)) {
		$_SESSION['register_error'] = 'Username is exist. Please pick another username';
		return FALSE;
	};

	#Check Contact existance
	if (isExist('email', $email)) {
		$_SESSION['register_error'] = 'Email address is exist. Please pick another email';
		return FALSE;
	};

	$hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

	$query = mysqli_query($conn,"INSERT INTO {$db_table} (shop_id, first_name, last_name, email, username, role, img, password) VALUES ('$shop','$first_name','$last_name','$email','$username','$role','$dp','$hashed_pass')");
	if (!$query) {
		$_SESSION['error'] = 'Something went wrong';
		return FALSE;
	}
	return TRUE;
}

/**
 * Update user
 * @return bool: True If registered successful
 *************************************************************************************/
function update_user($user_id, $first_name, $last_name, $email, $username, $role){
	global $conn, $db_table;
	$query = mysqli_query($conn,"UPDATE {$db_table} SET first_name = '$first_name', last_name = '$last_name', email = '$email', username = '$username', status = '$role' WHERE id = '$user_id'");
	if (!$query) {
		$_SESSION['error'] = 'Something went wrong';
		return FALSE;
	}
	return TRUE;
}

/**
 * Change Password
 * @return bool If changed successful
 *************************************************************************************/
function change_pass($current, $new, $user_id = FALSE){
	global $conn, $db_table;
	if ($user_id == FALSE) {
		$user_id = $_SESSION['user_id'];
	}
	$pass = get_user($user_id)['password'];
	if (!password_verify($current, $pass)) {
		$_SESSION['change_error'] = 'Incorrect curent password!';
		return FALSE;
	}else{
		$new = password_hash($new, PASSWORD_DEFAULT);
		$sql = mysqli_query($conn, "UPDATE {$db_table} SET password = '$new' WHERE id = '$user_id'");
		return TRUE;
	}
}

/**
 * Delete user
 *  @return bool: true if deleted | false if not
 *************************************************************************************/
function delete_user($user_id = FALSE){
	global $conn, $db_table;
	if ($user_id == FALSE) {
		$user_id = $_SESSION['user_id'];
	}

	$sql = mysqli_query($conn, "DELETE FROM {$db_table} WHERE id = '$user_id'");
	if ($sql) return true;
	return false;
}

/**
 * Check if specific field exist
 * @return bool: true if exist | false if not
 *************************************************************************************/
function isExist($col, $item){
	global $conn, $db_table;
	$sql = mysqli_query($conn, "SELECT * FROM {$db_table} WHERE {$col} = '$item'");
	if (mysqli_num_rows($sql) > 0) return true;
	return false;
}

/**
 * Get all Users
 * @return array|users on success | false on fail
 *************************************************************************************/
function get_users() {
	global $conn, $db_table;
	$sql = mysqli_query($conn, "SELECT * FROM {$db_table}");
	if (mysqli_num_rows($sql) > 0) return mysqli_fetch_all($sql, MYSQLI_ASSOC);
	return false;
}

/**
 * Get user informations
 * @return array|user_info on success | false on fail
 *************************************************************************************/
function get_user($user_id){
	global $conn, $db_table;
	$sql = mysqli_query($conn, "SELECT * FROM {$db_table} WHERE id = '$user_id'");
	if (mysqli_num_rows($sql) > 0) return mysqli_fetch_assoc($sql);
	return false;
}

/**
 * Ban user
 * @return array|true on success | false on fail
 *************************************************************************************/
function ban_user($user_id){
	global $conn, $db_table;
	$sql = mysqli_query($conn, "UPDATE {$db_table} SET status = '0' WHERE id = '$user_id'");
	if ($sql) return true;
	return false;
}

/**
 * UnBan user
 * @return array|true | false on fail
 *************************************************************************************/
function unban_user($user_id){
	global $conn, $db_table;
	$sql = mysqli_query($conn, "UPDATE {$db_table} SET status = '1' WHERE id = '$user_id'");
	if ($sql) return true;
	return false;
}