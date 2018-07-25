<?php
require '../../includes/dbConnect.php' ;


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}

session_start();



if (isset($_POST['copy_data_set'])){

  $project_id = validateInput($_POST['project_id']);
  $name = validateInput($_POST['name']);

  $data_set_id= $_SESSION['current_data_set_id'];

  $query= "SELECT * FROM tbl_data_set where id ='$data_set_id'";

  $result = $db_conn->query($query);

  // $row = $result->fetch_assoc();
  // echo $row['status'];

  $row = $result->fetch_assoc();
  # code...
  $description = $row['description'];
  $method = $row['method'];
  $period= $row['datefilter2'];
  $times = $row['times'];
  $periodicity = $row['periodicity'];
  $reference = $row['reference'];
  $cross_reference = $row['cross_reference'];
  $keywords = $row['keywords'];
  $observations = $row['observations'];
  $formula = $row['formula'];






$query = "INSERT INTO tbl_data_set (project_id,name, description,method,period,
   times,periodicity, reference, cross_reference, keywords,observations,formula)
  VALUES ('$project_id','$name', '$description','$method','$period',
  '$times','$periodicity','$reference','$cross_reference','$keywords','$observations','$formula')";

    $result = $db_conn->query($query) or die(mysqli_error($db));

    if ($result){


    $url=$_SESSION['last_url'];
    header("location: $url");      }
    else {
      $queryError = 'Could not insert values.';
    }

}




 ?>
