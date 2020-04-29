<?php
	session_start();
	$_SESSION['loggedin'] = false;
	$_SESSION['user_name'] = "";
	$_SESSION['employee'] = false;
	header('Location: ' . "http://localhost/SSPSpring2020/main.php");
?>