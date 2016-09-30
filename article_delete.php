<!doctype html>
    <html>
        <head>
            <title>Delete User Posts</title>
        </head>
        <body>
            <!--code from http://stackoverflow.com/questions/14475096/delete-multiple-rows-by-selecting-checkboxes-using-php-->
<?php
require 'database_rw.php';
$sql = "SELECT * FROM stories";
                            $res = mysql_query($sql);
                            if (mysql_num_rows($res)) {
                            $query = mysql_query("SELECT * FROM stories ORDER BY story_id");
                            $i=1;
                            while($row = mysql_fetch_assoc($query)){
                            ?>


<input type="checkbox" name="checkboxstatus[<?php echo $i; ?>]" value="<?php echo $row['story_id']; ?>"  />

<?php $i++; }} ?>


<input type="submit" value="Delete" name="Delete" />

<?php if($_REQUEST['Delete'] != '')
{
    if(!empty($_REQUEST['checkboxstatus'])) {
        $checked_values = $_REQUEST['checkboxstatus'];
        foreach($checked_values as $val) {
            $sqldel = "DELETE from stories WHERE story_id = '$val'";
           mysql_query($sqldel);

        }
    }
}
?>
        </body>
    </html>
