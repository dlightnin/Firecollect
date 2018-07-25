<?php
require '../../includes/dbConnect.php' ;

session_start();
$project_id =$_SESSION['current_project_id'];

// if (isset($_POST['file_name'])) {

  if (!empty($_POST['del_arr'])){
    $del_arr= json_decode(stripslashes($_POST['del_arr']));

  // here i would like use foreach:

  foreach($del_arr as $file_id){
     // echo $file_id;

     $query = "SELECT file_path FROM tbl_data_files WHERE id = '$file_id'";
     $result = $db_conn->query($query);

     // $row = $result->fetch_assoc();
     // echo $row['status'];



     $row = $result->fetch_assoc();
       $file_path= $row['file_path'];


       if (unlink($file_path)){
           echo "$file_id deleted";
       }


     $query2 = "DELETE FROM tbl_data_files WHERE id = '$file_id'";
     $db_conn->query($query2);

  }
    // $file_id = $_POST['file_id'];
    // if ($_POST['type'] == 'img'){

    // }
  }
  if (!empty($_POST['file_id'])){
        $file_id = $_POST['file_id'];
         $query = "SELECT file_path FROM tbl_data_files WHERE id = '$file_id'";
         $result = $db_conn->query($query);

         $row = $result->fetch_assoc();
           $file_path= $row['file_path'];


           if (unlink($file_path)){
               echo "$file_id deleted";
           }


         $query2 = "DELETE FROM tbl_data_files WHERE id = '$file_id'";
         $db_conn->query($query2);

  }
  // $file_name = $_POST['file_name'];

  // $check = "SELECT * from tbl_project_images where name = '$file_name'" ;
  // $result = $db_conn->query($check) ;
  // $res = $result->fetch_assoc() ;


  // $query2 = "DELETE FROM tbl_project_images WHERE name = '$file_name'";

  // $db_conn->query($query2);
  // unlink("uploads/$file_name");

// }

  ?>
