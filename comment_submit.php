<?php
	session_start();

	//open mod3 database
	require 'database_rw.php';

	//list of variables to add to table
	$text=$_POST["comment_submit"];
	$username=$_SESSION["Login"];
	$story_id=$_POST["story_id"];

	//check to make sure article text contains no funny characters
	//if( !preg_match('/^[\w_\-]+$/', $text) ){
	//	echo "Invalid article text; remove special characters";
	//	exit;
	//}

	//if comment text is valid, add it to mysql table
	$stmt = $mysqli->prepare("insert into comments (comment, username, story_id) values (?, ?, ?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}

	$stmt->bind_param('sss', $text, $username, $story_id);
	$stmt->execute();
	$stmt->close();
	//get the number of comments before comment added
	$get_comcount = $mysqli->prepare("select comment_count from stories where story_id=?");
	if(!$get_comcount){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$get_comcount->bind_param('i', $story_id);
	$get_comcount->execute();
	$get_comcount->bind_result($numcomments);
	$get_comcount->close();
	//increase the comment count
	++$numcomments;
    
	//increase the comment count in the stories table
	$increase_comcount = $mysqli->prepare("update stories set comment_count=? where story_id=?");
	if(!$increase_comcount){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	
	$increase_comcount->bind_param('ii', $numcomments, $story_id);
	$increase_comcount->execute();
	$increase_comcount->close();
    
//reroute to home page once working 
    //header("Location: post_comment.php");
	//exit;
	
