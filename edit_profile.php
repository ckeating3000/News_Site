<!DOCTYPE html>
    <html>
        <head>
            <title>Edit Your Profile</title>
            <link rel="stylesheet" type="text/css" href="article_submit.css">
			
        </head>
        <body>
			<!--form that allows users to add information about themselves, sent to php to store info
			in users database-->
            <?php session_start();?>
			<form name="return" action="home_page_login.php" method="post"> 
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
			    <input type="submit" value="Return to Home Page"/>
			</form>

    
            <p>Tell the other users more about yourself</p>
            <form name="EmailSubmit" action="email_submit.php" id=email method="POST">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                <input type="email" name="email">
                
                    <input type="submit" value="Submit Email" />
                
            </form>
            <br>
            <form name="PhoneSubmit" action="phone_submit.php" id=phone method="POST">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                <input type="tel" name="phone_num">
                
                    <input type="submit" value="Submit Phone Number" />
            </form>
            <br>
            <form name="BioSubmit" action="bio_submit.php" id=bio method="POST">
                <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
                <textarea class="text_box" name="bio" >Enter or paste text here... </textarea>
                <p>
                    <input type="submit" value="Submit Bio" />
                </p>
            </form>
            
        </body> 
    </html>