<!DOCTYPE html>
    <html>
        <head>
            <title>EDIT POST</title>
        </head>
        <body>
        <?php session_start(); ?>
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