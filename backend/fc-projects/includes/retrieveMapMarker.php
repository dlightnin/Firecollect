<?php
require '../../includes/dbConnect.php' ;


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}

session_start();
if (isset($_POST['project_id'])){
  $project_id = validateInput($_POST['project_id']);

//receive project id
// retrieve markers from database
    $markers = array();
    $result = $db_conn->query("SELECT * FROM tbl_map where project_id ='$project_id'");

    $i=0;


    while ($row = $result->fetch_assoc() ) {
      $location= $row['location'];
      $latitude= $row['latitude'];
      $longitude=$row['longitude'];
      $marker_description= $row['description'];
      $location_id=$row['id'];


      $p_id = $row['project_id'];
      $res = $db_conn->query("SELECT title FROM tbl_projects where id ='$p_id'");
      $rowp =$res->fetch_assoc();
      $p_title = $rowp['title'];


      $markers[$i]=array();
      array_push($markers[$i],$location,$latitude,$longitude,$marker_description,$location_id,$p_title);
      $i= $i + 1 ;


    }
    // $all_projects =  array();
    // $all_projects= array_push($markers)
    $locations = json_encode($markers);
    echo $locations;
}
 ?>
