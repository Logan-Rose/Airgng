<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="home1.css">
</head>
<body>
<?php
	session_start();
	$prop_id = $_SESSION['prop_id'];
	$uid = $_SESSION['user_id'];
	$payment_type = $_POST['payment'];
	$ndays = $_POST['numdays'];
	$ppd = $_SESSION['priceperday'];
	$tot_price = $ndays * $ppd;
	$conn_string = $_SESSION['connString'];
	$dbconn = pg_connect($conn_string) or die('Connection failed');
	$qt_id = "SELECT * FROM payment";
	$res = pg_query($dbconn, $qt_id);
	$t_id = pg_num_rows($res);
	$t_id++;

	// $_SESSION['tot_price'] = $tot_price;
	$numG = $_POST['numguests'];

	// echo "T-id: " . $t_id ." Payment type: " . $payment_type ." Total price: " . $tot_price . " Uid: ".$_SESSION['user_id']. " Num_guests: ". $_POST['numguests'];
	$q = "INSERT INTO payment(transaction_id, payment_type, amount, status, user_id) VALUES('$t_id', '$payment_type', '$tot_price', 1, '$uid')";
	$result = pg_query($dbconn,$q);
	echo pg_last_error();

	if(!$result){
		header("Location: ./payment_failed.php");
		exit();
	}
	$qb_id = "SELECT * FROM booking";
	$bres = pg_query($dbconn,$qb_id);
	$b_id = pg_num_rows($bres);
	$b_id++;
	$date = date('d/m/Y');
	// echo "b-id: " . $b_id ." Payment: " . $tot_price ." date: " . $date . " Uid: ".$_SESSION['user_id']. " Num_guests: ". $_POST['numguests'];
	$qb = "INSERT INTO booking(booking_id, user_id, booking_date, checkin_date, checkout_date, price, property_id, num_guests) VALUES('$b_id', '$uid', '$date', '$date', '$date', $tot_price, $prop_id, $numG)"; 
	$bres = pg_query($dbconn, $qb);

	// echo pg_last_error();
	if(!$bres){
			header("Location: ./booking_failed.php");
			exit();
	}else{
			header("Location: ./booking_success.php");
			exit();
	}
?>
</body>
</html>