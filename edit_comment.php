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
	$comment_id = $_POST["comment_id"];
	$comment = $_POST["comment_submit"];
	
	//then update specified comment in database
	$stmt = $mysqli->prepare("update comments set comment=? where comment_id=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		 //redirect to error page
		//header("Location: link_upload_error.html");
		exit;
	}
	$stmt->bind_param('ss', $comment, $comment_id);
	$stmt->execute();
	$stmt->close();

	//redirect to homepage
	header("Location: edit_posts_comments.php");
?>