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
	$story_id=$_SESSION["story_id"];

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
	//$get_comcount = $mysqli->prepare("select comment_count from stories where story_id=?");
	//if(!$get_comcount){
	//	printf("Query Prep Failed: %s\n", $mysqli->error);
	//	exit;
	//}
	//$get_comcount->bind_param('i', $story_id);
	//$get_comcount->execute();
	//$get_comcount->bind_result($numcomments);
	//$get_comcount->close();
	////increase the comment count
	//$numcomments=$numcomments +1;
    
	//increase the comment count in the stories table, from http://stackoverflow.com/questions/2259155/increment-value-in-mysql-update-query
	$mysqli->query("
    UPDATE stories
    SET comment_count = comment_count + 1
    WHERE story_id = '".$story_id."'
");
    
//reroute to home page once working 
    header("Location: home_page_login.php");
	exit;
	
