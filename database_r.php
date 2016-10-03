<?php
//connect to database with only ability to select from mod3 tables
$mysqli = new mysqli('localhost', 'read', 'read', 'mod3');
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>