<?php

//Turn on error reporting
ini_set('display_errors', 'On');
include "password.php";
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","wujiao-db",$password,"wujiao-db");
if(!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

$query = "DELETE FROM inventory WHERE 1";

if(!($stmt = $mysqli->prepare($query))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}
/*
if(!($stmt->bind_param('ssi',$name, $category, $length))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}*/

if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
$stmt->close();

header('Location: index.php');
exit;
?>



