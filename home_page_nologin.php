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
                 <form name="Login" action="login.php" method="POST"> <!--add action to go to page with files-->
                <p>Username: <input type="text" name="username">
                    <input type="submit" value="Login" />
                </p>
            </form>
            
            <form name="add_user" action="add_user.php" method="POST">
                 <p>
                    Register New User: <input type="text" name="newname">
                    <input type="submit" value="Add new user" />
                </p>
            </form>
            </aside>
        </body>
    </html>