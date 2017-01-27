<!DOCTYPE html>
    <html>
        <head>
            <title>View Likes</title>
			<link rel="stylesheet" type="text/css" href="mewstories.css"/>
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
        
                <?php
    			    session_start();
    				 if(!isset($_SESSION['Login'])){
    				Header("Location: home_page_nologin.php");
    				exit;
    			    }
                    $story_id = $_GET["name"];
    				$_SESSION["story_id"]=$story_id;
    				
                    require 'database_r.php';
    			    echo "<br> <br> <br>";
                    //display the article
                    $get_story = $mysqli->prepare("select link, story_text, username, story_title from stories where story_id=?");
                    if(!$get_story){
                        printf("Query Prep Failed: %s\n", $mysqli->error);
                        exit;
                    }
    				
                    $get_story->bind_param('i', $story_id);
                    $get_story->execute();
                    $get_story->bind_result($link, $text, $username, $title);
    				$get_story->fetch();
                    printf("\t <a href='%s'>%s</a> <br> %s <br> %s <br>
    						   <br>\n",
                            htmlspecialchars($link),
                            htmlspecialchars($title),
                            htmlspecialchars($text), 
                            "Posted by: ".htmlspecialchars($username)
                          );
                    $get_story->close();
                     
                    //display a list of who liked the post...string of text from the stories database
                    
                    $get_likes = $mysqli->prepare("select likers from stories where story_id=?");
                    if(!$get_likes){
                        printf("Query Prep Failed: %s\n", $mysqli->error);
                        exit;
                    }
                    $get_likes->bind_param('i', $story_id);
                    $get_likes->execute();
                     
                    $get_likes->bind_result($likers);
                    echo "Users who have liked this post: ";
                    while($get_likes->fetch()){
                        printf("\t %s  
    						   \n",
                            htmlspecialchars($likers)
                        );
                    }
                     
                    $get_likes->close();
                
                ?>
        </body>
    </html>