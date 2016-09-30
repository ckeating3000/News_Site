<!DOCTYPE html>
    <html>
        <head>
            <title>Comment View</title>
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
				echo "You do not have access to this content";
			   }
			   echo "<br> <br> <br>";
               
                //display a list of articles
                require 'database_r.php';
                $get_stories = $mysqli->prepare("select username, comment from comments");
                if(!$get_stories){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                 
                $get_stories->execute();
                 
                $get_stories->bind_result($username, $comment);
                 
                echo "<ul>\n";
                while($get_stories->fetch()){
                    printf("\t<li> %s said: %s <br> %s <br>
						   <a href='post_comment.php?name=$id'>Comment on this Post</a>
						   </li><br>\n",
                        htmlspecialchars($username),
                        htmlspecialchars($comment)
                    );
					//echo "<a href='comment.php?name=$title'>Comment on this Post</a>";
					//allow the person to delete posts that are their own
					//if($username==$_SESSION["Login"]){
					//	echo "<a href='delete.php?name=$title'>Delete this Post</a>";
					//}
                }
                echo "</ul>\n";
                 
                $get_stories->close();
                
                //destroy the session after someone hits the logout button, send them back to the login screen
                
                ?>
        </body>
    </html>