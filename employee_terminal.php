<html>
	<head>
	  <link rel="stylesheet" href="home1.css">
	</head>
	<script type="text/javascript">
		function book(id) {
			alert(id);
		}
	</script>


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

				$i = 0;
				echo "<table id='resultable'>
				<thead>
					<th id='resultheader'>
						Image	
					</th>
					<th id='resultheader'>
						ID	
					</th>
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
						Amenities
					</th>
					<th id='resultheader'>
						Number of Bathrooms
					</th>
				</thead>
				<tbody>"
				;
				while($row = pg_fetch_row($result)){  
				 //Creates a loop to loop through results
					$im = "SELECT image FROM property_image WHERE  property_id = ${row[0]}";
					$res = pg_query($dbconn,$im);
					echo 
					"<form id='main' class='mainRight' method='POST'>
					<tr>
						  <td id='resultimg'><img src = '/images/" . pg_fetch_result($res, 0)    .
					"' heigt = '84' width = '84'/></td><td id='resultdata'>" . $row[0] .
					"</td><td id='resultdata'>" . $row[1] . 
					"</td><td id='resultdata'>" . $row[2] . 
					"</td><td id='resultdata'>" . $row[3] . 
					"</td><td id='resultdata'>" . $row[4] .
					"</td><td id='resultdata'>" . $row[5] .
					"</td>";
					$i++;
				}

				echo "</tbody></table>";			

			?>
			<br>
		</div>

	</body>

</html>