<?php
	session_start();
	if(isset($_SESSION['loggedin'])){
		$logged_in = $_SESSION['loggedin'];
		if($logged_in){
			header('Location: ' . "http://localhost/SSPSpring2020/login.php");
		}else{
			echo '<div class="navbar"><div class="logo"><img src="./Images/pizzaboblogo.png" /></div><div class="navLinks"><ul><li><a href="main.php">Home</a></li><li><a href="menu.php">Menu</a></li><li><a href="order.php">Order</a></li><li><a href="login.php">Sign In</a></li></ul></div></div>';
		}
	}else{
		echo '<div class="navbar"><div class="logo"><img src="./Images/pizzaboblogo.png" /></div><div class="navLinks"><ul><li><a href="main.php">Home</a></li><li><a href="menu.php">Menu</a></li><li><a href="order.php">Order</a></li><li><a href="login.php">Sign In</a></li></ul></div></div>';
	}
?>

<html>
	<head>
		<title>Create Account</title>
		<link rel="stylesheet" type="text/css" href="./CSS/createAccount.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
		<script>
			function validateForm(){
				event.preventDefault();
				var invalid = validateFields();

				if(invalid){
					return;
				}

				var postData = {
					"firstName" : document.getElementById('firstName').value,
					"lastName" :document.getElementById('lastName').value,
					"streetAddress" : document.getElementById('streetAddress').value,
					"city" : document.getElementById('city').value,
					"state" : document.getElementById('state').value,
					"zipcode" : document.getElementById('zipcode').value,
					"phoneNumber" : document.getElementById('phoneNumber').value,
					"email" : document.getElementById('email').value,
					"password" : document.getElementById('password').value
				};

				$.post("createAccountRequest.php", postData).done(function(data){
					if(data == "Email already in use"){
						alert(data);
					}else{
						window.location.href = "http://localhost/SSPSpring2020/login.php";
					}
				});
			}

			function validateFields(){
			var invalid = false;
			var firstName = document.getElementById('firstName');
			var lastName = document.getElementById('lastName');
			var streetAddress = document.getElementById('streetAddress');
			var city = document.getElementById('city');
			var state = document.getElementById('state');
			var zipcode = document.getElementById('zipcode');
			var phoneNumber = document.getElementById('phoneNumber');
			var email = document.getElementById("email");
			var password = document.getElementById('password');
			var confirmPassword = document.getElementById('confirmPassword');

			if(firstName.value == "" || !checkNumbers(firstName) || firstName.value.length > 15){
				document.getElementById("firstNameError").innerHTML = "*Invalid First Name";
				invalid = true;
			}else{
				document.getElementById("firstNameError").innerHTML = "";
			}

			if(lastName.value == "" || !checkNumbers(lastName) || lastName.value.length > 15){
				document.getElementById("lastNameError").innerHTML = "*Invalid Last Name";
				invalid = true;
			}else{
				document.getElementById("lastNameError").innerHTML = "";
			}

			if(streetAddress.value == "" || streetAddress.value.length > 150){
				document.getElementById("streetAddressError").innerHTML = "*Invalid Street Address";
				invalid = true;
			}else{
				document.getElementById("streetAddressError").innerHTML = "";
			}

			if(city.value == "" || !checkNumbers(city) || city.value.length > 30){
				document.getElementById("cityError").innerHTML = "*Invalid City";
				invalid = true;
			}else{
				document.getElementById("cityError").innerHTML = "";
			}

			if(state.value == "" || !checkNumbers(state) || state.value.length != 2){
				document.getElementById("stateError").innerHTML = "*Invalid State";
				invalid = true;
			}else{
				document.getElementById("stateError").innerHTML = "";
			}

			if(zipcode.value == "" || !checkLetters(zipcode) || zipcode.value.length != 5){
				document.getElementById("zipcodeError").innerHTML = "*Invalid Zipcode";
				invalid = true;
			}else{
				document.getElementById("zipcodeError").innerHTML = "";
			}

			if(phoneNumber.value == "" || !checkLetters(phoneNumber) || phoneNumber.value.length != 10){
				document.getElementById("phoneNumberError").innerHTML = "*Invalid Phone Number";
				invalid = true;
			}else{
				document.getElementById("phoneNumberError").innerHTML = "";
			}

			if(email.value == "" || email.value.length > 30){
				document.getElementById("emailError").innerHTML = "*Invalid Email";
			}else{
				document.getElementById("emailError").innerHTML = "";
			}

			if(password.value != confirmPassword.value){
					document.getElementById('passwordError').innerHTML = "*PASSWORDS DO NOT MATCH";
			}else{
					document.getElementById('passwordError').innerHTML = "";
			}

			return invalid;
		}

		function checkLetters(check){
			var letters = /^[a-zA-Z]+$/;
			if(check.value.match(letters)){
				return false;
			}else{
				return true;
			}
		}

		function checkNumbers(check){
			var numbers = /^[0-9]+$/;
			if(check.value.match(numbers)){
				return false;
			}else{
				return true;
			}
		}
		</script>
	</head>
	<body>
		<form onsubmit="validateForm()">
			<div class="mainFormDiv">
				<label id="firstNameError"></label>
				<input type="text" id="firstName" class="textInput" placeholder="First Name" required>
				<label id="lastNameError"></label>
				<input type="text" id="lastName" class="textInput" placeholder="Last Name" required>
				<label id="emailError"></label>
				<input type="email" id="email" class="textInput" placeholder="Email" required>
				<label id="streetAddressError"></label>
				<input type="text" id="streetAddress" class="textInput" placeholder="Street Address" required>
				<label id="cityError"></label>
				<input type="text" id="city" class="textInput" placeholder="City" required>
				<label id="stateError"></label>
				<input type="text" id="state" class="textInput" placeholder="State (ex: 'MO')" required>
				<label id="zipcodeError"></label>
				<input type="text" id="zipcode" class="textInput" placeholder="Zipcode" required>
				<label id="phoneNumberError"></label>
				<input type="phonenumber" id="phoneNumber" class="textInput" placeholder="Phone Number (ex: '1234567890')" required>
				<label id="passwordError"></label>
				<input type="password" id="password" class="textInput" placeholder="Password" required>
				<input type="password" id="confirmPassword" class="textInput" placeholder="Confirm Password" required>
				<button>Create Account</button>
			</div>
		</form>
	</body>
</html>