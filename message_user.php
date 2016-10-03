<!DOCTYPE html>
    <html>
        <head>
            <title>Message User</title>
            <link rel="stylesheet" type="text/css" href="article_submit.css">
        </head>
        <body>
            <!--form allows users to post messages to a form that will be updated in the messages db-->
            <?php session_start(); ?>
             <!--home button -->
                <form name="Home" action="home_page_login.php" method="post"> 
                     <input type="submit" value="Home"/>
                </form>
            <div>
                <strong>Send users messages to get to know them better!</strong>
            </div>
                <form name="LinkSubmit" action="post_message.php" method="POST"> 
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                    <p>
                        Message subject: <input type="text" name="subject">
                    </p>
                    <p>
                         User to: <input type="text" name="user_to">
                    </p>
                          <p>
                            Your message:
                          </p>
                        
                        <textarea class="text_box" name="message" > </textarea>
                        <p>
                        <input type="submit" value="Send message" />
                    </p>
                </form>

                <br>
        </body> 
    </html>