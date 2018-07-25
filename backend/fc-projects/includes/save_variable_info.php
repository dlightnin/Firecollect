<?php
session_start();

require '../../includes/dbConnect.php' ;


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}



// $project_id = $_SESSION['current_project_id'];

$data_set_id = $_SESSION['current_data_set_id'];


if (isset($_POST['add_variable'])){
$name = validateInput($_POST['variable_name']);
$abbreviation = validateInput($_POST['abbreviation']);
$data_type = validateInput($_POST['data_type']);
$definition = validateInput($_POST['definition']);
$unit = validateInput($_POST['unit']);
$precision = validateInput($_POST['precision']);
$variable_list = validateInput($_POST['variable_list']);
$observations = validateInput($_POST['observations']);
$missing_data_codes = validateInput($_POST['missing_data_codes']);



  $query = "INSERT INTO tbl_variables (data_set_id,name,abbreviation,data_type, definition,
    unit_of_measurement,precision_of_measurement, variable_list, observations,missing_data_codes)
    VALUES ('$data_set_id','$name','$abbreviation','$data_type','$definition', '$unit', '$precision',
    '$variable_list','$observations','$missing_data_codes')";

    $result = $db_conn->query($query) or die(mysqli_error($db));



    //
    // $query2= "SELECT * FROM tbl_variables where data_set_id='$data_set_id' AND name ='$name' ";
    //
    // $result = $db_conn->query($query2);
    //
    //
    //
    // $row = $result->fetch_assoc();
    //   # code...
    //   $variable_id = $row['id'];
    //
    //   $_SESSION['current_variable_id']= $variable_id;






    if ($result){

      $url=$_SESSION['last_url'];
      header("location: $url");

    }
    else {
      $queryError = 'Could not insert values.';
      echo $queryError;
    }


}





 ?>
