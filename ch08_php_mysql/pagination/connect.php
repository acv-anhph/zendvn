<?php
	require_once 'class/Database.class.php';
	$params		= array(
			'server' 	=> 'localhost',
			'username'	=> 'root',
			'password'	=> '',
			'database'	=> 'zendvn',
			'table'		=> 'manage_user'
	);
	$database = new Database($params);