<?php
	session_start();

	if(isset($_SESSION['loggedin'])){
		$user_name = $_SESSION['user_name'];
		$email = $_SESSION['email'];
		$employee = $_SESSION['employee'];
	}

	$servername = "www.math-cs.ucmo.edu";
    $username = "cs4130_sp2020";
    $password = "tempPWD!";
    $db = "cs4130_sp2020";
	
	$conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
	
	if($employee == "true"){
		$sql = "SELECT * FROM ZGF_PB_Employees WHERE email = '" . $email . "'";
	}else{
		$sql = "SELECT * FROM ZGF_PB_Users WHERE email = '" . $email . "'";
	}

?>