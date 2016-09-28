<?php
	// destroy any previous sessions
	session_start();
    session_destroy();
	require 'database.php';
	
	$username=$_POST["username"];
    $password_guess=$_POST["password"];
	//make sure username is safe
//check username validity
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

//check password validity
if( !preg_match('/^[\w_\-]+$/', $password_guess) ){
	echo "Invalid password";
	exit;
}


    //if that's a reasonable user, log them in
	$check_u_p = $mysqli->prepare("select username, password from users where username=? ");
    $check_u_p->bind_param('s', $username);
    $check_u_p->execute();
    
    $check_u_p->bind_result($username_db, $password_db);
    $check_u_p->fetch();
    if(crypt($password_guess, $password_db)==$password_db){
        session_start();
		$_SESSION["Login"] = $username_db;
    }
    //send the user to failed login if not a user or allow them to home menu
//	else{
//        session_destroy();
//		Header("Location: failed_login.html");
//		exit;
//	}
    if(isset($_SESSION["Login"])){
           Header("Location: home_page_login.php");
            exit;
    }
	
?>