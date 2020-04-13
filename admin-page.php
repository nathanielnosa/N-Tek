
<?php 
session_start();
include ('connection/connect.php');

if (!isset($_SESSION['admin_name'])) {

		echo "<script>alert('You must first login!'); window.location = 'login.php'</script>";
}


// pagination for the orders
	// determin result
	$limit = 3;

	//finding the number of content
	$querypg = "SELECT * FROM orders ";
	$result = mysqli_query($conn, $querypg);
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


// query for getting Orders
$query1 = "SELECT * FROM orders LIMIT $start, $limit";
 $result1 = mysqli_query($conn, $query1);
 $res = mysqli_fetch_all($result1, MYSQLI_ASSOC);

mysqli_free_result($result1);
// getting users
	// $gtuser = "SELECT photo, fname, lname,email,pnum FROM register ORDER BY regdate";
	// $getreq = mysqli_query($conn, $gtuser);
	// $result = mysqli_fetch_all($getreq);

	// print_r($result);

// query for getting users
$query = "SELECT photo, fname, lname,email,pnum FROM register ORDER BY regdate DESC";

	$qresult = mysqli_query($conn, $query);

	$result = mysqli_fetch_all($qresult, MYSQLI_ASSOC);



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
				<li><a href="admin-page.php" style="color:white">Home</a></li>
				<li><a href="adminproduct.php" style="color:white">Products</a></li>
				<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</li>



				<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
				<li style="color:white;"><?php echo "Welcome, ".strtoupper($_SESSION['admin_name']); ?></li>
				<li>&nbsp;&nbsp;&nbsp;</li>
				<li ><i class="fa fa-user-circle-o" style="font-size: 30px; color: white"> </i></li>
				<li><a href="logout.php" style="color:white;"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
					
		</ul>
	</div>
</nav>
<!-- nav bar begins -->


<div class="container">
	<div class="row">

		<div class="col-md-12" style="border:1px solid brown">

				<center><h4 style="color: brown"><i class="glyphicon glyphicon-wrench" style="font-size: 20px"></i> Admin Settings</h4></center>
			<a href="addproduct.php" class="btn btn-primary" style="margin-bottom:15px;background-color: transparent;border:1px solid brown; color: brown;width:250px;"> <span class="glyphicon glyphicon-plus" style="background-color:transparent;"> </span> Add Products</a>


			<a href="adminproduct.php" class="btn btn-primary" style="margin-bottom:15px;background-color: transparent;border:1px solid brown; color: brown;width:250px;"> <span class="glyphicon glyphicon-edit" style="background-color:transparent;"> </span> Products</a>
			


			<a href="viewcart.php" class="btn btn-primary" style="margin-bottom:15px;background-color: transparent;border:1px solid brown; color: brown;width:250px;"> <span class="glyphicon glyphicon-shopping-cart" style="background-color:transparent;"> </span> View Carts</a>

			<a href="viewcart.php" class="btn btn-primary" style="margin-bottom:15px;background-color: transparent;border:1px solid brown; color: brown;width:250px;"> <span class="glyphicon glyphicon-shopping-cart" style="background-color:transparent;"> </span> View Carts</a>	

		</div>

	</div>
</div>

<p></p>

<div class="container">
	<div class="row" >

		<div class="col-md-6" style="border-right: 1px solid brown">
			
			<table class="table table-bordered">
				<center><h4 style="color: brown"><i class="fa fa-user-circle-o" style="font-size: 20px"></i> Users</h4></center>
				<tr>
					<thead>
						<th>Photo</th>
						<th>Full Name</th>
						<th>Email</th>
						<th>Phone Number</th>
					</thead>
				</tr>

					<?php foreach ($result as $results) {?>
						<tr>
						<tbody>
							<td><?php echo "<img src = 'upload/".$results['photo']."' class='img-circle' style='width:60px; height:50px'/>"; ?></td>
							<td><?php echo $results['fname'].$results['lname']; ?></td>
							<td><?php echo $results['email']; ?></td>
							<td><?php echo $results['pnum']; ?></td>
							
						</tbody>
					</tr>
					<?php } ?>
				</table>
		</div>
		<div class="col-md-6" >
			
			<table class="table table-bordered">
				<center><h4 style="color: brown"><i class="glyphicon glyphicon-shopping-cart" style="font-size: 20px"></i> Orders </h4></center>
				<tr>
					<thead>
						<th>Order Id</th>
						<th>Products</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
						<th>User</th>
						<th>Order Date</th>
					</thead>
				</tr>

					<?php foreach ($res as $results1) {?>
						<tr>
						<tbody>
							<td><?php echo $results1['order_id']; ?></td>
							<td><?php echo $results1['pro_name']; ?></td>
							<td><?php echo $results1['pro_price']; ?></td>
							<td><?php echo $results1['qty']; ?></td>
							<td><?php echo $results1['total']; ?></td>
							<td><?php echo $results1['uname']; ?></td>
							<td><?php echo $results1['order_date']; ?></td>
							
						</tbody>
					</tr>
					<?php } ?>

			</table>
			<center>
					<ul class="pagination">
						<li> <?php echo '<a href="admin-page.php?page='.$prev.'">'."Prev" .'</a>'; ?></li>

							<?php for ($page=1; $page <=$no_of_page ; $page++) { ?>
				
						<li><?php echo '<a href="admin-page.php?page=' . $page. '">'. $page .'</a>'; ?></li>
				
							<?php } ?>

						<li> <?php echo '<a href="admin-page.php?page='.$next.'">'."Next" .'</a>'; ?></li>
					</ul>

				</center>

		</div>

	</div>

</div>


</body>
</html>