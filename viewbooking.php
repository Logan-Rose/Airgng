<html>
	<head>
	  <link rel="stylesheet" href="home1.css">
	</head>

	<body>

		<div id="main" class="mainCenter">
			<?php
				session_start();
				$mail = $_SESSION['mail'];
				$uid =  $_SESSION['user_id'];
				$conn_string = $_SESSION['connString'];

				$dbconn = pg_connect($conn_string) or die('Connection failed');

				echo $uid;

				$q = "SELECT *
					  FROM booking b
					  WHERE b.user_id = '$uid'";

				$stmt = pg_prepare($dbconn,"pt",$q);
				$result = pg_query($dbconn,$q);

				$i = 0;

				echo "<table id='resultable'>
				<thead>
					<th id='resultheader'>
						Booking Date
					</th>
					<th id='resultheader'>
						Check In Date
					</th>
					<th id='resultheader'>
						Check Out Date
					</th>
					<th id='resultheader'>
						Price
					</th>
					<th id='resultheader'>
						Refund
					</th>
					<th id='resultheader'>
						Status
					</th>
					<th id='resultheader'>
						Cancel
					</th>
				</thead>
				<tbody>"
				;

				while($row = pg_fetch_row($result)){  
					echo "<tr>";

					echo "
					<td id='resultdata'>"		. $row[0] . 
					"</td><td id='resultdata'>" . $row[1] . 
					"</td><td id='resultdata'>" . $row[2] . 
					"</td><td id='resultdata'>" . $row[3] . 
					"</td><td id='resultdata'>" . $row[4] .
					"</td><td id='resultdata'>" . $row[5] .
					"</td><td id='resultdata'> <button type =\"button\" id = '${i}'>Cancel</button></td>"; 

					echo "</tr>";

					$i++;
				}
				echo "</tbody></table>";

			?>
			<br>
		</div>

	</body>

</html>