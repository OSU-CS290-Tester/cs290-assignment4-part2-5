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
<p><input type = "submit" name = "Add" value = "Add a video"/></p>
        </fieldset>
</form>
</div>

<p></p>
<div>
<fieldset><legend>Filter Videos</legend>
<form method="POST" action = "filtervideos.php">
<select name="filtercategory">
<option>All Movies</option>
<?php
    if(!($stmt = $mysqli->prepare("SELECT DISTINCT category FROM inventory"))){
                echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }
    
    if(!$stmt->execute()){
                echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
    if(!$stmt->bind_result($name)){
                echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
    while($stmt->fetch()){
                echo '<option> ' . $name . '</option>\n';
                    }
    $stmt->close();
    ?>
</select>
<p><input type="submit" name= "filter" value = "Filter Videos"/></p>
</form>
</fieldset>
</div>

<p></p>
<div id = "video">
<fieldset><legend>Display Videos</legend>
<table>
    <tr>
        <td>Name</td>
        <td>Category</td>
        <td>Length</td>
        <td>Status</td>
    </tr>
<?php
//if (isset($_POST['Add']) || $_POST['filtercategory'] == 'All Movies'){
    $query = "SELECT name, category, length, CASE WHEN rented = 1 THEN 'Available' ELSE 'Checked Out' END FROM inventory";
    //$query = "SELECT name, category, length, rented FROM inventory";

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
        echo  "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $category . "\n</td>\n<td>\n" . $length ."\n</td>\n";
        //echo "<td>\n" . $rented ."\n</td>";
        echo "<td><form method = \"POST\" action = \"updatevideo.php\">";
        echo "<input type=\"submit\" value=$rented>";
        echo "</form></td>";
        echo "<td><form method = \"POST\" action = \"deletevideo.php\">";
        echo "<input type = \"hidden\" name=\" \" >";
        echo "<input type=\"submit\" value=\"Delete\">";
        echo "</form></td>\n</tr>";
    }

    $stmt->close();

?>
</table>
</fieldset>
</div>

<p></p>
<div>
<fieldset><legend>Delete All Videos</legend>
<form method="POST" action = "deleteall.php">
<p><input type="submit" name= "delete" value = "Delete All Videos"/></p>
</form>
</fieldset>
</div>

<p></p>
<div>
<fieldset><legend>Filter Videos</legend>
<form method="POST" action = "filtervideos.php">
<select name="filtercategory">
<option>All Movies</option>
<?php
    if(!($stmt = $mysqli->prepare("SELECT DISTINCT category FROM inventory"))){
                echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }
    
    if(!$stmt->execute()){
                echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
    if(!$stmt->bind_result($name)){
                echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                    }
    while($stmt->fetch()){
                echo '<option> ' . $name . '</option>\n';
                    }
    $stmt->close();
    ?>
</select>
<p><input type="submit" name= "filter" value = "Filter Videos"/></p>
</form>
</fieldset>
</div>

<p></p>
</body>
</html>


