<!DOCTYPE html>
    <html>
        <head>
            <title>Edit Post</title>
            <link rel="stylesheet" type="text/css" href="mewstories.css"/>
        </head>
        <body>
        <?php session_start(); ?>
         <!--home button -->
                <form name="Home" action="home_page_login.php" method="post"> 
                     <input type="submit" value="Home"/>
                </form>
            <div>
                <strong>Edit your comment</strong>
            </div>
            <!--form to submit coments, users get a textbox to view their comments-->
                <form action="edit_comment.php" method="POST"> 
                        
                    <textarea class="text_box" name="comment_submit" >Enter your insightful comment </textarea>
                    <p>
                        <input type="hidden" value="<?php echo $_GET['name']; ?>" name="comment_id" />
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
                        <input type="submit" value="Submit Edit" />
                    </p>
                </form>

                <br>
        </body> 
    </html>