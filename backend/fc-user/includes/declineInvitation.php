<?php
  require '../../includes/dbConnect.php' ;


  if(isset($_POST['r_id']))
  {
     $R = $_POST['r_id'] ;
     $db_conn->query("DELETE FROM tbl_requests where request_id=$R") ;
     echo "invite was declined";

  }
?>

<script>
  // window.history.back();
</script>
