<?php
	session_start();

	//open mod3 database
	require database.php

	//list of variables to add to table
	$article=$_POST['article_submit'];
	$title=$_POST['article_title'];
	$username=$_SESSION['login'];

	//check to make sure article text contains no funny characters
	if( !preg_match('/^[\w_\-]+$/', $article) ){
		echo "Invalid article text; remove special characters";
		exit;
	}
	
	//if article text is valid, add it to mysql mod3 database
	$stmt = $mysqli->prepare("insert into mod3 (story_text, username, story_title) values (?, ?, ?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}

	$stmt->bind_param('sss', $article, $username, $story_title);
	$stmt->execute();
	$stmt->close();
	
?>