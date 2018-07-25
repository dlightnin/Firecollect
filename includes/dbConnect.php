<?php
$servername = "localhost" ;
$username = "catecmaster" ;
$password =  "G3d30n" ;
$db_name = "fcollect_ts" ;

# create connection
$db_conn = new mysqli($servername, $username, $password, $db_name) ;

#check connection
// if ($db_conn->connect_error) {
// 	die("Connection failed: " . $db_conn->connect_error) ;
// }
//
// echo "Connected successfully!" ;
//$mysqli->close() ;

?>
