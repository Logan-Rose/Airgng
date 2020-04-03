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

				$q = "SELECT *
					  FROM property p
					  WHERE p.user_id = '$uid'";

				$stmt = pg_prepare($dbconn,"pt",$q);
				$result = pg_query($dbconn,$q);

				$i = 0;

				echo "<table id='resultable'>
				<thead>
					<th id='resultheader'>
						Address
					</th>
					<th id='resultheader'>
						Property Type
					</th>
					<th id='resultheader'>
						Room Type
					</th>
					<th id='resultheader'>
						Amentities
					</th>
					<th id='resultheader'>
						# of Bathooms
					</th>
					<th id='resultheader'>
						# of Bedrooms
					</th>
					<th id='resultheader'>
						Description
					</th>
					<th id='resultheader'>
						Delete
					</th>
				</thead>
				<tbody>"
				;

				while($row = pg_fetch_row($result)){  
					echo "<tr>";
					echo "
					<td id='resultdata'>"		. $row[1] . 
					"</td><td id='resultdata'>" . $row[2] . 
					"</td><td id='resultdata'>" . $row[3] . 
					"</td><td id='resultdata'>" . $row[4] . 
					"</td><td id='resultdata'>" . $row[5] .
					"</td><td id='resultdata'>" . $row[6] .
					"</td><td id='resultdata'>" . $row[7] .
					"</td><td id='resultdata'> <button type =\"button\" id = '${i}'>Delete</button></td>"; 
					echo "</tr>";

					$i++;
				}
				echo "</tbody></table>";

			?>
			<br>
		</div>

	</body>

</html>