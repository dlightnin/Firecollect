<?php
require '../../includes/dbConnect.php' ;

session_start();


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}




if (isset($_POST['edit_data_set'])){
  $name = validateInput($_POST['data_set_name']);
  $description = validateInput($_POST['data_set_description']);
  $method = validateInput($_POST['method']);
  $period = validateInput($_POST['datefilter2']);
  $times = validateInput($_POST['times']);
  $periodicity = validateInput($_POST['periodicity']);
  $reference = validateInput($_POST['reference']);
  $cross_reference = validateInput($_POST['cross_reference']);
  $keywords = validateInput($_POST['keywords']);
  $observations = validateInput($_POST['observations']);
  $formula = validateInput($_POST['formula']);
  $data_set_id = validateInput($_POST['data_set_id']);





    $query = "UPDATE tbl_data_set SET name = '$name',description='$description',
    method='$method', period='$period',
    times='$times',periodicity='$periodicity',reference='$reference',
    cross_reference='$cross_reference', keywords='$keywords', observations='$observations', formula='$formula' WHERE id ='$data_set_id' ";

    $result = $db_conn->query($query);

    // if ($result){

    $url=$_SESSION['last_url'];
    header("location: $url");
    // }
    // else {
    //   $queryError = 'Could not insert values.';
    // }


}



 ?>
