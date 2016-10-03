
<?php
//connect to mod3 database with all permissions
$mysqli = new mysqli('localhost', 'wustl_inst', 'wustl_pass', 'mod3');
if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>