<!DOCTYPE html>
    <html>
        <head>
            <title>New Stories</title>
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
		   
            //display a list of user's posts and comments
            require 'database_rw.php';
            $get_posts = $mysqli->prepare("select link, story_text, username, story_title, story_id, comment_count from stories order by story_id");
            if(!$get_posts){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            
            $get_posts->execute();
            
            $get_posts->bind_result($link, $text, $username, $title, $id, $comcount);
            
            echo "<ul>\n";

            while($get_posts->fetch()){
                printf("\t<li> <a href='%s'>%s</a> <br> %s <br> %s <br> %s
					   <a href='delete_post.php?name=%s'>delete this post</a>
					   </li><br>\n",
                    htmlspecialchars($link),
                    htmlspecialchars($title),
                    htmlspecialchars($text),
                    "Posted by: ".htmlspecialchars($username),
					htmlentities($id),
					htmlentities($id)
                );

				//allow the person to delete posts that are their own
				//if($username==$_SESSION["Login"]){
				//	echo "<a href='delete.php?name=$title'>Delete this Post</a>";
				//}
            }
            echo "</ul>\n";
            
            $get_posts->close();
            
            //destroy the session after someone hits the logout button, send them back to the login screen
            
            ?>
        </body>
    </html>