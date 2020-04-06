<?php

 $filepath = realpath(dirname(__FILE__));
	include_once($filepath.'/classes/Users.php');
	$usr = new Users();


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name     = $_POST['name'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$email    = $_POST['email'];
		$userregi = $usr->userRegistrations($name,$username,$password,$email);
		
	}




?>