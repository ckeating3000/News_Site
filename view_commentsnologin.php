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
				You must Login to post your own comments
			   <form name="return" action="home_page_login.php" method="post"> 
			   <input type="submit" value="Return to Home Page"/>
			   </form>
				
            </nav>
            <!--sidebar of options-->
        
               <?php
			   session_start();
			
                $story_id = $_GET["name"];
               require 'database_r.php';
			   echo "<br> <br> <br>";
               //display the article
                $get_story = $mysqli->prepare("select link, story_text, username, story_title, story_id from stories where story_id=?");
                if(!$get_story){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $get_story->bind_param('i', $story_id);
                $get_story->execute();
                $get_story->bind_result($link, $text, $username, $title, $id);
                printf("\t<li> <a href='%s'>%s</a> <br> %s <br> %s <br>
						   </li><br>\n",
                        htmlspecialchars($link),
                        htmlspecialchars($title),
                        htmlspecialchars($text), 
                        "Posted by: ".htmlspecialchars($username)
                      );
                $get_story->close();
                 
                //display a list of comments
                
                $get_stories = $mysqli->prepare("select username, comment, story_id from comments");
                if(!$get_stories){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                 
                $get_stories->execute();
                 
                $get_stories->bind_result($username, $comment, $id);
                 
                echo "<ul>\n";
                while($get_stories->fetch()){
                    printf("\t<li> %s said: %s <br> 
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