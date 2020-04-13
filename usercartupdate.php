<?php 
session_start();
include ('connection/connect.php');

// getting carts input base on user
	$query =  "SELECT  uname FROM cart WHERE uname ='".$_SESSION['uname']."' ";

	$request= mysqli_query($conn, $query);

	$call = mysqli_fetch_all($request, MYSQLI_ASSOC); //mysqli_fetch_assoc($request);


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

//view information
if (isset($_GET['cart_id'])) {

	$cart_id = mysqli_real_escape_string($conn, $_GET['cart_id']);

	$query = "SELECT * FROM cart WHERE cart_id='$cart_id'";

	$result = mysqli_query($conn, $query);

	$viewme = mysqli_fetch_assoc($result);
	
}


// updating


$succ = '';
$ntsucc ='';

if (isset($_POST['upcart'])) {
		
		$pro_id = $_POST['pro_id'];
		$qty = $_POST['qty'];
		$pro_name = $_POST['pro_name'];
		$pro_price = $_POST['pro_price'];
		$img = $_POST['img'];
		$uname = $_POST['uname'];
		
	$query = "UPDATE cart SET  qty = '$qty' WHERE uname ='".$_SESSION['uname']."' && cart_id = '".$_GET['cart_id']."' ";
	/*pro_id = '$pro_id',, pro_name = '$pro_name', pro_price = '$pro_price', img = '$img', uname = '$uname'*/

		$req = mysqli_query ($conn, $query);

		 $succ = "<p style='color:brown; text-align:center'> Product Updated Successfully ! </p>";
		 header('refresh:2');
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

				<li><a href="carts.php?uname=<?php if(isset($_SESSION['uname']))?>" style="color:white;"><i class="glyphicon glyphicon-shopping-cart"></i><i class="badge" style="background-color:brown;color:white"><?php echo count($call); ?></i></a>
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
	<h4 style="color:brown">Update Shopping Cart</h4>
</center>
<hr/ style="color:2px solid grey; width: 430px">

<div class="container">
	<div class="row">
				<div class="col-md-6">

				<table class="table table-bordered">
					<tr>
						<thead>
						<th>#</th>
						<th>Product</th>
						<th>Price</th>
						<th>Qauntity</th>
						<th>Total</th>
						</thead>
					</tr>

					
						<?php if($viewme): ?>
					<tr>
						<tbody>
						<td><?php echo $viewme['cart_id']; ?></td>
						<td>
							<h5><?php echo $viewme['pro_name']; ?></h5>
							<?php echo "<img src = 'proupload/".$viewme['img']."' style='width:80px; height:70px'/>";  ?>
						</td>
						<td>
							<b><?php echo '#'.number_format($viewme['pro_price'],2); ?></b>
						</td>
						<td>
							<input type="text" name="qtty" value="<?php echo $viewme['qty']?>">
						</td>
						<td>
							<h5 style="color:brown"><b><?php echo number_format($total = $viewme['pro_price'] * $viewme['qty']); ?></b></h5>
						</td>
						
						</tbody>
					</tr>
						<?php endif ?>
				</table>
			</div>
			<div class="col-md-6">
				
					<table class="table">
						<tr>
							<tbody>
								<td>
									<center><h4 style="color:brown">Update Quantity</h4></center>
									<form class="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
										<div class="form-group">
									<center>
									<input type="text" name="qty" class="form-control" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;width: 300px;">
									<br/>
										<input  type="hidden" name="pro_id" value="<?php echo $viewme['pro_id']; ?>">
										<input  type="hidden" name="pro_name" value="<?php echo $viewme['pro_name']; ?>">
										<input  type="hidden" name="pro_price" value="<?php echo $viewme['pro_price']; ?>">
										<input  type="hidden" name="img" value="<?php echo $viewme['img']; ?>">
										<input  type="hidden" name="uname" value="<?php echo strtoupper($_SESSION['uname']); ?>">
										
									<?php echo $succ; ?>

									<button type="submit" name="upcart" class="form-control" style="background: brown;color:white; width: 300px;"> Update
										<span class="glyphicon glyphicon-shopping-cart" style="background-color:transparent;"> </span>
									</button>
								</center>
							</div>
							</form>
								</td>
							</tbody>
						</tr>
					</table>

			</div>
		</div>
	</div>

</body>
</html>