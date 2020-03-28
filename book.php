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

				echo $_SESSION['address'];


			?>
			<br>
		</div>


	</body>

</html>