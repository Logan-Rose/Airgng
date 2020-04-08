<html>
	<head>
	  <link rel="stylesheet" href="home.css">
	</head>

	<body>

		<div id="main" class="mainCenter">
			<?php
				session_start();
				$mail = $_SESSION['mail'];
				$conn_string = $_SESSION['connString'];
				$first_name = $_SESSION['first_name'];
				$dbconn = pg_connect($conn_string) or die('Connection failed');
				$q = "SELECT first_name, acctype FROM users where email= '$mail' AND first_name = '$first_name'";
				$stmt = pg_prepare($dbconn,"pt",$q);
				$result = pg_query($dbconn,$q);
				
				while ($row = pg_fetch_row($result)) {
				echo "Welcome, $row[0], you are signed in as a $row[1]";
				echo "<br />\n";
				}
			?>
			<br>
			<a href="createlisting.php">
				<button id ="menuButton" type="button">Create a listing</button>
			</a>
			<br>
			<a href="viewproperty.php">
				<button id ="menuButton" type="button">View Bookings</button>
			</a>
			<br>
			<a href="home.html">
				<button id ="menuButton" type="button">Sign Out</button>
			</a>
		</div>


	</body>

</html>