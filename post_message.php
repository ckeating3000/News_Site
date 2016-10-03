<?php
	session_start();

	//open mod3 database
	require 'database_rw.php';

	//check for valid token created when user logs in
	if($_SESSION['token'] !== $_POST['token']){
		die("Request forgery detected");
	}

	//list of variables to add to table
	$subject = $_POST["subject"];
	$user_to = $_POST["user_to"];
	$body = $_POST["message"];
	$user_from=$_SESSION["Login"];

	//add message to the database
		$message = $mysqli->prepare("insert into messages (user_from, user_to, message, subject) values (?, ?, ?, ?)");
		if(!$message){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			 //redirect to error page
		}
		$message->bind_param('ssss', htmlspecialchars($user_from), htmlspecialchars($user_to), htmlspecialchars($body), htmlspecialchars($subject));
		$message->execute();
		$message->close();
		//redirect to homepage
		header("Location: messagesent.html");
	
	
?>