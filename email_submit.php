<?php
session_start();
require 'database_rw.php';
$email =$_POST["email"];
$username = $_SESSION["Login"];
$set= $mysqli->prepare("update users set email=? where username=?");
$set->bind_param('ss', $email, $username);
$set->execute();
$set->close;

	Header("Location: view_profile.php");
	exit;    

?>