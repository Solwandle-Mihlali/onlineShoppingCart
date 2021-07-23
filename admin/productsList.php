<?php  

  include('..\dbConn.php');

  if (!isset($_SESSION['emailx'])) {
  	//$_SESSION['msg'] = "You must log in first";
  	header('location: ../login.php');
  }
 
  if (isset($_GET['logout1'])) {
  	session_destroy();
  	//unset($_SESSION['email']);
  	header("location: ../login.php");
  } 

// initialize variables
	$pname = "";
	$price = "";
	$pid = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$pname = $_POST['pname'];
		$price = $_POST['price'];
		$imageURL = '\image/pic2.jpg';
		$qnty = 20;
		
		mysqli_query($conn, "INSERT INTO products (pname, price, image, qnty) VALUES ('$pname','$price', '$imageURL',$qnty)"); 
		$_SESSION['message'] = "Product added!!!"; 
		header('location: productsList.php');	
	}
	
		if (isset($_GET['edit'])) {
		$pid = $_GET['edit'];
		$update = true;
		$record = mysqli_query($conn, "SELECT * FROM products WHERE pid=$pid");

		if (mysqli_num_rows($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$pname = $n['pname'];
			$price = $n['price'];
		}
	}
	
	
	if (isset($_POST['update'])) {
		$pid = $_POST['pid'];
		$pname = $_POST['pname'];
		$price = $_POST['price'];

		mysqli_query($conn, "UPDATE products SET pname='$pname', price = '$price' WHERE pid=$pid");
		$_SESSION['message'] = "Product updated!"; 
		header('location:productsList.php');
	}
	
		if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($conn, "DELETE FROM products WHERE pid=$id");
		$_SESSION['message'] = "Product deleted!"; 
		header('location: productsList.php');
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Dash Board</title>
	<link rel="stylesheet" href="style2.css" /> 
</head>
<body>
<center>
 <div id="logo_text">
          <h1><a href="index.html">Techno<span class="logo_colour">Geeks</span></a></h1>
          <h2>For all your tech needs and info</h2>
        </div>
		
 
  
  <div class="content" style=" width:598px;
  margin: 0px auto;
  padding: 0px 0px 0px 10px;
  border: 1px solid #B0C4DE;
  background: white;
  border-radius: 0px 0px 0px 0px;">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['emailx'])) : ?>
    	<p>LOGGED IN AS: <strong><?php echo $_SESSION['emailx']; ?></strong></p>
    	<p>  <a href="productsList.php" style="color: red;">Manage Products</a> | <a href="contact.php" style="color: red;">Contact Us</a> | <a href="productsList.php?logout1='1'" style="color: red;">logout</a> </p>&nbsp;
    <?php endif ?>
</div>

  <div id="main" style="
	  width: 599px;
	  margin: 5px auto 0px;
	  align: center;
	  border: 1px solid #B0C4DE;
	  border-radius: 0px 0px 0px 0px;
	  padding: 5px;">


<?php $results = mysqli_query($conn, "SELECT * FROM products"); ?>


	<h3> Product List </h3>
	
	<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>
<br>

	<table border="1" cellspacing="1" cellpadding="1">
		<thead>
			<tr>
				<th>Name</th>
				<th>Price</th>
				<th colspan="2">Action</th>
			</tr>
		</thead>
		
		<?php while ($row = mysqli_fetch_array($results)) { ?>
			<tr>
				<td><?php echo $row['pname']; ?></td>
				<td><?php echo "<b>R :</b>".$row['price']; ?></td>
				<td>
					<button type="button"><a href="productsList.php?edit=<?php echo $row['pid']; ?>" >Edit</a></button>
				</td>
				<td>
					<button type="button"><a href="productsList.php?del=<?php echo $row['pid']; ?>">Delete</a></button>
				</td>
			</tr>
		<?php } ?>
	</table>
	<br>


	<hr width = "595">

	<h3> Add Product </h3>
	
<div>
	<form method="post" action="" >
	<input type="hidden" name="pid" value="<?php echo $pid; ?>">
		<table>
		<tr>
			<td>Name</td><td><input type="text" name="pname" value="<?php echo $pname; ?>"></td>
		</tr>
		<tr>
			<td>Price</td><td><input type="text" name="price" value="<?php echo $price; ?>"></td>
		</tr>
		<tr><td></td>
			<td>
			<?php if ($update == true): ?>
				<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
			<?php else: ?>
				<button class="btn" type="submit" name="save" >Save</button>
			<?php endif ?>
			</td>
		</tr>
		</table>
	</form>
</div>
<div></div>
</div>
 

</center>
</body>
</html>