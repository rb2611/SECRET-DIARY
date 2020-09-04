<?php
	session_start();
	if(array_key_exists('email','password', $_POST)){
	include("connectdb.php");
	$sql = "INSERT INTO user (email, password, diary) VALUES ('".$POST["email"]."', '".$_POST["password"]."' , '')";
	mysqli_query($conn,$sql);
	$_SESSION["user"] = $_POST["email"];
	header("Location: loggedin.php");
	}
?>