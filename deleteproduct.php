<?php 
session_start();
include ('connection/connect.php');
// to fetch the More details information

if (isset($_GET['pro_id'])) {
	$pro_id = mysqli_real_escape_string($conn, $_GET['pro_id']);

	$query = "SELECT * FROM products WHERE pro_id = '$pro_id'";

	$result = mysqli_query($conn, $query);

	$viewpro = mysqli_fetch_assoc($result);


//	print_r($viewmore);
	mysqli_free_result($result);
	mysqli_close($conn);
}

	// delete products

$succ = '';
$ntsucc ='';
	if (isset($_POST['delete'])) {
	$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

	$query =  "DELETE FROM products WHERE pro_id='$id_to_delete'";
	if(mysqli_query($conn, $query)){
		$succ = "Product Deleted Successfully !";
			header('refresh:20, url=admin-page.php');
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
				<li><a href="admin-page.php" style="color:white">Home</a></li>
				<li><a href="adminproduct.php" style="color:white">Products</a></li>
				<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</li>

				<li><a href="#" style="color:white;"><i class="glyphicon glyphicon-shopping-cart"></i> </a> </li>
				<li hidden="true"><a href="logout.php" style="color:white;"><i class="glyphicon glyphicon-log-out"></i> Logout</a></li>
					
		</ul>
	</div>
</nav>
<!-- nav bar begins -->

<div class="container">
	<div class="row">
				<center><h4 style="color:brown"> Delete Products</h4></center>
				<hr/>
				<center>
				<i style="color:green"><?php echo $succ; ?></i> <i style="color:red"><?php echo $ntsucc; ?></i>
			</center>


				<table class="table">
				<tr class="success">
						<th>Product ID</th>
						<th>Product Name</th>
						<th>Product Price</th>
						<th>Product Details</th>
						<th>Product Color</th>
						<th>Product Image</th>
						<th>Delete</th>
						<th>Update</th>
					</tr>
				<tr>
					<?php if($viewpro): ?>
						<td><?php echo htmlspecialchars($viewpro['pro_id']); ?></td>
						<td><?php echo htmlspecialchars($viewpro['pro_name']); ?></td>
						<td><?php echo number_format($viewpro['pro_price'], 2); ?></td>
						<td>
								<ul>
									<?php foreach (explode(',', $viewpro['abt_pro']) as $abt_pro) {?>
										<li><?php echo $abt_pro; ?></li>
									<?php } ?>
								</ul>
							</td>
						<td><?php echo $viewpro['pro_color']; ?></td>
						<td>
								<?php echo "<img src = 'proupload/".$viewpro['img']."' style='width:100px; height:80px'/>";  ?>
			
						</td>
						<td>
							<form action="deleteproduct.php" method="POST" class="form">
							<input type="hidden" name="id_to_delete" value="<?php echo $viewpro['pro_id'] ?>">
							<input type="submit" name="delete" value="Delete" class="btn btn-danger">
							</form>

						</td>
						</td>
							<td><a href="updateproduct.php?pro_id=<?php echo $viewpro['pro_id']?>" name="update" class="btn btn-success">Update</a></td>
						</tr>


					<?php else: ?>
						<td><?php echo "No record found"; ?></td>
					<?php endif ?>
				</tr>
				</table>

	</div>
</div>

</body>
</html>