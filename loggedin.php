<?php
	session_start();
    include ("connectdb.php");
		 
			$sql = "SELECT diary FROM user WHERE email ='".$_SESSION["user"]."'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
				$content = $row["diary"];
				}
			}
			
			else {
				$content = "Write Your Secret Here...";
			}
      

		
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Secret Diary</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="loggedin.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="header row row-content">
		<div class="col-md-11"><a href="#" id="log"><img id="logo" src="img/logo.png"> Secret Diary</a><span id="uname"><?php echo $_SESSION["user"]; ?></div>
		<div class="col-md-1"><button type="button" id="logout" class="btn  btn-lg"  >Log Out</button></div>
	</div>
	<div class="text">
		<textarea id="diary-text" name="content"><?php echo $content; ?></textarea>
	</div>
	<div class="footer">FOOTER
	</div>
	<script type="text/javascript">
		
		$("#diary-text").on("change paste keyup", function() {

 			  $.ajax({
				  method: "POST",
				  url: "updateText.php",
				  data: { content: $("#diary-text").val() }
				});

		});

	</script>
</body>
</html>