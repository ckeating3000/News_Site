<!DOCTYPE html>
    <html>
        <head>
            <title>New Stories</title>
        </head>
        <body>
            <p>
				
			</p>
            <nav>
                <!--users that are logged in should be able to: post new articles, logout, -->
				
			   <form name="postArticle" action="article_submit.html" method="post"> 
			   <input type="submit" value="Create a New Post"/>
				</form>
				<form name="deleteArticle" action="article_delete.php" method="post"> 
			   <input type="submit" value="Delete A Post"/>
				</form>
				<form name="logout" action="logout.php" method="post"> 
			   <input type="submit" value="Logout"/>
				</form>
            </nav>
            <!--sidebar of options-->
        
               <?php
			   session_start();
			   echo "<br> <br> <br>";
			   echo "Welcome ".$_SESSION["Login"]."!";
			   
                //display a list of articles
                require 'database_r.php';
                $get_stories = $mysqli->prepare("select link, story_text, username, story_title from stories order by story_id");
                if(!$get_stories){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                 
                $get_stories->execute();
                 
                $get_stories->bind_result($link, $text, $username, $title);
                 
                echo "<ul>\n";
                while($get_stories->fetch()){
                    printf("\t<li> <a href='%s'>%s</a> <br> %s <br> %s</li>\n",
                        htmlspecialchars($link),
                        htmlspecialchars($title),
                        htmlspecialchars($text), 
                        "Posted by: ".htmlspecialchars($username)
                    );
					"<a href='comment.php'>Comment on this Post</a>";
                }
                echo "</ul>\n";
                 
                $get_stories->close();
                
                //destroy the session after someone hits the logout button, send them back to the login screen
                
                ?>
        </body>
    </html>