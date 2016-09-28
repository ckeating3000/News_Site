<?php
	// destroy any previous sessions
	session_start();
	session_destroy();

	//open mod3 database
	require database.php

	$link = $_POST['article_link'];
	

	//check to make sure link exists
	$link_exists=false;

	//adapted from http://stackoverflow.com/questions/2280394/how-can-i-check-if-a-url-exists-via-php
	$file_headers = @get_headers($link);
	if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
	    $link_exists = false;
	}
	else {
	    $link_exists = true;
	}
	//if link exists, add it to mysql mod3 database
 	if(link_exists){
		$stmt = $mysqli->prepare("insert into mod3 (link) values (?)");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}

		$stmt->bind_param('s', $link);
		 
		$stmt->execute();
		 
		$stmt->close();
	}
?>
