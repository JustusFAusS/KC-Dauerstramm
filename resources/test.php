
<form action="test.php" method="post" name='test'></input>
Name: <input type="text" name="name"></input>
Mail: <input type="text" name="Mail"></input>
Webseite: <input type="text" name="webseite"></input>
Comment: <textarea type="comment"  rows="5" cols="40" name="comment"></textarea>
<input type="submit" name="test"></input>
</form>
<?php

if(isset($_POST['test']))
{
    echo $_POST['name'];
    //echo "submitted";
}
//echo "!test";
?>
