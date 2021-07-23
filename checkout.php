<?php
require 'dbConn.php';
require 'item.php';

$cid = $_SESSION['cid'];
$date = date('Y-m-d');

//Save new order
mysqli_query($conn, "insert into orders(cid, datecreation)
values($cid,'$date')");
$_SESSION['oid'] = $ordersid = mysqli_insert_id($conn);

// Save order details for new order
$cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
for($i=0; $i<count($cart); $i++) {
	$result = mysqli_query($con, 'insert into orderproduct(oid, pid, price, qnty)
values('.$ordersid.', '.$cart[$i]->id.','.$cart[$i]->price.', '.$cart[$i]->quantity.')');

if ($result) {
	
	// Clear all products in cart
	unset($_SESSION['cart']);
	header('location: thankYou.php');
	
	}
}

?>
