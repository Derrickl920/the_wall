<?php 
session_start();
require('new-connection.php');


if(isset($_POST['entermessage']) && $_POST['action'] == 'message')
{
	postmessage($_POST['entermessage']);
	header('location: thewall.php');
}
if(isset($_POST['entercomment']) && $_POST['action'] == 'reply')
{
	postcomment($_POST['entercomment']);
	header('location: thewall.php');
}

function postmessage($post)
{
	if(empty($_POST['entermessage']))
	{
		return FALSE;
		header('location: thewall.php');
	}
	if(isset($_POST['entermessage']))
	{
		$query1 = "INSERT INTO messages (message, users_id, created_at, updated_at)
				  VALUES ('{$_POST['entermessage']}','{$_SESSION['user_id']}', NOW(), NOW())";
		run_mysql_query($query1);
		header('location: thewall.php');
	}
}

function postcomment($post)
{
	if(empty($_POST['entercomment']))
	{
		return FALSE;
		header('location: thewall.php');
	}
	if(isset($_POST['entercomment']))
	{
		$message_id = $_POST['comment_id'];
		$query2 = "INSERT INTO comments (messages_id, users_id, comment, created_at, updated_at)
				  VALUES ('$message_id','{$_SESSION['user_id']}', '{$_POST['entercomment']}', NOW(), NOW())";
		run_mysql_query($query2);
		header('location: thewall.php');
	}
		
		// header('location: thewall.php');
}

 ?>