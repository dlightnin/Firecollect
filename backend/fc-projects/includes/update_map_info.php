<?php
require '../../includes/dbConnect.php' ;


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}

session_start();
$project_id = $_SESSION['current_project_id'];




if (isset($_POST['edit_marker'])){

  $marker_id = validateInput($_POST['marker_id']);

  $location = validateInput($_POST['location']);
  $latitude = validateInput($_POST['latitude']);
  $longitude = validateInput($_POST['longitude']);
  $description = validateInput($_POST['description']);






  $query = "UPDATE tbl_map SET location = '$location',
  latitude='$latitude', longitude='$longitude',description='$description' WHERE id ='$marker_id' ";

    $result = $db_conn->query($query);


    // if ($result){


    $url=$_SESSION['last_url'];
    header("location: $url");    // }
    // else {
    //   $queryError = 'Could not insert values.';
    // }

}




 ?>
