<?php
require '../../includes/dbConnect.php' ;

session_start();
$project_id =$_SESSION['current_project_id'];

// if (isset($_POST['file_name'])) {

  $file_name = $_POST['file_name'];

  // $check = "SELECT * from tbl_project_images where name = '$file_name'" ;
  // $result = $db_conn->query($check) ;
  // $res = $result->fetch_assoc() ;


  $query2 = "DELETE FROM tbl_project_images WHERE name = '$file_name'";

  $db_conn->query($query2);
  unlink("../../../../fc-projects/includes/uploads/$file_name");

// }

  ?>
