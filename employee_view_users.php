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

				$q = "SELECT * FROM users where users.country='$country' order by user_id";

				$stmt = pg_prepare($dbconn,"pt",$q);
				$result = pg_query($dbconn,$q);

				echo "<FORM method = 'POST' action = '/deleteUser.php' id = 'form1'>
				<table id='resultable'>
				<thead>
					<th id='resultheader'>
						Last Name
					</th>
					<th id='resultheader'>
						First Name	
					</th>
					<th id='resultheader'>
						Account Type
					</th>
					<th id='resultheader'>
						Email
					</th>
					<th id='resultheader'>
						Country
					</th>
					<th id='resultheader'>
						User ID
					</th>
					<th id='resultheader'></th>
				</thead>
				<tbody>";
				while($row = pg_fetch_row($result)){  
					echo  
					"</td><td id='resultdata'>" . $row[0] . 
					"</td><td id='resultdata'>" . $row[1] . 
					"</td><td id='resultdata'>" . $row[6] .
					"</td><td id='resultdata'>" . $row[7] .
					"</td><td id='resultdata'>" . $row[9] .
					"</td><td id='resultdata'>" . $row[8] .
					"</td><td id='resultdata'> <input id='del' type = 'submit' name = '${row[8]}' value= 'X'></td></tr>";
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