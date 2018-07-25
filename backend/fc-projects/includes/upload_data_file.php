<?php
require '../../includes/dbConnect.php' ;

session_start();


function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}

if (isset($_POST['data_file'])){
  $file = $_FILES['data_file'];
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

  $file_ext= explode('.',$file_name);
  $file_ext = strtolower(end($file_ext));
  $allowed = array('jpg','jpeg','png','gif');
  // if extension is inside array
  if (in_array($file_ext, $allowed)){
    if($file_error===0){
      if ($file_size < 500000){
        $file_new_name = uniqid('',true).".".$file_ext;
        $file_dest= "uploads/".$file_new_name;
        move_uploaded_file($file_tmp_name,$file_dest);
        echo $file_dest;
        echo "FILE UPLOADED SUCCESSFULLY";




      }else {
        echo "The file size is too big";
      }

    } else {
      echo "there was an error uploading the file";
    }



  }else {
    echo "upload a jpg, jpeg, png or gif file";
  }




}
?>
