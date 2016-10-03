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
        
            <?php
		    session_start();
			//make sure someon is logged in
		    if(!isset($_SESSION['Login'])){
			    header("Location: home_page_nologin.php");
			    exit;
		    }
			//obtain username from login session variable
            $username = $_SESSION['Login'];
            require 'database_rw.php';
		    echo "<br>\n<br>\n";
            

        //DISPLAY/DELETE COMMENTS
            echo "Your comments";
			//get comments from database
            $get_comments = $mysqli->prepare("select comment, story_id, username, comment_id from comments where username=? order by story_id");
            if(!$get_comments){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
			$get_comments->bind_param('s', $username);
            $get_comments->execute();
            $get_comments->bind_result($comment, $story_id, $username, $comment_id);
            
            echo "<ul>\n";
			//list comments with link to delete them
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
            
            ?>
        </body>
    </html>