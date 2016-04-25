<?php
require('header.php');
require('connection-functions.php');
  
if(isset($_REQUEST['pin'])){
$pin = $_REQUEST['pin'];
$pin = sanitizeString($pin, $connection);
$pin = hashString($pin, $salt1, $salt2);

$result = $connection->query("SELECT id FROM users WHERE pin = '$pin'");
$user = array();
$result->data_seek(0);
while($row = $result->fetch_assoc()){
	$user[] = $row;
}
      if(sizeof($user) < 1){
      echo json_encode(array('id' => -1));
      }
      else{
      echo json_encode(array('id'=>$user[0]['id']));
      }
}
else{
	echo json_encode(array('id' => -1));
}


mysqli_close($connection);


?>
