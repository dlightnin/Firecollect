<?php
require '../../includes/dbConnect.php' ;
session_start() ;
$u = $_SESSION['user_id'] ;

function validateInput($data){
  $data = trim(stripcslashes(htmlspecialchars($data)));
  return $data;


}

if (isset($_POST['save_image'])){
  $file = $_FILES['user_image'];
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
      if ($file_size < 5000000){
        $file_new_name = uniqid('',true).".".$file_ext;
        $file_dest= "../uploads/userImages/".$file_new_name;


        $old = "SELECT image_path FROM tbl_user_info where u_id = $u" ;
        $old = $db_conn->query($old) ;
        $oldPath = $old->fetch_assoc() ;
        if($oldPath['image_path'] != 'default.jpg')
        {
          exec('rm -f ../uploads/userImages/'.$oldPath['image_path']) ;
        }

        move_uploaded_file($file_tmp_name,$file_dest);
        $imageQuery = "UPDATE tbl_user_info SET image_path = '$file_new_name' where u_id = $u" ;
        $db_conn->query($imageQuery) ;

        $_SESSION['pic_change'] = 1 ;

        header("location:../myProfile.php") ;




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
