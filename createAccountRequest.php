<?php
	$servername = "www.math-cs.ucmo.edu";
    $username = "cs4130_sp2020";
    $password = "tempPWD!";
    $db = "cs4130_sp2020";

    $conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "SELECT * FROM ZGF_PB_Users WHERE email = '" . $_POST['email'] ."'";

	$result = $conn->query($sql);


	if($result->num_rows > 0){
		echo "Email already in use";
		return;
	}
	

	$sql = "INSERT INTO ZGF_PB_Users (first_name, last_name, street_address, state, city, zipcode, phone_number, email, password) ";
	$sql = $sql . "values ('" . $_POST['firstName'] . "', '" . $_POST['lastName'] . "', '" . $_POST['streetAddress'] . "', '" . $_POST["state"];
	$sql = $sql . "', '" . $_POST['city'] . "', '" . $_POST['zipcode'] . "', '" . $_POST['phoneNumber'] . "', '" . $_POST['email'] . "', '" . $_POST['password'] . "')";

	if ($conn->query($sql) === TRUE) {
		$conn->close();
		echo "Account Created!";
	} else {
		$conn->close();
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>