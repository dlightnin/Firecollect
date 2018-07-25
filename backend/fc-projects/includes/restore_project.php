<?php
require '../../includes/dbConnect.php' ;
include '../../includes/topMenu.php';
include '../../includes/sideBar.php';

session_start();


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}




if ($_POST['project_id']){

// $research_area = validateInput($_POST['research_area']);
  $project_id = validateInput($_POST['project_id']);


    $query = "UPDATE tbl_projects SET  deleted=0 WHERE id ='$project_id' ";

    $result = $db_conn->query($query);

    // send project datasets to trash
    $db_conn->query("UPDATE tbl_data_set Set deleted = 0 where project_id = '$project_id'" );
    // select all datasets that are associated with project id
    $result2 =$db_conn->query("SELECT * from tbl_data_set where project_id = '$project_id'");
    while ($row = $result2->fetch_assoc() ) {
      $ds_id=$row['id'];
      // set all variables associated with ds_id as deleted
      $db_conn->query("UPDATE tbl_variables Set deleted = 0 where data_set_id= '$ds_id'");
      // set all data files associated with ds_id as deleted
      $db_conn->query("UPDATE tbl_data_files Set deleted = 0 where data_set_id= '$ds_id'");


    }

    echo "project was restored in DB";

    // if ($result){

    // header("location: ../projects.php");
    // }
    // else {
    //   $queryError = 'Could not insert values.';
    // }


}

include '../../includes/footer.php' ;


 ?>
