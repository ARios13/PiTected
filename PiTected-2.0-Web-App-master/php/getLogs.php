<?php
require('header.php');
if(isset($_REQUEST['log_type'])){
$log_type = $_REQUEST['log_type'];
}


if($log_type === "system"){
	$sql = "SELECT users.username, system_logs.status, system_logs.timestamp FROM system_logs, users WHERE sensor_id = 0 AND users.id = system_logs.user_id ORDER BY timestamp DESC";
	fetchData($sql, $connection);
}
else if($log_type === "sensors"){
	$sql = "SELECT system_logs.status, system_logs.timestamp, sensors.name FROM system_logs, sensors WHERE system_logs.sensor_id = sensors.id AND sensors.type IN (1,2) ORDER BY timestamp DESC";
	fetchData($sql, $connection);
}
else if($log_type === "all"){
	$sql = "SELECT system_logs.status, system_logs.timestamp, sensors.name FROM system_logs, sensors WHERE system_logs.sensor_id = sensors.id AND sensors.type IN (0, 1,2) ORDER BY timestamp DESC";
	fetchData($sql, $connection);
}
else if($log_type === "current"){
	$sql = "SELECT * FROM sensors WHERE type != 0";
	fetchData($sql, $connection);
}

function fetchData($sql, $connection){
$myArray = array();
$result=mysqli_query($connection,$sql);
	if ($result){
 		while($row = $result->fetch_array(MYSQL_ASSOC)) {
            $myArray[] = $row;
    	}
    	echo json_encode($myArray);
	}
    else echo $connection->error;
}

mysqli_close($connection);

?>