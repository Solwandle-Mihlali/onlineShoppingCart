<?php
session_start();

if(!isset($_SESSION['email'])){
    header("location:login.php");
}

if(isset($_POST['submit']))
{
    header("location:login.php");
    
    unset($_SESSION['email']);  
    session_destroy(); 
}

if(isset($_POST['shop']))
{
    header("location:loadShop.php");
}

?>

<html>
<head>
<title>Thank You Page!!!!!</title>
</head>
<body>
<center>
<br>
<br>
<center>

Thanks for shopping with us <b><?php echo $_SESSION['email']; ?></b> You continue shopping or logout.
<br>
<br>

        <form method="post">
            <input type="submit" name="shop" value="Bak to Shopping" />

            <input type="submit" name="submit" value="Logout" />
        </form>

<hr>

</center>
</body>
</html>