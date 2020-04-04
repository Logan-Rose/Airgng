<html>
	<head>
	  <link rel="stylesheet" href="home1.css">
	</head>
	<style type="text/css">
	.center{
		display: block;
		margin-left: auto;
		margin-right: auto;
		width: 50%; 
	}
	</style>
	<script type="text/javascript">

		function newprice(ind, pr) {
			var p =   document.getElementById("numdays").options[ind].value  * parseInt(pr);
			document.getElementById('price').innerHTML = ("Price: $" + p);
			console.log(p);
		}
	</script>
	<body>
		<div id = "image" class ='center'>
			<?php 
				session_start();

				$prop_id = array_keys($_POST)[0];
				$_SESSION['prop_id'] = $prop_id;

				$mail = $_SESSION['mail'];
				$uid =  $_SESSION['user_id']; 
				$conn_string = $_SESSION['connString'];

				$dbconn = pg_connect($conn_string) or die('Connection failed');
				$q1 = "SELECT * FROM property p INNER JOIN pricing_agreement pa ON p.property_id = pa.property_id where p.property_id = '$prop_id'";
				$res1 = pg_query($dbconn, $q1);
				$row = pg_fetch_row($res1);
				$im = "SELECT image FROM property_image WHERE  property_id = ${row[0]}";
					$res = pg_query($dbconn,$im);
					echo 
					"<img src = '/images/" . pg_fetch_result($res, 0) .
					"' >"; 
					
			?>
		</div>

		<div id="main" class="mainCenter">
			<?php

				echo "
				<col>
				<col>
				<colgroup span = '7'></colgroup>
				<table id='resultable'>
				<thead>
					<th id='resultheader'>
						Property Type
					</th>
					<th id='resultheader'>
						Address	
					</th>
					<th id='resultheader'>
						Number of Bedrooms
					</th>
					<th id='resultheader'>
						Number of Bathrooms
					</th>
					<th id='resultheader'>
						Price per Day
					</th>
					<th id='resultheader'>
						Minimum Stay
					</th>
					<th id='resultheader'>
						Maximum Guests Allowed
					</th>
				</thead>
				<tbody>";
				// $row = pg_fetch_row($res1));

				 //Creates a loop to loop through results
					echo "<td id='resultdata'>" . $row[2] . 
					"</td><td id='resultdata'>" . $row[1] . 
					"</td><td id='resultdata'>" . $row[5] . 
					"</td><td id='resultdata'>" . $row[4] .
					"</td><td id='resultdata'>$" . $row[10] .
					"</td><td id='resultdata'>" . $row[13] .
					"</td><td id='resultdata'>" . $row[12] .
					"<tfoot><tr> <br></tr><td colspan = '1' scope = 'colgroup'> Description:</td> 
					<td colspan = '6' scope ='colgroup'>".$row[6]."</td></tfoot>";  //$row['index'] the index here is a field name
				

				echo "</tbody></table>";
				$rice = $row[10];
				$min_stay = $row[13];
				$num_guests = $row[12];
			
				$_SESSION['priceperday'] = $rice;
				if (is_null($num_guests) || $num_guests < 1) {
					$num_guests = 9;
				}
				if (is_null($min_stay) || $min_stay < 1) {
					$min_stay = 1;
				}
				$start_price = $rice * $min_stay; 
				echo "<FORM method = 'POST' action = '/book.php' id = 'book'>


<table>
	<thead>
	<th>
		Number of days:
	</th>
	<th>
		Number of guests:
	</th>
	<th>
		Payment type:
	</th>
	<th>
		<p id = 'price'>
			Price: \$$start_price
		</p>
	</th>
	</thead>
	<tbody>
		<tr>
			<td>
				<select id = 'numdays' name = 'numdays' class ='ndays' onchange = 'newprice(this.selectedIndex, ${rice})'>";
				for ($i=$min_stay; $i < 10 ; $i++) { 
						echo "<option value = '$i'>$i</option>";
					}	
echo			 "</select>
			</td>

			<td>
				<select id = 'numguests' name = 'numguests' class ='nguests'>";
				for ($i=1; $i <= $num_guests ; $i++) { 
						echo "<option value = '$i'>$i</option>";
					}	
echo			 "</select>
			</td>
			<td>
				<select id = 'payment' name = 'payment' class ='payment'>
					<option value = 'Credit'>Credit</option>
					<option value = 'Debit'>Debit</option>
					<option value = 'DirDeposit'>Direct Deposit</option>
				</select>
			</td>
			<td><input type = 'submit' name = '${row[0]}' value= 'book'>
			</td>
		</tr>
	</tbody>
</table>
</FORM>"


				;
			
			?>
	</body>

</html>