<?php
	session_start();

	$logged_in = $_SESSION['loggedin'];
	$user_name = $_SESSION['user_name'];

	if($logged_in == true){
		echo '<div class="navbar"><div class="logo"><img src="./Images/pizzaboblogo.png" /></div><div class="navLinks"><ul><li><a href="main.php">Home</a></li><li><a href="menu.php">Menu</a></li><li><a href="order.php">Order</a></li><li><a href="userprofile.php">' . $user_name . '</a></li><li><a href="logout.php" >Log Out</a></li></ul></div></div>';
	}else{
		echo '<div class="navbar"><div class="logo"><img src="./Images/pizzaboblogo.png" /></div><div class="navLinks"><ul><li><a href="main.php">Home</a></li><li><a href="menu.php">Menu</a></li><li><a href="order.php">Order</a></li><li><a href="login.php">Sign In</a></li></ul></div></div>';
	}

	echo '<div class="mainBackground"><img src="./Images/mainPizzaBackground.jpg" /></div>';
?>

<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="./CSS/main.css">
</head>

<body>

</body>

</html>