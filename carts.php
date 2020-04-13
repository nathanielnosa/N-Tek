
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

	//delete cart order
	$succ = '';
	$ntsucc ='';
	if (isset($_POST['delete'])) {
	$cart_order_delete = mysqli_real_escape_string($conn, $_POST['cart_order_delete']);

	$query =  "DELETE FROM cart WHERE cart_id='$cart_order_delete'";
	if(mysqli_query($conn, $query)){
		$succ = "Product Deleted Successfully !";
			header('refresh:2, url=carts.php');
	}else{
		$ntsucc = "Check, There is a problem somewhere!";
	}
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
	<h4 style="color:brown">Shopping Cart</h4>
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
						<th>#</th>
						<th>Product</th>
						<th>Price</th>
						<th>Qauntity</th>
						<th>Total</th>
						<th><i class="glyphicon glyphicon-trash" style="color:brown;font-size: 19px"></i></th>
						<th><center><i class="glyphicon glyphicon-edit" style="color:brown;font-size: 19px"></i></center></th>
						</thead>
					</tr>

					
						<?php foreach ($call as $calls): ?>
					<tr>
						<tbody>
						<td><?php echo $calls['cart_id']; ?></td>
						<td>
							<h5><?php echo $calls['pro_name']; ?></h5>
							<?php echo "<img src = 'proupload/".$calls['img']."' style='width:80px; height:70px'/>";  ?>
						</td>
						<td>
							<b><?php echo '#'.number_format($calls['pro_price'],2); ?></b>
						</td>
						<td>
							<input type="text" name="qtty" value="<?php echo $calls['qty']?>">
						</td>
						<td>
							<h5 style="color:brown"><b><?php echo number_format($total = $calls['pro_price'] * $calls['qty']); ?></b></h5>
						</td>
						<td>
						<form action="carts.php" method="POST" class="form">
							<input type="hidden" name="cart_order_delete" value="<?php echo $calls['cart_id'] ?>">
							<input type="submit" name="delete" value="Delete" class="btn btn-danger">
						</form>

						</td>
						<td>
							<a href="usercartupdate.php?cart_id=<?php echo $calls['cart_id'] ?>" class="form-control" style="float:left;background: brown;color:white;text-decoration: none;"> Update Cart</a>
						</td>
						</tbody>
					</tr>
						<?php endforeach ?>

					
				</table>
						
					<div>
							
								<center>
									<a href="placeorder.php" class="form-control" style=" text-decoration: none;background: brown;color:white; width: 200px";>
									<span class="glyphicon glyphicon-log-in" style="background-color:transparent;"> </span> Proceed To Order
									</a>
								</center>
		
					</div>
			</div>

				<div class="col-md-2"></div>

		
	</div>
</div>

</body>
</html>

