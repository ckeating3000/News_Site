<!DOCTYPE html>
    <html>
        <head>
            <title>Submit a Story</title>
        </head>
        <body>
            <?php
            //check if they're logged in; then if so, start session
	           
                session_start();
	            if( !preg_match('/^[\w_\-]+$/', $usertoshare) ){
                echo "Invalid username";
                exit;
            ?>
                <form name="LinkSubmit" action="link_submit.php" method="POST"> <!--add action to go to page with files-->
                <p>Link: <input type="text" name="article_link">
                    <input type="submit" value="Link" />
                </p>

                <form name="TextSubmit" action="text_submit.php" method="POST"> <!--add action to go to page with files-->
                <p>Link: <input type="text" name="article_text">
                    <input type="submit" value="Text" />
                </p>

            </form>
            
        </body>
    </html>