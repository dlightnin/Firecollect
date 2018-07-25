<?php
require '../../includes/dbConnect.php' ;
include '../../includes/topMenu.php';
include '../../includes/sideBar.php';

session_start();


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}




if ($_POST['variable_id']){

// $research_area = validateInput($_POST['research_area']);
  $variable_id = validateInput($_POST['variable_id']);

      // set all variables associated with ds_id as deleted
      $db_conn->query("UPDATE tbl_variables Set deleted = 0 where id= '$variable_id'");

    echo "Variable was restored in DB";

    // if ($result){

    // header("location: ../projects.php");
    // }
    // else {
    //   $queryError = 'Could not insert values.';
    // }


}

include '../../includes/footer.php' ;


 ?>
