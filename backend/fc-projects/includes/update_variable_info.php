<?php
require '../../includes/dbConnect.php' ;

session_start();


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}





$project_id = $_SESSION['current_project_id'];

$variable_id = $_SESSION['current_variable_id'];


if (isset($_POST['edit_variable'])){
$name = validateInput($_POST['variable_name']);
$abbreviation = validateInput($_POST['abbreviation']);
$data_type = validateInput($_POST['data_type']);
$definition = validateInput($_POST['definition']);
$unit = validateInput($_POST['unit']);
$precision = validateInput($_POST['precision']);
$variable_list = validateInput($_POST['variable_list']);
$observations = validateInput($_POST['observations']);
$missing_data_codes = validateInput($_POST['missing_data_codes']);



$query = "UPDATE tbl_variables SET name = '$name',abbreviation='$abbreviation',
data_type='$data_type', definition='$definition',unit_of_measurement='$unit',
precision_of_measurement='$precision',variable_list='$variable_list',observations='$observations',
missing_data_codes='$missing_data_codes' WHERE id ='$variable_id' ";

$result = $db_conn->query($query);





$url=$_SESSION['last_url'];
header("location: $url");





    // if ($result){

    // }
    // else {
    //   $queryError = 'Could not insert values.';
    // }


}



 ?>
