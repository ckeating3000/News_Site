<!DOCTYPE html>
    <html>
        <head>
            <title>New Stories</title>
        </head>
        <body>
            
            <nav>
                
            </nav>
            <!--sidebar of options-->
            <aside>
               <?php
                //destroy the session after someone hits the logout button, send them back to the login screen
                	session_start();
                	session_destroy();
                	Header("Location: login.html");
                	exit;
                ?>
            </aside>
        </body>
    </html>