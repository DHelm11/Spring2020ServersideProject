<?php
    $servername = "www.math-cs.ucmo.edu";
    $username = "cs4130_sp2020";
    $password = "tempPWD!";
    $db = "cs4130_sp2020";

    $conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "SELECT * FROM ZGF_PB_Pizzas";
    $result = $conn->query($sql);

	if($_SESSION['loggedin'] == true){
		echo '<div class="navbar"><div class="logo"><img src="./Images/pizzaboblogo.png" /></div><div class="navLinks"><ul><li><a href="main.php">Home</a></li><li><a href="menu.php">Menu</a></li><li><a href="order.php">Order</a></li><li><a href="userprofile.php">' + $_SESSION['user_name'] + '</a></li><li><a >Log Out</a></li></ul></div></div>';
	}else{
		echo '<div class="navbar"><div class="logo"><img src="./Images/pizzaboblogo.png" /></div><div class="navLinks"><ul><li><a href="main.php">Home</a></li><li><a href="menu.php">Menu</a></li><li><a href="order.php">Order</a></li><li><a href="login.php">Sign In</a></li></ul></div></div>';
	}

	echo '<div style="margin-top: 10em; text-align: center; color: white; background-color: black; border-top: 5px solid darkred; border-bottom: 5px solid darkred;"><div><h1>PRICING</h1></div><div><h1>Small - $8 Medium - $12 Large - $16</h1></div><div><h2>Extra Toppings</h2></div><div><h3>(Per Topping)</h3></div><div><h4>Small - $0.50 Medium - $1.00 Large - $1.50</h4></div></div>';
    
	if($result->num_rows > 0){
        $pizza = '<div class="pizzasDiv">';
        while($row = $result -> fetch_assoc()){
            $pizza = $pizza . '<div class="pizza">';
            $pizza = $pizza . '<img src="' . $row["pizza_img"] . '"/>';
            $pizza = $pizza . '<div><h1>' . $row["pizza_name"] . '</h1><h2>' . $row["pizza_description"] . '</h2></div>';
            $pizza = $pizza . '</div>';
        }
        echo $pizza;
    }else{
        echo "No results";
    }

    $conn->close();
?>

<html>
    <head>
        <title>Menu</title>
        <link rel="stylesheet" type="text/css" href="./CSS/menu.css">
    </head>
    <body>
    </body>
</html>