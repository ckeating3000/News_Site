<?php
require 'database_rw.php';
session_start();
$liker = $_SESSION["Login"];
$story_id = $_GET["name"];

// check if user has already liked the post
$liker_string = " ".$liker."\r\n";
if(strpos($liker_string, $liker)===false){
	//increase the value of likes by one
	$like=$mysqli->prepare("update stories set num_likes=num_likes +1 where story_id=?");
	$like->bind_param('i', $story_id);
	$like->execute();
	$like->close();
	//update liker string
	$liker_string = " ".$liker."\r\n";
	//add new user to the list of likers
	//adapted from http://stackoverflow.com/questions/19081743/how-can-i-add-text-to-sql-column
	$likers=$mysqli->prepare("update stories set likers= CONCAT('$hliker_string', likers) where story_id=?");
	$likers->bind_param('i', $story_id);
	$likers->execute();
	$likers->bind_result($like_list);
	$likers->close();
}




//redirect to homepage
	header("Location: home_page_login.php");
    exit;

?>