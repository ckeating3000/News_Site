<!DOCTYPE html>
    <html>
        <head>
            <title>Edit your posts and comments</title>
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
			//send to homepage if they are not logged in
		    if(!isset($_SESSION['Login'])){
			    header("Location: home_page_nologin.php");
			    exit;
		    }

		    echo "<br>\n<br>\n";
			$username = $_SESSION['Login'];
            require 'database_rw.php';
			
			echo "Your comments";
            //DISPLAY/EDIT COMMENTS
			//get comments from database
            $get_comments = $mysqli->prepare("select comment, story_id, username, comment_id from comments where username=?");
            if(!$get_comments){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
			$get_comments->bind_param('s', $username);
            $get_comments->execute();
            $get_comments->bind_result($comment, $story_id, $username, $comment_id);
            
            echo "<ul>\n";
			//display them with link that takes you to comment editing form
            while($get_comments->fetch()){
                printf("\t<li> %s <br>
                       <a href='edit_comment_form.php?name=%s'>edit this comment</a>
                       </li><br>\n",
                    htmlspecialchars($comment),
                    htmlspecialchars($comment_id)
                );
            }
            echo "</ul>\n";
            $get_comments->close();
            
            ?>
        </body>
    </html>