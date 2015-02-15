<?php

//Turn on error reporting
ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","wujiao-db","cUhlYd6WZm2g9lqP","wujiao-db");
if(!$mysqli || $mysqli->connect_errno){
    echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
?>


<?php

$query = "TRUNCATE TABLE inventory";

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
?>


<?php
$stmt->close();

header('Location: interface.php');
exit;
?>



