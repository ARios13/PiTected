<?php
require_once('header.php');
if(isset($argv[1])){
    $imageLocation = $argv[1];
}
$dateTaken = date("Y-m-d H:i:s");

$sql = "INSERT INTO camera (location, date_taken) VALUES ('$imageLocation', '$dateTaken')";
if ($connection->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $connection->error;
}
$connection->close();
?>