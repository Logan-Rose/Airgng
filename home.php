<html>
	<head>
		<title>Information gathered</title>
	</head>

	<body>
		<?php
			session_start();
			$conn_string = "host=web0.eecs.uottawa.ca port = 15432 dbname=lrose039 user=lrose039 password =";
			$dbconn = pg_connect($conn_string) or die('Connection failed');
			$mail = $_POST['email'];
			$password = $_POST['password'];


			$_SESSION['mail'] = $mail;
			$_SESSION['connString'] = $conn_string;

			$query = "SELECT acctype FROM users where email= '$mail' and pass='$password'";
			$stmt = pg_prepare($dbconn,"ps",$query);
			$result = pg_query($dbconn,$query);

			while ($row = pg_fetch_row($result)) {
				if($row[0] =="guest"){
					header("Location: ./guest_terminal.php");
					exit();
				} else if($row[0] =="host"){
					header("Location: ./host_terminal.php");
					exit();
				}
			}
			header("Location: ./home.html");
			exit();



		?>
	</body>
</html>