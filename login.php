<?php
	session_start();
?>

<html>
	<head>
		<title>Log In</title>
		<link rel="stylesheet" type="text/css" href="./CSS/login.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
		<script>
			function LogInButtonClicked(){
				var validate = true;

				if(document.getElementById("emailField").value == ""){
					validate = false;
					document.getElementById("emailError").innerHTML = "*An email is required to sign in";
				}else{
					document.getElementById("emailError").innerHTML = "";
				}

				if(document.getElementById("passwordField").value == ""){
					validate = false;
					document.getElementById("passwordError").innerHTML = "*A password is required to sign in";
				}else{
					document.getElementById("passwordError").innerHTML = "";
				}

				if(!validate){
					return;
				}

				var postData = {
					"email" : document.getElementById('emailField').value,
					"password" : document.getElementById("passwordField").value,
					"employee" : document.getElementById("employeeCheckbox").checked
				};

				$.post("logInRequest.php", postData).done(function(data){
					window.location.href = "http://localhost/SSPSpring2020/main.php";
				});
			}
		</script>
	</head>

	<body>
		<div class="navbar">
			<div class="logo">
				<img src="./Images/pizzaboblogo.png"/>
			</div>
			<div class="navLinks">
				<ul>
					<li><a href="main.php">Home</a></li>
					<li><a href="menu.php">Menu</a></li>
					<li><a href="order.php">Order</a></li>
					<li><a href="login.php">Sign In</a></li>
				</ul>
			</div>
		</div>
		<div class="logInDiv">
			<label id="emailError" style="color: red;"></label>
			<input type="email" id="emailField"placeholder="E-mail">
			<label id="passwordError" style="color: red;"></label>
			<input type="password" id="passwordField" placeholder="Password">
			<div>
				<label>Employee: </label><input id="employeeCheckbox" type="checkbox">
			</div>
			<button onclick="LogInButtonClicked()">Log In</button>
		</div>
	</body>
</html>
