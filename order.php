
<?php 
session_start();
include ('connection/connect.php');

$order_id = "Tek-".str_shuffle('abcd6789');

// eco user details

	if (!isset($_SESSION['uname'])) {
		echo "<script>alert('You must first login!'); window.location = 'login.php'</script>";
}else{

	$query =  "SELECT * FROM register WHERE uname ='".$_SESSION['uname']."'";

	$result = mysqli_query($conn, $query);

	while ($uimg = mysqli_fetch_assoc($result)) {
	
		$uimgg = "<img src = 'upload/".$uimg['photo']."'  class='img-circle' style='width:50px; height:50px'/>";
	}

}

if (isset($_GET['uname'])) {

	$uname = mysqli_real_escape_string($conn, $_GET['uname']);

	$query = "SELECT * FROM cart WHERE uname='$uname'";

	$result = mysqli_query($conn, $query);

	$viewme = mysqli_fetch_assoc($result);
	
}


// for carts product by user

// getting carts input base on user
	$query =  "SELECT pro_name, cart_id, pro_price, qty,img, uname FROM cart WHERE uname ='".$_SESSION['uname']."' ";

	$request= mysqli_query($conn, $query);

	$call = mysqli_fetch_all($request, MYSQLI_ASSOC); //mysqli_fetch_assoc($request);

	
//view information
if (isset($_GET['cart_id'])) {

	$cart_id = mysqli_real_escape_string($conn, $_GET['cart_id']);

	$query = "SELECT * FROM cart WHERE cart_id='$cart_id'";

	$result = mysqli_query($conn, $query);

	$viewme = mysqli_fetch_assoc($result);
	
}

// insert into order table

$succ = '';
$ntsucc ='';

if (isset($_POST['order'])) {
		$order_id = $_POST['order_id'];
		$cart_id = $_POST['cart_id'];
		$pro_name = $_POST['pro_name'];
		$pro_price = $_POST['pro_price'];
		$qty = $_POST['qty'];
		$img = $_POST['img'];
		$total = $_POST['total'];
		$uname = $_POST['uname'];
$queryin = "INSERT INTO orders (order_id, cart_id, pro_name, pro_price, qty, img, total, uname) VALUES ('$order_id','$cart_id','$pro_name','$pro_price','$qty','$img','$total','$uname')";

			mysqli_query ($conn, $queryin);

	$queryde = "DELETE FROM cart WHERE uname ='".$_SESSION['uname']."' && cart_id = '".$_GET['cart_id']."'";
			mysqli_query ($conn, $queryde);
		 $succ = "<p style='color:brown; text-align:center'> Order Successfully ! </p>";
		 header('refresh:2, url=placeorder.php');


	}

	
 ?>

 



<!DOCTYPE html>
<html>
<head>
	<title>Welcome To N-Tek</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=-1">
	<meta http-equiv="x-ua-compactible" content="ie-edge">
 	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="font4.7/css/font-awesome.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery.innerfade.js"></script>

</head>
<body>


<!-- nav bar begins -->

<nav class="navbar navbar-default navbar-static-top" role="navigation" style="background-color:brown";>

	<div class="navbar-header">
		<a class="navbar-brand" href="#" style="font-size: 30px; font-family:cursive; color:white; ">N-Tek</a>
	</div>

	<div>
		<ul class="nav navbar-nav" style=" float: left; margin-left:500px;">
				<li><a href="products.php" style="color:white">Home</a></li>
				<li><a href="products.php" style="color:white">Products</a></li>
				<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</li>

				<li><a href="#" style="color:white;"><i class="glyphicon glyphicon-shopping-cart"></i> </a> </li>
				<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
				<li style="color:white;"><?php echo "Welcome ".strtoupper($_SESSION['uname']); ?></li>
				<li>&nbsp;&nbsp;&nbsp;</li>
				<li ><?php echo $uimgg ?></li>
				<li><a href="logout.php" style="color:white;"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
					
		</ul>
	</div>
</nav>
<!-- nav bar begins -->

<center>
	<h4 style="color:brown">Make Order</h4>
</center>
<hr/ style="color:2px solid grey; width: 430px">
	<center><i style="color:green"><?php echo $succ; ?></i> <i style="color:red"><?php echo $ntsucc; ?></i></center>
<div class="container">
	<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">

				<table class="table table-bordered">
					<tr>
						<thead>
					
						<th>Product</th>
						<th>Price</th>
						<th>Qauntity</th>
						<th>Total</th>
						
						</thead>
					</tr>



						<?php if($viewme): ?>
					<tr>
						<tbody>
						<td>
							<h5><?php echo $viewme['pro_name']; ?></h5>
							<?php echo "<img src = 'proupload/".$viewme['img']."' style='width:80px; height:70px'/>";  ?>
						</td>
						<td>
							<b><?php echo '#'.number_format($viewme['pro_price'],2); ?></b>
						</td>
						<td>
							<h5><?php echo $viewme['qty']; ?></h5>
						</td>
						<td>
							<h5 style="color:brown"><b><?php echo number_format($total = $viewme['pro_price'] * $viewme['qty']); ?></b></h5>
						</td>
						<td>

							<form class="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
										<div class="form-group">
									
										<input  type="hidden" name="cart_id" value="<?php echo $viewme['cart_id']; ?>">
										<input  type="hidden" name="pro_name" value="<?php echo $viewme['pro_name']; ?>">
										<input  type="hidden" name="pro_price" value="<?php echo $viewme['pro_price']; ?>">
										<input  type="hidden" name="img" value="<?php echo $viewme['img']; ?>">
										<input  type="hidden" name="qty" value="<?php echo $viewme['qty']; ?>">
										<input  type="hidden" name="uname" value="<?php echo strtoupper($_SESSION['uname']); ?>">
										<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
										<input type="hidden" name="total" value="<?php echo $total; ?>">
									

									<button type="submit" name="order" class="form-control" style="background: brown;color:white; width: 150px;"> Order
										<span class="glyphicon glyphicon-shopping-cart" style="background-color:transparent;"> </span>
									</button>
								
							</div>
							</form>
							
						</td>
						
						</tbody>
					</tr>
						<?php endif ?>

				</table>

				<div class="col-md-2"></div>

		
	</div>
</div>

</body>
</html>

