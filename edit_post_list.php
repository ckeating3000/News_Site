<!DOCTYPE html>
    <html>
        <head>
            <title>Edit your posts and comments</title>
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

		    echo "<br>\n<br>\n";
			$username = $_SESSION['Login'];
            require 'database_rw.php';
		   
		   echo "Your Posts";
            //DISPLAY/EDIT POSTS

            //get user posts from the database
            $get_posts = $mysqli->prepare("select link, story_text, username, story_title, story_id, comment_count from stories where username=? order by story_id");
            if(!$get_posts){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
			$get_posts->bind_param('s', $username);
            $get_posts->execute();
            $get_posts->bind_result($link, $text, $username, $title, $id, $comcount);
            
//display posts with link to page that allows editing
            while($get_posts->fetch()){
                printf("<p> <a href='%s'>%s</a> <br> %s <br> %s <br>
					   <a href='edit_post_form.php?name=%s&token=%s'>edit this post</a>
					   </p><br>",
                    htmlspecialchars($link),
                    htmlspecialchars($title),
                    htmlspecialchars($text),
                    "Posted by: ".htmlspecialchars($username),
					htmlentities($id),
                    $_SESSION["token"]
                );
            }
            $get_posts->close();
            
            ?>
        </body>
    </html>