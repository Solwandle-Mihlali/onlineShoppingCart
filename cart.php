<?php
require 'dbConn.php';
require 'item.php';

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

if (isset ( $_GET ['id'] ) && !isset($_POST['update'])) {

	$result = mysqli_query ( $conn, 'select * from products where pid=' . $_GET ['id'] );
	$product = mysqli_fetch_object ( $result );
	$item = new Item ();
	$item->id = $product->pid;
	$item->name = $product->pname;
	$item->price = $product->price;
	$item->quantity = 1;
	// Check product is existing in cart
	$index = - 1;
	if (isset ( $_SESSION ['cart'] )) {
		$cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
		for($i = 0; $i < count ( $cart ); $i ++)
		if ($cart [$i]->id == $_GET ['id']) {
			$index = $i;
			break;
		}
	}
	if ($index == - 1)
	$_SESSION ['cart'] [] = $item;
	else {
		$cart [$index]->quantity ++;
		$_SESSION ['cart'] = $cart;
	}
}

// Delete product in cart
if (isset ( $_GET ['index'] ) && !isset($_POST['update'])) {
	$cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
	unset ( $cart [$_GET ['index']] );
	$cart = array_values ( $cart );
	$_SESSION ['cart'] = $cart;
}

// Update quantity in cart
if(isset($_POST['update'])) {
	$arrQuantity = $_POST['quantity'];

	// Check validate quantity
	$valid = 1;
	for($i=0; $i<count($arrQuantity); $i++)
	if(!is_numeric($arrQuantity[$i]) || $arrQuantity[$i] < 1){
		$valid = 0;
		break;
	}
	if($valid==1){
		$cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
		for($i = 0; $i < count ( $cart ); $i ++) {
			$cart[$i]->quantity = $arrQuantity[$i];
		}
		$_SESSION ['cart'] = $cart;
	}
	else
		$error = 'Quantity is InValid';
}

?>

<?php echo isset($error) ? $error : ''; ?>
<!DOCTYPE html>
<html>
<head><title>TechnoGeeks</title><link rel="stylesheet" href="style2.css" /> 
<head>
<body>
<center>

<p><b><?php echo $_SESSION['email']; ?></b></p>

        <form method="post">
            <input type="submit" name="shop" value="Continue Shopping" />

            <input type="submit" name="submit" value="Logout" />
        </form>
<br>
<hr>		
<br>
<form method="post">
	<table cellpadding="2" cellspacing="2" border="1">
		<tr>
			<th>Option</th>
			<th>Name</th>
			<th>Price</th>
			<th>Quantity <input type="image" src="images\save.jpg"> <input
				type="hidden" name="update">
			</th>
			<th>Sub Total</th>
		</tr>
		<?php
		$cart = unserialize ( serialize ( $_SESSION ['cart'] ) );
		$s = 0;
		$index = 0;
		for($i = 0; $i < count ( $cart ); $i ++) {
			$s += $cart [$i]->price * $cart [$i]->quantity;
			?>
		<tr>
			<td><a href="cart.php?index=<?php echo $index; ?>"
				onclick="return confirm('Are you sure?')">Delete</a></td>
			<td><?php echo $cart[$i]->name; ?></td>
			<td><?php echo "R :".$cart[$i]->price; ?></td>
			<td><center><input type="number" value="<?php echo $cart[$i]->quantity; ?>"
				style="width: 50px;" name="quantity[]"></center></td>
			<td><?php echo "R :".$cart[$i]->price * $cart[$i]->quantity; ?></td>
		</tr>
		<?php
		$index ++;
		}
		?>
		<tr>
			<td colspan="4" align="right"><b>Grand Total</b></td>
			<td align="left"><?php echo "<b>R :$s</b>"; ?></td>
		</tr>
	</table>
</form>
<br>
<a href="loadShop.php">Continue Shopping</a> | <a href="checkout.php">Checkout</a>
</center>
</body>
</html>