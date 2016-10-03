<?php
	session_start();

	//open mod3 database
	require 'database_rw.php';

	$id = $_GET["name"];

	// adapted from http://www.w3schools.com/php/php_mysql_delete.asp

	//first delete all comments associated with that article
	$delete_comments = "delete from comments where story_id='$id'";
	if ($mysqli->query($delete_comments) === TRUE) {
		echo "Deleted comments:";
	}
	else {
		echo "Error deleting comments:";
	}
	//then delete specified row from database
	$stmt = $mysqli->prepare("delete from stories where story_id=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		 //redirect to error page
		header("Location: link_upload_error.html");
		exit;
	}
	$stmt->bind_param('s',$id);
	$stmt->execute();
	$stmt->close();
	
	header("Location: home_page_login.php");
	exit;

	//redirect to homepage
	//header("Location: delete_comments_posts.php");
?>