<?php
require '../../includes/dbConnect.php' ;

session_start();
$project_id =$_SESSION['current_project_id'];



function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}

$query2 = "SELECT * FROM tbl_projects";

// $resultb = $db_conn->query($query2);
//
// // $row = $resultb->fetch_assoc();
// while ($row = $resultb->fetch_assoc() ) {
//
//     $id = $row['id'];
//     if (file_exists ("../uploads/$id") == false) {
//       mkdir("../uploads/$id",0777, true);
//
//     }
//     // echo file_exists ("uploads/$project_id");
// }



$result2 = $db_conn->query($query2);

// $row = $result2->fetch_assoc();
while ($row = $result2->fetch_assoc() ) {

    $id = $row['id'];
    if (file_exists ("../uploads/$id/img") == false) {
      mkdir("../uploads/$id/img",0777, true);

    }
    // echo file_exists ("uploads/$project_id");
}

// $h= $_FILES['name'];

$ds          = DIRECTORY_SEPARATOR;  //1
$back_dir = '..';
$uploads= 'uploads';
$storeFolder = 'img';   //2

if (!empty($_FILES)) {

    $tempFile = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_error = $_FILES['file']['error'];

    // $targetPath = "/home/catec/public_html/firecollect_ts/backend/fc-projects/uploads/image_uploads/".$project_id.$ds;
    $targetPath = dirname( __FILE__ ).$ds .$back_dir.$ds.$uploads.$ds.$project_id.$ds.$storeFolder .$ds;

    $file_ext= explode('.',$file_name);
    $file_ext = strtolower(end($file_ext));
    $file_new_name = uniqid('',true).".".$file_ext;

// change to $file_new_name
    $targetFile =  $targetPath. $file_new_name;

    move_uploaded_file($tempFile,$targetFile);


// change to new name
    $query="INSERT INTO tbl_project_images (project_id, name, type, description, size, real_name)
             VALUES ('$project_id','$file_new_name','$file_type','','$file_size','$targetFile')";
    $db_conn->query($query);

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
