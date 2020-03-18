<html>
	<head>
		<title>Information gathered</title>
	</head>

	<body>


		<?php

			$conn_string = "host=web0.eecs.uottawa.ca port = 15432 dbname=lrose039 user=lrose039 password =";
			$dbconn = pg_connect($conn_string) or die('Connection failed');


			$usersName = $_POST['username'];
			$password = $_POST['password'];
			$type = $_POST['type'];

			echo $usersName . "</br>";
			echo $password . "</br>";
			echo $type . "</br>";


			if($type == 'guest'){
				header("Location: ./guest_terminal.php");
				exit();
			} else{
				header("Location: ./host_terminal.html");
				exit();
			}


		?>
	</body>
</html>