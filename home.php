<html>
	<head>
		<title>Information gathered</title>
	</head>

	<body>


		<?php

			$conn_string = "host=web0.eecs.uottawa.ca port = 15432 dbname=lrose039 user=lrose039 password = 1Logic145carrots5";
			$dbconn = pg_connect($conn_string) or die('Connection failed');


			$usersName = $_POST['username'];
			$password = $_POST['password'];
			$type = $_POST['type'];

			echo $usersName . "</br>";
			echo $password . "</br>";
			echo $type . "</br>";

		?>
	</body>
</html>