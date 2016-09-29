<?php
//connect to users database
$mysqli = new mysqli('localhost', 'readwrite', 'readwrite', 'mod3');
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>