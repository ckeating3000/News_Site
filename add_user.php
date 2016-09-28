<?php
//be able to access the database
require 'database.php';

$new_username = $_POST["newname"];
$new_password = $_POST["newpass"];
//check username validity
if( !preg_match('/^[\w_\-]+$/', $new_username) ){
	echo "Invalid username";
	exit;
}

//check password validity
if( !preg_match('/^[\w_\-]+$/', $new_password) ){
	echo "Invalid password";
	exit;
}

//run salting and hash on the password
$password_crypted = crypt($new_password);

//get the username and passwords from the database, make sure they don't already exist
$check_u_p = $mysqli->prepare("select username, password from users where username like '$new_username' password like '$password_crypted'");

$check_u_p->execute(); 
if(!$check_u_p){
	//add username and password to the database
	$adduser = $mysqli->prepare("insert into users (username, password) values (?, ?)");
	if(!$adduser){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
	}
 
	$adduser->bind_param('ss', $new_username, $password_crypted);
 
	$adduser->execute();
 
	$adduser->close();
}

else{
	echo "Username and password already taken";
}
 $check_u_p->close();   

?>