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
				$country = $_SESSION['country'];

				$dbconn = pg_connect($conn_string) or die('Connection failed');

				$q = "select * from property P where P.country='$country' order by property_id ";

				$stmt = pg_prepare($dbconn,"pt",$q);
				$result = pg_query($dbconn,$q);

				echo "<FORM method = 'POST' action = '/deleteProperty.php' id = 'form1'>
				<table id='resultable'>
				<thead>
					<th id='resultheader'>
						Image	
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
					<th id='resultheader'></th>
				</thead>
				<tbody>";
				while($row = pg_fetch_row($result)){  
					$im = "SELECT image FROM property_image WHERE  property_id = ${row[0]}";
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
					echo  
					"</td><td id='resultdata'>" . $row[1] . 
					"</td><td id='resultdata'>" . $row[2] . 
					"</td><td id='resultdata'>" . $row[3] .
					"</td><td id='resultdata'>" . $row[4] .
					"</td><td id='resultdata'>" . $row[5] .
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