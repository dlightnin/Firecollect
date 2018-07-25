<?php
require '../../includes/dbConnect.php' ;
include '../../includes/topMenu.php';
include '../../includes/sideBar.php';

session_start();


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}




if ($_POST['dataset_id']){

// $research_area = validateInput($_POST['research_area']);
  $dataset_id = validateInput($_POST['dataset_id']);

    // send project datasets to trash
    $db_conn->query("UPDATE tbl_data_set Set deleted = 0 where id = '$dataset_id'" );
      // set all variables associated with ds_id as deleted
      $db_conn->query("UPDATE tbl_variables Set deleted = 0 where data_set_id= '$dataset_id'");
      // set all data files associated with ds_id as deleted
      $db_conn->query("UPDATE tbl_data_files Set deleted = 0 where data_set_id= '$dataset_id'");




    echo "dataset was restored in DB";

    // if ($result){

    // header("location: ../projects.php");
    // }
    // else {
    //   $queryError = 'Could not insert values.';
    // }


}

include '../../includes/footer.php' ;


 ?>
