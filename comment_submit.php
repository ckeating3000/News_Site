<?php
	session_start();

	//open mod3 database
	require 'database_rw.php';

	//check for valid token created when user logs in
	if($_SESSION['token'] !== $_POST['token']){
		die("Request forgery detected");
	}
	
	//list of variables to add to table
	$text=$_POST["comment_submit"];
	$username=$_SESSION["Login"];
	$story_id3=$_POST["story_id2"];
	//$story_id=$_SESSION["story_id"];


	//if comment text is valid, add it to mysql table
	$stmt = $mysqli->prepare("insert into comments (comment, username, story_id) values (?, ?, ?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}

	$stmt->bind_param('sss', $text, $username, $story_id3);
	$stmt->execute();
	$stmt->close();
    
	//increase the comment count in the stories table, from http://stackoverflow.com/questions/2259155/increment-value-in-mysql-update-query
	$stmt = $mysqli->prepare("UPDATE stories SET comment_count = comment_count + 1 WHERE story_id =?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		 //redirect to error page
		header("Location: link_upload_error.html");
		exit;
	}
	$stmt->bind_param('s', $story_id3);
	$stmt->execute();
	$stmt->close();
    
//reroute to home page once working 
    header("Location: home_page_login.php");
	exit;
	
