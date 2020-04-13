<?php 
session_start();
include ('connection/connect.php');

//view information
if (isset($_GET['pro_id'])) {
	
	$pro_id = mysqli_real_escape_string($conn, $_GET['pro_id']);

	$query = "SELECT * FROM products WHERE pro_id= '$pro_id'";

	$upres = mysqli_query($conn, $query);

	$upview = mysqli_fetch_assoc($upres);

	mysqli_free_result($upres);

}

// updating


$errors = ['pro_name'=>'','pro_price'=>'','abt_pro'=>'', 'img'=>'','pro_color'=>''];
$succ = '';
$ntsucc ='';
if (isset($_POST['updpro'])) {
	
	// for pro_name

	if (empty($_POST['pro_name'])) {
		$errors['pro_name'] = "Enter a Product";
		
	}else{
		$pro_name = $_POST['pro_name'];
		if (!preg_match('#[^a-z0-9]+#i', $pro_name)) {
		$errors['pro_name'] = "No special character";
			
		}
	}


	// for pro_price

	if (empty($_POST['pro_price'])) {
		$errors['pro_price'] = "Enter a Price";
		
	}else{
		$pro_price = $_POST['pro_price'];
		if (!preg_match("/^[0-9]+$/", $pro_price)) {
		$errors['pro_price'] = "No special character";
			
		}
	}


	// for abt_pro

	if (empty($_POST['abt_pro'])) {
		$errors['abt_pro'] = "Enter Product Details";
		
	}else{
		$abt_pro = $_POST['abt_pro'];
		if (!preg_match('#[^a-z0-9]+#i', $abt_pro)) {
		$errors['abt_pro']= "seperate the items with comma";
		}
	}

	// for pro_color

	if (empty($_POST['pro_color'])) {
		$errors['pro_color'] = "Enter a Product Color";
		
	}else{
		$pro_color = $_POST['pro_color'];
		if (!preg_match("/^[a-zA-Z\s]+$/", $pro_color)) {
		$errors['pro_color'] = "No special character";
			
		}
	}



		$picname = $_FILES['img']['name'];
		$loc = 'proupload/'.$picname;

		$pro_name = $_POST['pro_name'];
		$pro_color = $_POST['pro_color'];

		$pronamecheck = "SELECT * FROM products WHERE pro_name = '$pro_name'";

		$recheck = mysqli_query($conn, $pronamecheck);

		if (mysqli_num_rows($recheck) > 0) {

			$errors['pro_name'] = "Product already exist";

		}elseif(!move_uploaded_file($_FILES['img']['tmp_name'], $loc)) {

			$errors['img'] = "Failed to upload";

		}elseif(!array_filter($errors)) {

		$sql = "UPDATE products SET img = '$picname', pro_name = '$pro_name', pro_price = '$pro_price', abt_pro = '$abt_pro', pro_color = '$pro_color' WHERE pro_id = '$pro_id'";
			
			if(mysqli_query($conn, $sql)){
			$succ = "Product Updated Successfully !";
			header('refresh:2, url=admin-page.php');
			}else{
			$ntsucc = "Check, There is a problem somewhere!";

			}

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
		<div class="col-md-8">
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

						<td><?php echo htmlspecialchars($upview['pro_id']); ?></td>
						<td><?php echo htmlspecialchars($upview['pro_name']); ?></td>
						<td><?php echo number_format($upview['pro_price'], 2); ?></td>
						<td>
								<ul>
									<?php foreach (explode(',', $upview['abt_pro']) as $abt_pro) {?>
										<li><?php echo $abt_pro; ?></li>
									<?php } ?>
								</ul>
							</td>
						<td><?php echo $upview['pro_color']; ?></td>
						<td>
								<?php echo "<img src = 'proupload/".$upview['img']."' style='width:100px; height:80px'/>";  ?>
			
						</td>
				</tr>
				</table>


		</div>


		<div class="col-md-4">
			<center><h4 style="color:brown"> Update Products</h4></center>
			<hr/>

			<center>
				<i style="color:green"><?php echo $succ; ?></i> <i style="color:red"><?php echo $ntsucc; ?></i>
			</center>

			<form class="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" >

				<div class="input-form">
					<input type="text" name="pro_name" class="form-control" placeholder="Enter Product name" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;">

					<p style="background: none; border: none;color: red;"><?php echo $errors['pro_name']; ?></p>
				</div>

				<div class="input-group">
					<span class="input-group-addon" style="background:none; color:brown; border-bottom:2px solid brown; border-top:2px solid brown;border-right:none;border-left:2px solid brown;">#</span> 

					<input type="text" name="pro_price" class="form-control" placeholder="Enter Product Price" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;">
					<span class="input-group-addon" style="background:none; color:brown; border-bottom:2px solid brown;border-top:2px solid brown;border-right:2px solid brown;border-left:2px solid brown;">.00</span>
						
				</div>
	
							<p style="background: none; border: none;color: red;"><?php echo $errors['pro_price']; ?></p>
				
				<div class="input-form">
					<textarea name="abt_pro" class="form-control" placeholder="Enter Product Details" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;"></textarea>
					<p style="background: none; border: none;color: red;"><?php echo $errors['abt_pro']; ?></p>
				</div>

				<div class="input-form">
					<input type="text" name="pro_color" class="form-control" placeholder="Enter Product color" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;">

					<p style="background: none; border: none;color: red;"><?php echo $errors['pro_color']; ?></p>
				</div>

				<div class="input-form">
					<input type="file" name="img" class="form-control" placeholder="Select Image" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;">
					<p style="background: none; border: none;color: red; height:3px"><?php echo $errors['img']; ?></p>
				</div>
				<div class="form-group">
					<center>
						<button type="submit" name="updpro" class="form-control" style="background: brown;color:white; width: 200px;">Update Product</button>
					</center>
				</div>
			</form>
		</div>
		
	</div>
</div>

</body>
</html>