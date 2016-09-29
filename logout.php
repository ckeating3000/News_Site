<?php
//destroy the session after someone hits the logout button, send them back to the login screen
	session_start();
	session_destroy();
	Header("Location: home_page_nologin.php");
	exit;
?>