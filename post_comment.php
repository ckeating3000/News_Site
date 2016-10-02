<!DOCTYPE html>
    <html>
        <head>
            <title>Comment on a Post</title>
            <link rel="stylesheet" type="text/css" href="article_submit.css">
        </head>
        <body>

			<form name="return" action="home_page_login.php" method="post"> 
			    <input type="submit" value="Return to Home Page"/>
			</form>

            <?php
                session_start();
                //check for login
                if(!isset($_SESSION['Login'])){
    				Header("Location: home_page_nologin.php");
    				exit;
    			   }
                $story_id = $_GET["name"];
    			//STORE THE story id as a session variable so we can reference it in comment_submit.php
    			$_SESSION["story_id"]=$story_id;

                require 'database_rw.php';
    			
    			//prints out the story you are going to comment on
                $get_stories = $mysqli->prepare("select story_text, username, story_title from stories where story_id=?");
                if(!$get_stories){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $get_stories->bind_param('i', $story_id);
                $get_stories->execute();
                $get_stories->bind_result($text, $username, $title);
                echo "<ul>\n";
    			while($get_stories->fetch()){
                    printf("\t %s <br> %s <br> %s\n",
                        htmlspecialchars($title),
                        htmlspecialchars($text), 
                        "Posted by: ".htmlspecialchars($username)
                    );
    			}
                    echo "</ul>\n";
                $get_stories->close();
            ?>

            <p>Post your comments below</p>

            <form name="CommentSubmit" action="comment_submit.php" id=text_form method="POST">
                <input type="hidden" name="story_id" value="<?php echo $story_id; ?>">
                <textarea class="text_box" name="comment_submit" >Enter or paste text here... </textarea>
                <p>
                    <input type="submit" value="Submit Comment" />
                </p>
            </form>
            
        </body> 
    </html>