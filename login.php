<?php 
session_start();

include('connection/connect.php');
$error = $Successful = $invalid ='';

if (isset($_POST['login'])) {

		$queryuser = mysqli_query($conn, "SELECT * FROM register WHERE uname='".$_POST['uname']."' && pwd='".$_POST['pwd']."'");

		$queryadmin = mysqli_query($conn, "SELECT * FROM admin WHERE admin_name='".$_POST['uname']."' && admin_pwd='".$_POST['pwd']."'");

		// $succ = '';
		// $succ1 ='';

		if(mysqli_num_rows($queryuser) > 0){
			$_SESSION['uname'] = $_POST['uname'];
			echo $succ= "<p style='color:brown; text-align:center'> User Login Successful ! </p>";
			header('refresh:2; url=products.php');

		}elseif(mysqli_num_rows($queryadmin) > 0){
			$_SESSION['admin_name'] = $_POST['uname'];
			echo $succ1 = "<p style='color:brown; text-align:center'> AdminLogin Successful ! </p>";
			header('refresh:2; url=admin-page.php');

		}else{

			echo "<script type='text/javascript'>alert('Wrong Login Details!')</script>";
			header('refresh:1; url=index.php');
		}
	}
	
// 	if(empty($_POST['uname']) || empty($_POST['pwd']))  {
	
// 	$error = "<p style='color:red; text-align:center'> Enter Username or Password ! </p>";

// 	}else{
// 		$_SESSION['uname'] = $uname = $_POST['uname'];
// 		$pwd = $_POST['pwd'];

// 		$query = "SELECT * FROM register WHERE uname ='$uname' && pwd ='$pwd'";

// 		$result = mysqli_query($conn, $query);

// 		if(mysqli_fetch_assoc($result)){
// 			$Successful = "<p style='color:brown; text-align:center'> Login Successful ! </p>";
// 			header('refresh:2, url=products.php');

// 		}else{
// 			$invalid = "<p style='color:red; text-align:center'>Invalid Username or Password ! </p>";

// 		}


// 	}


// }
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
<?php include ('payref.php') ?>
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

		<div class="col-md-6">
			<form class="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" >
				<center><h4 style="color:brown">Login Here!</h4></center>
				<p style="color: red"><?php echo $error; ?></p>
				<p style="color: red"><?php echo $invalid; ?></p>
				

				<div class="form-group">
					<input type="text" name="uname" class="form-control" placeholder="Enter Username" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;">
				</div>

				<div class="form-group">
					<input type="password" name="pwd" class="form-control" placeholder="Enter Password" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;">
				</div>

				
				<div class="form-group">
					<center>
						<button type="submit" name="login" class="form-control" style="background: brown;color:white; width: 100px;">
							<span class="glyphicon glyphicon-log-in" style="background-color:transparent;"> </span> Login</button>
					</center>
				</div>
				<center>
				<a href="forget.php" class="btn btn-primary" style="background-color: transparent;border:1px solid brown; color: brown"> <span class="glyphicon glyphicon-question-sign" style="background-color:transparent;"> </span> Forget Password?</a>
					<a href="registration.php" class="btn btn-primary" style="background:brown;border:1px solid brown;width: 200px"> <span class="glyphicon glyphicon-user" ></span> Register!</a>
					</center>
			</form>
		</div>
	</div>
</div>
</body>
</html>