<!DOCTYPE html>
    <html>
        <head>
            <title>New Story Form</title>
            <link rel="stylesheet" type="text/css" href="article_submit.css">
        </head>
        <body>
            <?php session_start();?>
            <div>
                <!--from so users can submit stories-->
                <strong>Share your story below!</strong>
            </div>
                <form name="LinkSubmit" action="link_submit.php" method="POST"> 
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                    <p>
                        Post title: <input type="text" name="article_title">
                    </p>
                    <p>
                         Story link: <input type="text" name="link_submit">
                    </p>
                          <p>
                            Your reaction:
                          </p>
                        <!--text area used so they have more room to see what they are typing-->
                        <textarea class="text_box" name="comment_submit" >Why is this news to you... </textarea>
                        <p>
                        <input type="submit" value="Submit Link" />
                    </p>
                </form>

                <br>
        </body> 
    </html>