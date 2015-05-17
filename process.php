<?php 
session_start();
require('new-connection.php');

if(isset($_POST['action']) && $_POST['action'] == 'register')
{
	register_user($_POST);
}
elseif(isset($_POST['action']) && $_POST['action'] == 'login')
{
	login_user($_POST);
}
else
 {
 	session_destroy();
 	header('location: index.php');
	die();
 }

function register_user($post)
{
	$_SESSION['errors'] = array();
	if(preg_match("/^[a-zA-Z]+$/", $_POST['first_name']) === 0)
	{
		$_SESSION['errors'][] = "Your first name can only contain letters!";
		// echo "first name error";
	}
	if(preg_match("/^[a-zA-Z]+$/", $_POST['last_name']) === 0)
	{
		$_SESSION['errors'][] = "Your last name can only contain letters!";
	}
	if(empty($post['first_name']))
	{
		$_SESSION['errors'][] = "first name can't be blank!";
	}
	if(empty($post['last_name']))
	{
		$_SESSION['errors'][] = "last name can't be blank!";
	}
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		$errors[] = "Your email address was invalid!";
	}
	if(empty($post['email']))
	{
		$_SESSION['errors'][] = "Your email cannot be blank!";
	}
	if(empty($post['password']))
	{
		$_SESSION['errors'][] = "Your email cannot be blank!";
	}
	if(strlen($post['password']) < 6)
	{
		$_SESSION['errors'][] = "Your password must be at least 6 characters!";
	}
	if($post['password'] !== $post['confirm_password'])
	{
		$_SESSION['errors'][] = "Your password confirm must match!";
	}
	if(count($_SESSION['errors']) > 0)
	{
		header('location: index.php');
		die();
	}
	else
	{
		$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at)
				  VALUES ('{$post['first_name']}', '{$post['last_name']}','{$post['email']}','{$post['password']}', NOW(), NOW())";
		run_mysql_query($query);
		$_SESSION['success_message'] = "User successfully created!";
		header('location: index.php');
		die();
	}
}
function login_user($post) //just a parameter called post
{
	$query = "SELECT * FROM users WHERE users.password = '{$post['password']}' 
			  AND users.email = '{$post['email']}'";
	$user = fetch_all($query); //go and attempt to grab user with above credentials!
	if(count($user) > 0)
	{
		$_SESSION['user_id'] = $user[0]['id'];
		$_SESSION['first_name'] = $user[0]['first_name'];
		$_SESSION['last_name'] = $user[0]['last_name'];
		$_SESSION['logged_in'] = TRUE;
		header('location: thewall.php');
	}
	else
	{
		$_SESSION['errors'][]= "can't find a user with those credentials!";
		header('location: index.php');
		die();
	}
}



 ?>