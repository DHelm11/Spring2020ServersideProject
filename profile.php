<?php
	session_start();

	if(isset($_SESSION['loggedin'])){
		$logged_in = $_SESSION['loggedin'];
		$user_name = $_SESSION['user_name'];
		$email = $_SESSION['email'];
		$employee = $_SESSION['employee'];
	}

	if($logged_in == false){
		header('Location: ' . "http://localhost/SSPSpring2020/login.php");
	}

	$servername = "www.math-cs.ucmo.edu";
    $username = "cs4130_sp2020";
    $password = "tempPWD!";
    $db = "cs4130_sp2020";
	
	$conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
	
	if($employee == "true"){
		echo '<div class="navbar"><div class="logo"><img src="./Images/pizzaboblogo.png" /></div><div class="navLinks"><ul><li><a href="viewOrders.php">View Orders</a></li><li><a href="profile.php">' . $user_name . '</a></li><li><a href="logout.php">Log Out</a></li></ul></div></div>';
		$sql = "SELECT * FROM ZGF_PB_Employees WHERE email = '" . $email . "'";
		
		$result = $conn->query($sql);

		$row = $result -> fetch_assoc();

		$orderForm = "<div class='MainDiv'><div class='UserForm'><h1>Employee Information</h1>";
		$orderForm = $orderForm . "<div><p style='color: red;' id='firstNameError'></p></div>";
		$orderForm = $orderForm . "<div><input type='text' placeholder='First Name' value='" . $row['first_name'] . "' id='firstName'></input></div>" . "<div><p style='color: red;' id='lastNameError'></p></div>" . "<div><input type='text' placeholder='Last Name' value='" . $row['last_name'] . "' id='lastName'></input></div>";
		$orderForm = $orderForm . "<div style='margin-top: 1em;'><input disabled type='text' value='Pay Rate: " . $row['pay_rate'] . "'></div>";
		$orderForm = $orderForm . "<div><p style='color: red;' id='streetAddressError'></p></div><div><input type='text' placeholder='Street Address' value='" . $row['street_address'] . "' id='streetAddress'></input></div>";
		$orderForm = $orderForm . "<div><p style='color: red;' id='cityError'></p></div><div><input type='text' placeholder='City' value='" . $row['city'] . "' id='city'></input></div><div><p style='color: red;' id='stateError'></p></div><div><input placeholder='State (ex: MO)' type='text' value='" . $row['state'] . "' id='state'></input></div>";
		$orderForm = $orderForm . "<div><p style='color: red;' id='zipcodeError'></p></div><div><input placeholder='Zipcode' type='text' value='" . $row['zipcode'] . "' id='zipcode'></div>";
		$orderForm = $orderForm . "<div><p style='color: red;' id='phoneNumberError'></p></div><div><input type='tel' id='phoneNumber' pattern='[0-9]{3}-[0-9]{2}-[0-9]{3}' placeholder='Phone Number (ex: 1234567890)' value='" . $row['phone_number'] . "'></input></div>";

		$orderForm = $orderForm . "</div><div><button onclick='validateForm(1)'>UPDATE</button></div></div></div>";
		echo $orderForm;
	}else{
		echo '<div class="navbar"><div class="logo"><img src="./Images/pizzaboblogo.png" /></div><div class="navLinks"><ul><li><a href="main.php">Home</a></li><li><a href="menu.php">Menu</a></li><li><a href="order.php">Order</a></li><li><a href="profile.php">' . $user_name . '</a></li><li><a href="logout.php">Log Out</a></li></ul></div></div>';
		$sql = "SELECT * FROM ZGF_PB_Users WHERE email = '" . $email . "'";
		
		$result = $conn->query($sql);

		$row = $result -> fetch_assoc();

		$orderForm = "<div class='MainDiv'><div class='UserForm'><h1>User Information</h1>";
		$orderForm = $orderForm . "<div><p style='color: red;' id='firstNameError'></p></div>";
		$orderForm = $orderForm . "<div><input type='text' placeholder='First Name' value='" . $row['first_name'] . "' id='firstName'></input></div>" . "<div><p style='color: red;' id='lastNameError'></p></div>" . "<div><input type='text' placeholder='Last Name' value='" . $row['last_name'] . "' id='lastName'></input></div>";
		$orderForm = $orderForm . "<div><p style='color: red;' id='streetAddressError'></p></div><div><input type='text' placeholder='Street Address' value='" . $row['street_address'] . "' id='streetAddress'></input></div>";
		$orderForm = $orderForm . "<div><p style='color: red;' id='cityError'></p></div><div><input type='text' placeholder='City' value='" . $row['city'] . "' id='city'></input></div><div><p style='color: red;' id='stateError'></p></div><div><input placeholder='State (ex: MO)' type='text' value='" . $row['state'] . "' id='state'></input></div>";
		$orderForm = $orderForm . "<div><p style='color: red;' id='zipcodeError'></p></div><div><input placeholder='Zipcode' type='text' value='" . $row['zipcode'] . "' id='zipcode'></div>";
		$orderForm = $orderForm . "<div><p style='color: red;' id='phoneNumberError'></p></div><div><input type='tel' id='phoneNumber' pattern='[0-9]{3}-[0-9]{2}-[0-9]{3}' placeholder='Phone Number (ex: 1234567890)' value='" . $row['phone_number'] . "'></input></div>";

		$orderForm = $orderForm . "</div><div><button onclick='validateForm(0)'>UPDATE</button></div></div></div>";
		echo $orderForm;
	}

?>

<html>
	<head>
		<title>Your Profile</title>
		<link rel="stylesheet" type="text/css" href="./CSS/profile.css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
		<script>
			function validateForm(employeeFlag){
				var invalid = validateFields();

				if(invalid){
					return;
				}

				var postData = {
				"employeeFlag" : employeeFlag,
				"firstName" : document.getElementById('firstName').value,
				"lastName" :document.getElementById('lastName').value,
				"streetAddress" : document.getElementById('streetAddress').value,
				"city" : document.getElementById('city').value,
				"state" : document.getElementById('state').value,
				"zipcode" : document.getElementById('zipcode').value,
				"phoneNumber" : document.getElementById('phoneNumber').value
				};

				$.post("updateInfo.php", postData).done(function(data){
					alert("Updated");
					window.location.href = "http://localhost/SSPSpring2020/profile.php";
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

	</body>
</html>
