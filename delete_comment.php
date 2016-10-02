<?php
	session_start();

	//open mod3 database
	require 'database_rw.php';

	$id = $_GET["name"];

	// adapted from http://www.w3schools.com/php/php_mysql_delete.asp

	//first delete all comments associated with that article
	$delete_comments = "delete from comments where comment_id='$id'";
	$mysqli->query("
    UPDATE stories
    SET comment_count = comment_count - 1
    WHERE story_id = '".$story_id."'
	");
	if ($mysqli->query($delete_comments) === TRUE) {
		header("Location: delete_comments_posts.php");
			//decrease the comment count in the stories table, from http://stackoverflow.com/questions/2259155/increment-value-in-mysql-update-query
	
	}
	else {
		echo "Error deleting comments:";
	}
?>