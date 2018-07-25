<?php
require '../../includes/dbConnect.php' ;


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}

session_start();



if (isset($_POST['copy_project'])){

  $project_title = validateInput($_POST['project_title']);
  $short_name = validateInput($_POST['short_name']);

  $project_id= validateInput($_POST['project_id']);

  $query= "SELECT * FROM tbl_projects where id ='$project_id'";

  $result = $db_conn->query($query);

  // $row = $result->fetch_assoc();
  // echo $row['status'];

  $row = $result->fetch_assoc();
  # code...
  $description = $row['description'];
  $contact_name = $row['contact_name'];
  $contact_email = $row['contact_email'];
  $sponsor = $row['sponsor'];
  $status = $row['status'];
  $research_area = $row['research_area'];
  $period= $row['period'];

  $u_id=$row['u_id'];





$query = "INSERT INTO tbl_projects (u_id,title,short_name,period,
   description, contact_name,contact_email, status, sponsor,research_area)
  VALUES ('$u_id','$project_title','$short_name','$period', '$description',
  '$contact_name','$contact_email','$status','$sponsor','$research_area')";

    $result = $db_conn->query($query) or die(mysqli_error($db));

    if ($result){


    $url=$_SESSION['last_url'];
    header("location: $url");      }
    else {
      $queryError = 'Could not insert values.';
    }

}




 ?>
