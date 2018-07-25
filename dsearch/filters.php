<?php
  // $Q = array() ;
  session_start() ;

  include '../includes/dbConnect.php' ;
  include 'dsearchContainers.php' ;

  $rowNums = 0 ;
  $filter = $_POST['checked_box'] ;

    if(isset($filter)){

      // array_push($Q, $filter) ;


      if($filter == 'projects'){
        $query = "SELECT P.title, P.description, U.f_name, U.l_name, I.inst_name FROM tbl_projects P, tbl_user_info U, tbl_institution I WHERE P.u_id = U.u_id AND U.institution_id = I.inst_id AND P.deleted = 0 AND P.status = 1" ;
        $result = mysqli_query($db_conn,$query) ;
        $rowNums += mysqli_num_rows($result) ;
      }
      else if($filter == 'datasets'){
        $query2 = "SELECT @temp='null', D.description, P.title, P.contact_name, I.inst_name, D.name FROM tbl_data_set D, tbl_projects P, tbl_user_info U, tbl_institution I
                         WHERE D.deleted = 0 and P.deleted = 0 and U.institution_id = I.inst_id and D.project_id = P.id and P.u_id = U.u_id" ;
        $result2 = mysqli_query($db_conn,$query2) ;
        $rowNums += mysqli_num_rows($result2) ;

      }
      else if($filter == "datafiles"){

        $query = "SELECT @temp='null', D.description, P.title, P.contact_name, I.inst_name, D.name
                  FROM tbl_data_set D, tbl_projects P, tbl_user_info U, tbl_institution I
                  WHERE D.deleted = 0 and P.deleted = 0 and D.status = 1 and U.institution_id = I.inst_id and D.project_id = P.id and P.u_id = U.u_id and D.id in (SELECT df.data_set_id
                                                                                                                                                                   from tbl_data_files df, tbl_data_set ds
                                                                                                                                                                   where ds.id = df.data_set_id and ds.status = 1 and ds.deleted = 0)";
        $result2 = mysqli_query($db_conn,$query2) ;
        $rowNums += mysqli_num_rows($result2) ;

      }

    }


            $_SESSION["numRows"] = $rowNums ;
            // if no filters are selected and user uses search OR id project filter selected
            if(mysqli_num_rows($result) > 0) {

                while($row = mysqli_fetch_array($result)) {

                  projectContainer($row) ;

                }

            }
          // if datasearch filter selected only
          else if(mysqli_num_rows($result2) > 0){

            while($row = mysqli_fetch_array($result2)){

              datasetContainer($row) ;

            }
          }
          //if nothing was found
          else {
            $_SESSION["numRows"] = 0 ;
          }


          mysqli_close() ;


 ?>
