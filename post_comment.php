<!DOCTYPE html>
    <html>
        <head>
            <title>Comment on a Post</title>
            <link rel="stylesheet" type="text/css" href="article_submit.css">
        </head>
        <body>
            <?php
            $story_id = $_GET["name"];
             require 'database_r.php';
                $get_stories = $mysqli->prepare("select link, story_text, username, story_title, story_id from stories where story_id=?");
                if(!$get_stories){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                $get_stories->bind_param('i', $story_id);
                $get_stories->execute();
                 
                $get_stories->bind_result($link, $text, $username, $title, $story_id);
                 
                    printf("\t<li> <a href='%s'>%s</a> <br> %s <br> %s</li>\n",
                        htmlspecialchars($link),
                        htmlspecialchars($title),
                        htmlspecialchars($text), 
                        "Posted by: ".htmlspecialchars($username)
                    );
                    //STORE THE story id as a session variable so the user can reference it
                $_SESSION["story_id"]=$story_id;
                 
                $get_stories->close();
            ?>

                <p>Post your comments below</p>

                <textarea class="text_box" name="comment_submit" form="CommentSubmit">Enter or paste text here... </textarea>
                <form name="CommentSubmit" action="comment_submit.php" id=text_form method="POST"> 
                    <p>
                        <input type="submit" value="Submit Comment" />
                    </p>
                </form>
                
        </body> 
    </html>