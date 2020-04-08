<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="home1.css">
</head>
<body>
<?php
	session_start();
	$conn_string = $_SESSION['connString'];
	$dbconn = pg_connect($conn_string) or die('Connection failed');

	$prop_id = array_keys($_POST)[0];

	$q = "delete from Property where property_id= $prop_id";
	$result = pg_query($dbconn,$q);
	$q1 = "delete from pricing_agreement where property_id = $prop_id";
	$res1 = pg_query($dbconn, $q1);
	$q2 = "delete from booking where property_id = $prop_id";
	$res2 = pg_query($dbconn, $q2);
	header("Location: ./host_terminal.php");
	exit();
?>
</body>
</html>