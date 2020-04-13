<?php 

include('connection/connect.php');

//echo "Hello world";

$error = ['email' => ''];
$getdis ='';
if (isset($_POST['getpwd'])) {

	$email = $_POST['email'];

	if (empty($_POST['email'])) {
		$error['email'] = "Input an email";
	}else{
		$email = $_POST['email'];

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error['email'] = "Wrong email format";
		}
	}
	$query = "SELECT pwd, id FROM register WHERE email='$email'";

	$result = mysqli_query($conn, $query);

	$getemail = mysqli_fetch_assoc($result);

	$getdis =  $getemail['pwd'];
	
	
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
				<li><a href="index.php" style="color:white">Home</a></li>
				<li><a href="#" style="color:white">Products</a></li>
				<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</li>

				<li><a href="#" style="color:white;"><i class="glyphicon glyphicon-shopping-cart"></i> </a> </li>
				<li hidden="true"><a href="" style="color:white;"><i class="glyphicon glyphicon-log-in"></i> Login</a></li>
					
		</ul>
	</div>
</nav>
<!-- nav bar begins -->

<div class="container">
	<div class="row">
		<div class="col-md-6" style="height: 550px; border: 1px solid black; background:url(img/d.jpeg);">
	
		</div>

		<div class="col-md-6" >
					<br/><br/><br/>
					<center>
					<div style="border:2px solid brown;">
					<form class="form" action="forget.php" method="POST">
						
					<div class="form-group">

						<label style="color: brown">Enter Your Email Address</label>
						<input type="text" name="email" class="form-control" style="background-color:transparent;width: 400px">
						<p style="color: red"><?php echo $error['email'];?></p>
						<p style="color:brown"><b>This is your Password:</b><?php echo $getdis?></p>
					</div>
					
					<div class="form-group">
					<center>
						<button type="submit" name="getpwd" class="form-control" style="background: brown;color:white; width: 200px;">
							<span class="glyphicon glyphicon-question-sign" style="background-color:transparent;"> </span> Get Password</button>
					</center>
					</div>

						<center>

					<a href="login.php" class="btn btn-primary" style="background-color:transparent;color:brown;border:1px solid brown; width: 150px;"> <span class="glyphicon glyphicon-log-in"> </span>  Login</a>

					<a href="registration.php" class="btn btn-primary" style="background-color:transparent;border:1px solid brown; color:brown;width: 150px"> <span class="glyphicon glyphicon-user" ></span> Register!</a>
						</center>
						<br/>
				</form>
			</div>
			</center>
		</div>
	</div>
</div>
</body>
</html>
