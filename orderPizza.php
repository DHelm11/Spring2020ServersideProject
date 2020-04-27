<?php
	$servername = "www.math-cs.ucmo.edu";
    $username = "cs4130_sp2020";
    $password = "tempPWD!";
    $db = "cs4130_sp2020";

    $conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

	$sql = "SELECT * FROM ZGF_PB_Orders WHERE order_finished_time is null";

	$result = $conn->query($sql);

	$waitTime = 20;

	if($result->num_rows - 4 >= 0){
		$orders = $result->num_rows - 3;
		$waitTime = $waitTime + ($orders * 5);
	}
	

	$sql = "INSERT INTO ZGF_PB_Orders (pizza_type, pizza_size, pizza_toppings, price, est_wait_time, first_name, last_name, street_address, state, city, zipcode, phone_number) ";
	$sql = $sql . "values ('" . $_POST["type"] . "', '" . $_POST['size'] . "', '" . $_POST['toppings'] . "', " . $_POST['price'] . ", " . $waitTime . ", '" . $_POST['firstName'] . "', '" . $_POST['lastName'];
	$sql = $sql . "', '" . $_POST['streetAddress'] . "', '" . $_POST["state"] . "', '" . $_POST['city'] . "', '" . $_POST['zipcode'] . "', '" . $_POST['phoneNumber'] . "')";

	if ($conn->query($sql) === TRUE) {
		$conn->close();
		echo "Thank you for ordering! Your pizza will be ready in approximately " . round($waitTime) . " minutes!";
	} else {
		$conn->close();
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>