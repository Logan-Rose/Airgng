<html>
	<head>
	  <link rel="stylesheet" href="home1.css">
	  <title>Create Pricing Agreement</title>
	</head>

	<?php
		if (isset( $_POST['save'] ))
		{

			session_start();
			$mail = $_SESSION['mail'];
			$pid = $_SESSION['pid'];

			$conn_string = $_SESSION['connString'];
			$dbconn = pg_connect($conn_string) or die('Connection failed');

			$price_day = $_POST['pday'];
			$sitefees = $_POST['sfees'];
			$guests_allowed = $_POST['gallowed'];
			$min_stay = $_POST['minstay'];
			$amenities = $_POST['amm'];


			$query = "INSERT INTO pricing_agreement(property_id, price_per_day, site_fees, allowed, minimum_stay, amenities) VALUES ('$pid','$price_day','$sitefees','$guests_allowed','$min_stay','$amenities')";

			$result = pg_query($dbconn,$query);


			if(!$result){
				header("Location: ./listing_failure.php");
				exit();
			}else{
				header("Location: ./listing_success.php");
				exit();
			}

			pg_free_result($result);
			pg_close($dbconn);
 
		}
	?>
<body>
	<form id="main" class="mainRight" method="POST" action="">
		<p> <label for="pday">Price per day:</label>
				<input name="pday" type="text" id="pday"/>
		</p>

		<p> <label for="sfees">Total site fees:</label>
				<input name="sfees" type="text" id="sfees"/>
		</p>

		<p> <label for="gallowed">Maximum guests allowed:</label>
				<input name="gallowed" type="text" id="gallowed"/>
		</p>

		<p> <label for="minstay">Minimum length of stay:</label>
				<input name="minstay" type="text" id="minstay"/>
		</p>

		<p> <label for="amm">Provided amenities:</label>
				<input name="amm" type="text" id="amm"/>
		</p>
		<p><input type="submit" value="Create Agreement" name="save" /></p>
	</form>

</body>
</html>
