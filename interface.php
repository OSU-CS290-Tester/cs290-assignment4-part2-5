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
<head>
</head>
<body>

<div>
<form method="POST" action = "addvideo.php">
<fieldset>
            <legend>Add Video</legend>
            <p>Name: <input type = "text" name = "name"/></p>
            <p>Category: <input type = "text" name = "category"/></p>
            <p>Length: <input type = "text" name = "length"/></p>
        </fieldset>
<p><input type = "submit" name = "Add" value = "Add a video"/></p>
</form>
</div>

<div id = "video">
<table>
    <tr>
        <td>Name</td>
        <td>Category</td>
        <td>Length</td>
    </tr>
<?php

$query = "SELECT name, category, length, rented FROM inventory";

if(!($stmt = $mysqli->prepare($query))){
        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
        echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->bind_result($name, $category, $length, $rented)) {
        echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while ($stmt->fetch()){
        echo  "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $category . "\n</td>\n<td>\n" . $length ."\n</td>\n<td>\n" . $rented ."\n</td>\n</tr>";
}

$stmt->close();

?>
</table>
</div>
</body>
</html>


