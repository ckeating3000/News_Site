<!DOCTYPE html>
    <html>
        <head>
            <title>EDIT POST</title>
        </head>
        <body>
            <div>
                <strong>Edit your post</strong>
            </div>
                <form name="EditPost" action="edit_post.php" method="POST"> 
                    <p>
                        Post title: <input type="text" name="article_title">
                    </p>
                    <p>
                         Story link: <input type="text" name="link_submit">
                    </p>
                          <p>
                            Your reaction:
                          </p>
                        
                        <textarea class="text_box" name="comment_submit" >Why is this news to you... </textarea>
                        <p>
                        <input type="submit" value="Submit Link" />
                    </p>
                </form>

                <br>
        </body> 
    </html>