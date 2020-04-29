<?php
	session_start();
	$servername = "www.math-cs.ucmo.edu";
    $username = "cs4130_sp2020";
    $password = "tempPWD!";
    $db = "cs4130_sp2020";

    $conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

	$check = $_POST['employee'];

	if($check == "true"){
		$sql = "SELECT first_name FROM ZGF_PB_Employees where email = '" . $_POST['email'] . "'";
	}else{
		$sql = "SELECT first_name FROM ZGF_PB_Users where email = '" . $_POST['email'] . "' AND password = '" . $_POST['password'] . "'";
	}

	$result = $conn->query($sql);

	if($result){
		$row = $result -> fetch_assoc();

		if($row['first_name'] != ""){
			$_SESSION['employee'] = $check;
			$_SESSION['loggedin'] = true;
			$_SESSION['user_name'] = $row['first_name'];
			echo $row['first_name'];
		}else{
			echo "";
		}
	}

?>