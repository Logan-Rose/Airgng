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
				$dbconn = pg_connect($conn_string) or die('Connection failed');
				$q = "SELECT first_name, acctype, country FROM users where email= '$mail'";
				$stmt = pg_prepare($dbconn,"pt",$q);
				$result = pg_query($dbconn,$q);
				
				while ($row = pg_fetch_row($result)) {
				echo "Welcome, $row[0], you are signed in as a $row[1]";
				$_SESSION['country'] = $row[2];
				echo "<br />\n";
				}
			?>
			<br>
			<a href="employee_view_properties.php">
				<button id ="menuButton" type="button">View Properties</button>
			</a>
			<br>
			<a href="employee_view_bookings.php">
				<button id ="menuButton" type="button">View Bookings</button>
			</a>
			<br>
			<a href="employee_view_users.php">
				<button id ="menuButton" type="button">View Users</button>
			</a>
			<br>
			<a href="home.html">
				<button id ="menuButton" type="button">Sign Out</button>
			</a>
		</div>


	</body>

</html>