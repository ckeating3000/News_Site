<?php
	session_start();

	//open mod3 database
	require 'database_rw.php';

	$id = $_GET["name"];
	$story_id = $_GET["story"];

	//delete comment with specified comment_id
	$stmt = $mysqli->prepare("delete from comments where comment_id=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		 //redirect to error page
		header("Location: link_upload_error.html");
		exit;
	}
	$stmt->bind_param('s', $id);
	$stmt->execute();
	$stmt->close();

	//decrease the comment count in the stories table, from http://stackoverflow.com/questions/2259155/increment-value-in-mysql-update-query
	$stmt = $mysqli->prepare("UPDATE stories SET comment_count = comment_count - 1 WHERE story_id =?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		 //redirect to error page
		header("Location: link_upload_error.html");
		exit;
	}
	$stmt->bind_param('s', $story_id);
	$stmt->execute();
	$stmt->close();

	header("Location: home_page_login.php");
	exit;
	
?>