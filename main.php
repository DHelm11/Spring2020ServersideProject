<?php
	session_start();
	$_SESSION['loggedin'] = false;
	$_SESSION['user_name'] = "";

	if($_SESSION['loggedin'] == true){
		echo '<div class="navbar"><div class="logo"><img src="./Images/pizzaboblogo.png" /></div><div class="navLinks"><ul><li><a href="main.php">Home</a></li><li><a href="menu.php">Menu</a></li><li><a href="order.php">Order</a></li><li><a href="userprofile.php">' . $_SESSION['user_name'] . '</a></li><li><a >Log Out</a></li></ul></div></div>';
	}else{
		echo '<div class="navbar"><div class="logo"><img src="./Images/pizzaboblogo.png" /></div><div class="navLinks"><ul><li><a href="main.php">Home</a></li><li><a href="menu.php">Menu</a></li><li><a href="order.php">Order</a></li><li><a href="login.php">Sign In</a></li></ul></div></div>';
	}

	echo '<div class="mainBackground"><img src="./Images/mainPizzaBackground.jpg" /></div>';

	echo "<p>" . $_SESSION['loggedin'] . " " . $_SESSION['user_name'] . "</p>";
?>

<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="./CSS/main.css">
</head>

<body>

</body>

</html>