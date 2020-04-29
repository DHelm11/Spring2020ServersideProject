<?php
	if(isset($_SESSION['loggedin'])){
		header('Location: ' . "http://localhost/SSPSpring2020/login.php");
	}else{
		echo '<div class="navbar"><div class="logo"><img src="./Images/pizzaboblogo.png" /></div><div class="navLinks"><ul><li><a href="main.php">Home</a></li><li><a href="menu.php">Menu</a></li><li><a href="order.php">Order</a></li><li><a href="login.php">Sign In</a></li></ul></div></div>';
	}
?>

<html>
	<head>
		<title>Create Account</title>
		<link rel="stylesheet" type="text/css" href="./CSS/createAccount.css">
		<script>
			function validateForm(){
				event.preventDefault();
				if(document.getElementById('passField').value != document.getElementById('confPassField').value){
					document.getElementById('passError').innerHTML = "*PASSWORDS DO NOT MATCH";
				}else{
					document.getElementById('passError').innerHTML = "";
				}
			}
		</script>
	</head>
	<body>
		<form action="createAccountRequest.php" onsubmit="validateForm()">
			<div class="mainFormDiv">
				<input type="text" id="firstNameField" class="textInput" placeholder="First Name" required>
				<input type="text" id="lastNameField" class="textInput" placeholder="Last Name" required>
				<input type="email" id="emailField" class="textInput" placeholder="Email" required>
				<input type="text" id="streetField" class="textInput" placeholder="Street Address" required>
				<input type="text" id="cityField" class="textInput" placeholder="City" required>
				<input type="text" id="stateField" class="textInput" placeholder="State (ex: 'MO')" required>
				<input type="text" id="zipField" class="textInput" placeholder="Zipcode" required>
				<input type="phonenumber" id="phoneField" class="textInput" placeholder="Phone Number (ex: '1234567890')" required>
				<input type="password" id="passField" class="textInput" placeholder="Password" required>
				<input type="password" id="confPassField" class="textInput" placeholder="Confirm Password" required>
				<button>Create Account</button>
			</div>
		</form>
	</body>
</html>