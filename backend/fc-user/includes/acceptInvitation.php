<?php
  require '../../includes/dbConnect.php' ;
  session_start() ;
  $U = $_SESSION['user_id'] ;

  if(isset($_POST['p_id']) and isset($_POST['r_id']))
  {
     $P = $_POST['p_id'] ;
     $R = $_POST['r_id'] ;
     $db_conn->query("INSERT into tbl_collaborators(user_id,p_id) values('$U','$P')") ;
     $db_conn->query("DELETE FROM tbl_requests where request_id=$R") ;
     echo "invite was accepted";
  }
?>

<script>
  // window.history.back();
</script>
