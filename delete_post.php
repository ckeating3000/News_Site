<?php
	session_start();

	//open mod3 database
	require 'database_rw.php';

	$id = $_GET["name"];

	// adapted from http://www.w3schools.com/php/php_mysql_delete.asp

	//first delete all comments associated with that article
	$delete_comments = "delete from comments where story_id=$id";
	if ($mysqli->query($delete_comments) === TRUE) {
		echo "Deleted comments:";
	}
	else {
		echo "Error deleting comments:";
	}
	//then delete specified row from database
	$delete_post = "delete from stories where story_id='$id'";
	if ($mysqli->query($delete_post) === TRUE) {
		header("Location: delete_comments_posts.php");
	}
	else {
		echo "Error deleting post";
	}

	//redirect to homepage
	//header("Location: delete_comments_posts.php");
?>