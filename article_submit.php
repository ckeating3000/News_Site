<?php
	// destroy any previous sessions
	session_start();
	session_destroy();

	//open mod3 database
	require database.php

	$article = $_POST['article_submit'];
	

	//check to make sure article text contains no funny characters
	if( !preg_match('/^[\w_\-]+$/', $article) ){
		echo "Invalid article text; remove special characters";
		exit;
	}

	
	//if article text is valid, add it to mysql mod3 database
 	if(link_exists){
		$stmt = $mysqli->prepare("insert into mod3 (story_text) values (?)");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}

		$stmt->bind_param('s', $article);
		 
		$stmt->execute();
		 
		$stmt->close();
	}
?>