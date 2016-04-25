<?php
require('header.php');
require('connection-functions.php');
if(isset($_REQUEST["userID"])){
	$userID = $_REQUEST["userID"];
}
if(isset($_REQUEST['armStatus'])){
	$status = $_REQUEST['armStatus'];
}
if(isset($_REQUEST['pin'])){
	$pin = $_REQUEST['pin'];
	$pin = hashString($pin, $salt1, $salt2);

$result = $connection->query("SELECT * FROM users WHERE pin = '$pin'");
}

$user = array();
$result->data_seek(0);


while($row =mysqli_fetch_assoc($result))
    {	
        $user[] = $row;
       
    }
   
    if(sizeof($user) === 0){
    	echo json_encode(array(result => false));
    	exit();

    }
	

$sql ="UPDATE sensors set status = '$status' WHERE sesnors.type = 0";
if (mysqli_query($connection, $sql)) {
	mysqli_stmt_close($sql);
	$sql2 = mysqli_prepare($connection, "INSERT INTO  system_logs (sensor_id, user_id, status,timestamp)VALUES (0,?,?,now())");
	mysqli_stmt_bind_param($sql2, "ss",$userID, $status);
	if (mysqli_stmt_execute($sql2)) {
	     echo json_encode(array(result => true));
	} else {
	     echo json_encode(array(result => false));
         echo $connection->error;
	     exit();
	}

} else {
    echo json_encode(array(result => false));
    exit();
}


mysqli_stmt_close($sql2);


mysqli_close($connection);

?>
