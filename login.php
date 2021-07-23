
    <?php
	
    include_once('dbConn.php');
    include_once('createTable.php');
	unset($_SESSION['email']); 
	
    $output = NULL;
    $email = $pass = "";

    if(isset($_POST['save']))
    {
		$email = $_POST['email'];
        $pass = $_POST['pass'];
        $hpass = md5($pass);
		$_SESSION['email'] = $email;
		
        $query = "SELECT * FROM customers WHERE email = '$email' AND password = '$hpass'";
        
        $result = mysqli_query($conn,$query);

        $row = mysqli_fetch_array($result);

		$_SESSION['cid'] = $row['cid'];
		
		if($email == "admin@admin.com" && $pass == "admin") {
	  
			  $_SESSION['emailx'] = $email;
			  $_SESSION['success'] = "You are now logged in";
			  header('location: admin/productsList.php');  
		}
        
		  
        if(empty($email))
        {
            $output = "Please eneter email";
        }
        else 
        { 
             if($row['email'] == $email && $row['password'] == $hpass) 
             {
                 header("location:index.php");
             }
            else 
            {
                $output = "Incorrect Username\Password";
            }
        
        }
    
    }
    ?>
	
	

	<!DOCTYPE html>
	<htm>
		<head>
			<title></title>
				<link rel="stylesheet" href="style2.css" /> 
		</head>
		
	<body>
		<center>
		
		 <div id="logo_text">
          <h1><a href="store.php">Techno<span class="logo_colour">Geeks</span></a></h1>
          <h2>For All your tech needs and info</h2>
        </div>
			<br>
			<br>
			<br>
		
		<form method="post" action="login.php">
			<table>
				<tr>
					<td>Email :</td>
					<td> <input type="email" name = "email"  value = "<?php echo $email; ?>" ></td>
				</tr>
				<tr>
					<td>Password :</td>
					<td> <input type="password" name = "pass"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="save" value="Login"></td>
				</tr>
			</table>
		</form>
		<?php
		echo "<br>";
		echo $output;
		
		?>
		<p>No Account? : Click here to <a href="register.php">Register</a></p> 
			</center>
		
	</body>


	</html>