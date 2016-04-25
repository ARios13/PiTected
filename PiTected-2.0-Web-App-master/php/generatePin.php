<?php
require('header.php');
require('connection-functions.php');
//Generate a random pin for the user and check for duplicates
$generate = true;
while($generate){

	$generatedPin = mt_rand(1, 9).mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);

	$hashedPin = hashString($generatedPin, $salt1, $salt2);
	$result = $connection->query("SELECT * FROM users WHERE `pin` =  '$hashedPin'");
	$user = array();
	$result->data_seek(0);
	while($row = $result->fetch_assoc()){
		$user[] = $row;
	}
	      if(sizeof($user) < 1){
	      	$generate = false;
	      echo json_encode(array('pin' => $generatedPin));
	      }
	      else{
	      //Generate another pin
	      }	
}


mysqli_close($connection);


?>
