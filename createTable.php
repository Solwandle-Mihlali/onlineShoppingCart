<?php


		$sqla = "CREATE TABLE `customers` (
				  `cid` int(10) NOT NULL AUTO_INCREMENT,
				  `name` varchar(50) NOT NULL,
				  `surname` varchar(50) NOT NULL,
				  `email` varchar(50) NOT NULL,
				  `password` varchar(200) NOT NULL,
				  PRIMARY KEY (`cid`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$sqlb = "CREATE TABLE `products` (
				  `pid` int(10) NOT NULL AUTO_INCREMENT,
				  `pname` varchar(50) NOT NULL,
				  `price` decimal(10,2) NOT NULL,
				  `image` varchar(50) NOT NULL,
				  `qnty` int(10) NOT NULL,
				  PRIMARY KEY (`pid`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$sqlc = "CREATE TABLE `orders` (
				  `oid` int(10) NOT NULL AUTO_INCREMENT,
				  `cid` int(10) NOT NULL,
				  `datecreation` date NOT NULL,
				  PRIMARY KEY (`oid`),
				  KEY `cid` (`cid`),
				  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `customers` (`cid`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$sqld = "CREATE TABLE `orderproduct` (
				  `oid` int(10) NOT NULL,
				  `pid` int(10) NOT NULL,
				  `price` decimal(10,2) NOT NULL,
				  `qnty` int(10) NOT NULL,
				  KEY `oid` (`oid`),
				  KEY `pid` (`pid`),
				  CONSTRAINT `orderproduct_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`),
				  CONSTRAINT `orderproduct_ibfk_2` FOREIGN KEY (`oid`) REFERENCES `orders` (`oid`)
				) ENGINE=InnoDB DEFAULT CHARSET=latin1";

		$CreateTableA = mysqli_query($conn, $sqla);
		$CreateTableB = mysqli_query($conn, $sqlb);
		$CreateTableC = mysqli_query($conn, $sqlc);
		$CreateTableD = mysqli_query($conn, $sqld);
		

		if ($CreateTableA && $CreateTableB && $CreateTableC && $CreateTableD == TRUE) {
			
				//echo "<br>Tables created<br>";
				#echo "There was an error :".mysqli_error($conn);
				
		} else {

			//echo "<br>Tables exsist";
			
		}

		$query = "SELECT * FROM customers";

		$result = mysqli_query($conn,$query);

		if (mysqli_num_rows($result) == 0) {
			
			loadCustomers();
			loadProducts();
		}
		
		function loadProducts(){

		global $conn;
		// Open the file for read access
		$open = fopen('productData.txt','r');

		while (!feof($open)) // Loop thru file until the end
			
			{
				$getTextLine = fgets($open); //Get each line
				$explodeLine = explode(",",$getTextLine);

				list($pname,$price,$image,$qnty) = $explodeLine;

				$qry = "insert into products 
				(pname, price, image, qnty) values('$pname','$price','$image','$qnty')";
				mysqli_query($conn,$qry);
			}

		fclose($open);  
		}
	
	
		function loadCustomers(){

		global $conn;

		$open = fopen('userData.txt','r');

		while (!feof($open)) 
			
			{
				$getTextLine = fgets($open);
				$explodeLine = explode(",",$getTextLine);

				list($fname,$email,$pass,$lname) = $explodeLine;

				$qry = "insert into customers
				(name, email, password, surname) values('$fname','$email','$pass','$lname')";
				mysqli_query($conn,$qry);
			}

		fclose($open);
		
		}

?>



