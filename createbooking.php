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

				$q = "SELECT * FROM property";

				$stmt = pg_prepare($dbconn,"pt",$q);
				$result = pg_query($dbconn,$q);

				echo "<table id='resultSet'>";
				while($row = pg_fetch_row($result)){   //Creates a loop to loop through results
					echo 
					"<tr id='resultSet'><td id='resultSet'>" . $row[0] .
					"</td><td id='resultSet'>" . $row[1] . 
					"</td><td id='resultSet'>" . $row[2] . 
					"</td><td id='resultSet'>" . $row[3] . 
					"</td><td id='resultSet'>" . $row[4] .
					"</td><td id='resultSet'>" . $row[5] .
					"</td><td id='resultSet'> <button onclick='book()' type='button'>Book</button></td></tr>";  //$row['index'] the index here is a field name
				}

				echo "</table>";

			?>
			<br>
		</div>


	</body>

</html>