<?php
session_start();
require 'database_rw.php';
//check for valid token created when user logs in
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}
$email =$_POST["bio"];
$username = $_SESSION["Login"];
$set= $mysqli->prepare("update users set bio=? where username=?");
$set->bind_param('ss', $email, $username);
$set->execute();
$set->close;

	Header("Location: view_profile.php");
	exit;    

?>