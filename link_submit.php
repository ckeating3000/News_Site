<?php
	session_start();

	//open mod3 database
	require 'database_rw.php';

	//check for valid token created when user logs in
	if($_SESSION['token'] !== $_POST['token']){
		die("Request forgery detected");
	}

	//list of variables to add to table
	$link = $_POST["link_submit"];
	$comment = $_POST["comment_submit"];
	$title = $_POST["article_title"];
	$username=$_SESSION["Login"];

	//check to make sure link exists
	//adapted from http://stackoverflow.com/questions/2280394/how-can-i-check-if-a-url-exists-via-php
	$link_exists=false;
	$file_headers = @get_headers($link);
	
	if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
	    $link_exists = false;
	    //redirect to error page
		header("Location: link_nonexist_error.html");
	}
	else {
	    $link_exists = true;
	}
	//if link exists, add it to mysql mod3 database
 	if($link_exists){
		$stmt = $mysqli->prepare("insert into stories (link, username, story_title, story_text) values (?, ?, ?, ?)");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			 //redirect to error page
			header("Location: link_upload_error.html");
			exit;
		}
		$stmt->bind_param('ssss', htmlspecialchars($link), $username, $title, $comment);
		$stmt->execute();
		$stmt->close();
		//redirect to homepage
		header("Location: home_page_login.php");
	}
	
?>