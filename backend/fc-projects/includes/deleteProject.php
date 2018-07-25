<?php
require '../../includes/dbConnect.php';
// include '../projects.php' ;

if(isset($_POST['del']))
{
  $del = $_POST['del'];
  $check = "SELECT * from tbl_projects where id = '$del'" ;
  $result = $db_conn->query($check) ;
  $res = $result->fetch_assoc() ;

// if not already in trash
  if($res['deleted'] == 0)
  {

    $db_conn->query("UPDATE tbl_projects Set deleted = 1 where id = '$del'" );
    // send project datasets to trash
    $db_conn->query("UPDATE tbl_data_set Set deleted = 1 where project_id = '$del'");
    // select all datasets that are associated with project id

    $result2 =$db_conn->query( "SELECT * from tbl_data_set where project_id = '$del'");
    while ($row = $result2->fetch_assoc() ) {
        $ds_id=$row['id'];
        // set all variables associated with ds_id as deleted
        $db_conn->query("UPDATE tbl_variables Set deleted = 1 where data_set_id= '$ds_id'" );
        // set all data files associated with ds_id as deleted
        $db_conn->query("UPDATE tbl_data_files Set deleted = 1 where data_set_id= '$ds_id'");

        echo "Trash";
    //
    //
        }
  }




  elseif($res['deleted'] == 1)
  {

    // select all datasets that are associated with project id
    // $query_v = "SELECT * tbl_data_set where project_id = '$del'" ;
    // $result3 =$db_conn->query($query_v);
    // // Delete variables and datafiles before deleting the data sets
    // while ($row2 = $result3->fetch_assoc() ) {
    //   $ds_id=$row2['id'];
    //   // set all variables associated with ds_id as deleted
    //   $query_ds = "DELETE FROM tbl_variables  where data_set_id= '$ds_id'" ;
    //   $db_conn->query($query_ds);
    //   // set all data files associated with ds_id as deleted
    //   $query_df = "DELETE FROM tbl_data_files  where data_set_id= '$ds_id'" ;
    //   $db_conn->query($query_df);
    // }
    //
    // // send project datasets to trash
    // $query_ds = "DELETE FROM tbl_data_set  where project_id = '$del'" ;
    // $db_conn->query($query_ds);
    // delete project
    $query2 = "DELETE FROM tbl_projects WHERE id = '$del'";
    $db_conn->query($query2);
    echo "Deleted";
  }

}

?>
