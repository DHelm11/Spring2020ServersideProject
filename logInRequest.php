<?php
	$servername = "www.math-cs.ucmo.edu";
    $username = "cs4130_sp2020";
    $password = "tempPWD!";
    $db = "cs4130_sp2020";

    $conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

	$check = $_POST['employee'];

	$s = "The following was sent " . $check . " " . $_POST['email'] . " " . $_POST['password'];

	if($check == "true"){
		$s = $s . "\nSELECTING FROM EMPLOYEES";
		$sql = "SELECT first_name FROM ZGF_PB_Employees where email = '" . $_POST['email'] . "'";
	}else{
		$s = $s . "\nSELECTING FROM USERS";
		$sql = "SELECT first_name FROM ZGF_PB_Users where email = '" . $_POST['email'] . "'";
	}

	$result = $conn->query($sql);

	$row = $result -> fetch_assoc();

	if($row['first_name'] != ""){
		$_SESSION['loggedin'] = true;
		$_SESSION['user_name'] = $row['first_name'];
		return $row['first_name'];
	}else{
		return false;
	}

?>