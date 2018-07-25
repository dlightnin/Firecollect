<?php
require '../../includes/dbConnect.php' ;

session_start();

function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}


//"protocol": "sftp",
// "host": "136.145.54.38", // string - Hostname or IP address of the server. Default: 'localhost'
// "port": 22, // integer - Port number of the server. Default: 22
// "user": "root", // string - Username for authentication. Default: (none)
// "pass": "Arn1th1k3", // string - Password for password-based user authentication. Default: (none)

// $db_conn->query("INSERT INTO tbl_projects (title,short_name,starting_date,
//   end_date, description, contact_name,contact_email, status, sponsor ) VALUES
//   ('test','test','test', 'test', 'test',
//   'test','test','0','test')");
$u_id =$_SESSION["user_id"];

if (isset($_POST['add_project'])){
$title = validateInput($_POST['project_title']);
$short_name = validateInput($_POST['short_name']);
$period = validateInput($_POST['datefilter2']);
$description = validateInput($_POST['project_description']);
$contact_name = validateInput($_POST['contact_name']);
$contact_email = validateInput($_POST['contact_email']);
$status = validateInput($_POST['status']);
$sponsor = validateInput($_POST['sponsor']);
// $research_area = validateInput($_POST['research_area']);




  $query = "INSERT INTO tbl_projects (u_id,title,short_name,period,
     description, contact_name,contact_email, status, sponsor)
    VALUES ('$u_id','$title','$short_name','$period','$description',
    '$contact_name','$contact_email','$status','$sponsor')";

    $result = $db_conn->query($query);

// MAKE project directory for images
// if it doesnt exist
    // $query2 = "SELECT * FROM tbl_projects";
    //
    // $result2 = $db_conn->query($query2);
    //
    // // $row = $result2->fetch_assoc();
    // while ($row = $result2->fetch_assoc() ) {
    //
    //     $project_id = $row['id'];
    //     if (file_exists ("../uploads/$project_id") == false) {
    //       mkdir("../uploads/$project_id",0777, true);
    //
    //     }
    //     // echo file_exists ("uploads/$project_id");
    // }


    // if ($result){
    $url=$_SESSION['last_url'];
    header("location:../projects.php");    // }
    // else {
    //   $queryError = 'Could not insert values.';
    // }


}



 ?>
