<?php
require 'database_rw.php';
session_start();
$liker = $_SESSION["Login"];
$story_id = $_GET["name"];

//increase the value of likes by one
$like=$mysqli->prepare("update stories set num_likes=++num_likes where story_id=?");
$like->bind_param('i', $story_id);
$like->execute();
$like->close();

//get prev list of people that liked the post
$likers=$mysqli->prepare("select likers from stories where story_id=?");
$likers->bind_param('i', $story_id);
$likers->execute();
$likers->bind_result($like_list);
$likers->close();
//add new user to the list of likers
$like_list=$like_list."<br> $liker";

$add_like=$mysqli->prepare("update stories set likers=?" );
$add_like->bind_param('s', $like_list);
$add_like->execute();
$add_like->close();

//redirect to homepage
	header("Location: home_page_login.php");
    exit;

?>