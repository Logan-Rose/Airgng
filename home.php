<html>
	<head>
		<title>Information gathered</title>
	</head>

	<body>
		<?php
		//THIS IS THE ONLY PLACE YOU NEED TO PUT UR USERNAME AND PASSWORD!!!!
		$USER_USERNAME = "kdabb095";
		$USER_PASSWORD = "";
			session_start();
			$conn_string = "host=web0.eecs.uottawa.ca port = 15432 dbname=group_108 user=".$USER_USERNAME." password = " .$USER_PASSWORD;
			$dbconn = pg_connect($conn_string) or die('Connection failed');
			$mail = $_POST['email'];
			$password = $_POST['password'];


			
			$_SESSION['mail'] = $mail;
			$_SESSION['connString'] = $conn_string;
			$query = "SELECT acctype, first_name, user_id FROM users where email= '$mail' and pass='$password'";
			$stmt = pg_prepare($dbconn,"ps",$query);
			$result = pg_query($dbconn,$query);


			while ($row = pg_fetch_row($result)) {
				$_SESSION['user_id'] = $row[2];
				$_SESSION['first_name'] = $row[1];
				if($row[0] =="guest"){
					header("Location: ./guest_terminal.php");
					exit();
				} else if($row[0] =="host"){
					header("Location: ./host_terminal.php");
					exit();
				} else if($row[0] =="employee"){
					header("Location: ./employee_terminal.php");
					exit();
				}
			}
			header("Location: ./home.html");
			exit();



		?>
	</body>
</html>
