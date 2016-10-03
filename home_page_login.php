<!DOCTYPE html>
    <html>
        <head>
            <title>New Stories</title>
			<link rel="stylesheet" type="text/css" href="mewstories.css"/>
        </head>
        <body>
            <p>
				
			</p>
                <!--users that are logged in should be able to: post new articles, logout, -->
			
				<form name="view_prof" action="view_profile.php" method="post"> 
			        <input type="submit" value="View Your Profile"/>
				</form>

    			<form name="postArticle" action="article_submit.php" method="post"> 
    			    <input type="submit" value="Create a New Post"/>
    			</form>

    			<form name="deleteComment" action="delete_comment_list.php" method="post"> 
    			    <input type="submit" value="Delete A Comment"/>
    			</form>

                <form name="deleteArticle" action="delete_post_list.php" method="post"> 
                    <input type="submit" value="Delete A Post"/>
                </form>

                <form name="editArticle" action="edit_post_list.php" method="post"> 
                    <input type="submit" value="Edit A Post"/>
                </form>

                 <form name="editComment" action="edit_comment_list.php" method="post"> 
                    <input type="submit" value="Edit A Comment"/>
                </form>
				
				<form name="messager" action="message_user.php" method="post"> 
			        <input type="submit" value="Message User"/>
				</form>
				
				<form name="message_view" action="message_view.php" method="post"> 
			        <input type="submit" value="View Your Messages"/>
				</form>

				<form name="logout" action="logout.php" method="post"> 
			        <input type="submit" value="Logout"/>
				</form>
				
        
            <?php
			    session_start();
				//if not logged in, revert to other homepage
			    if(!isset($_SESSION['Login'])){
				    Header("Location: home_page_nologin.php");
				    exit;
			    }

			    echo "<br> <br> <br>";
			    echo "Welcome ".$_SESSION["Login"]."!";
			   
                //display a list of articles
                require 'database_r.php';
                $get_stories = $mysqli->prepare("select link, story_text, username, story_title, story_id, comment_count, num_likes from stories order by story_id");
                if(!$get_stories){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                 
                $get_stories->execute();
                 
                $get_stories->bind_result($link, $text, $username, $title, $id, $comcount, $num_likes);
                 
				//links allow users to view the likes and comments of each post as well as post their own
                while($get_stories->fetch()){
                    printf("\t<p> <a href='%s'>%s</a> <br> %s <br> Posted by: 
						   <a href='view_user_other.php?name=%s'>%s</a> <br>
						   %s <a href='view_likes.php?name=%u'>likes</a> on this post 
						    <a href='like_post.php?name=%u'>Like this post</a> <br>
						   %s <a href='view_comments.php?name=%u'>comments</a> on this post
						   <a href='post_comment.php?name=%u'>Add a comment</a>
						   </p><br>\n",
                        htmlspecialchars($link),
                        htmlspecialchars($title),
                        htmlspecialchars($text), 
                        htmlspecialchars($username),
						htmlspecialchars($username),
						"There are ".htmlspecialchars($num_likes),
						htmlentities($id),
						htmlentities($id),
						"There are ".htmlspecialchars($comcount),
						htmlentities($id),
						htmlentities($id)
                    );
                }
                
                $get_stories->close();
                
            ?>
        </body>
    </html>