<?php
	session_start();

	if(isset($_SESSION['loggedin'])){
		$user_name = $_SESSION['user_name'];
	}

	$servername = "www.math-cs.ucmo.edu";
    $username = "cs4130_sp2020";
    $password = "tempPWD!";
    $db = "cs4130_sp2020";
	
	$conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
	#need to save the user's email as well because there could be multiple zach's in the database
	$sql = "SELECT first_name FROM ZGF_PB_Employees where email = '" . $_POST['email'] . "'";
?>