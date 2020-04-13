<?php 

include ('connection/connect.php');

// to fetch the More details information

	$query = "SELECT * FROM products ORDER BY pro_date DESC LIMIT 4";

	$result = mysqli_query($conn, $query);

	$viewme = mysqli_fetch_all($result, MYSQLI_ASSOC);


	

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



	<!-- the script -->
<script>

$(document).ready(function(){
  // Activate Carousel
  $("#slideimg").carousel();

   // Enable Carousel Controls
  $(".carousel-control-prev").click(function(){
    $("#slideimg").carousel("prev");
  });
  $(".carousel-control-next").click(function(){
    $("#slideimg").carousel("next");
  });
    
});

</script>

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
				<li><a href="products.php" style="color:white">Products</a></li>
				<li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</li>

				<li><a href="#" style="color:white;"><i class="glyphicon glyphicon-shopping-cart"></i> </a> </li>
				<li><a href="registration.php" style="color:white;"><i class="glyphicon glyphicon-user"></i> Register</a></li>
				<li><a href="login.php" style="color:white;"><i class="glyphicon glyphicon-log-in"></i> Login</a></li>
					
		</ul>
	</div>
</nav>
<!-- nav bar begins -->

<!-- Begining curosel -->

<!--The images container -->
<div class="container">
	<div id="slideimg" class="carousel slide" data-ride="carousel">
  		<!-- Indicators -->
  		<ul class="carousel-indicators">
  	  		<a class="carousel-control-prev" href="#slideimg"><span class="glyphicon glyphicon-circle-arrow-left"></span></a>
   				 <li data-target="#slideimg" data-slide-to="0" class="active"></li>
   				 <li data-target="#slideimg" data-slide-to="1"></li>
   				 <li data-target="#slideimg" data-slide-to="2"></li>
      		<a class="carousel-control-next" href="#slideimg"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
 		</ul>
  
  <!-- The slideshow -->
  		<div class="carousel-inner" style="height: 520px;">

    		<div   class="item active">
      			<img src="img/b.jpeg" width="1100" height="400">
      			<div class="carousel-caption"> 
      				<h3>Welcome To NTek</h3>
      			</div>
    		</div>
    		<div  class="item">
      			<img src="img/c.jpeg" width="1100" height="400">
    		</div>
    		<div   class="item">
      			<img src="img/a.jpeg" width="1100" height="400">
    		</div>

  		</div>
	</div>	
</div>

<!-- end of curosel -->


<hr/ style="color:2px solid grey; width: 430px">
<center>
	<h4 style="color:brown">Recently Added Products</h4>
</center>

<div class="container">
	<div class="row">
			<div class="col-md-2"></div>

			<div class="col-md-8">
				
				<table class="table table-bordered">
					<tr>
						<?php foreach ($viewme as $viewpro): ?>
					
						<td>
							<?php echo "<img src = 'proupload/".$viewpro['img']."' style='width:150px; height:150px'/>";  ?>
							<h3><?php echo $viewpro['pro_name']; ?></h3>
							<b><?php echo '#'.number_format($viewpro['pro_price'],2); ?></b>
							<center><p><a href=""> More --></a></p></center>
						</td>
						
						<?php endforeach ?>
					</tr>
				</table>


			</div>

			<div class="col-md-2"></div>

	</div>
</div>


</body>
</html>