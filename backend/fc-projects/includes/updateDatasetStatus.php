<?php
require '../../includes/dbConnect.php' ;

session_start();


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}





$data_set_id = validateInput($_POST['update_id']);

$status = validateInput($_POST['status']);

$res = $db_conn->query("UPDATE tbl_data_set SET status='$status' WHERE id ='$data_set_id' ");
if ($res) {
  echo $status;
}


?>
