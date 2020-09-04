<?php
	session_start();

	if(array_key_exists('content', $_POST)){

	include("connectdb.php");

	$query = "UPDATE user SET diary = '".$_POST['content']."' WHERE email = '".$_SESSION["user"]."'" ;

	mysqli_query($conn,$query);
		


}


?>