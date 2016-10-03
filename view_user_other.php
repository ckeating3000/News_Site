<!doctype html>
    <html>
        <head>
            <title>User Profile</title>
			<link rel="stylesheet" type="text/css" href="mewstories.css"/>
        </head>
        <body>
			<form name="return" action="home_page_login.php" method="post"> 
			    <input type="submit" value="Return to Home Page"/>
			</form>
            <?php
			//same are view_profile, but no option to edit the profile
            $username = $_GET["name"];
            //display user info...only need to be able to select
             require 'database_r.php';
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

                $user_info->close();
             ?>
        </body>
    </html>