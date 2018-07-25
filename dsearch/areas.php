<?php
include '../includes/dbConn.php' ;

$query = "SELECT A.name FROM tbl_area A" ;
$result = mysqli_query($db_conn,$query) ;
$rowNums = mysqli_num_rows($result) ;

if(mysqli_num_rows($result) > 0){

  echo "<select id=researchAreas style=width:175px>" ;
  while($row = mysqli_fetch_array($result)){
    echo "<option value='".$row['name']."'>".$row['name']."</option>" ;
  }
  echo "</select>" ;
}
 ?>
