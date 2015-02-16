<?php

//Turn on error reporting
ini_set('display_errors', 'On');
include "password.php";
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","wujiao-db",$password,"wujiao-db");
if(!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
$id = $_GET['id'];
$query1 = "SELECT rented FROM inventory WHERE id = '$id'";
if(!($stmt = $mysqli->prepare($query1))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
}
if(!($stmt->bind_result($rented))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}
while ($stmt->fetch()){
    if ($rented == 1){
        $rented = 0;
    }
    else {
        $rented = 1;
    }
    //echo "$rented\n";
}

$query = "UPDATE inventory SET rented = '$rented' WHERE id = '$id'";

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
/*
if(!($stmt->bind_result($rented))){
    echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
}*/
/*
while ($stmt->fetch()){
    echo "hi"."$rented\n";
    //echo  "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $category ."\n</td>\n<td>\n" . $length.  "\n</td>\n\n</tr>";
}*/
$stmt->close();

header('Location: index.php');
exit;
?>



