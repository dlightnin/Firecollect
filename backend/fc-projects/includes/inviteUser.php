<?php
require '../../includes/dbConnect.php' ;
session_start() ;
$s = $_SESSION['user_id'] ;


  if(isset($_POST['users']))
  {
    $p = $_POST['p_id'] ;
    for ($i=0; $i < sizeof($_POST['users']) ; $i++)
    {
       $u = $_POST['users'][$i] ;
       $db_conn->query("INSERT into tbl_requests(project_id,receiver_id,sender_id) values( '$p','$u','$s')") ;
    }

  }
  $_SESSION['invited'] = 1 ;


 ?>
<script>
    window.history.back();
</script>
