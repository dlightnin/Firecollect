<?php
session_start() ;

    include '../includes/dbConnect.php' ;

      $rowNums = 0 ;

      $q = $_POST['variable'] ;
      $filter = $_POST['checked_box'] ;
      $sort = $_POST['sortData'] ;
      $authorName = $_POST["query"] ;

      // ############################################### BY AUTHER SEARCH BAR ###############################################

      if(isset($authorName)){

        $output = "" ;
        $byAuthorQuery = "SELECT f_name, l_name FROM tbl_user_info WHERE f_name LIKE '%$authorName%' or l_name LIKE '%$authorName%'" ;
        $byAuthorResult = mysqli_query($db_conn, $byAuthorQuery) ;

        if(mysqli_num_rows($byAuthorResult) > 0){
          while($row = mysqli_fetch_array($byAuthorResult)){
            echo $row["f_name"]." ".$row["l_name"]."</br>" ;
          } // while
        } // if
        else{
          echo "No Results" ;
        }// else
      } // if isset

      // ############################################### BY AUTHER SEARCH BAR ###############################################



      // ############################################### FILTER AND SORT QUERIES ###############################################


      if($q!=""){
        $query = "SELECT P.title, P.description, P.contact_name, I.inst_name FROM tbl_projects P, tbl_institution I
                  WHERE (P.title LIKE '%$q%') AND P.status = 1 AND P.deleted = 0 and I.inst_name in ( select distinct(I.inst_name) from tbl_institution I, tbl_user_info U where I.inst_id = U.institution_id)" ;
        // "SELECT P.title, P.description, U.f_name, U.l_name, I.inst_name FROM tbl_projects P, tbl_user_info U, tbl_institution I
        //           WHERE (P.title LIKE '%$q%') or (P.description LIKE '%$q%') and (P.u_id = U.u_id) AND (U.institution_id = I.inst_id) AND (P.deleted = 0) AND (P.status = 0)" ;

        $query2 = "SELECT D.name, D.description, P.title, P.contact_name, I.inst_name FROM tbl_data_set D, tbl_projects P, tbl_institution I
                   WHERE (D.name LIKE '%$q%') or (P.title LIKE '%$q%') and D.deleted = 0 and P.deleted = 0 and D.project_id = P.id and I.inst_id in (select distinct(I.inst_name) from tbl_institution I, tbl_user_info U where I.inst_id = U.institution_id) " ;


        $result = mysqli_query($db_conn,$query) ;
        $result2 = mysqli_query($db_conn,$query2) ;

        $rowNums += mysqli_num_rows($result) + mysqli_num_rows($result2);


      }
      if(isset($filter)){
        if(isset($sort)){ // YES SORT
          // if($filter = 'projects' and $sort='recent') {
          //   // dummy until i add timestamp to projects. this should be the default sort being applied to projects
          //       $query = "SELECT P.title, P.description, U.f_name, U.l_name, I.inst_name FROM tbl_projects P, tbl_user_info U, tbl_institution I WHERE P.u_id = U.u_id AND U.institution_id = I.inst_id AND P.deleted = 0 AND P.status = 1" ;
          //       $result = mysqli_query($db_conn,$query) ;
          //       $rowNums += mysqli_num_rows($result) ;
          // }
            // else if($filter = 'projects' and $sort = 'recent'  ) {
            //   // dummy until i add timestamp to projects. this should be the default sort being applied to projects
            //       $query = "SELECT P.title, P.description, U.f_name, U.l_name, I.inst_name FROM tbl_projects P, tbl_user_info U, tbl_institution I WHERE P.u_id = U.u_id AND U.institution_id = I.inst_id AND P.deleted = 0 AND P.status = 1" ;
            //       $result = mysqli_query($db_conn,$query) ;
            //       $rowNums += mysqli_num_rows($result) ;
            // }
            // if($sort='order' and $filter='projects'){
            //   $query = "SELECT P.title, P.description, U.f_name, U.l_name, I.inst_name FROM tbl_projects P, tbl_user_info U, tbl_institution I WHERE P.u_id = U.u_id AND U.institution_id = I.inst_id AND P.deleted = 0 AND P.status = 1 ORDER BY P.title asc" ;
            //   $result = mysqli_query($db_conn,$query) ;
            //   $rowNums += mysqli_num_rows($result) ;
            //
            // }
            // else if($sort='reverse' and $filter='projects'){
            //   $query = "SELECT P.title, P.description, U.f_name, U.l_name, I.inst_name FROM tbl_projects P, tbl_user_info U, tbl_institution I WHERE P.u_id = U.u_id AND U.institution_id = I.inst_id AND P.deleted = 0 AND P.status = 1 ORDER BY P.title desc" ;
            //   $result = mysqli_query($db_conn,$query) ;
            //   $rowNums += mysqli_num_rows($result) ;
            //
            // }
            // else if($filter='datasets') {
            //       $query2 = "SELECT D.name, D.description, P.title, P.contact_name, I.inst_name FROM tbl_data_set D, tbl_projects P, tbl_user_info U, tbl_institution I
            //                 WHERE D.deleted = 0 and P.deleted = 0 and U.institution_id = I.inst_id and D.project_id = P.id and P.u_id = U.u_id" ;
            //       $result2 = mysqli_query($db_conn,$query2) ;
            //       $rowNums += mysqli_num_rows($result2) ;
            //
            // }
      }
      else{ // NO SORT
        if($filter = 'projects'){
        $query = "SELECT P.title, P.description, U.f_name, U.l_name, I.inst_name FROM tbl_projects P, tbl_user_info U, tbl_institution I WHERE P.u_id = U.u_id AND U.institution_id = I.inst_id AND P.deleted = 0 AND P.status = 1" ;
        $result = mysqli_query($db_conn,$query) ;
        $rowNums += mysqli_num_rows($result) ;
        }
        else if($filter = 'datasets'){
          $query2 = "SELECT D.name, D.description, P.title, P.contact_name, I.inst_name FROM tbl_data_set D, tbl_projects P, tbl_user_info U, tbl_institution I
          //                 WHERE D.deleted = 0 and P.deleted = 0 and U.institution_id = I.inst_id and D.project_id = P.id and P.u_id = U.u_id" ;
          //       $result2 = mysqli_query($db_conn,$query2) ;
          //       $rowNums += mysqli_num_rows($result2) ;

        }
      }
    }


        $_SESSION["numRows"] = $rowNums ;
        // if no filters are selected and user uses search OR id project filter selected
        if(mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_array($result)) {

              echo "<section id=resultSectionP value=projectDiv style='box-shadow: 3px 3px 3px #FD6B25;margin-top:35px;'>
                      <div id=resultSectionImage  class=col-sm-2>
                        <img src=imgs/fc_dummy_search.png align=center style=padding-top:10px;width:100%;height:80%;>

                        <i class='fa fa-plus' style='font-size:22px;margin-top:15px;color:#0f758d;'></i>
                        <i class='fa fa-share' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>
                        <i class='fa fa-eye' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>
                        <i class='fa fa-bars' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>


                      </div>
                      <div style=margin-top:5px id=resultSectionInfo class=col-sm-10 >
                          <h3><b>Project Title:</b> ".$row['title']."</h3>
                            <h5><b>Author: </b>".$row['f_name']."".$row['l_name']."</h5>
                            <h5><b>Institution: </b>".$row['inst_name']."</h5>
                            <h5 id=descrip ><b>Description: </b>".$row['description']." </h5>
                      </div>
                    </section>
                    ";

            }
            if(mysqli_num_rows($result2) > 0) {
            while($row = mysqli_fetch_array($result2)){
              echo "<section id=resultSectionD value=dataSetDiv style='box-shadow: 3px 3px 3px #19758B;margin-top:35px;'>
                      <div id=resultSectionImage  class=col-sm-2>
                        <img src=imgs/fc_dummy_search.png align=center style=padding-top:10px;width:100%;height:80%;>

                        <i class='fa fa-plus' style='font-size:22px;margin-top:15px;color:#0f758d;'></i>
                        <i class='fa fa-share' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>
                        <i class='fa fa-eye' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>
                        <i class='fa fa-bars' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>


                      </div>
                      <div style=margin-top:5px id=resultSectionInfo class=col-sm-10 >
                          <h3><b>Dataset Title: </b>".$row['name']."</h3>
                            <h5><b>Parent Project: </b>".$row['title']."</h5>
                            <h5><b>Contact: </b>".$row['contact_name']."</h5>
                            <h5><b>Institution: </b>".$row['inst_name']."</h5>
                            <h5 id=descrip ><b>Description: </b>".$row['description']." </h5>
                      </div>
                    </section>";

            }
          }
      //
      }
      // if datasearch filter selected only
      elseif(mysqli_num_rows($result2) > 0){
        while($row = mysqli_fetch_array($result2)){
          echo "<section id=resultSectionD value=dataSetDiv style='box-shadow: 3px 3px 3px #19758B;margin-top:35px;'>
                  <div id=resultSectionImage  class=col-sm-2>
                    <img src=imgs/fc_dummy_search.png align=center style=padding-top:10px;width:100%;height:80%;>

                    <i class='fa fa-plus' style='font-size:22px;margin-top:15px;color:#0f758d;'></i>
                    <i class='fa fa-share' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>
                    <i class='fa fa-eye' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>
                    <i class='fa fa-bars' style='font-size:22px;margin-top:15px;color:#0f758d;padding-left:12px'></i>


                  </div>
                  <div style=margin-top:5px id=resultSectionInfo class=col-sm-10 >
                      <h3><b>Dataset Title: </b>".$row['name']."</h3>
                        <h5><b>Parent Project: </b>".$row['title']."</h5>
                        <h5><b>Contact: </b>".$row['contact_name']."</h5>
                        <h5><b>Institution: </b>".$row['inst_name']."</h5>
                        <h5 id=descrip ><b>Description: </b>".$row['description']." </h5>
                  </div>
                </section>";
        }
      }
      //if nothing was found
      else {
        // echo "0 results found!" ;
        $_SESSION["numRows"] = 0 ;
        // break ;
      }


    // $_SESSION["numRows"] = $rowNums ;
    // echo $tt ;
      mysqli_close() ;

 ?>
