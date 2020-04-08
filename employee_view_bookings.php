<html>
	<head>
	  <link rel="stylesheet" href="home1.css">
	</head>
		<style type="text/css">
		.zoom{
			padding: 10px;
			transition: transform .2s;
			width: 150px !importent;
			height: 100px !importent;
			margin: 0 auto; 
		}
		.zoom:hover{
			transform: scale(1.25);
		}
		</style>

	<body>

		<div id="main" class="mainCenter">
			<?php
				session_start();
				$mail = $_SESSION['mail'];
				$conn_string = $_SESSION['connString'];

				$dbconn = pg_connect($conn_string) or die('Connection failed');

				$q = "SELECT * FROM booking order by booking_id";

				$stmt = pg_prepare($dbconn,"pt",$q);
				$result = pg_query($dbconn,$q);

				echo "<FORM method = 'POST' action = '/deleteBooking.php' id = 'form1'>
				<table id='resultable'>
				<thead>
					<th id='resultheader'>
						Booking ID	
					</th>
					<th id='resultheader'>
						Guest ID	
					</th>
					<th id='resultheader'>
						Property ID	
					</th>
					<th id='resultheader'>
						Check in Date
					</th>
					<th id='resultheader'>
						Price
					</th>
					<th id='resultheader'>
						Number of Guests
					</th>
					<th id='resultheader'></th>
				</thead>
				<tbody>";
				while($row = pg_fetch_row($result)){  
					echo  
					"</td><td id='resultdata'>" . $row[0] . 
					"</td><td id='resultdata'>" . $row[1] . 
					"</td><td id='resultdata'>" . $row[6] .
					"</td><td id='resultdata'>" . $row[3] .
					"</td><td id='resultdata'>" . $row[5] .
					"</td><td id='resultdata'>" . $row[7] .
					"</td><td id='resultdata'> <input id='del' type = 'submit' name = '${row[0]}' value= 'X'></td></tr>";
				}
				echo "</tbody></table>";			
			?>

			<br>

			<a href="employee_terminal.php">
				<button id ="menuButton" type="button">Terminal</button>
			</a>
		</div>

	</body>

</html>