<?php

    include('dbConn.php');
    $output = NULL;
    $fname = $lname = $email = $pass =  $rpass = "";

    if(isset($_POST['submit']))
    {
    
        $fname = $_POST['fname'];
		$lname = $_POST['fname'];
        $email = $_POST['email'];
        $pass = $_POST['pass']; 
        $rpass = $_POST['rpass'];
        
        $pattern = '/^(?=.*[!@#$%^&*-?])(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{4,20}$/';
		
        $query = "SELECT * FROM customers WHERE email = '$email'";
    
        $checkUserExsists = mysqli_query($conn,$query);
        
        if(empty($fname) || empty($lname) || empty($email) || empty($pass) || empty($rpass))
        {
            $output = "Fields cannot be empty";
        }
        elseif(filter_var($email, FILTER_VALIDATE_EMAIL) != true)
        {
            $output = "Invliad Email address";
        }
        elseif(mysqli_num_rows($checkUserExsists) == 1)
        {
            $output = "User already exsists";
        }

        elseif($pass != $rpass)
        {
            $output = "Passwords do not match";
        }

		elseif(!preg_match($pattern, $pass))
		{
			$output = "Password is not strong enough";
		}
        else
        {
			
            $pass = md5($pass);
            $query = "INSERT INTO customers (name,surname, email, password) VALUES ('$fname','$lname','$email','$pass')";
            $insertUser = mysqli_query($conn,$query);
            if ($insertUser == true) 
            {
                $output = "You have Sucessfully been Registered";
            
			}
        }
    
    
    }
	
?>

<!DOCTYPE html>
<htm>
    <head>
        <title></title>
		
    </head>
    
<body>
    <center>
	 <div id="site_content">
    
    <form method="post">
        <table>
            <tr>
                <td>Firstname :</td>
                <td> <input type="text" name = "fname" minlength="3" maxlength="20" value = "<?php echo $fname; ?>" ></td>
            </tr>
			<tr>
                <td>Surname :</td>
                <td> <input type="text" name = "lname" minlength="3" maxlength="20" value = "<?php echo $lname; ?>" ></td>
            </tr>
			
            <tr>
                <td>Email :</td>
                <td> <input type="email" name = "email"  value = "<?php echo $email; ?>" ></td>
            </tr>
            <tr>
                <td>Password :</td>
                <td> <input type="password" name = "pass"></td>
            </tr>
            <tr>
                <td>Confirm Password :</td>
                <td> <input type="password" name = "rpass"></td>
            </tr>
                        <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Register"></td>
            </tr>
        </table>
        
    
    
    </form>
	</div>
    <?php
    echo "<br>";
    echo $output;
    ?>
        
        <p>Already have an Account : Click here to <a href="login.php">Login</a></p> 
        </center>
    
</body>


</htm>