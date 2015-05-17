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
 <div id="container">
 	 <div id="register">
	 	<h1>Register</h1>
	  	<form action="process.php" method="post">
	  		First Name: <input type="text" name="first_name"><br>
	  		Last Name: <input type="text" name="last_name"><br>
	 		Email Address: <input type="text" name="email"><br>
	 		Password: <input type="password" name="password"><br>
	 		Confirm Password: <input type="password" name="confirm_password"><br>
	 		<input type="submit" name="register" value="Register">
	 		<input type="hidden" name="action" value="register">
	 	</form>
 	</div>
 	<div id="login">
 	<h1>Login</h1>
 	<form action="process.php" method="post">
 		Email Address: <input type="text" name="email"><br>
 		Password: <input type="password" name="password"><br>
 		<input type="submit" value="Login">
 		<input type="hidden" name="action" value="login">
 	</form>
	</div>
</div>
 </body>
 </html>