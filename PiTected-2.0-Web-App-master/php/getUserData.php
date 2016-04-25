<?php
require('header.php');
require('connection-functions.php');
require('session-functions.php');
$name = $_REQUEST["username"];
$password = $_REQUEST["password"];
/**Hash the password before matching to queried password*/
$hashword = hashString($password, $salt1, $salt2);
$result = $connection->query("SELECT * FROM users WHERE username='$username'");
$user = array();
$result->data_seek(0);
while($row =mysqli_fetch_assoc($result))
    {
    	
        $user[] = $row;
    }
 if(sizeof($user) > 0){
    if($user[0]['password'] == $hashword){
    /**Create unique session ID*/
    $sessID = uniqid();
    //Insert/update sessionID in to the user's columm
    storeSession($connection, $name, $sessID);
		
    	 $return = array('session' => $sessID, 'username' => $name, 'result'=>true, 'permissions'=>$user[0]['privileges'], 'pin'=>$user[0]['pin'], 'id'=>$user[0]['id']);
		} 
    else {
    	$return = array('session' => "", 'username' => "", 'result'=>false, 'permissions'=>"", 'pin'=>"",'id'=>"");
	}
 }
 else{
     $return = array('session' => "", 'username' => "", 'result'=>false, 'permissions'=>"", 'pin'=>"",'id'=>"");
 }
   	
echo json_encode($return);
      
mysqli_close($connection);
?>
