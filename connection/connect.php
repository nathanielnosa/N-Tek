<?php 

$conn = mysqli_connect('localhost','root','','ntek');

if (!$conn == true) {
	echo "Bad connection cheeck the server". mysqli_connect_error;
}

 ?>