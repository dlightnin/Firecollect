<?php

  function LogOut()
  {
    session_start() ;
    session_unset();
    session_destroy();

  }

  if(isset($_GET['exit']))
  {
    LogOut() ;
    header('Location:../../../index.php');
  }

?>
