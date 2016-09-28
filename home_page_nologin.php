<!DOCTYPE html>
    <html>
        <head>
            <title>NewStories</title>
        </head>
        <body>
            
            <nav>
                
            </nav>
            <!--sidebar of options-->
            <aside>
                 <form name="Login" action="loggedin.php" method="POST"> <!--add action to go to page with files-->
                <p>Username: <input type="text" name="username">
                Password: <input type="text" name="password">
                    <input type="submit" value="Login" />
                </p>
            </form>
            
            <form name="add_user" action="add_user.html" method="POST">
                 <p>
                    <input type="submit" value="Join as New User" />
                </p>
            </form>
            
            </aside>
        </body>
    </html>