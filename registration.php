<html>
	<head>
	  <link rel="stylesheet" href="home1.css">
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

			$conn_string = "host=web0.eecs.uottawa.ca port = 15432 dbname=group_108 user=kdabb095 password = ";
			$dbconn = pg_connect($conn_string) or die('Connection failed');
			$q = 'SELECT * FROM users';
			$r = pg_query($q);
			$uid = pg_num_fields($r);
			$uid++;
			$query = "INSERT INTO users(last_name,first_name,pass,street,city,email, dob, acctype,user_id) VALUES ('$last_name','$first_name','$password','$street','$city','$email', '$dob', '$acctype','$uid')";

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

		<p> <label for="email">Email:</label>
				<input name="email" type="text" id="email"/>
		</p>
		<p> <label for="dob">Date of birth:</label>
				<input name="dob" type="date" id="dob"/>
		</p>
			<tr>
				<input type="radio" id="guest" name="type" value="guest">
				<label for="guest">Guest</label>
				<input type="radio" id="host" name="type" value="host">
				<label for="host">Host</label><br>
			</tr>
		<p><input type="submit" value="Register" name="save" /></p>
	</form>

</body>
</html>