<?php 
session_start();

 ?>
 <html>
 <head>
 	<title>THE WALL LOGIN PAGE</title>
 	<meta charset='utf-8'>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
 	<link rel="stylesheet" type="text/css" href="styles.css">
 </head>
 <body>
 	<?php 
 	if(isset($_SESSION['errors']))
 	{
 		foreach($_SESSION['errors'] as $error)
 		{
 			echo "<p class='errors'> {$error} </p>";
 		}
 		unset($_SESSION['errors']);
 	}
 	if(isset($_SESSION['success_message']))
 	{
 		echo "<p class='success'>{$_SESSION['success_message']} </p>";
 		unset($_SESSION['success_message']);
 	}
 	 ?>
 <div id="home-container">
 	 <div id="login-register">
	 	<h1 class='text-primary'>Register</h1>
	 	<div class="form-group">
		  	<form action="process.php" method="post">
		  		<input class='form-control col-xs-4' type="text" name="first_name" placeholder='First Name'><br>
		  		<input class='form-control col-xs-4' type="text" name="last_name" placeholder='Last Name'><br>
		 		<input class='form-control col-xs-4' type="text" name="email" placeholder="Email"><br>
		 		<input class='form-control col-xs-4' type="password" name="password" placeholder="Password"><br>
		 		<input class='form-control col-xs-4' type="password" name="confirm_password" placeholder="Confirm Password"><br>
		 		<input class='btn btn-primary' type="submit" name="register" value="Register">
		 		<input type="hidden" name="action" value="register">
		 	</form>
	 	</div>
	 	<h1 class='text-success'>Login</h1>
	 	<div class="form-group">
		 	<form action="process.php" method="post">
		 		<input class='form-control col-xs-4' type="text" name="email" placeholder='Email'><br>
		 		<input class='form-control col-xs-4' type="password" name="password" placeholder='Password'><br>
		 		<input  class='btn btn-success' type="submit" value="Login">
		 		<input type="hidden" name="action" value="login">
		 	</form>
 		</div>
	</div>
</div>
 </body>
 </html>