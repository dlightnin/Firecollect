<?php
require '../../includes/dbConnect.php';


if(isset($_POST['del']))
{
  $del = $_POST['del'];
  $check = "SELECT * from tbl_data_set where id = '$del'" ;
  $result = $db_conn->query($check) ;
  $res = $result->fetch_assoc() ;

  if($res['deleted'] == 0)
  {

    $query = "UPDATE tbl_data_set Set deleted = 1 where id = '$del'" ;
    $db_conn->query($query);

  }

  elseif($res['deleted'] == 1)
  {
    $query2 = "DELETE FROM tbl_data_set WHERE id = '$del'";
    $db_conn->query($query2);
  }
}


?>
