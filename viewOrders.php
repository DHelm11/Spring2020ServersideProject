<?php
	$servername = "www.math-cs.ucmo.edu";
    $username = "cs4130_sp2020";
    $password = "tempPWD!";
    $db = "cs4130_sp2020";

    $conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM ZGF_PB_Orders WHERE picked_up = 0";
    $result = $conn->query($sql);

	echo '<div class="navbar"><div class="logo"><img src="./Images/pizzaboblogo.png" /></div><div class="navLinks"><ul><li><a href="main.php">Home</a></li><li><a href="menu.php">Menu</a></li><li><a href="order.php">Order</a></li><li><a href="viewOrders.php">View Orders</a></li></ul></div></div>';

	$s = "<div class='tablesDiv'><h1>Current Orders</h1>";
	$s = $s . "<table class='tableDiv'><tr><td>Order Number</td><td>Pizza</td><td>Customer</td></tr>";

	if($result->num_rows > 0){
		while($row = $result -> fetch_assoc()){
			$s = $s . "<tr><td>" . $row["order_id"] . "</td><td>" . $row["pizza_type"] . "</td><td>" . $row["first_name"] . " " . $row["last_name"] . "</td></tr>";
		}
	}

	$s = $s . "</table></div>";
	
	echo $s;
?>

<html>
	<head>
		<title>View Orders</title>
		<link rel="stylesheet" type="text/css" href="./CSS/viewOrders.css">
	</head>

	<body>
	</body>
</html>