<?php
require '../../includes/dbConnect.php' ;

session_start();


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}




if (isset($_POST['edit_project'])){
$title = validateInput($_POST['project_title']);
$short_name = validateInput($_POST['short_name']);
$period = validateInput($_POST['datefilter2']);
$description = validateInput($_POST['project_description']);
$contact_name = validateInput($_POST['contact_name']);
$contact_email = validateInput($_POST['contact_email']);
$status = validateInput($_POST['status']);
$sponsor = validateInput($_POST['sponsor']);
// $research_area = validateInput($_POST['research_area']);
$project_id = validateInput($_POST['project_id']);


echo $short_name;



    $query = "UPDATE tbl_projects SET title = '$title',short_name='$short_name',
    period='$period',description='$description',
    contact_name='$contact_name',contact_email='$contact_email',status='$status',
    sponsor='$sponsor' WHERE id ='$project_id' ";

    $result = $db_conn->query($query);

    // if ($result){

    $url=$_SESSION['last_url'];
    header("location: $url");    // }
    // else {
    //   $queryError = 'Could not insert values.';
    // }


}



 ?>
