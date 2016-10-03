<?php
	session_start();
//no longer used because of new structure
	//open mod3 database
	require 'database_rw.php';

	//list of variables to add to table
	$article=$_POST["big_text_box"];
	$title=$_POST["article_title"];
	$username=$_SESSION["Login"];

	//check to make sure article text contains no funny characters
	if( !preg_match('/^[\w_\-]+$/', $article) ){
		echo "Invalid article text; remove special characters";
		exit;
	}
	
	//if article text is valid, add it to mysql mod3 database
	$stmt = $mysqli->prepare("insert into stories (story_text, username, story_title) values (?, ?, ?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}

	$stmt->bind_param('sss', $article, $username, $story_title);
	$stmt->execute();
	$stmt->close();
	//once this is working, reroute to the home page so they can see their article
	//Header("Location: home_page_login.php");
	//exit;
?>