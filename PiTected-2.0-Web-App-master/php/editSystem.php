<?php
require_once('header.php');
if(isset($_REQUEST['edit_type'])){
    if($_REQUEST['edit_type'] === "editSensor"){   
        
        $id = $_REQUEST['sensorID'];
        $name = $_REQUEST['sensorName'];
        
        $statement = mysqli_prepare($connection, "UPDATE sensors SET name=? WHERE id=?");
        mysqli_stmt_bind_param($statement, "ss", $name, $id);
        
    } else if($_REQUEST['edit_type'] === "addSensor"){
        $name = $_REQUEST['sensorName'];
        $sensorType = $_REQUEST['sensorType'];
        $nodeID = $_REQUEST['nodeID'];
      
        $statement = mysqli_prepare($connection, "INSERT INTO sensors (name, type, status, batPcnt, nodeID) VALUES (?, ?, 0, 100, ?)");
        mysqli_stmt_bind_param($statement, "sss", $name, $sensorType, $nodeID);
        
    }else if($_REQUEST['edit_type'] === "addSensorType"){
       
        $name = $_REQUEST['sensorTypeName'];
        $statement = mysqli_prepare($connection, "INSERT INTO sensor_type (type_name) VALUES (?)");
        mysqli_stmt_bind_param($statement, "s", $name);
    }
    
}

if(mysqli_stmt_execute($statement)){
   $response=array('result'=>true);
 }else {
   $response=array('result'=>false);
  }
   echo json_encode($response);
mysqli_stmt_store_result($statement);

$connection->close();
?>