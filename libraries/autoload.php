<?php
spl_autoload_register(function($class){
	require_once $class.'.php';
});

$db = DB::get_instance();
$perms = new Permission;
$shop = new Shop();
