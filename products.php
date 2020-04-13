<?php 
session_start();
include ('connection/connect.php');


// getting carts input base on user
	$query =  "SELECT  uname FROM cart WHERE uname ='".$_SESSION['uname']."' ";

	$request= mysqli_query($conn, $query);

	$call = mysqli_fetch_all($request, MYSQLI_ASSOC); //mysqli_fetch_assoc($request);


//pagination 

	// determin result
	$limit = 4;

	//finding the number of content
	$query = "SELECT * FROM products ";
	$result = mysqli_query($conn, $query);
	$no_of_rows = mysqli_num_rows($result);

	// fininding number of total page
	$no_of_page = ceil($no_of_rows/$limit);

	//determining the curret page of users
	if (!isset($_GET['page'])) {
		$page = 1;
	}else{
		$page = $_GET['page'];
	}
	
	// determine sql limit
	$start = ($page - 1)*$limit;

$prev = $page - 1;
	$next = $page + 1;

// to fetch the products information

	$query = "SELECT * FROM products ORDER BY pro_date DESC LIMIT $start, $limit";

	$result = mysqli_query($conn, $query);

	$viewme = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
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

				<li><a href="carts.php?uname=<?php if(isset($_SESSION['uname']))?>" style="color:white;"><i class="glyphicon glyphicon-shopping-cart"></i><i class="badge" style="background-color:brown;color:white"><?php echo count($call); ?></i></a>

				<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
				<li style="color:white;"><?php echo "Welcome, ".strtoupper($_SESSION['uname']); ?></li>
				<li>&nbsp;&nbsp;&nbsp;</li>
				<li ><?php echo $uimgg ?></li>
				<li><a href="logout.php" style="color:white;"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
					
		</ul>
	</div>
</nav>
<!-- nav bar begins -->

<center>
	<h4 style="color:brown">Products</h4>
</center>
<hr/ style="color:2px solid grey; width: 430px">

<div class="container">
	<div class="row">
			<div class="col-md-2"></div>

			<div class="col-md-8">
				<p class="badge" style="background-color:brown;color:white"><?php echo count($viewme); ?></p>
				<table class="table table-bordered">
					<tr>
						<?php foreach ($viewme as $viewpro): ?>
					
						<td>
							<?php echo "<img src = 'proupload/".$viewpro['img']."' style='width:150px; height:150px'/>";  ?>
							<h3><?php echo $viewpro['pro_name']; ?></h3>
							<b><?php echo '#'.number_format($viewpro['pro_price'],2); ?></b>

							<center><p><a href="users.php?pro_id=<?php echo $viewpro['pro_id'] ?>"> More --></a></p></center>
						<td/>
						<?php endforeach ?>
				
					</tr>
				</table>

				<center>
					<ul class="pagination">
						<li> <?php echo '<a href="products.php?page='.$prev.'">'."Prev" .'</a>'; ?></li>

							<?php for ($page=1; $page <=$no_of_page ; $page++) { ?>
				
						<li><?php echo '<a href="products.php?page=' . $page. '">'. $page .'</a>'; ?></li>
				
							<?php } ?>

						<li> <?php echo '<a href="products.php?page='.$next.'">'."Next" .'</a>'; ?></li>
					</ul>

				</center>



			</div>

			<div class="col-md-2"></div>

	</div>
</div>


</body>
</html>