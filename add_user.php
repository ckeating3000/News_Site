<?php
$new_username = $_POST["newname"];
//check username validity
if( !preg_match('/^[\w_\-]+$/', $new_username) ){
	echo "Invalid username";
	exit;
}
//make sure username doesn't already exist

$used_name = false;
	$h = fopen("/home/ckeating3000/Module2Users/users.txt", "r");
    //$h = fopen("/home/kharline/Module2Users/users.txt", "r");
	while(!feof($h)){
		$line_x = trim(fgets($h));
		
		if($line_x==$new_username)
		{
			$used_name=True;
            echo "username already exists";
            exit;
		}
	}
    
    if($used_name==false){
        //make the new user a directory in Module2users
        
        //mkdir("/home/kharline/Module2Users/$new_username");
        mkdir("/home/ckeating3000/Module2Users/$new_username");
        
        //add their name to users.txt file (code adapted from http://www.dynamicdrive.com/forums/showthread.php?4539-how-do-i-modify-existing-txt-files-with-php)
        
        //$f = "/home/kharline/Module2Users/users.txt";
        $f = "/home/ckeating3000/Module2Users/users.txt";
        
        $file = fopen($f, "a+");
        $string = "\n" . $new_username;
        fwrite($file, $string);
        fclose($file);
        //send them back to the login page
        header("Location: login.html");
        exit;
    }
    

?>