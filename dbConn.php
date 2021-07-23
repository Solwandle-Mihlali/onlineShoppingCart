<?php
session_start();
$con = mysqli_connect('localhost','root','');

$dbname="19331202_POE";
 
# Check connection

	if (!$con) {
		
			die("Connection failed: " . mysqli_connect_error());
		 	
		}
		
		//echo "<br>Connected successfully<br>";


	$selectDB = mysqli_select_db($con,$dbname);
	

		if (!$selectDB) {

		$sql = "CREATE DATABASE ".$dbname."";
		
		mysqli_query($con, $sql); 
		
		
		//echo "<br>Database ".$dbname." succesfully created<br>";

		} else {
			
		   //echo "<br>Database ".$dbname." already exsist<br>";
			
		}
	
	# new connection with database name specified
	
    $conn = mysqli_connect('localhost','root','',$dbname);

?>



