<?php
require('header.php');

$result = $connection->query("SELECT * FROM system WHERE id =0");

$user = array();
$result->data_seek(0);

while($row =mysqli_fetch_assoc($result))
    {	
        $user[] = $row;
       
    }
    	echo json_encode(array('status'=>$user[0]['status']));

    
mysqli_stmt_close($query);

mysqli_close($connection);
?>