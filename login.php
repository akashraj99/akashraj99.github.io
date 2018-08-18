<?php

$con = mysqli_connect('localhost','root','rootpassword','experienz');

if(!$con) {
	die('Couldn\'t connect to the database: ' . mysqli_error());
}

?>
<html>
<head>
<title>Experienz</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="jquery-2.1.3.js"></script>
<script>
$(document).ready(function() {
	$('.submit').on('click', function(e) {
		e.preventDefault();
		var uname = $('#uname').val();
		var pword = $('#pword').val();
		
		if(uname == '' || pword == '') {
			alert("Please fill in the credentials!");
		}
		
		else {
			$.ajax({
				type: 'POST',
				url: 'check.php',
				data: $('.form').serialize(),
				success: function(result){
					if(result == '0') {
						alert("Invalid Credentials! Please try again");
					}
					else {
						window.location = 'main.php';
					}
				}
			});
		}
	});
});
</script>
</head>

<body>

<center>
	
	<div class="login-box">
	
		<form class="form">
			
			<input type="text" id="uname" name="username" placeholder="Enter Username">
			
			<input type="password" id="pword" name="password" placeholder="Enter Password">
			
<br /><br /><br /><br />
			
			<input class="submit" type="submit" Value="Login">
			
			<a href="#" >Forgot Password</a>
			
		</form>
	
	</div>
	
</center>
</body>
</html>
