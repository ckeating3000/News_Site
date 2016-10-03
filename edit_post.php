<?php
	session_start();

	//open mod3 database
	require 'database_rw.php';

	//check for tokens
	if(isset($_GET['token'])){
		if($_SESSION['token'] !== $_GET['token']){
			die("Request forgery detected");
		}
	}

	if(isset($_POST['token'])){
		if($_SESSION['token'] !== $_POST['token']){
			die("Request forgery detected");
		}
	}

	//check for login
    if(!isset($_SESSION['Login'])){
		header("Location: home_page_nologin.php");
		exit;
	}

	//list of variables to update
	$id = $_POST["id"];
	$link = $_POST["link_submit"];
	$comment = $_POST["comment_submit"];
	$username = $_SESSION["Login"];

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
	
 	if($link_exists){
		//then update specified story in database
		$stmt = $mysqli->prepare("update stories set link=?, story_text=? where story_id=?");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			 //redirect to error page
			header("Location: link_upload_error.html");
			exit;
		}
		$stmt->bind_param('sss', htmlspecialchars($link), $comment, $id);
		$stmt->execute();
		$stmt->close();
	}

	//redirect
	header("Location: edit_posts_comments.php");
	exit;
?>