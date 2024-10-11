<?php
session_start();
#Includes necessary files.
include 'dbh.php';
include 'mp_auth.php';
require_once '../core/init.php';

$auth = new Auth();

#If login button clicked
if (isset($_POST['loginBtn'])) {
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	#Then let's Login
	if (login($username, $password)) {
		Redirect::to('../pages/dashboard');
	} else {
		Session::flash('login-error', Session::get('login_error'));
		Redirect::to('../');
	}
}

#Register user
if (isset($_POST['regBtn'])) {
	$fname = mysqli_real_escape_string($conn, $_POST['fname']);
	$lname = mysqli_real_escape_string($conn, $_POST['lname']);
	$uname = mysqli_real_escape_string($conn, $_POST['username']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	//$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$role = mysqli_real_escape_string($conn, $_POST['role']);
	$pass = mysqli_real_escape_string($conn, $_POST['password']);
	$shop = mysqli_real_escape_string($conn, $_POST['shop']);

	if (register_user($shop, $fname, $lname, $email, $uname, $role, $pass, $path)) {
		Session::flash('success', 'New user has been registered successfully!');
		Redirect::to('../pages/users');
	}
}

#Ban or Unban User
if (isset($_GET['ban']) && isset($_SERVER['HTTP_REFERER'])) {
	if ($_GET['ban'] == 'true')
		ban_user($_GET['id']);
	else
		unban_user($_GET['id']);
	Redirect::to($_SERVER['HTTP_REFERER']);
}

#Change Password 
if (isset($_POST['change-password'])) {
	$current = $_POST['current'];
	$new = $_POST['new'];

	if ($auth->change_password($current, $new)) {
		Redirect::to('../pages/dashboard');
	}
}

function upload($name)
{
	$file = $_FILES[$name];

	if (empty($file['name'])) {
		return "dp_images/user.jpg";
	}

	// Upload images
	$path = "../pages/dp_images/" . uniqid() . ".jpg";
	$temp = $file['tmp_name'];

	$img = @file_get_contents($temp);
	$img = @imagecreatefromstring($img);
	if ($img !== false) {
		imagejpeg($img, $path, 75);
		imagedestroy($img);
		return substr($path, 9);
	}
	return false;
}