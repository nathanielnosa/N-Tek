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
				<li><a href="#" style="color:white">Home</a></li>
				<li><a href="#" style="color:white">Products</a></li>
				<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</li>

				<li><a href="carts.php?uname=<?php if(isset($_SESSION['uname']))?>" style="color:white;"><i class="glyphicon glyphicon-shopping-cart"></i></a>

				<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
				<li style="color:white;"><?php echo "Welcome, ".strtoupper($_SESSION['uname']); ?></li>
				<li>&nbsp;&nbsp;&nbsp;</li>
				<li ><?php echo $uimgg ?></li>
				<li><a href="logout.php" style="color:white;"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
					
		</ul>
	</div>
</nav>
<!-- nav bar begins -->

<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8" style="margin-top:50px;height:400px;">
			<center>
				<h3>Thank You for visiting our page </h3><br/><h5><i><em>Looking Forward to seeing you again</em></i></h5>
				<img src="img/tnk.png" style="width:80px; height: 120px">
			</center>

			<?php $tktnk= mysqli_query($conn, "SELECT order_id, pro_name FROM orders WHERE uname ='".$_SESSION['uname']."'"); 
			$fet = mysqli_fetch_all($tktnk, MYSQLI_ASSOC);?>
				<table class="table">
					<tr>
						<thead>
							<th>Your Order Id</th>
							<th>Products</th>
						</thead>
					</tr>
					<?php foreach ($fet as $fets) {?>
					<tr>
						<tbody>
							
								<td><?php echo $fets['order_id'].'<br>'; ?></td>
								<td><?php echo $fets['pro_name'].'<br>'; ?></td>
							
						</tbody>
					</tr>
					<?php }  ?>
				</table>
			<?php ?>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>
</body>
</html