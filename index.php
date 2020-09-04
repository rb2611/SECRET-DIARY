<?php
session_start();
$message="";
$error="";

if(count($_POST)>0) {
	$conn = mysqli_connect("localhost","root","12345678","mydb");
	$result = mysqli_query($conn,"SELECT * FROM user WHERE email='" . $_POST["email"] . "' and password = '". $_POST["password"]."'");
	$count  = mysqli_num_rows($result);
	if($count==0) {
		$message = "Invalid Username or Password!";
	} 

	
	
	
	else {
		$_SESSION["user"] = "".$_POST["email"];
		header("Location: loggedin.php");
	}
}

?>
<!doctype HTML>
<html>
<head>
	<title>Bootstrap Example</title>
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
			<form method="POST">
				<div class="error"><?php if($error!="") { echo $error; } ?></div><br/>
				E-mail : <input type="email" name="email" id="email" placeholder="Your email" required></input><br/><br/>
				Password : <input type="password" name="password" id="password" placeholder="password" required></input><br/><br/>
				Confirm Password : <input type="password" name="confirmpassword" id="confirmpassword" placeholder="confirm password" required></input><br/><br/>
				Stayloggedin : <input type="checkbox" name="stayloggedin" ></input><br/><br/>
				<input type="submit" id="signup"  name="submit" value="Sign Up"></input>
				
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
	<div class="col-md-1"><button type="button" id="sign" class="btn btn-success btn-lg" data-toggle="modal" data-target="#signupbox">Sign Up</button></div>
	
  </div>
  <div class="loginpanel container">
  
	<form class="login" method="POST">
		<div class="error"><?php if($message!="") { echo $message; } ?></div><br/>
		E-mail : <input type="email" name="email" placeholder="Your email" required></input><br/><br/>
		Password : <input type="password" name="password" placeholder="password" required></input><br/><br/>
		Stayloggedin : <input type="checkbox" name="stayloggedin" ></input><br/><br/>
		<input type="submit" name="submit" id="loginbtn" value="Log in"></input>
	</form>

  </div>

   <script type="text/javascript">
		
		$("#signup").click(function() {
			if( $("#password").val() == $("#confirmpassword").val()){
 			  $.ajax({
				  method: "POST",
				  url: "insertdata.php",
				  data: { email: $("#email").val(),password:$("#password").val() }
				});
	
			}
			else {
				alert("Password Doesn't Match");
			}

		});

	</script>

  
	
</body>
</html>