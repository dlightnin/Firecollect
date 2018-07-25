<?php
require '../../includes/dbConnect.php' ;

session_start();
$project_id =$_SESSION['current_project_id'];



function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}

if (isset($_POST['save_image'])){
  $file = $_FILES['project_image'];
  $file_name= $file['name'];
  $file_type =$file['type'];
  $file_tmp_name = $file['tmp_name'];
  $file_size = $file['size'];
  $file_error = $file['error'];
  echo "file name: ".$file_name."<br>";
  echo "file size: ".$file_size."<br>";
  echo "file tmp name: ".$file_tmp_name."<br>";
  echo "file type: ".$file_type."<br>";
  echo "file error: ".$file_error."<br>";


  // $retcode = cl_scanfile($file_tmp_name, $virusname);
  //          if ($retcode == CL_VIRUS) {
  //              echo "File path : ".$file."Return code : ".cl_pretcode($retcode)."Virus found name : ".$virusname;
  //          } else {
  //              echo "File path : ".$file."Return code : ".cl_pretcode($retcode);
  //          }
     // echo shell_exec("sudo su clamdscan uploads/");
exec('/usr/bin/clamdscan  --stdout --fdpass '.$file_tmp_name, $output, $return);
print "<pre>";
print_r($output);
echo $return;
echo "<br>";

// echo substr($output[3],16) ;

// echo $res;
//
//   $file_ext= explode('.',$file_name);
//   $file_ext = strtolower(end($file_ext));
//   $allowed = array('jpg','jpeg','png','gif');
//   // if extension is inside array
//   if (in_array($file_ext, $allowed)){
//     if($file_error===0){
//       if ($file_size < 500000){
//         $file_new_name = uniqid('',true).".".$file_ext;
//         $file_dest= "uploads/".$project_id."/".$file_new_name;
//
//         $query="INSERT INTO tbl_project_images (project_id, name, type, description, size, real_name)
//         VALUES ('$project_id','$file_new_name','$file_type','','$file_size','')";
//         $db_conn->query($query);
//         move_uploaded_file($file_tmp_name,$file_dest);
//         echo $file_dest;
//         echo "FILE UPLOADED SUCCESSFULLY";
//         header("location: ../user_project.php?id=$project_id");
//
//
//
//
//       }else {
//         echo "The file size is too big";
//       }
//
//     } else {
//       echo "there was an error uploading the file";
//     }
//
//
//
//   }else {
//     echo "upload a jpg, jpeg, png or gif file";
//   }
//
//
//
//
}
?>
