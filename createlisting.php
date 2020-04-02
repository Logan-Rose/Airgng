<html>
	<head>
	  <link rel="stylesheet" href="home1.css">
	  <title>Create Listing</title>
	</head>

	<?php
		if (isset( $_POST['save'] ))
		{

			session_start();
			$mail = $_SESSION['mail'];
			$conn_string = $_SESSION['connString'];
			$dbconn = pg_connect($conn_string) or die('Connection failed');
			$q = "SELECT user_id FROM users where email= '$mail'";
			$stmt = pg_prepare($dbconn,"pt",$q);
			$result = pg_query($dbconn,$q);
				
			$uid = pg_fetch_row($result)[0];

			echo $uid;

			$q = 'SELECT * FROM property';
			$r = pg_query($dbconn, $q);
			$pid = pg_num_rows($r);
			$pid++;


			$address = $_POST['address'];
			$prop_type = $_POST['ptype'];
			$room_type = $_POST['rtype'];
			$baths = $_POST['numbaths'];
			$beds = $_POST['numbeds'];
			$description = $_POST['desc'];


			$conn_string = "host=web0.eecs.uottawa.ca port = 15432 dbname=group_108 user=lrose039 password = 1Logic145carrots5";
			$dbconn = pg_connect($conn_string) or die('Connection failed');

			$query = "INSERT INTO property(property_id, address, property_type, room_type, bathrooms, bedrooms, description, user_id) VALUES ('$pid','$address','$prop_type','$room_type','$baths','$beds', '$description', '$uid')";

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
		<p> <label for="address">Address:</label>
				<input name="address" type="text" id="address"/>
		</p>

		<p> <label for="ptype">Property Type:</label>
				<input name="ptype" type="text" id="ptype"/>
		</p>

		<p> <label for="rtype">Room Type:</label>
				<input name="rtype" type="text" id="rtype"/>
		</p>

		<p> <label for="numbeds">Number of Bedrooms:</label>
				<input name="numbeds" type="text" id="numbeds"/>
		</p>

		<p> <label for="numbaths">Number of Bathrooms:</label>
				<input name="numbaths" type="text" id="numbaths"/>
		</p>
		<p> <label for="desc">Description:</label>
				<input name="desc" type="text" id="desc"/>
		</p>
		Status
		<br>
			<tr>
				<input type="radio" id="availabe" name="type" value="availabe">
				<label for="availabe">Available</label>
				<input type="radio" id="unavailabe" name="type" value="unavailabe">
				<label for="unavailabet">Unavailable</label><br>
			</tr>
		<p><input type="submit" value="Register" name="save" /></p>
	</form>

</body>
</html>
