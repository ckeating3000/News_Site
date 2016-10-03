<!DOCTYPE html>
    <html>
        <head>
            <title>Personal Messages</title>
        </head>
        <body>
            <p>
				
			</p>
            <nav>
                <!--users that are logged in should be able to: post new articles, logout, -->
				
			   <form name="return" action="home_page_login.php" method="post"> 
			   <input type="submit" value="Return to Home Page"/>
				</form>
				
            </nav>
            <!--sidebar of options-->
        
               <?php
			   session_start();
				 if(!isset($_SESSION['Login'])){
				Header("Location: home_page_nologin.php");
				exit;
			   }
                $username = $_SESSION["Login"];
				
               require 'database_r.php';
			   echo "<br> <br> <br>";
               //display messages
                $get_messages = $mysqli->prepare("select user_from, message, subject from messages where user_to=?");
                if(!$get_messages){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $get_messages->bind_param('s', $username);
                $get_messages->execute();
                $get_messages->bind_result($user_from, $message, $subject);
				$get_messages->fetch();
                echo "Your messages";
                while($get_messages->fetch()){
                    printf(" %s %s %s<br> 
						   <br>",
                        "Subject: ".htmlspecialchars($subject),
                        "From: ".htmlspecialchars($user_from),
                        "Message: <br>".htmlspecialchars($message)
                    );
                }
        
                $get_messages->close();
                ?>
        </body>
    </html>