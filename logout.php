<?php 

session_start();
ob_start();

if(isset($_SESSION['uname'])){
	unset($_SESSION['uname']);
	header('refresh:2, url=index.php');
}
elseif(isset($_SESSION['admin_name'])){
	unset($_SESSION['admin_name']);
	header('refresh:2, url=index.php');
}
else
{
	header('location:index.php');
}
session_destroy();

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

	<div class="container">
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4" style="margin-top: 50px">
				<br/>
				<center><h3 style="color: brown"> Loging Out ...</h3></center>
				<div class="progress progress-striped active">
					<div class="progress-bar progress-bar-success" style="width:90%">
						<span class="sr-only">90% complet</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4"></div>
		</div>
	</div>

</body>
</html>