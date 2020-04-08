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

	$user_id = array_keys($_POST)[0];

	$q = "delete from users where user_id= $user_id";
	$result = pg_query($dbconn,$q);
	$row = pg_fetch_row($result);
	header("Location: ./employee_view_users.php");
	exit();
?>
</body>
</html>