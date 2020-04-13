<?php 
session_start();
include ('connection/connect.php');

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


	// to fetch the products information

	$query = "SELECT * FROM products ORDER BY pro_date DESC LIMIT $start, $limit";

	$result = mysqli_query($conn, $query);

	$viewme = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$prev = $page - 1;
	$next = $page + 1;

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

							<center><p><a href="deleteproduct.php?pro_id=<?php echo $viewpro['pro_id'] ?>"> More --></a></p></center>
						<td/>
						<?php endforeach ?>
				
					</tr>
				</table>

				<center>
					<ul class="pagination">
						<li> <?php echo '<a href="adminproduct.php?page='.$prev.'">'."Prev" .'</a>'; ?></li>

							<?php for ($page=1; $page <=$no_of_page ; $page++) { ?>
				
						<li><?php echo '<a href="adminproduct.php?page=' . $page. '">'. $page .'</a>'; ?></li>
				
							<?php } ?>

						<li> <?php echo '<a href="adminproduct.php?page='.$next.'">'."Next" .'</a>'; ?></li>
					</ul>

				</center>

			</div>

			<div class="col-md-2"></div>

	</div>
</div>


</body>
</html>