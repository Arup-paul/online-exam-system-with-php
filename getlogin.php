<?php

 $filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/classes/Users.php');
	$usr = new Users();


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$email    = $_POST['email'];
		$password = md5($_POST['password']);
		$userLogin = $usr->userLogin($email,$password);
	}




?> 