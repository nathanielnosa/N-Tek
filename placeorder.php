
<?php 
session_start();
include ('connection/connect.php');


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



		 // to move to thanks page
	$tnksql = "SELECT * FROM cart WHERE uname ='".$_SESSION['uname']."' ";
	$resu = mysqli_query($conn, $tnksql);

	if (mysqli_num_rows($resu)<1) {
		header('location:thanks.php');
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
	<h4 style="color:brown">Your Orders</h4>
</center>
<hr/ style="color:2px solid grey; width: 430px">
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

					
						<?php foreach ($call as $calls): ?>
					<tr>
						<tbody>
						<td>
							<h5><?php echo $calls['pro_name']; ?></h5>
							<?php echo "<img src = 'proupload/".$calls['img']."' style='width:80px; height:70px'/>";  ?>
						</td>
						<td>
							<b><?php echo '#'.number_format($calls['pro_price'],2); ?></b>
						</td>
						<td>
							<h5><?php echo $calls['qty']; ?></h5>
							
						</td>
						<td>
							<h5 style="color:brown"><b><?php echo number_format($total = $calls['pro_price'] * $calls['qty']); ?></b></h5>
						</td>
						<td>
							<a href="order.php?cart_id=<?php echo $calls['cart_id'] ?>" class="form-control" style="float:left;background: brown;color:white;text-decoration: none;"> <span class="glyphicon glyphicon-log-in" style="background-color:transparent;"> </span> Place Order</a>
						</td>
						</tbody>
					</tr>
					
						<?php endforeach ?>
				</table>

				<div class="col-md-2"></div>

		
	</div>
</div>

</body>
</html>

