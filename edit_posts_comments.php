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
            <!--sidebar of options-->
        
            <?php
		    session_start();
		    if(!isset($_SESSION['Login'])){
			    header("Location: home_page_nologin.php");
			    exit;
		    }

		    echo "<br>\n<br>\n";
			$username = $_SESSION['Login'];
            require 'database_rw.php';
		   
		   echo "Your Posts";
            //DISPLAY/EDIT POSTS

            
            $get_posts = $mysqli->prepare("select link, story_text, username, story_title, story_id, comment_count from stories where username=? order by story_id");
            if(!$get_posts){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
			$get_posts->bind_param('s', $username);
            $get_posts->execute();
            $get_posts->bind_result($link, $text, $username, $title, $id, $comcount);
            
            echo "<ul>\n";

            while($get_posts->fetch()){
                printf("\t<li> <a href='%s'>%s</a> <br> %s <br> %s <br>
					   <a href='edit_post_form.php?name=%s&token=%s'>edit this post</a>
					   </li><br>\n",
                    htmlspecialchars($link),
                    htmlspecialchars($title),
                    htmlspecialchars($text),
                    "Posted by: ".htmlspecialchars($username),
					htmlentities($id),
                    $_SESSION["token"]
                );
            }
            echo "</ul>\n";
            $get_posts->close();
			
			echo "Your comments";
            //DISPLAY/EDIT COMMENTS
            $get_comments = $mysqli->prepare("select comment, story_id, username, comment_id from comments where username=?");
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