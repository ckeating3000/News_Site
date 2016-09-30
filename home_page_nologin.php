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
            
                <!-- add a user -->
                <form name="add_user" action="add_user.html" method="POST">
                     <p>
                        <input type="submit" value="Join as New User" />
                    </p>
                </form>
            </aside>

            <div id="content">
                
                <?php
                //display a list of articles
                require 'database_r.php';
                $get_stories = $mysqli->prepare("select link, story_text, username, story_title from stories order by story_id");
                if(!$get_stories){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                 
                $get_stories->execute();
                
                $get_stories->bind_result($link, $text, $username, $title);
                 
                echo "<ul>\n";
                while($get_stories->fetch()){
                    printf("\t<li> <a href='%s'>%s</a> <br> %s <br> %s</li>\n",
                        htmlspecialchars($link),
                        htmlspecialchars($title),
                        htmlspecialchars($text), 
                        "Posted by: ".htmlspecialchars($username)
                    );
                }
                echo "</ul>\n";
                 
                $get_stories->close();
                ?>
            </div>
        </body>
    </html>