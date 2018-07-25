<?php
require '../../includes/dbConnect.php';
// include '../projects.php' ;

if(isset($_POST['del']))
{
  $del = $_POST['del'];
  $check = "SELECT * from tbl_variables where id = '$del'" ;
  $result = $db_conn->query($check) ;
  $res = $result->fetch_assoc() ;

// if not already in trash
  if($res['deleted'] == 0)
  {
    // set all variables associated with ds_id as deleted
    $db_conn->query("UPDATE tbl_variables Set deleted = 1 where id= '$del'" );

  }

  elseif($res['deleted'] == 1)
  {

    // delete variable
    $db_conn->query("DELETE FROM tbl_variables WHERE id = '$del'");

  }

}

?>
