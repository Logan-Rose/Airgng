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
				$uid =  $_SESSION['user_id'];
				$conn_string = $_SESSION['connString'];

				$dbconn = pg_connect($conn_string) or die('Connection failed');


				$q = "SELECT *
					  FROM booking b join property p on b.property_id = p.property_id 
					  WHERE b.user_id = '$uid'";

				$stmt = pg_prepare($dbconn,"pt",$q);
				$result = pg_query($dbconn,$q);

				$i = 0;

				echo "
				<table id='resultable'>
				<thead>
					<th>
						Image
					</th>
					<th id='resultheader'>
						Address
					</th>
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
						Number of Guests
					</th>
					<th id='resultheader'>
						Price
					</th>
					<th id='resultheader'>
						Cancel
					</th>
				</thead>
				<tbody>"
				;

				while($row = pg_fetch_row($result)){  
					$im = "SELECT image FROM property_image WHERE  property_id = ${row[6]}";
					$res = pg_query($dbconn,$im);
					if (pg_affected_rows($res) == 0){
						echo 
						"<tr>
						  <td id='resultimg'><img class = 'zoom' src = '/images/default.jpeg' heigt = '84' width = '84'/>";
					}else{
						echo 
						"<tr>
							  <td id='resultimg'><img class = 'zoom' src = '/images/" . pg_fetch_result($res, 0)    .
						"' heigt = '84' width = '84'/></td>";
					}

					echo "
					<td id='resultdata'>"		. $row[9] . 
					"</td><td id='resultdata'>"	. $row[2] . 
					"</td><td id='resultdata'>" . $row[3] .
					"</td><td id='resultdata'>" . $row[4] . 
					"</td><td id='resultdata'>" . $row[7] .
					"</td><td id='resultdata'>" . $row[5] . 
					"</td><td id='resultdata'> <button type =\"button\" id = '${row[0]}'>Cancel</button></td>"; 

					echo "</tr>";

				}
				echo "</tbody></table>";

			?>
			<br>
		</div>

	</body>

</html>