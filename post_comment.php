<!DOCTYPE html>
    <html>
        <head>
            <title>Comment on a Post</title>
            <link rel="stylesheet" type="text/css" href="article_submit.css">
        </head>
        <body>
            <?php
            session_start();
            if(!isset($_SESSION['Login'])){
				Header("Location: home_page_nologin.php");
				exit;
			   }
            $story_id = $_GET["name"];

             require 'database_r.php';
                $get_stories = $mysqli->prepare("select story_text, username, story_title from stories where story_id=?");
                if(!$get_stories){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $get_stories->bind_param('i', $story_id);
                $get_stories->execute();
                 
                $get_stories->bind_result($text, $username, $title);
                 echo "<ul>\n";
                    printf("\t<li> %s <br> %s <br> %s</li>\n",
                        htmlspecialchars($title),
                        htmlspecialchars($text), 
                        "Posted by: ".htmlspecialchars($username)
                    );
                    echo "</ul>\n";
                    //STORE THE story id as a session variable so the user can reference it
                $_SESSION["story_id"]=$story_id;
                 
                $get_stories->close();
            ?>

                <p>Post your comments below</p>

                
                <form name="CommentSubmit" action="comment_submit.php" id=text_form method="POST">
                    <textarea class="text_box" name="comment_submit" >Enter or paste text here... </textarea>
                    <p>
                        <input type="submit" value="Submit Comment" />
                    </p>
                </form>
                
        </body> 
    </html>