<?php 
session_start();
require('new-connection.php');

 ?>

 <html>
 <head>
 	<title>THE WALL</title>
 	<meta charset='utf-8'>
 	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
 	<link rel="stylesheet" type="text/css" href="styles.css">
 </head>
 <body>
 	<div id="wall-container">
 		<div id="header">
 			<div class="row">
 				<h1 class='col-xs-8'>The Wall - Game Of Thrones</h1>
 				<h3 class='col-xs-2'> Welcome <span style='text-transform: capitalize;'><?="{$_SESSION['first_name']}!"?></span></h3>
 				<button onclick="window.location='process.php';" type="button" class='btn btn-danger col-xs-2'>LOG OFF</button>
			</div>
			<hr>
 		</div>
 		<div id="content">
 			<div id='postamessage'>
	 			<h2>Post a message to The Wall</h2>
	 			<form action ="wallprocess.php" method="post">
	 				<textarea name="entermessage" id="textbox" ></textarea><br>
	 				<input class='btn btn-primary btn-sm' type="submit" value="Post a message">
	 				<input type="hidden" name="action" value="message">
	 			</form>
	 			<hr>
 			</div>
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
						$date = date('F dS, Y g:iA', strtotime($message['created_at']));
			?>			<div id='message'>
		<?php				echo "<h3> <span style='text-transform: capitalize'>{$message['first_name']}</span> <span style='text-transform: capitalize'> {$message['last_name']}</span> - {$date}</h3> <br>";
							?>
							<div id='postedmessage'>
		<?php				echo "<p>{$message['message']}</p>". '<br>'; ?>
							</div>
		<?php  	$query4 = "SELECT comments.comment, users.first_name, users.last_name, messages.id, comments.users_id, comments.created_at, comments.created_at
		 					FROM comments
		 					LEFT JOIN messages ON messages.id = comments.messages_id
		 					LEFT JOIN users ON users.id = comments.users_id
		 					WHERE messages_id = $message[id]
		 					ORDER BY comments.created_at ASC";
							$commentpost = fetch_all($query4);
							foreach($commentpost as $comment)
							{	?>
						<div id='newcomment'>
							<div id='commentname'>
		<?php					echo "<h4><span style='text-transform: capitalize'>{$comment['first_name']}</span><span style='text-transform: capitalize'> {$comment['last_name']}</span> - {$date}  </h4>";	?>
							</div>
							<div id='postedcomment'>				
		<?php					echo "<p>{$comment['comment']}</p>".'<br>';
							} ?>
							</div>
		 						<form  id="commentform" action ="wallprocess.php" method="post">
									<textarea name="entercomment" id="commentbox"></textarea><br>
					 				<input type = "hidden" name="comment_id" value="<?= $message['id']?>">
					 				<input class='btn btn-success btn-sm' type="submit" value="Post a comment">
							 		<input type="hidden" name="action" value="reply">
						 		</form>
						 </div>
						</div>
						<hr>
<?php		} ?>
				</div>
 			</div>
 		</div>
 	</div>
 </body>
 </html>