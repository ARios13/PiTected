<?php
  require('header.php');

  


$result = $connection->query("SELECT name FROM sensors WHERE status = 1 AND type != 0");

if($result){
$user = array();
$result->data_seek(0);


while($row =mysqli_fetch_assoc($result))
    {	
        $user[] = $row;
       
    }
    if(sizeof($user) === 0){
    	echo json_encode();
    }
    else{
    	echo json_encode($user);
    }
    
      
      }
      else{
      echo json_encode(array());
      }
mysqli_stmt_close($query);

mysqli_close($connection);

?>
