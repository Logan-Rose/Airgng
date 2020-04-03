<html>
	<head>
		<title>Information gathered</title>
	</head>

	<body>
		<?php
			session_start();
			$conn_string = "host=web0.eecs.uottawa.ca port = 15432 dbname=group_108 user=lrose039 password = 1Logic145carrots5";
			$dbconn = pg_connect($conn_string) or die('Connection failed');
			$mail = $_POST['email'];
			$password = $_POST['password'];


			
			$_SESSION['mail'] = $mail;
			$_SESSION['connString'] = $conn_string;

			$query = "SELECT acctype, first_name FROM users where email= '$mail' and pass='$password'";
			$stmt = pg_prepare($dbconn,"ps",$query);
			$result = pg_query($dbconn,$query);


			while ($row = pg_fetch_row($result)) {
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
