<!DOCTYPE html>
    <html>
        <head>
            <title>New Stories</title>
        </head>
        <body>
            <p>
				
			</p>
            <nav>
                
            </nav>
            <!--sidebar of options-->
            <aside>
               <?php
			   session_start();
			   echo "Welcome ".$_SESSION["Login"]."!";
			   
                //destroy the session after someone hits the logout button, send them back to the login screen
                
                ?>
            </aside>
        </body>
    </html>