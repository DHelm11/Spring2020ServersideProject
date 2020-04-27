<?php
	$servername = "www.math-cs.ucmo.edu";
    $username = "cs4130_sp2020";
    $password = "tempPWD!";
    $db = "cs4130_sp2020";

    $conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

	$status = $_POST['status'];

	$s = "The status was " . $status;

	if($status == "finished"){
		$sql = "UPDATE ZGF_PB_Orders SET order_finished_time = '" . $_POST['datetime'] ."' WHERE order_id = '" . $_POST['order_id'] . "'";
	}else{
		$sql = "UPDATE ZGF_PB_Orders SET order_picked_up_time = '" . $_POST['datetime'] . "' WHERE order_id = '" . $_POST['order_id'] . "'";
	}

	$result = $conn->query($sql);

	if($result){
		echo $result;
	}else{
		echo "Nothing?";
	}
?>