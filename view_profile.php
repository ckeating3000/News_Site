<!doctype html>
    <html>
        <head>
            <title>User Profile</title>
        </head>
        <body>
            <form name="edit_prof" action="edit_profile.php" method="post"> 
			   <input type="submit" value="Edit Profile"/>
				</form>
            <form name="return" action="home_page_login.php" method="post"> 
			    <input type="submit" value="Return to Home Page"/>
			</form>
            <?php
			session_start();
			
            $username=$_SESSION["Login"];
            //display user info
             require 'database.php';
             $user_info=$mysqli->prepare("select phone_number, email, bio from users where username=?");
             $user_info->bind_param('s', $username);
             $user_info->execute();
             $user_info->bind_result($phone_num, $email, $bio);
                 
               
                $user_info->fetch();
                    printf("\t <br><br> %s <br><br> %s <br><br> %s <br><br> %s
						   <br>\n",
                        "User: ".htmlspecialchars($username),
                        "Email address: ".htmlspecialchars($email),
                        "Phone Number: ".htmlspecialchars($phone_num), 
                        "About me: <br>".htmlspecialchars($bio)
                    );
					//allow the person to delete posts that are their own
					//if($username==$_SESSION["Login"]){
					//	echo "<a href='delete.php?name=$title'>Delete this Post</a>";
					//}
                
                
                $user_info->close();
             ?>
        </body>
    </html>