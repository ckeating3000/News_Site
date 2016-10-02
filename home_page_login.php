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
				<form name="view_prof" action="view_profile.php" method="post"> 
			   <input type="submit" value="View Your Profile"/>
				</form>
			   <form name="postArticle" action="article_submit.html" method="post">
			   <input type="submit" value="Create a New Post"/>
				</form>
				<form name="deleteArticle" action="delete_comments_posts.php" method="post"> 
			   <input type="submit" value="Delete A Post or Comment"/>
				</form>
                <form name="editArticle" action="edit_posts_comments.php" method="post"> 
               <input type="submit" value="Edit A Post or Comment"/>
                </form>
				<form name="logout" action="logout.php" method="post"> 
			   <input type="submit" value="Logout"/>
				</form>
				
            </nav>
            <!--sidebar of options-->
        
               <?php
			   session_start();
			   if(!isset($_SESSION['Login'])){
				Header("Location: home_page_nologin.php");
				exit;
			   }
			   echo "<br> <br> <br>";
			   echo "Welcome ".$_SESSION["Login"]."!";
			   
                //display a list of articles
                require 'database_r.php';
                $get_stories = $mysqli->prepare("select link, story_text, username, story_title, story_id, comment_count from stories order by story_id");
                if(!$get_stories){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                 
                $get_stories->execute();
                 
                $get_stories->bind_result($link, $text, $username, $title, $id, $comcount);
                 
                echo "<ul>\n";
                while($get_stories->fetch()){
                    printf("\t<li> <a href='%s'>%s</a> <br> %s <br> %s <br> %s
						   <a href='view_comments.php?name=%u'>comments</a> on this post <br>
						   <a href='post_comment.php?name=%u'>Add a comment</a>
						   </li><br>\n",
                        htmlspecialchars($link),
                        htmlspecialchars($title),
                        htmlspecialchars($text), 
                        "Posted by: ".htmlspecialchars($username),
						"There are ".htmlspecialchars($comcount),
						htmlentities($id),
						htmlentities($id)
                    );
					//allow the person to delete posts that are their own
					//if($username==$_SESSION["Login"]){
					//	echo "<a href='delete.php?name=$title'>Delete this Post</a>";
					//}
                }
                echo "</ul>\n";
                
                $get_stories->close();
                
                
                
                ?>
        </body>
    </html>