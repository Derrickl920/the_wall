<?php 
session_start();
require('new-connection.php');

 ?>

 <html>
 <head>
 	<title>THE WALL</title>
 	<meta charset='utf-8'>
 	<link rel="stylesheet" type="text/css" href="styles.css">
 </head>
 <body>
 	<div id="container">
 		<div id="header">
 			<h2>Coding Dojo Wall</h2>
 			<h4> Welcome <?="{$_SESSION['first_name']}"?></h4>
 			<a href='process.php'>LOG OFF</a>
			<hr>
 		</div>
 		<div id="content">
 			<h3>Post a message</h3><br>
 			<form action ="wallprocess.php" method="post">
 				<input type="textarea" name="entermessage" id="textbox" ><br>
 				<input type="submit" value="Post a message">
 				<input type="hidden" name="action" value="message">
 			</form>
 			<div id="wallpost">
<?php
	$query3 = "SELECT messages.message, users.first_name, users.last_name, messages.created_at, messages.updated_at, messages.id 
				FROM messages 
				LEFT JOIN users ON users.id = messages.users_id
				ORDER BY messages.created_at DESC";
	$messagepost = fetch_all($query3);
		?>	<div id='messagebox'>
<?php		foreach($messagepost as $message)
			{	
				$date = date('F dS, Y', strtotime($message['created_at']));
	?>			<div id='message'>
<?php				echo "<h3>{$message['first_name']} {$message['last_name']}  {$date}</h3> <br>";
					echo $message['message']. '<br><br>'; ?>
						<p>Post a comment</p><br>
 							<form  id="commentform" action ="wallprocess.php" method="post">
				 				<input type="text" name="entercomment" id="commentbox" ><br>
				 				<input type = "hidden" name="comment_id" value="<?= $message['id']?>">
				 				<input type="submit" value="Post a comment">
				 				<input type="hidden" name="action" value="reply">
				 			</form>
<?php  	$query4 = "SELECT comments.comment, users.first_name, users.last_name, messages.id, comments.users_id, comments.created_at, comments.created_at
 					FROM comments
 					LEFT JOIN messages ON messages.id = comments.messages_id
 					LEFT JOIN users ON users.id = comments.users_id
 					WHERE messages_id = $message[id]
 					ORDER BY comments.created_at ASC";
					$commentpost = fetch_all($query4);
					foreach($commentpost as $comment)
					{
						echo "<h5>{$comment['first_name']} {$comment['last_name']} {$date} </h5>";
						echo $comment['comment'].'<br>';
					} ?>

				</div>
<?php		} ?>			
			</div>
 			</div>
 		</div>
 	</div>
 </body>
 </html>