<?php
//connect to users database
$mysqli = new mysqli('localhost', 'mod3', 'read', 'read');
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>