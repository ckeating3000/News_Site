<!DOCTYPE html>
    <html>
        <head>
            <title>NewStories</title>
			<link rel="stylesheet" type="text/css" href="mewstories.css"/>
        </head>
        <body>
			
           
            <nav>
                
            </nav>

            <aside>
                <form name="Login" action="loggedin.php" method="POST"> <!--add action to go to page with files-->
                    <p>Username: <input type="text" name="username">
                        Password: <input type="password" name="password">
                        <input type="submit" value="Login" />
                    </p>
                </form>
            <p>
				 Join Newstories to view user profiles, add your own posts and comments and more!
			</p>
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
                $get_stories = $mysqli->prepare("select link, story_text, username, story_title, story_id, comment_count from stories order by story_id");
                if(!$get_stories){
                    printf("Query Prep Failed: %s\n", $mysqli->error);
                    exit;
                }
                 
                $get_stories->execute();
                
                $get_stories->bind_result($link, $text, $username, $title, $id, $comcount);
                 
                while($get_stories->fetch()){
					//nonusers can only see comments from other users
                        printf(" <p><a href='%s'>%s</a> <br> %s <br> %s <br> %s
						   <a href='view_commentsnologin.php?name=%u'>comments</a> on this post </p>
						   ",
                        htmlspecialchars($link),
                        htmlspecialchars($title),
                        htmlspecialchars($text), 
                        "Posted by: ".htmlspecialchars($username),
						"There are ".htmlspecialchars($comcount),
						htmlentities($id)
                    );
                }
                 
                $get_stories->close();
                ?>
            </div>
        </body>
    </html>