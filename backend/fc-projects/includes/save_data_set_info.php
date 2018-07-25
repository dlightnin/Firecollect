<?php
session_start();

require '../../includes/dbConnect.php' ;


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

// $project_id = $_SESSION['current_project_id'];

if (isset($_POST['add_data_set'])){
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
$project_id = validateInput($_POST['project_id']);




  $query = "INSERT INTO tbl_data_set (project_id,name,description,method,period,times, periodicity, reference,cross_reference, keywords, observations,formula)
    VALUES ('$project_id','$name','$description','$method','$period', '$times',
    '$periodicity','$reference','$cross_reference','$keywords','$observations','$formula')";

    $result = $db_conn->query($query) or die(mysqli_error($db));

    // the following query and result insert the searchable data into a specific table used to display the data later in the data search
    // $testing = "select p.contact_name, i.inst_name from tbl_projects p, tbl_data_set d, tbl_institution i, tbl_user_info u where d.project_id = p.id and p.u_id = u.u_id and u.institution_id = i.inst_name" ;
    // $dquery = "INSERT INTO tbl_dsearch_data (id, title, description, contact/author, institution)" ;
    //







// // MAKE DIRECTORIES FOR DATAFILES
//       $query3 = "SELECT * FROM tbl_data_set";
//
//       $result3 = $db_conn->query($query3);
//
//       // $row = $result3->fetch_assoc();
//       while ($row = $result3->fetch_assoc() ) {
//
//           $ds_id = $row['id'];
//           if (file_exists ("../uploads/$project_id/datasets") == false) {
//             mkdir("../uploads/$project_id/datasets",0777, true);
//
//           }
//           // echo file_exists ("uploads/$project_id");
//       }
//
//
//       $result3 = $db_conn->query($query3);
//
//       // $row = $result3->fetch_assoc();
//       while ($row = $result3->fetch_assoc() ) {
//
//           $ds_id = $row['id'];
//           if (file_exists ("../uploads/$project_id/datasets/$ds_id") == false) {
//             mkdir("../uploads/$project_id/datasets/$ds_id",0777, true);
//
//           }
//           // echo file_exists ("uploads/$project_id");
//       }



//
      // $query2= "SELECT * FROM tbl_data_set where project_id='$project_id' AND name ='$name' ";
      //
      // $result = $db_conn->query($query2);
      //
      // // $row = $result->fetch_assoc();
      // // echo $row['status'];
      //
      //
      //
      // $row = $result->fetch_assoc();
      //   # code...
      //   $data_set_id = $row['id'];
      //
      //   $_SESSION['current_data_set_id']= $data_set_id;



    if ($result){
      $url=$_SESSION['last_url'];
      header("location: $url");

    }
    else {
      $queryError = 'Could not insert values.';
      echo $queryError;
    }
    //

}



 ?>
