<?php
session_start();
$message="";
$error="";

if($_POST["email"]!="" && $_POST["password"]!="" && $_POST["confirmpassword"]=="") {
	$conn = mysqli_connect("localhost","root","12345678","mydb");
	$result = mysqli_query($conn,"SELECT * FROM user WHERE email='" . $_POST["email"] . "' and password = '". md5($_POST["password"])."'");
	$count  = mysqli_num_rows($result);
	if($count==0) {
		$message = "Invalid Username or Password!";
	}
	else {
		$_SESSION["user"] = "".$_POST["email"];
		header("Location: loggedin.php");
	}
}
else if($_POST["email"]!="" && $_POST["password"]!="" && $_POST["confirmpassword"]!=""){
	
	if ($_POST["password"]==$_POST["confirmpassword"])
	{
		include ("connectdb.php");
		$sql = "INSERT INTO user (email, password, diary) VALUES ('".$_POST["email"]."', '".md5($_POST["password"])."' , '')";
		mysqli_query($conn,$sql);
		$_SESSION["user"] = "".$_POST["email"];
		header("Location: loggedin.php");
	}
	else {
		echo alert("Password doesn't match");
	}
}

?>
<!doctype HTML>
<html>
<head>
	<title>Log In</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style>
		.error {
			color:red;
		}
	</style>
</head>
<body>

<!-- Sign up Modal -->
  <div class="modal fade" id="signupbox" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title ">Sign Up</h4>
        </div>
        <div class="modal-body">
			<form method="post">
				<div class="error"><?php if($error!="") { echo $error; } ?></div><br/>
				E-mail : <input type="email" name="email" id="email" placeholder="Your email" required></input><br/><br/>
				Password : <input type="password" name="password" id="password" placeholder="password" required></input><br/><br/>
				Confirm Password : <input type="password" name="confirmpassword" id="confirmpassword" placeholder="confirm password" required></input><br/><br/>
				<input type="submit" id="signup" class="btn btn-success" value="Sign up"></input>
			</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  <div class="header row row-content">
	<div class="col-md-11"><a href="#" id="log"><img id="logo" src="img/logo.png"> Secret Diary</a></div>
	<div class="col-md-1"><button type="button" id="sign" class="btn btn-lg" data-toggle="modal" data-target="#signupbox">Sign Up</button></div>
	
  </div>
  <div class="loginpanel container">
  
	<form class="login" method="POST">
		<div class="error"><?php if($message!="") { echo $message; } ?></div><br/>
		E-mail : <input type="email" name="email" placeholder="Your email" required></input><br/><br/>
		Password : <input type="password" name="password" placeholder="password" required></input><br/><br/>
		<input type="submit" name="submit" id="loginbtn"  class="btn btn-success" value="Log in"></input>
	</form>

  </div>

   

  
	
</body>
</html>