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
                <strong>Edit your post</strong>
            </div>
            <!--form with options to edit the post-->
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
                        <input type="submit" value="Submit Edit" />
                    </p>
                </form>

                <br>
        </body> 
    </html>