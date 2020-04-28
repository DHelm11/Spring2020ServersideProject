<?php
	$servername = "www.math-cs.ucmo.edu";
    $username = "cs4130_sp2020";
    $password = "tempPWD!";
    $db = "cs4130_sp2020";

    $conn = new mysqli($servername, $username, $password, $db);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

	if($_SESSION['loggedin'] == true){
		echo '<div class="navbar"><div class="logo"><img src="./Images/pizzaboblogo.png" /></div><div class="navLinks"><ul><li><a href="main.php">Home</a></li><li><a href="menu.php">Menu</a></li><li><a href="order.php">Order</a></li><li><a href="userprofile.php">' + $_SESSION['user_name'] + '</a></li><li><a >Log Out</a></li></ul></div></div>';
	}else{
		header('Location: ' . "http://localhost/SSPSpring2020/login.php");
	}
	
	echo '<div style="position: fixed; top: 6em; right: 5em; padding: 1em 4em; text-align: center; color: white; background-color: black; border-right: 5px solid darkred; border-left: 5px solid darkred; border-bottom: 5px solid darkred;"><div><h1>PRICE</h1><h1 id="price">$8</h1></div></div>';

	$sql = "SELECT pizza_name FROM ZGF_PB_Pizzas";
	$result = $conn->query($sql);

	$orderForm = "<div class='Forms'><div class='PizzaForm'><h1>Pizza Information</h1>";
	$orderForm = $orderForm . "<div><label>Type: </label><select id='type'>";

	while($row = $result -> fetch_assoc()){
		$orderForm = $orderForm . "<option value='" . $row["pizza_name"] . "'>" . $row["pizza_name"] . "</option>";
    }

	$orderForm = $orderForm . "</select></div>";
	$orderForm = $orderForm . "<div><label>Size:</label><input checked='checked' id='small' type='radio' name='sizeOption'>Small</input><input id='medium' type='radio' name='sizeOption'>Medium</input><input id='large' type='radio' name='sizeOption'>Large</input></div>";
	$orderForm = $orderForm . "<div><label>Extra Toppings:</label>";

	$sql = "SELECT topping_name FROM ZGF_PB_Toppings";
	$result = $conn->query($sql);

	$orderForm = $orderForm . "<table>";
	$index = 1;
	while($row = $result -> fetch_assoc()){
		if($index % 2 != 0){
			$orderForm = $orderForm . "<tr><td><input type='checkbox' name='toppings' value='" . $row["topping_name"] . "'><label>" . $row["topping_name"] . "</label></input></td>";
		}else{
			$orderForm = $orderForm . "<td><input type='checkbox' name='toppings' value='" . $row["topping_name"] . "'><label>" . $row["topping_name"] . "</label></input></td></tr>";
		}
		$index = $index + 1;
	}
	
	$orderForm = $orderForm . "</table></div></div>";

	$orderForm = $orderForm . "<div class='CustomerForm'><h1>Customer Information</h1>";
	$orderForm = $orderForm . "<div><p style='color: red;' id='firstNameError'></p></div>";
	$orderForm = $orderForm . "<div><label>First Name: </label><input type='text' value='' id='firstName'></input></div>" . "<div><p style='color: red;' id='lastNameError'></p></div>" . "<div><label> Last Name: </label><input type='text' value='' id='lastName'></input></div>";
	$orderForm = $orderForm . "<div><p style='color: red;' id='streetAddressError'></p></div><div><label>Street Address: </label><input type='text' value='' id='streetAddress'></input></div>";
	$orderForm = $orderForm . "<div><p style='color: red;' id='cityError'></p></div><div><label>City: </label><input type='text' value='' id='city'></input></div><div><p style='color: red;' id='stateError'></p></div><div><label> State: </label><input placeholder='MO' type='text' value='' id='state'></input></div>";
	$orderForm = $orderForm . "<div><p style='color: red;' id='zipcodeError'></p></div><div><label>Zipcode: </label><input placeholder='12345' type='text' value='' id='zipcode'></div>";
	$orderForm = $orderForm . "<div><p style='color: red;' id='phoneNumberError'></p></div><div><label>Phone Number: </label><input type='tel' id='phoneNumber' pattern='[0-9]{3}-[0-9]{2}-[0-9]{3}' placeholder='123-456-7890'></input></div>";

	$orderForm = $orderForm . "</div><div><button onclick='validateForm()'>Submit</button></div></div>";
	echo $orderForm;
?>

<html>
<head>
    <title>Order</title>
    <link rel="stylesheet" type="text/css" href="./CSS/order.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"> </script>
	<script>
		window.setInterval(updatePrice, 1000);

		function validateForm(){
			var invalid = validateFields();

			if(invalid){
				return;
			}

			var size = getSize();
			var toppings = getToppings();

			var postData = {
				"type" : document.getElementById('type').value,
				"size" : size,
				"toppings" : toppings,
				"price" : updatePrice(),
				"firstName" : document.getElementById('firstName').value,
				"lastName" :document.getElementById('lastName').value,
				"streetAddress" : document.getElementById('streetAddress').value,
				"city" : document.getElementById('city').value,
				"state" : document.getElementById('state').value,
				"zipcode" : document.getElementById('zipcode').value,
				"phoneNumber" : document.getElementById('phoneNumber').value
			};

			$.post("orderPizza.php", postData).done(function(data){
				alert(data);
				window.location.href = "http://localhost/SSPSpring2020/main.php";
			});
		}

		function getSize(){
			if(document.getElementById('small').checked){
				return 'small';
			}else if(document.getElementById('medium').checked){
				return 'medium';
			}else{
				return 'large';
			}
		}

		function getToppings(){
			var checkboxes = new Array();
			checkboxes = document.getElementsByTagName('input');
			var s = "";
			for(var i = 0; i < checkboxes.length; i++){
				if(checkboxes[i].type == "checkbox"){
					if(checkboxes[i].checked){
						s = s + checkboxes[i].value + ";";
					}
				}
			}

			return s;
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

		function updatePrice(){
			var price = 0;

			var checkboxes = new Array();
			checkboxes = document.getElementsByTagName('input');
			var topping_count = 0;
			for(var i = 0; i < checkboxes.length; i++){
				if(checkboxes[i].type == "checkbox"){
					if(checkboxes[i].checked){
						topping_count = topping_count + 1;
					}
				}
			}

			if(getSize() == "small"){
				price = price + 8;
				price = price + (topping_count * .5);
			}else if(getSize() == "medium"){
				price = price + 12;
				price = price + (topping_count * 1);
			}else{
				price = price + 16;
				price = price + (topping_count * 1.5);
			}

			document.getElementById('price').innerHTML = "$" + price;
			return price;
		}
	</script>
</head>
<body>
</body>
</html>