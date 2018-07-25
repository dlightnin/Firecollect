<?php
require '../../includes/dbConnect.php' ;

session_start();


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}





$project_id = validateInput($_POST['update_id']);

$status = validateInput($_POST['status']);

$res = $db_conn->query("UPDATE tbl_projects SET status='$status' WHERE id ='$project_id' ");
if ($status == 0) {
  $db_conn->query("UPDATE tbl_data_set SET status='$status' WHERE project_id ='$project_id' ");
}
if ($res) {
  echo $status;
}


?>
