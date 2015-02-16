<?php

//Turn on error reporting
ini_set('display_errors', 'On');
include "password.php";
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","wujiao-db",$password,"wujiao-db");
if(!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

$name = $_POST['name'];
$category = $_POST['category'];
$length = $_POST['length'];
if (empty($name) || $length < 0 ||!is_numeric($length) ){
    header('Location: index.php');
    exit;
}
    $query = "INSERT INTO inventory(name, category, length) Values (?, ?, ?)";


if(!($stmt = $mysqli->prepare($query))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_param('ssi',$name, $category, $length))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
/*
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
 */
$stmt->close();

header('Location: index.php');
exit;
?>



