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


			$result = pg_query($dbconn, "SELECT country FROM users where email= '$mail'");
			$country = pg_fetch_row($result)[0];
			echo $country;

			$q = "select max(property_id) from property";

			$r = pg_query($dbconn, $q);
			$pid = pg_fetch_row($r)[0];
			if (is_null($pid)){
				$pid = 0;
			}
		


			$pid++;

			$target_dir =  __DIR__ . "/images/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$im_name = basename($_FILES["fileToUpload"]["name"]);
    		}else {
        		$im_name = "default.jpeg";
    		}
			$address = $_POST['address'];
			$prop_type = $_POST['ptype'];
			$room_type = $_POST['rtype'];
			$baths = $_POST['numbaths'];
			$beds = $_POST['numbeds'];
			$description = $_POST['desc'];

			$q_im = "SELECT * FROM property_image";
			
			$res_im = pg_query($dbconn, $q_im);
			$im_id = pg_num_rows($res_im);
			$im_id++;

			$qq = "INSERT INTO property_image(image_id, property_id, image) VALUES('$im_id','$pid', '$im_name')";
			$im_query = pg_query($dbconn, $qq);

			$query = "INSERT INTO property(property_id, address, property_type, room_type, bathrooms, bedrooms, description, user_id, country) VALUES ('$pid','$address','$prop_type','$room_type','$baths','$beds', '$description', '$uid', '$country')";

			$result = pg_query($dbconn,$query);

			$_SESSION['pid'] = $pid;

			if(!$result){
				die("Error in SQL query:" .pg_last_error());
			}
			// echo($im_name);
			//echo "Data Successfully Entered ". "<a href='pricingagreement.php'></a>";
			header("Location: ./pricingagreement.php");
			exit();

			pg_free_result($result);
			pg_close($dbconn);

		}
	?>
<body>
	<form id="main" class="mainRight" method="POST" action="" enctype="multipart/form-data">
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
		<p>
			<input type="file" name="fileToUpload" id="fileToUpload">
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
