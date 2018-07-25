<?php
session_start() ;

    include '../includes/dbConnect.php' ;
    include 'dsearchContainers.php' ;


      $rowNums = 0 ;
      $sort = $_POST['sortData'] ;
      $filters = $_POST['array'] ;





      if(isset($filters)){

        if(isset($sort)){

          for($i=0; $i<sizeof($filters); $i++){

            if(in_array('projects', $filters)){
                    if(in_array('datasets', $filters)){
                            if(in_array('publications', $filters)){
                                  if(in_array('datafiles', $filters)){
                                    // if projects datasets publications datafiles
                                  }
                                  else{
                                    // if projects datasets publications
                                  }
                            }
                            else if(in_array('datafiles', $filters)){
                              // if projects datasets datafiles
                            }
                            else{
                              // if projects datasets
                              // sort($sort) ; pense hacer una funcion pero vamoa ver

                              if($sort == 'order'){

                                  $query = "SELECT * FROM (
                                              SELECT @temp:='project', p.title, p.description, p.contact_name, i.inst_name, @temp2='dataset_name'
                                              FROM tbl_projects p, tbl_institution i
                                              WHERE p.status = 1 AND p.deleted = 0 AND i.inst_id IN (SELECT u.institution_id
                                                                                                     FROM tbl_user_info u
                                                                                                     WHERE p.u_id = u.u_id)
                                          		UNION
                                          	SELECT @temp:='dataset', p.title, d.description, p.contact_name, i.inst_name,d.name
                                              FROM tbl_data_set d, tbl_projects p, tbl_institution i
                                              WHERE d.status = 1 AND p.status = 1 AND d.deleted = 0 AND p.deleted = 0 AND d.project_id = 	p.id AND i.inst_id IN (SELECT u.institution_id
                                                                                                                                                                 FROM tbl_user_info u
                                                                                                                                                                 WHERE p.u_id = u.u_id)
                                            ) AS data ORDER BY title ASC";


                                  $result = mysqli_query($db_conn,$query) ;
                                  $rowNums += mysqli_num_rows($result) ;
                              }
                              else if($sort == 'reverse'){
                                  $query = "SELECT * FROM (
                                              SELECT @temp:='project', p.title, p.description, p.contact_name, i.inst_name, @temp2='dataset_name'
                                              FROM tbl_projects p, tbl_institution i
                                              WHERE p.status = 1 AND p.deleted = 0 AND i.inst_id IN (SELECT u.institution_id
                                                                                                     FROM tbl_user_info u
                                                                                                     WHERE p.u_id = u.u_id)
                                          		UNION
                                          	SELECT @temp:='dataset', p.title, d.description, p.contact_name, i.inst_name,d.name
                                              FROM tbl_data_set d, tbl_projects p, tbl_institution i
                                              WHERE d.status = 1 AND p.status = 0 AND d.deleted = 0 AND p.deleted = 0 AND d.project_id = 	p.id AND i.inst_id IN (SELECT u.institution_id
                                                                                                                                                                 FROM tbl_user_info u
                                                                                                                                                                 WHERE p.u_id = u.u_id)
                                            ) AS data ORDER BY title DESC";

                                  $result = mysqli_query($db_conn,$query) ;
                                  $rowNums += mysqli_num_rows($result) ;
                              }
                              // else if($sort == 'recent'){
                              //
                              // }
                              // else if($sort == 'oldest'){
                              //
                              // }



                            }

                    }
                    else if (in_array('publications', $filters)){
                            if(in_array('datafiles', $filters)){
                              // if projects publications datafiles
                            }
                            else{
                              // if projects publiations
                            }
                    }
                    else if(in_array('datafiles', $filters)){
                      // if projects datafiles

                    }
                    else{
                          // if projects
                          if($sort == 'order'){
                              $query = "SELECT P.title, P.description, U.f_name, U.l_name, I.inst_name
                                        FROM tbl_projects P, tbl_user_info U, tbl_institution I
                                        WHERE P.u_id = U.u_id AND U.institution_id = I.inst_id AND P.deleted = 0 AND P.status = 1 ORDER BY P.title asc" ;
                              $result = mysqli_query($db_conn,$query) ;
                              $rowNums += mysqli_num_rows($result) ;
                          }
                          else if($sort == 'reverse'){
                              $query = "SELECT P.title, P.description, U.f_name, U.l_name, I.inst_name
                                        FROM tbl_projects P, tbl_user_info U, tbl_institution I
                                        WHERE P.u_id = U.u_id AND U.institution_id = I.inst_id AND P.deleted = 0 AND P.status = 1 ORDER BY P.title desc" ;
                              $result = mysqli_query($db_conn,$query) ;
                              $rowNums += mysqli_num_rows($result) ;
                          }
                          // else if($sort == 'recent'){
                          //
                          // }
                          // else if($sort == 'oldest'){
                          //
                          // }
                    }
            }

            else if(in_array('datasets', $filters)){
                  if(in_array('publications', $filters)){
                        if(in_array('datafiles', $filters)){
                          // if datasets publications datafiles
                        }
                        else{
                          // if datasets publications
                        }
                  }
                  else if(in_array('datafiles', $filters)){
                    // if datasets datafiles
                  }
                  else{

                        if($sort == 'order'){
                            $query2 = "SELECT D.name, D.description, P.title, P.contact_name, I.inst_name
                                       FROM tbl_data_set D, tbl_projects P, tbl_user_info U, tbl_institution I
                                       WHERE D.deleted = 0 and P.deleted = 0 and U.institution_id = I.inst_id and D.project_id = P.id and P.u_id = U.u_id ORDER BY D.name asc" ;
                            $result2 = mysqli_query($db_conn,$query2) ;
                            $rowNums += mysqli_num_rows($result2) ;
                        }
                        else if($sort == 'reverse'){
                            $query2 = "SELECT D.name, D.description, P.title, P.contact_name, I.inst_name
                                       FROM tbl_data_set D, tbl_projects P, tbl_user_info U, tbl_institution I
                                       WHERE D.deleted = 0 and P.deleted = 0 and U.institution_id = I.inst_id and D.project_id = P.id and P.u_id = U.u_id ORDER BY D.name desc" ;
                            $result2 = mysqli_query($db_conn,$query2) ;
                            $rowNums += mysqli_num_rows($result2) ;
                        }
                        // else if($sort == 'recent'){
                        //
                        // }
                        // else if($sort == 'oldest'){
                        //
                        // }

                      }
            }
            else if(in_array('publications', $filters)){
                  if(in_array('datafiles', $filters)){
                    // if publications datafiles
                  }
                  else{
                    // if publications
                  }
                }
            else{
              // if datafiles
            }

          } // for

        } // ISSET SORT

      else{


        // NO SORT SELECTED

      }

    } // ISSET FILTERS

      $_SESSION["numRows"] = $rowNums ;
      // if no filters are selected and user uses search OR id project filter selected
      if(mysqli_num_rows($result) > 0) {

          while($row = mysqli_fetch_array($result)) {

            if($row[0]=='project'){
              projectContainer($row) ;

            }
            else if($row[0]=='dataset'){
              datasetContainer($row) ;

            }

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
      // echo "No" ;
    }


    mysqli_close() ;

 ?>
