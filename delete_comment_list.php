<!DOCTYPE html>
    <html>
        <head>
            <title>Delete Comments</title>
        </head>
        <body>
            
            <nav>
                <!--logout button -->
				<form name="logout" action="logout.php" method="post"> 
			         <input type="submit" value="Logout"/>
				</form>
                <!--home button -->
                <form name="Home" action="home_page_login.php" method="post"> 
                     <input type="submit" value="Home"/>
                </form>
            </nav>
            <!--sidebar of options-->
        
            <?php
		    session_start();
		    if(!isset($_SESSION['Login'])){
			    header("Location: home_page_nologin.php");
			    exit;
		    }
            $username = $_SESSION['Login'];
            require 'database_rw.php';
		    echo "<br>\n<br>\n";
            

        //DISPLAY/DELETE COMMENTS
            echo "Your comments";
            $get_comments = $mysqli->prepare("select comment, story_id, username, comment_id from comments where username=? order by story_id");
            if(!$get_comments){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
			$get_comments->bind_param('s', $username);
            $get_comments->execute();
            $get_comments->bind_result($comment, $story_id, $username, $comment_id);
            
            echo "<ul>\n";

            while($get_comments->fetch()){
                printf("\t<li> %s <br>
                       <a href='delete_comment.php?name=%s&story=%s'>delete this comment</a>
                       </li><br>\n",
                    htmlspecialchars($comment),
                    htmlspecialchars($comment_id),
                    htmlspecialchars($story_id)
                );
            }
            echo "</ul>\n";
            $get_comments->close();
            
            //destroy the session after someone hits the logout button, send them back to the login screen
            
            ?>
        </body>
    </html>