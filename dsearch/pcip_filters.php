<?php

                                //ORGANIZATION FILTERS

                                // if( (!$_POST['org1'] and !$_POST['org2']) or ($_POST['org1'] and $_POST['org2']) or ($_POST['clr']) ) {
                                //   // SELECTS ALL DATA FROM DATABASE
                                //     $query = 'SELECT T.id_index, T.subject, T.title, T.author, N.newspaper_name, T.page, T.suplement, T.illustration, T.date, O.organization
                                //               FROM tbl_index T, tbl_newspaper N, tbl_organization O
                                //               WHERE T.id_newspaper = N.id_newspaper and T.id_organization = O.id_organization' ;
                                // }
                                // else if($_POST['org1']){
                                //   $pucpr = $_POST['org1'] ;
                                //   // SELECTS ONLY DATA THAT WAS ENTERED BY PUCPR
                                //   $query = "SELECT T.id_index, T.subject, T.title, T.author, N.newspaper_name, T.page, T.suplement, T.illustration, T.date, O.organization
                                //             FROM tbl_index T, tbl_newspaper N, tbl_organization O
                                //             WHERE T.id_newspaper = N.id_newspaper AND T.id_organization = O.id_organization AND O.organization = '$pucpr' " ;
                                // }
                                // else if($_POST['org2']){
                                //   $pcip = $_POST['org2'] ;
                                //   // SELECTS ONLY DATA THAT WAS ENTETED BY PCIP
                                //   $query = "SELECT T.id_index, T.subject, T.title, T.author, N.newspaper_name, T.page, T.suplement, T.illustration, T.date, O.organization
                                //             FROM tbl_index T, tbl_newspaper N, tbl_organization O
                                //             WHERE T.id_newspaper = N.id_newspaper AND T.id_organization = O.id_organization AND O.organization = '$pcip' " ;
                                // } #end of ORGANIZATION FILTERS


                                if(count($Q)){
                                    #NEWSPAPER FILTERS
                                    for( $i = 0; $i < count($Q); $i++){
                                      $filter = $Q[$i] ;
                                      if($filter='projects'){
                                        $query = "SELECT P.title, U.u_id, U.f_name FROM tbl_projects P, tbl_user_info U WHERE P.u_id = U.u_id" ;

                                        // SELECTS SPECIFIC NEWSPAPER(S) INDEX(ES) THAT ARE IN RELATION WITH ORGANIZATION PCIP
                                        // "SELECT T.id_index, T.subject, T.title, T.author, N.newspaper_name, T.page, T.suplement, T.illustration, T.date, O.organization
                                        //           FROM tbl_index T, tbl_newspaper N, tbl_organization O
                                        //           WHERE T.id_newspaper = N.id_newspaper and T.id_organization = O.id_organization and O.organization = '$pcip' and N.newspaper_name = '$filter' ";
                                      }
                                      // else if($filter and $pucpr){
                                      //   // SELECTS SPECIFIC NEWSPAPER(S) INDEX(ES) THAT ARE IN RELATION WITH ORGANIZATION PUCPR
                                      //   $query = "SELECT T.id_index, T.subject, T.title, T.author, N.newspaper_name, T.page, T.suplement, T.illustration, T.date, O.organization
                                      //             FROM tbl_index T, tbl_newspaper N, tbl_organization O
                                      //             WHERE T.id_newspaper = N.id_newspaper and T.id_organization = O.id_organization and O.organization = '$pucpr' and N.newspaper_name = '$filter' ";
                                      // }
                                      // else if( ($filter and $pcip and $pucpr) or ($filter)){
                                      //   // SELECTS SPECIFIC NEWSPAPER(S) INDEX(ES) THAT ARE IN RELATION WITH BOTH ORGANIZATIONS
                                      //   $query = "SELECT T.id_index, T.subject, T.title, T.author, N.newspaper_name, T.page, T.suplement, T.illustration, T.date, O.organization
                                      //             FROM tbl_index T, tbl_newspaper N, tbl_organization O
                                      //             WHERE T.id_newspaper = N.id_newspaper and T.id_organization = O.id_organization and N.newspaper_name = '$filter' ";
                                      // }

                                      $result = $db_conn->query($query);

                                      if ($result->num_rows > 0) {
                                            // output data of each row
                                        while($row = $result->fetch_assoc()){

                                            // echo "<tr>" ;
                                            // echo "<td>".$row["id_index"].    "</td>" ;
                                            // echo "<td>".$row["subject"].     "</td>" ;
                                            // echo "<td>".$row["title"].       "</td>" ;
                                            // echo "<td>".$row["author"].      "</td>" ;
                                            // echo "<td>".$row["descriptor"].  "</td>" ;
                                            // echo "<td>".$row["newspaper_name"].   "</td>" ;
                                            // echo "<td>".$row["page"].        "</td>" ;
                                            // echo "<td>".$row["suplement"].   "</td>" ;
                                            // echo "<td>".$row["illustration"]."</td>" ;
                                            // echo "<td>".$row["date"].        "</td>" ;
                                            // echo "<td>".$row["organization"]."</td>" ;
                                            // echo "</tr>" ;

                                        }
                                      }
                                      else echo "0 results";

                                    }
                                }
                            else {
                              $result = $db_conn->query($query);

                              if ($result->num_rows > 0) {
                                    // output data of each row
                                while($row = $result->fetch_assoc()){

                                    echo "<tr>" ;
                                    echo "<td>".$row["id_index"].    "</td>" ;
                                    echo "<td>".$row["subject"].     "</td>" ;
                                    echo "<td>".$row["title"].       "</td>" ;
                                    echo "<td>".$row["author"].      "</td>" ;
                                    echo "<td>".$row["descriptor"].  "</td>" ;
                                    echo "<td>".$row["newspaper_name"].   "</td>" ;
                                    echo "<td>".$row["page"].        "</td>" ;
                                    echo "<td>".$row["suplement"].   "</td>" ;
                                    echo "<td>".$row["illustration"]."</td>" ;
                                    echo "<td>".$row["date"].        "</td>" ;
                                    echo "<td>".$row["organization"]."</td>" ;
                                    echo "</tr>" ;

                                  }
                              }
                              else echo "0 results";
                            }

 ?>
