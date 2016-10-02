<!DOCTYPE html>
    <html>
        <head>
            <title>EDIT POST</title>
        </head>
        <body>
            <?php session_start(); ?>
            <div>
                <strong>Edit your post</strong>
            </div>
                <form action="edit_post.php" method="POST"> 
                    <p>
                         Story link: <input type="text" name="link_submit">
                    </p>
                    <p>
                        Your reaction:
                    </p>
                        
                    <textarea class="text_box" name="comment_submit" >Why is this news to you... </textarea>
                    <p>
                        <input type="hidden" value="<?php echo $_GET['name']; ?>" name="id" />
                        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                        <input type="submit" value="Submit Link" />
                    </p>
                </form>

                <br>
        </body> 
    </html>