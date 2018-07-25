<?php
require '../../includes/dbConnect.php' ;

session_start();

$fname = trim(stripslashes(strip_tags($_POST['fname'])));
$lname = trim(stripslashes(strip_tags($_POST['lname'])));
$gen = stripslashes(strip_tags($_POST['gender']));
$inst = stripslashes(strip_tags($_POST['inst']));
$phone = trim(stripslashes(strip_tags($_POST['phone'])));
$country = stripslashes(strip_tags($_POST['country']));
$city = trim(stripslashes(strip_tags($_POST['city'])));
$pos = trim(stripslashes(strip_tags($_POST['pos'])));
$desc = trim(stripslashes(strip_tags($_POST['desc'])));

$U = $_SESSION['user_id'] ;


$query = "UPDATE tbl_user_info
          SET f_name =' $fname', l_name = '$lname', gender = '$gen', phone_number = '$phone', country = '$country', city = '$city', institution_id = '$inst', pos_id = '$pos', description = '$desc'
          where u_id = $U " ;

$db_conn->query($query) ;

$_SESSION['info_change'] = 1 ;

header('location:../myProfile.php') ;


 ?>
