<?php
include '../includes/dbConnect.php' ;

$authorName = $_POST["query"] ;

// ############################################### BY AUTHER SEARCH BAR ###############################################

if(isset($authorName)){

  $output = "" ;
  $byAuthorQuery = "SELECT f_name, l_name FROM tbl_user_info WHERE f_name LIKE '%$authorName%' or l_name LIKE '%$authorName%'" ;
  $byAuthorResult = mysqli_query($db_conn, $byAuthorQuery) ;

  if(mysqli_num_rows($byAuthorResult) > 0){
    // echo "<ul id=au>" ;
    while($row = mysqli_fetch_array($byAuthorResult)){
      $value = $row['f_name']." ".$row['l_name'] ;
      echo "<section id='au' value=$value>".$value."</section>" ;
    } // while
    // echo "</ul>" ;
  } // if
  else{
    echo "No Results" ;
  }// else
} // if isset

?>
