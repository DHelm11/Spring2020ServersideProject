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

	$check = $_POST['employeeFlag'];

	if($check == 1){
		$sql = "UPDATE ZGF_PB_Employees SET first_name = '" . $_POST['firstName'] . "', last_name = '" . $_POST['lastName'] . "', street_address = '" . $_POST['streetAddress'];
		$sql = $sql . "', city = '" . $_POST['city'] . "', state = '" . $_POST['state'] . "', zipcode = '" . $_POST['zipcode'] . "', phone_number = '" . $_POST['phoneNumber'];
		$sql = $sql . "'";
	}else{
		$sql = "UPDATE ZGF_PB_Users SET first_name = '" . $_POST['firstName'] . "', last_name = '" . $_POST['lastName'] . "', street_address = '" . $_POST['streetAddress'];
		$sql = $sql . "', city = '" . $_POST['city'] . "', state = '" . $_POST['state'] . "', zipcode = '" . $_POST['zipcode'] . "', phone_number = '" . $_POST['phoneNumber'];
		$sql = $sql . "'";
	}

	$result = $conn->query($sql);
?>