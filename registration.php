<html>
	<head>
	  <link rel="stylesheet" href="home.css">
	  <title>Register</title>
	</head>

	<?php
		if (isset( $_POST['save'] ))
		{
			$last_name = $_POST['lastName'];
			$first_name = $_POST['firstName'];
			$password = $_POST['pass'];
			$street = $_POST['street'];
			$city = $_POST['city'];
			$email = $_POST['email'];
			$dob = $_POST['dob'];
			$acctype = $_POST['type'];
			$country = $_POST['country'];
			$number = $_POST['number'];
			

			$USER_USERNAME = "";
			$USER_PASSWORD = "";
			$conn_string = "host=web0.eecs.uottawa.ca port = 15432 dbname=group_108 user=".$USER_USERNAME." password = " .$USER_PASSWORD;
			$dbconn = pg_connect($conn_string) or die('Connection failed');
			$q = "select max(user_id) from users";

			$r = pg_query($dbconn, $q);
			$uid = pg_fetch_row($r)[0];
			if (is_null($uid)){
				$uid = 1;
			}
			$uid++;
			$query = "INSERT INTO users(last_name,first_name,pass,street,city,email, dob, acctype,user_id, country, phone) VALUES ('$last_name','$first_name','$password','$street','$city','$email', '$dob', '$acctype','$uid', '$country', '$number')";

			$result = pg_query($dbconn,$query);

			if(!$result){
				die("Error in SQL query:" .pg_last_error());
			}

			echo "Data Successfully Entered ". "<a href='home.html'>login now</a>";
			header("Location: ./home.html");
			exit();

			pg_free_result($result);
			pg_close($dbconn);

		}
	?>
<body>

		<video autoplay muted loop id="myVideo">
		  <source src="clouds.mp4" type="video/mp4">
		</video>

<form id="main" class="mainRight" method="POST" action="">
		<p> <label for="lastName">Last name:</label>
				<input name="lastName" type="text" id="lastName"/>
		</p>

		<p> <label for="firstName">First name:</label>
				<input name="firstName" type="text" id="firstName"/>
		</p>

		<p> <label for="pass">Password:</label>
				<input name="pass" type="password" id="pass"/>
		</p>

		<p> <label for="street">Street:</label>
				<input name="street" type="text" id="street"/>
		</p>

		<p> <label for="city">City:</label>
				<input name="city" type="text" id="city"/>
		</p>
		<p> <label for="country">Country:</label>
				<input name="country" type="text" id="country"/>
		</p>

		<p> <label for="email">Email:</label>
				<input name="email" type="text" id="email"/>
		</p>
		<p> <label for="number">Phone Number:</label>
				<input name="number" type="text" id="number"/>
		</p>
		<p> <label for="dob">Date of birth:</label>
				<input name="dob" type="date" id="dob"/>
		</p>
			<tr>
				<input type="radio" id="guest" name="type" value="guest">
				<label for="guest">Guest</label>
				<input type="radio" id="host" name="type" value="host">
				<label for="host">Host</label><br>
				<input type="radio" id="host" name="type" value="employee">
				<label for="host">Employee</label><br>
			</tr>
		<p><input type="submit" value="Register" name="save" /></p>
	</form>

</body>
</html>
