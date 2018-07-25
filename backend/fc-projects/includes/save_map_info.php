<?php
require '../../includes/dbConnect.php' ;


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}

session_start();




if (isset($_POST['add_marker'])){

  $project_id = validateInput($_POST['project_id']);

  $location = validateInput($_POST['location']);
  $latitude = validateInput($_POST['latitude']);
  $longitude = validateInput($_POST['longitude']);
  $description = validateInput($_POST['description']);




$query = "INSERT INTO tbl_map (project_id,location,latitude,longitude, description)
  VALUES ('$project_id','$location','$latitude','$longitude', '$description')";

    $result = $db_conn->query($query);

    echo $project_id;

    // if ($result){


    $url=$_SESSION['last_url'];
    header("location: $url");    // }
    // else {
    //   $queryError = 'Could not insert values.';
    // }

}




 ?>
