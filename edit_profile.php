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

    
            <p>Tell the other users more about yourself</p>
            <form name="EmailSubmit" action="email_submit.php" id=email method="POST">
                <input type="email" name="email">
                
                    <input type="submit" value="Submit Email" />
                
            </form>
            <br>
            <form name="PhoneSubmit" action="phone_submit.php" id=phone method="POST">
                <input type="tel" name="phone_num">
                
                    <input type="submit" value="Submit Phone Number" />
                
            </form>
            <br>
            <form name="BioSubmit" action="bio_submit.php" id=bio method="POST">
                <textarea class="text_box" name="bio" >Enter or paste text here... </textarea>
                <p>
                    <input type="submit" value="Submit Bio" />
                </p>
            </form>
            
        </body> 
    </html>