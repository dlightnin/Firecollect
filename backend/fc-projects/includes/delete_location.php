<?php
require '../../includes/dbConnect.php' ;


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}

session_start();
$project_id = $_SESSION['current_project_id'];




if (isset($_POST['marker_id'])) {
  $marker_id = $_POST['marker_id'];
  $query = "DELETE FROM tbl_map WHERE id = '$marker_id'";
  $db_conn->query($query);

  $query2= "SELECT * FROM tbl_map where project_id ='$project_id'";
  $result =$db_conn->query($query2);
  $i = 0;

  while ($row = $result->fetch_assoc() ) {
    $location= $row['location'];
    $latitude= $row['latitude'];
    $longitude=$row['longitude'];
    $marker_description= $row['description'];

    $markers[$i]=array();
    array_push($markers[$i],$location,$latitude,$longitude,$marker_description);
    $i= $i + 1 ;

  }
  $locations = json_encode($markers);
// RETURN location of markers after ajax load
  echo $locations;

}


 ?>
