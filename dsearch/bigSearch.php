<?php
session_start() ;

    include '../includes/dbConnect.php' ;

      $rowNums = 0 ;

      $q = $_POST['variable'] ;


      if($q!=""){
        $query = "SELECT P.title, P.description, P.contact_name, I.inst_name FROM tbl_projects P, tbl_institution I
                  WHERE (P.title LIKE '%$q%') AND P.status = 1 AND P.deleted = 0 and I.inst_name in ( select distinct(I.inst_name) from tbl_institution I, tbl_user_info U where I.inst_id = U.institution_id)" ;
        // "SELECT P.title, P.description, U.f_name, U.l_name, I.inst_name FROM tbl_projects P, tbl_user_info U, tbl_institution I
        //           WHERE (P.title LIKE '%$q%') or (P.description LIKE '%$q%') and (P.u_id = U.u_id) AND (U.institution_id = I.inst_id) AND (P.deleted = 0) AND (P.status = 0)" ;

        $query2 = "SELECT D.name, D.description, P.title, P.contact_name, I.inst_name FROM tbl_data_set D, tbl_projects P, tbl_institution I
                   WHERE (D.name LIKE '%$q%') or (P.title LIKE '%$q%') and D.deleted = 0 and P.deleted = 0 and D.project_id = P.id and I.inst_id in (select distinct(I.inst_name) from tbl_institution I, tbl_user_info U where I.inst_id = U.institution_id) " ;

        // $query3 = "";

        // $query4 = "";

        $result = mysqli_query($db_conn,$query) ;
        $result2 = mysqli_query($db_conn,$query2) ;

        $rowNums += mysqli_num_rows($result) + mysqli_num_rows($result2);


      }




?>
