<?php
//session_start();
include('dbConn.php');
if(!isset($_SESSION['email'])){
    header("location:index.php");
}

if(isset($_POST['submit']))
{
    header("location:login.php");
    
    unset($_SESSION['email']);  
    session_destroy(); 
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>TechnoGeeks SHOPPING CART</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />   
	<link rel="stylesheet" href="style2.css" /> 
</head>

<body>

<center>
   
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <h1><a href="index.php">Techno<span class="logo_colour">Geeks</span></a></h1>
          <h2>For all your tech needs and info</h2>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <li><a href="index.php">BACK</a></li>
		 
        
        </ul>
      </div>
    </div>

   
    <hr>
   
<table border="1" cellspacing="1" cellpadding="5">
            <tr>
            <td color="#ffff"><b>Item Name:</b></td>
            <td><b>Item Image:</b></td>
            <td><b>Item Price:</b></td>
			<td><b>Shop Item :</b></td>
       
	   </tr>
	   
	   
<?php

// Get images from the database
$sql = "SELECT * FROM products";
$query = mysqli_query($conn,$sql);
/*
if(mysqli_num_rows($query) > 0){
    while($row = mysqli_fetch_assoc($query)){
		$pid = $row["pid"];
        $imageURL = $row["image"];
        $imageDesc = $row["pname"];
        $sellprice = $row["price"];
*/

?>
    <tr>
		<?php while($product = mysqli_fetch_object($query)) { ?>
		<tr>
			<td><?php echo $product->pname; ?></td>
			<td><img src="<?php echo $product->image; ?>" alt="" width="200" /></td>
			<td><?php echo "R :".$product->price; ?></td>
			<td><a href="cart.php?id=<?php echo $product->pid; ?>"><button type="button">Add to Cart</button></a></td>
		</tr>
	<?php } ?>

</table>

 <div id="main">
   
	
	   <form method="post">
            <input type="submit" name="submit" value="Logout" />
        </form>
		
    <div id="footer">
      <p><a href="index.php">Home</a> | <a href="Our Work.php">Our Work</a> | <a href="About Us.php">About Us</a> | <a href="Get Involved.php">Get Involved</a> | <a href="contact.php">Contact Us</a></p>
      <p>Copyright &copy; Mihlali Solwandle| 
    </div>
	
	
  </div>

</center>


</body>
</html>