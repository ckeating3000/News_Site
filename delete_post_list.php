<!DOCTYPE html>
    <html>
        <head>
            <title>New Stories</title>
			<link rel="stylesheet" type="text/css" href="mewstories.css"/>
        </head>
        <body>
            
            <nav>
                <!--logout button -->
				<form name="logout" action="logout.php" method="post"> 
			         <input type="submit" value="Logout"/>
				</form>
                <!--home button -->
                <form name="Home" action="home_page_login.php" method="post"> 
                     <input type="submit" value="Home"/>
                </form>
            </nav>
        
            <?php
		    session_start();
		    if(!isset($_SESSION['Login'])){
			    header("Location: home_page_nologin.php");
			    exit;
		    }
$username = $_SESSION['Login'];
            require 'database_rw.php';
		    echo "<br>\n<br>\n";
            
        //DISPLAY/DELETE POSTS
		//get posts from database
            echo "Your posts";
            $get_posts = $mysqli->prepare("select link, story_text, username, story_title, story_id, comment_count from stories where username=? order by story_id");
            if(!$get_posts){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
			$get_posts->bind_param('s', $username);
            $get_posts->execute();
            $get_posts->bind_result($link, $text, $username, $title, $id, $comcount);
            
			//display posts with link to php page to delete them
            while($get_posts->fetch()){
                printf("<p> <a href='%s'>%s</a> <br> %s <br> <br>
					   <a href='delete_post.php?name=%s'>delete this post</a>
					   </p><br>",
                    htmlspecialchars($link),
                    htmlspecialchars($title),
                    htmlspecialchars($text),
					htmlentities($id)
                );
            }
            $get_posts->close();
            
            ?>
        </body>
    </html>