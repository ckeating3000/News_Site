<!DOCTYPE html>
    <html>
        <head>
            <title>Comment View</title>
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
				Header("Location: view_commentsnologin.php");
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
                 
                //display a list of comments
                
                $get_stories = $mysqli->prepare("select username, comment, story_id from comments where story_id=?");
                if(!$get_stories){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $get_stories->bind_param('i', $story_id);
                $get_stories->execute();
                 
                $get_stories->bind_result($username, $comment, $id);
           
                while($get_stories->fetch()){
                    printf("\t<p> %s said: %s <br> 
						   </><br>\n",
                        htmlspecialchars($username),
                        htmlspecialchars($comment)
                        
                    );
                }
       
                 
                $get_stories->close();
                
               
                
                ?>
        </body>
    </html>