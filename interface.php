<?php
//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","wujiao-db","cUhlYd6WZm2g9lqP","wujiao-db");
if(!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
?>

<!DOCTYPE html >

<html>

<body>

<div>
<form method="POST" action="addvideo.php">
<fieldset>
            <legend>Add Video</legend>
            <p>Name: <input type = "text" name = "name"/></p>
            <p>Category: <input type = "text" name = "category"/></p>
            <p>Length: <input type = "text" name = "length"/></p>
        </fieldset>
<p><input type = "submit" name = "Add" value = "Add a video"/></p>
    </form>
</div>
</body>
</html>


