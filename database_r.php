<?php
//connect to users database
$mysqli = new mysqli('localhost', 'read', 'read', 'mod3');
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>