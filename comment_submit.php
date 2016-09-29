<?php
	session_start();

	//open mod3 database
	require 'database_rw.php';

	//list of variables to add to table
	$text=$_POST["comment_submit"];
    $story_id=$_SESSION["story_id"];
	$username=$_SESSION["Login"];

	//check to make sure article text contains no funny characters
	if( !preg_match('/^[\w_\-]+$/', $article) ){
		echo "Invalid article text; remove special characters";
		exit;
	}
	
	//if article text is valid, add it to mysql table
	$stmt = $mysqli->prepare("insert into comments (text, username, story_id) values (?, ?, ?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}

	$stmt->bind_param('ssi', $test, $username, $story_id);
	$stmt->execute();
	$stmt->close();
    
//    reroute to home page once working 
//    Header("Location: home_page_login.php");
//	exit;
	
?>