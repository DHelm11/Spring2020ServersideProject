<?php
	$servername = "www.math-cs.ucmo.edu";
    $username = "cs4130_sp2020";
    $password = "tempPWD!";
    $db = "cs4130_sp2020";

    $conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM ZGF_PB_Orders";
    $result = $conn->query($sql);

	echo '<div class="navbar"><div class="logo"><img src="./Images/pizzaboblogo.png" /></div><div class="navLinks"><ul><li><a href="main.php">Home</a></li><li><a href="menu.php">Menu</a></li><li><a href="order.php">Order</a></li><li><a href="viewOrders.php">View Orders</a></li></ul></div></div>';

	$s = "<div class='tablesDiv'><h1>Orders</h1>";
	$s = $s . "<table class='tableDiv'><tr><td>Order Number</td><td>Pizza</td><td>Customer</td><td>Status</td><td>\t</td></tr>";

	if($result->num_rows > 0){
		while($row = $result -> fetch_assoc()){
			$s = $s . "<tr><td>" . $row["order_id"] . "</td><td>" . $row["pizza_type"] . "</td><td>" . $row["first_name"] . " " . $row["last_name"] . "</td>";
			if($row["order_finished_time"] == null){
				$s = $s . "<td>Cooking</td><td><button onclick='OrderFinishedButtonClicked(" . $row['order_id'] . ")'>Order Cooked</button></td>";
			}else if($row["order_picked_up_time"] == null){
				$s = $s . "<td>Cooked</td><td><button onclick='OrderPickedUpButtonClicked(" . $row['order_id'] . ")'>Order Picked Up</button></td>";
			}else{
				$s = $s . "<td>Picked Up</td><td></td>";
			}
			$s = $s . "</tr>";
		}
	}

	$s = $s . "</table></div>";
	
	echo $s;
?>

<html>
	<head>
		<title>View Orders</title>
		<link rel="stylesheet" type="text/css" href="./CSS/viewOrders.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
		<script>
			function OrderFinishedButtonClicked(id){
				const time = new Date(Date.now());
				
				var postData = {
					"order_id" : id,
					"status" : 'finished',
					"datetime" : time.getFullYear() + "-" + time.getMonth() + "-" + time.getDay() + " " + time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds()
				};

				$.post("updatePizza.php", postData).done(function(data){
					window.location.href = "http://localhost/SSPSpring2020/viewOrders.php";
				});
			}

			function OrderPickedUpButtonClicked(id){
				const time = new Date(Date.now());
				var postData = {
					"order_id": id,
					"status" : 'pickedUp',
					"datetime" : time.getFullYear() + "-" + time.getMonth() + "-" + time.getDay() + " " + time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds()
				};

				$.post("updatePizza.php", postData).done(function(){
					window.location.href = "http://localhost/SSPSpring2020/viewOrders.php";
				});
			}
		</script>
	</head>

	<body>
	</body>
</html>