<?php 

include('connection/connect.php');

$errors = ['fname'=>'','lname'=>'','email'=>'','addr'=>'','pnum'=>'','uname'=>'','pwd'=>'', 'photo'=>''];
$ch = $ch1 = '';

if (isset($_POST['reg'])) {
	
	//for fname
	if (empty($_POST['fname'])) {
		$errors['fname'] = "Enetr a first name";
	}else{
		$fname = $_POST['fname'];
		if (!preg_match("/^[a-zA-Z\s]+$/", $fname)) {
			$errors['fname'] = "No special character";
		}
	}

	//for lname
	if (empty($_POST['lname'])) {
		$errors['lname'] = "Enter a last name";
	}else{
			$lname = $_POST['fname'];
		if (!preg_match("/^[a-zA-Z\s]+$/", $lname)) {
			$errors['lname'] = "No special character";
		}
	}

	// email
	if (empty($_POST['email'])) {
		$errors['email'] = "Enter an emial address ";
	}else{
		$email = $_POST['email'];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = "Invalid Email";
		}
	}

	// for addr
	if (empty($_POST['addr'])) {
		$errors['addr'] = "Enter an address";
	}else{
		$addr = $_POST['addr'];
		$uppercase = preg_match('@[A-Z]@', $addr);
		$lowercase = preg_match('@[a-z]@', $addr);
		$number = preg_match('@[0-9]@', $addr);
		$spcharacter = preg_match('@[^\w]@', $addr);

		if (!($uppercase || $lowercase || $number || $spcharacter)){
			$errors['addr'] = "No special character";
		}

	}

	// for num
	if (empty($_POST['pnum'])) {
		$errors['pnum'] ="Enter phone number";
	}else{

	}

	// for unmae
	if (empty($_POST['uname'])) {
		$errors['uname'] = "Enter a username";
	}

	// for pwd
	if (empty($_POST['pwd'])) {
		$errors['pwd'] = "Enter password";
	}else{
		$pwd = $_POST['pwd'];

		if(strlen($_POST['pwd']) < 8){
			$errors['pwd'] =  "Password Too short";
		}
	}

		$picname = $_FILES['photo']['name'];
	
		$loc = 'upload/'.$picname;

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$addr = $_POST['addr'];
$pnum = $_POST['pnum'];
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];

		// for username
		$usercheck = "SELECT * FROM register WHERE uname = '$uname'";

		$recheck = mysqli_query($conn, $usercheck);

		if (mysqli_num_rows($recheck) > 0) {

			$errors['uname'] = "User already exist";

		}elseif(!move_uploaded_file($_FILES['photo']['tmp_name'], $loc)) {

			$errors['photo'] = "Failed to upload";

		}elseif(!array_filter($errors)) {

			$sql = "INSERT INTO register (fname, lname, email, pnum, addr,  uname, pwd, photo) VALUES ('$fname','$lname','$email','$pnum','$addr','$uname','$pwd','$picname')";
			
			if(mysqli_query($conn, $sql)){
			$ch1 = "Registration Successful!";
			header('refresh:2, url=index.php');
			}else{
			$ch = "Check, There is a problem somewhere!";

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
				<li ><a href="login.php" style="color:white;"><i class="glyphicon glyphicon-log-in"></i> Login</a></li>
					
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
				<center><h4 style="color:brown">Register Here!</h4></center>
				<p style="color: green"><?php echo $ch1; ?></p> <p style="color: red"><?php echo $ch; ?></p>

				<div class="form-group" >
					<input type="text" name="fname" class="form-control" placeholder="Enter First Name" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;">
					<p style="background: none; border: none;color: red; height:3px"><?php echo $errors['fname']; ?></p>
				</div>

				<div class="form-group">
					<input type="text" name="lname" class="form-control" placeholder="Enter Last Name" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;">
					<p style="background: none; border: none;color: red; height:3px"><?php echo $errors['lname']; ?></p>
				</div>

				<div class="form-group">
					<input type="text" name="email" class="form-control" placeholder="Enter Email" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;">
					<p style="background: none; border: none;color: red; height:3px"><?php echo $errors['email']; ?></p>
				</div>

				<div class="form-group">
					<input type="number" name="pnum" class="form-control" placeholder="Enter Phone Number" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;">
					<p style="background: none; border: none;color: red; height:3px"><?php echo $errors['pnum']; ?></p>
				</div>

				<div class="form-group">
				<textarea name="addr" class="form-control" placeholder="Enter Address" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;"></textarea>
				<p style="background: none; border: none;color: red; height:3px"><?php echo $errors['addr']; ?></p>
				</div>

				<div class="form-group">
					<input type="text" name="uname" class="form-control" placeholder="Enter Username" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;">
					<p style="background: none; border: none;color: red; height:3px"><?php echo $errors['uname']; ?></p>
				</div>

				<div class="form-group">
					<input type="password" name="pwd" class="form-control" placeholder="Enter Password" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;">
					<p style="background: none; border: none;color: red; height:3px"><?php echo $errors['pwd']; ?></p>
				</div>

				<div class="form-group">
					<input type="file" name="photo" class="form-control" placeholder="Select Image" style="background:none; color:brown; border-bottom:2px solid brown; border-top: none;border-right: none;border-left:2px solid brown;">
					<p style="background: none; border: none;color: red; height:3px"><?php echo $errors['photo']; ?></p>
				</div>
				<div class="form-group">
					<center>
						<button type="submit" name="reg" class="form-control" style="background: brown;color:white; width: 100px;">Register</button>
					</center>
				</div>

			</form>
		</div>
	</div>
</div>
</body>
</html>