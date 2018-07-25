<?php
require '../../includes/dbConnect.php' ;

session_start();
$project_id =$_SESSION['current_project_id'];
$data_set_id = $_SESSION['current_data_set_id'];






function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}

// $query3 = "SELECT * FROM tbl_data_set";
//
//
// $resulta = $db_conn->query($query3);
//
// // $row = $resulta->fetch_assoc();
// while ($row = $resulta->fetch_assoc() ) {
//
//     $ds_id = $row['id'];
//     if (file_exists ("../uploads/$project_id/datasets") == false) {
//       mkdir("../uploads/$project_id/datasets",0777, true);
//
//     }
//     // echo file_exists ("uploads/$project_id");
// }

$queryb = "SELECT * FROM tbl_data_set WHERE project_id='$project_id'";
//
// $resultb = $db_conn->query("SELECT * FROM tbl_data_set WHERE project_id='$project_id'");
//
// // $row = $resultb->fetch_assoc();
// while ($row2 = $resultb->fetch_assoc() ) {
//
//     $_id = $row2['id'];
//     if (file_exists ("../uploads/$project_id/datasets/$_id") == false) {
//       mkdir("../uploads/$project_id/datasets/$_id",0777, true);
//
//     }
//     // echo file_exists ("uploads/$project_id/datasets");
// }


$result3 = $db_conn->query($queryb);

// $row = $result3->fetch_assoc();
while ($row3 = $result3->fetch_assoc() ) {

    $id = $row3['id'];
    if (file_exists ("../uploads/$project_id/datasets/$id/datafiles") == false) {
      mkdir("../uploads/$project_id/datasets/$id/datafiles",0777, true);

    }
    // echo file_exists ("uploads/$project_id");
}

// $h= $_FILES['name'];

$ds          = DIRECTORY_SEPARATOR;  //1

$back_dir = '..';
$uploads= 'uploads';
$datasets= 'datasets';
$storeFolder = 'datafiles';   //2

if (!empty($_FILES)) {

    $file_tmp_name = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_error = $_FILES['file']['error'];


    $last_mod = "".date("F d Y H:i:s.",filemtime($file_tmp_name));

    // $last_mod = $POST['mod'];

    // $retcode = cl_scanfile($tempFile, $virusname);
    //          if ($retcode == CL_VIRUS) {
    //              echo "File path : ".$file."Return code : ".cl_pretcode($retcode)."Virus found name : ".$virusname;
    //          } else {
    //              echo "File path : ".$file."Return code : ".cl_pretcode($retcode);
    //          }

    exec('/usr/bin/clamdscan  --stdout --fdpass '.$file_tmp_name, $output, $return);
// print "<pre>";
// print_r($output);
// print_r($return);
// echo "<br>";
// ../uploads/datafile_uploads/


if ($return==0){
  // "/home/catec/public_html/firecollect_ts/backend/fc-projects/uploads/datafile_uploads/".$data_set_id.$ds
  $targetPath = dirname( __FILE__ ).$ds.$back_dir.$ds.$uploads.$ds.$project_id.$ds.$datasets.$ds.$data_set_id.$ds. $storeFolder.$ds;
  $dl_link = $uploads.$ds.$project_id.$ds.$datasets.$ds.$data_set_id.$ds. $storeFolder.$ds;
  $file_ext= explode('.',$file_name);
  $file_ext = strtolower(end($file_ext));
  $file_new_name = uniqid('',true).".".$file_ext;

// change to $file_new_name
  $targetFile =  $targetPath. $file_new_name;
$dl_link = $dl_link.$file_new_name;
  move_uploaded_file($file_tmp_name,$targetFile);


// change to new name
  $query="INSERT INTO tbl_data_files (title,data_set_id, file_name, file_type, file_size,file_path,last_mod,download_link)
           VALUES ('$file_name','$data_set_id','$file_new_name','$file_type','$file_size','$targetFile','$last_mod','$dl_link')";
  $db_conn->query($query);
  echo $return;
  // print_r ($_FILES);
  // echo $last_mod;

  // echo"<div>CLEANNN</div>";


}
echo $return;
// print_r ($_FILES);
// echo $last_mod;




}


// $query="INSERT INTO tbl_project_images (project_id, name, type, description, size, real_name)
// VALUES ('$project_id','$h','$file_type','','$file_size','')";
// $db_conn->query($query);

// if (isset($_POST['save_image']))
// $keys = ['name','type','tmp_name'];
// if (isset($_POST['file']))
//
// for ($i = 0; $i <= $n; $i++) {
//   $file_name= $file['name'];
//   $file_type =$file['type'];
//   $file_tmp_name = $file['tmp_name'];
//   $file_size = $file['size'];
//   $file_error = $file['error'];
//
// }
//
// (!empty($_FILES)) {
//   $file = $_FILES['file'];
//   $file_name= $file['name'];
//   $file_type =$file['type'];
//   $file_tmp_name = $file['tmp_name'];
//   $file_size = $file['size'];
//   $file_error = $file['error'];
//   echo "file name: ".$file_name."<br>";
//   echo "file size: ".$file_size."<br>";
//   echo "file tmp name: ".$file_tmp_name."<br>";
//   echo "file type: ".$file_type."<br>";
//   echo "file error: ".$file_error."<br>";
//
//   $file_ext= explode('.',$file_name);
//   $file_ext = strtolower(end($file_ext));
//   // $allowed = array('jpg','jpeg','png','gif');
//   // if extension is inside array
//   // if (in_array($file_ext, $allowed)){
//   //   if($file_error===0){
//   //     if ($file_size < 500000){
//         $file_new_name = uniqid('',true).".".$file_ext;
//         $file_dest= "uploads/".$file_new_name;
//
//         $query="INSERT INTO tbl_project_images (project_id, name, type, description, size, real_name)
//         VALUES ('$project_id','$file_new_name','$file_type','','$file_size','')";
//         $db_conn->query($query);
//         move_uploaded_file($file_tmp_name,$file_dest);
//         echo $file_dest;
//         echo "FILE UPLOADED SUCCESSFULLY";
//         // header("location: ../user_project.php?id=$project_id");
//
//
//
//   //
//   //     }else {
//   //       echo "The file size is too big";
//   //     }
//   //
//   //   } else {
//   //     echo "there was an error uploading the file";
//   //   }
//   //
//   //
//   //
//   // }else {
//   //   echo "upload a jpg, jpeg, png or gif file";
//   // }
//
//
//
//
// }
?>
