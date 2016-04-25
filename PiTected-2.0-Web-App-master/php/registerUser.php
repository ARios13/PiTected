<?php
require('header.php');
require('connection-functions.php');
  
if(isset($_REQUEST['username'])){
$username = $_REQUEST['username'];
$username = sanitizeString($username, $connection);
}
if(isset($_REQUEST['password'])){
$password = $_REQUEST['password'];
$password = sanitizeString($password, $connection);
$password = hashString($password, $salt1, $salt2);
}
if(isset($_REQUEST['pin'])){
$pin = $_REQUEST['pin'];
$pin = sanitizeString($pin, $connection);
$pin = hashString($pin, $salt1, $salt2);
}
if(isset($_REQUEST['passphrase'])){
$passphrase = $_REQUEST['passphrase'];
$passphrase = sanitizeString($passphrase, $connection);
$passphrase = md5($passphrase);
}

$result = $connection->query("SELECT * FROM system WHERE `passphrase` =  '$passphrase'");
$system = array();
$result->data_seek(0);
while($row = $result->fetch_assoc()){
	$system[] = $row;
}
      if(sizeof($system) < 1){
      echo json_encode(array('result' => false, 'description'=> 'Invalid Passphrase'));
      }
      else{
      	if(checkDuplicates($connection, $username)){
      	echo json_encode(array('result'=> false, 'description'=> 'Duplicate username'));
      	}
      	else{
      		insert_user($connection, $username, $password, $pin);
      	}
      
      }


function insert_user($connection, $username, $password, $pin){
	$insert = "INSERT INTO users (username, password, pin) VALUES ('$username', '$password', '$pin')";

if ($connection->query($insert) === TRUE) {
    echo json_encode(array('result'=>true, 'description'=>'New record inserted into database'));
} else {
    echo "Error: " . $insert . "<br>" . $connection->error;
}
}

function checkDuplicates($connection, $username){
	$result = $connection->query("SELECT * FROM users WHERE `username` =  '$username'");
$user = array();
$result->data_seek(0);
while($row = $result->fetch_assoc()){
	$user[] = $row;
}
	if(sizeof($user) > 0){
		return true;
	}
	else{
		return false;
	}
}
mysqli_close($connection);


?>
