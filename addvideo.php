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


<?php

$name = $_POST['name'];
$category = $_POST['category'];
$length = $_POST['length'];

$query = "INSERT INTO inventory(name, category, length) Values (?, ?, ?)";

if(!($stmt = $mysqli->prepare($query))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param('ssi',$name, $category, $length))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
} else {
    echo "Added " . $stmt->affected_rows . " rows to inventory table.";
}

?>


<div>
<p>The existing videos in the selected store are:</p>
<table>
    <tr>
        <td>Name</td>
        <td>Category</td>
        <td>Length</td>
    </tr>

<?php
/*
$store = $_POST['store']; 
$query = "SELECT gw_employees.first_name, gw_employees.last_name FROM gw_employees INNER JOIN gw_stores ON gw_stores.sid = gw_employees.store_id WHERE gw_stores.city = '$store'";

if(!($stmt = $mysqli->prepare($query))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->bind_result($firstname, $lastname)) {
    echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

while ($stmt->fetch()){
    echo  "<tr>\n<td>\n" . $firstname . "\n</td>\n<td>\n" . $lastname . "\n</td>\n</tr>";
}

$stmt->close();

 */
?>
                            </table>
</div>



</body>



</html>


