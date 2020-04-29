<?php
	session_start();
	$_SESSION['loggedin'] = false;
	$_SESSION['user_name'] = "";
	$_SESSION['employee'] = false;
	$_SESSION['email'] = "";
	header('Location: ' . "http://localhost/SSPSpring2020/main.php");
?>