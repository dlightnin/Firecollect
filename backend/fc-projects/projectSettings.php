<?php

  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';

  $p_id = $_GET['project'] ;



  // $user_id = $_SESSION["user_id"];
  //
  // $_SESSION['current_project_id']= $project_id;
  //
  // $result = $db_conn->query($query);
  //
  // $row = $result->fetch_assoc();
  $project_enc = encrypt($p_id,$key_enc) ;

?>
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                  <div class="row">
                    <div class="portlet light">
                      <div class="portlet-title">
                        <div class="caption">
                            <i class="font-red"></i>
                            <?php
                            $title = $db_conn->query("SELECT title FROM tbl_projects where id = '$p_id'") ;
                            $title = $title->fetch_assoc() ;
                            $title = $title['title'] ;

                             ?>
                            <span class="title firecollect">Permissions for: <?php echo $title ;?></span>
                        </div>
                      </div>

                      <div class="portlet-body">

                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th style="display: none ;"> ID </th>
                                    <th style="text-align:center;">
                                      <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                          <input id='checkAll' type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                          <span></span>
                                            </label>
                                    </th>

                                    <th style="text-align: center;"> Collaborator </th>
                                    <th style="text-align: center;"> Role </th>
                                    <th style="text-align: center;"> Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                                $count = 1 ;
                                $res = $db_conn->query("SELECT * FROM tbl_collaborators inner join tbl_user_info on tbl_collaborators.user_id = tbl_user_info.u_id where p_id = '$p_id'") ;
                                while($row = $res->fetch_assoc())
                                {
                                  $enc = encrypt($row['u_id'],$key_enc) ;


                                  echo "<tr>



                                      <td class='id' style='display:none'>
                                        ".$enc."
                                      </td>";

                                  echo "<td style='text-align:center;  position:relative;'>
                                                    <label class='mt-checkbox mt-checkbox-single mt-checkbox-outline' style='top:45% !important; left:45%; position:absolute;'>
                                                        <input type='checkbox' class='checkboxes'  value='1' />
                                                        <span></span>
                                                    </label>
                                                </td>";


                                  $img_id = $row['u_id'] ;
                                  $img = $db_conn->query("SELECT * FROM tbl_user_info where u_id = '$img_id'") ;
                                  $img = $img->fetch_assoc();


                                  echo "<td style='text-align:center; vertical-align:middle'>
                                  <div class='profile-userpic'>
                                    <img style='width:6% !important;' src='../fc-user/uploads/userImages/".$img['image_path']."' class='img-responsive'/>
                                    ".$row['f_name']." ".$row['l_name']."
                                  </div>


                                  </td>";
                                  $role_id = $row['role'] ;
                                  $role = $db_conn->query("SELECT * FROM tbl_roles where id = '$role_id'") ;
                                  $role = $role->fetch_assoc();



                                  echo "<td width='150px' style=' vertical-align:middle'>

                                      <select class='form-control' id='select'>
                                          <option value='".$role['id']."' selected>".$role['role']."</option>";

                                          if($role['id'] == 4)
                                          {
                                            echo "<option value='3'>Collaborator</option>
                                            <option value='2'>Manager</option>
                                            <option value='1'>Administrator</option>" ;
                                          }

                                          if($role['id'] == 3)
                                          {
                                            echo "<option value='4'>User</option>
                                            <option value='2'>Manager</option>
                                            <option value='1'>Administrator</option>" ;
                                          }

                                          if($role['id'] == 2)
                                          {
                                            echo "<option value='4'>User</option>
                                            <option value='3'>Collaborator</option>
                                            <option value='1'>Administrator</option>" ;
                                          }

                                          if($role['id'] == 1)
                                          {
                                            echo "<option value='4'>User</option>
                                            <option value='3'>Collaborator</option>
                                            <option value='2'>Manager</option>";
                                          }

                                      echo " </select>
                                      <label for='form_control_1'></label>

                                  </td>";

                                  echo "<td style=' vertical-align:middle'>
                                      <a href='#modal$count' data-toggle='modal' class='btn btn-icon-only blue'><i style='font-size:16px;' class=' fa fa-list'></i></a>
                                      <a href='javascript:;' class='btn btn-icon-only red'><i style='font-size:16px;' class=' fa fa-times'></i></a>
                                  </td>";


                                          echo "</div>
                                      </div>

                                      </td>

                                    </tr>" ;

                                    echo "<div class='modal fade modal-scroll modal_tag' id='modal$count' tabindex='-1' role='dialog' aria-hidden='true' >
                                          <div class='modal-dialog modal-lg' style='position:relative;' id='ea'>
                                            <div class='modal-content'>
                                             <div class='modal-header'>
                                             <button type='button' class='close close_modal' data-dismiss='modal' aria-hidden='true'></button>
                                              <h1 class='title firecollect'>Permissions for:".$row['f_name']." ".$row['l_name']."</h1>
                                                <div style='display:none;' id='id_enc'>".$enc."</div>
                                             </div>
                                            <div class='modal-body'>
                                                                                <!--BEGIN FORMS  -->
                                            <div class='portlet-body form'>

                                                <div class='col-md-4' style='border-right:2px solid #cccccc; '>
                                                  <h4 style='text-align:left;' class='subject firecollect'>Project Permissions:</h4>
                                                  <div class='form-group form-md-checkboxes'>

                                                      <div class='md-checkbox-list'>";

                                                          if($row['edit_project'] == 1)
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox1_$count' class='md-check' checked>
                                                                <label for='checkbox1_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Edit Project </label>
                                                            </div>" ;
                                                          }

                                                          else
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox1_$count' class='md-check' >
                                                                <label for='checkbox1_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Edit Project </label>
                                                            </div>" ;
                                                          }



                                                          if($row['edit_map'] == 1)
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox2_$count' class='md-check' checked>
                                                                <label for='checkbox2_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Edit Map </label>
                                                            </div>" ;
                                                          }

                                                          else
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox2_$count' class='md-check' >
                                                                <label for='checkbox2_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Edit Map </label>
                                                            </div>" ;
                                                          }

                                                          if($row['add_images'] == 1)
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox3_$count' class='md-check' checked>
                                                                <label for='checkbox3_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Add Images </label>
                                                            </div>";
                                                          }

                                                          else
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox3_$count' class='md-check'>
                                                                <label for='checkbox3_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Add Images </label>
                                                            </div>";
                                                          }

                                                          if($row['copy_project'] == 1)
                                                          {
                                                            echo " <div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox4_$count' class='md-check' checked>
                                                                <label for='checkbox4_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Copy Project </label>
                                                            </div>";
                                                          }

                                                          else
                                                          {
                                                            echo "  <div class='md-checkbox' style='margin-bottom:10px'>
                                                                  <input type='checkbox' name='permArr[]' id='checkbox4_$count' class='md-check'>
                                                                  <label for='checkbox4_$count'>
                                                                      <span></span>
                                                                      <span class='check'></span>
                                                                      <span class='box'></span> Copy Project </label>
                                                              </div>";
                                                          }



                                                        if($row['invite_users'] == 1)
                                                        {
                                                          echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                              <input type='checkbox' name='permArr[]' id='checkbox5_$count' class='md-check' checked>
                                                              <label for='checkbox5_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Invite Users </label>
                                                          </div>" ;
                                                        }

                                                        else
                                                        {
                                                          echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                              <input type='checkbox' name='permArr[]' id='checkbox5_$count' class='md-check'>
                                                              <label for='checkbox5_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Invite Users </label>
                                                          </div>" ;
                                                        }


                                                        if($row['change_permissions'] == 1)
                                                        {
                                                          echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                              <input type='checkbox' name='permArr[]' id='checkbox6_$count' class='md-check' checked>
                                                              <label for='checkbox6_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Change Permissions </label>
                                                          </div>" ;
                                                        }

                                                        else
                                                        {
                                                          echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                              <input type='checkbox' name='permArr[]' id='checkbox6_$count' class='md-check' >
                                                              <label for='checkbox6_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Change Permissions </label>
                                                          </div>" ;
                                                        }


                                                        if($row['change_status_project'] == 1)
                                                        {
                                                          echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                              <input type='checkbox' name='permArr[]' id='checkbox7_$count' class='md-check' checked>
                                                              <label for='checkbox7_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Change Project Status </label>
                                                          </div>" ;
                                                        }

                                                        else
                                                        {
                                                          echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                              <input type='checkbox' name='permArr[]' id='checkbox7_$count' class='md-check'>
                                                              <label for='checkbox7_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Change Project Status </label>
                                                          </div>" ;
                                                        }


                                                        if($row['add_dataset'] == 1)
                                                        {
                                                          echo "<div class='md-checkbox' >
                                                              <input type='checkbox' name='permArr[]' id='checkbox8_$count' class='md-check' checked>
                                                              <label for='checkbox8_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Add Datasets </label>
                                                          </div>" ;
                                                        }

                                                        else
                                                        {
                                                          echo "<div class='md-checkbox' >
                                                              <input type='checkbox' name='permArr[]' id='checkbox8_$count' class='md-check'>
                                                              <label for='checkbox8_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Add Datasets </label>
                                                          </div>" ;
                                                        }




                                                echo "      </div>
                                                    </div>
                                                  </div>

                                                  <div class='col-md-4' style='border-right:2px solid #cccccc; '>
                                                      <h4 style='text-align:left;' class='subject firecollect'>Dataset Permissions:</h4>
                                                      <div class='form-group form-md-checkboxes' >

                                                          <div class='md-checkbox-list'>";

                                                          if($row['edit_dataset'] == 1)
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px' >
                                                                <input type='checkbox' name='permArr[]' id='checkbox9_$count' class='md-check' checked>
                                                                <label for='checkbox9_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Edit Datasets </label>
                                                            </div>" ;
                                                          }

                                                          else
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px' >
                                                                <input type='checkbox' name='permArr[]' id='checkbox9_$count' class='md-check'>
                                                                <label for='checkbox9_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Edit Datasets </label>
                                                            </div>" ;
                                                          }

                                                          if($row['copy_dataset'] == 1)
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox10_$count' class='md-check' checked>
                                                                <label for='checkbox10_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Copy Datasets </label>
                                                            </div>" ;
                                                          }

                                                          else
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox10_$count' class='md-check' >
                                                                <label for='checkbox10_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Copy Datasets </label>
                                                            </div>" ;
                                                          }


                                                          if($row['delete_dataset'] == 1)
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox11_$count' class='md-check' checked>
                                                                <label for='checkbox11_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Delete Datasets </label>
                                                            </div>" ;
                                                          }

                                                          else
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox11_$count' class='md-check'>
                                                                <label for='checkbox11_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Delete Datasets </label>
                                                            </div>" ;
                                                          }

                                                          if($row['change_status_dataset'] == 1)
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox12_$count' class='md-check' checked>
                                                                <label for='checkbox12_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Change Dataset Status </label>
                                                            </div>" ;
                                                          }

                                                          else
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox12_$count' class='md-check'>
                                                                <label for='checkbox12_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Change Dataset Status </label>
                                                            </div>" ;
                                                          }

                                                          if($row['add_variable'] == 1)
                                                          {
                                                            echo "  <div class='md-checkbox' style='margin-bottom:10px'>
                                                                  <input type='checkbox' name='permArr[]' id='checkbox13_$count' class='md-check' checked>
                                                                  <label for='checkbox13_$count'>
                                                                      <span></span>
                                                                      <span class='check'></span>
                                                                      <span class='box'></span> Add Variables</label>
                                                              </div>" ;
                                                          }

                                                          else
                                                          {
                                                            echo "  <div class='md-checkbox' style='margin-bottom:10px'>
                                                                  <input type='checkbox' name='permArr[]' id='checkbox13_$count' class='md-check'>
                                                                  <label for='checkbox13_$count'>
                                                                      <span></span>
                                                                      <span class='check'></span>
                                                                      <span class='box'></span> Add Variables</label>
                                                              </div>" ;
                                                          }

                                                          if($row['edit_variable'] == 1)
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox14_$count' class='md-check' checked>
                                                                <label for='checkbox14_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Edit Variables </label>
                                                            </div>" ;
                                                          }

                                                          else
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox14_$count' class='md-check' >
                                                                <label for='checkbox14_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> Edit Variables </label>
                                                            </div>" ;
                                                          }


                                                          if($row['delete_variable'] == 1)
                                                          {
                                                            echo "  <div class='md-checkbox' style='margin-bottom:10px'>
                                                                  <input type='checkbox' name='permArr[]' id='checkbox15_$count' class='md-check' checked>
                                                                  <label for='checkbox15_$count'>
                                                                      <span></span>
                                                                      <span class='check'></span>
                                                                      <span class='box'></span> Delete Variables </label>
                                                              </div>" ;
                                                          }

                                                          else
                                                          {
                                                            echo "  <div class='md-checkbox' style='margin-bottom:10px'>
                                                                  <input type='checkbox' name='permArr[]' id='checkbox15_$count' class='md-check'>
                                                                  <label for='checkbox15_$count'>
                                                                      <span></span>
                                                                      <span class='check'></span>
                                                                      <span class='box'></span> Delete Variables </label>
                                                              </div>" ;
                                                          }


                                                          if($row['view_datafile'] == 1)
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox16_$count' class='md-check' checked>
                                                                <label for='checkbox16_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> View Datafiles </label>
                                                            </div>" ;
                                                          }

                                                          else
                                                          {
                                                            echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                                <input type='checkbox' name='permArr[]' id='checkbox16_$count' class='md-check'>
                                                                <label for='checkbox16_$count'>
                                                                    <span></span>
                                                                    <span class='check'></span>
                                                                    <span class='box'></span> View Datafiles </label>
                                                            </div>" ;
                                                          }


                                                echo"</div>
                                                  </div>
                                                </div>

                                                <div class='col-md-4' >
                                                    <h4 style='text-align:left;' class='subject firecollect'>Datafile Permissions:</h4>
                                                    <div class='form-group form-md-checkboxes' style='>

                                                        <div class='md-checkbox-list'>";

                                                        if($row['download_datafile'] == 1)
                                                        {
                                                          echo "<div class='md-checkbox' style='margin-bottom:10px' >
                                                              <input type='checkbox' name='permArr[]' id='checkbox17_$count' class='md-check' checked>
                                                              <label for='checkbox17_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Download Datafiles </label>
                                                          </div>" ;
                                                        }

                                                        else
                                                        {
                                                          echo "<div class='md-checkbox' style='margin-bottom:10px' >
                                                              <input type='checkbox' name='permArr[]' id='checkbox17_$count' class='md-check'>
                                                              <label for='checkbox17_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Download Datafiles </label>
                                                          </div>" ;
                                                        }


                                                        if($row['upload_datafile'] == 1)
                                                        {
                                                          echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                              <input type='checkbox' name='permArr[]' id='checkbox18_$count' class='md-check' checked>
                                                              <label for='checkbox18_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Upload Datafiles </label>
                                                          </div>" ;
                                                        }

                                                        else
                                                        {
                                                          echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                              <input type='checkbox' name='permArr[]' id='checkbox18_$count' class='md-check' >
                                                              <label for='checkbox18_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Upload Datafiles </label>
                                                          </div>" ;
                                                        }


                                                        if($row['edit_datafile'] == 1)
                                                        {
                                                          echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                              <input type='checkbox' name='permArr[]' id='checkbox19_$count' class='md-check' checked>
                                                              <label for='checkbox19_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Edit Datafiles </label>
                                                          </div>" ;
                                                        }

                                                        else
                                                        {
                                                          echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                              <input type='checkbox' name='permArr[]' id='checkbox19_$count' class='md-check'>
                                                              <label for='checkbox19_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Edit Datafiles </label>
                                                          </div>" ;
                                                        }



                                                        if($row['delete_datafile'] == 1)
                                                        {
                                                          echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                              <input type='checkbox' name='permArr[]' id='checkbox20_$count' class='md-check' checked>
                                                              <label for='checkbox20_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Delete Datafiles </label>
                                                          </div>" ;
                                                        }

                                                        else
                                                        {
                                                          echo "<div class='md-checkbox' style='margin-bottom:10px'>
                                                              <input type='checkbox' name='permArr[]' id='checkbox20_$count' class='md-check'>
                                                              <label for='checkbox20_$count'>
                                                                  <span></span>
                                                                  <span class='check'></span>
                                                                  <span class='box'></span> Delete Datafiles </label>
                                                          </div>" ;
                                                        }
                                                        $count = $count + 1 ;

                                                      echo "</div>
                                                      </div>
                                                      <div class='col-md-12' style='margin-top:20px;'>
                                                        <button class='btn dark btn-outline pull-right' style='margin-left:5px;' data-dismiss='modal' aria-hidden='true'>Close</button>
                                                        <input id='change_permissions' class='btn green pull-right' type='submit' value='Agree'>
                                                      </div>
                                                    </div>




                                            </div>

                                            </div>

                                          </div>
                                        </div>
                                      </div>" ;

                                }
                               ?>

                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>


      <?php
        include '../includes/footer.php' ;

      ?>
      <script type="text/javascript">
        var project = "<?php echo $project_enc ?>";
      </script>
      <script src="../includes/encryption/js/aes.js" type="text/javascript"></script>
      <script src="../includes/encryption/js/cryptoHelpers.js" type="text/javascript"></script>
      <script src="../includes/encryption/js/encrypt.js" type="text/javascript"></script>
      <script src="includes/js/sendPermissions.js" type="text/javascript"></script>
      <script>
      var check_all_flag = 0
      $(document).on("click", '#checkAll ', function(event) {
        // event.preventDefault();
          event.stopPropagation();
          check_all_flag = (check_all_flag + 1) % 2;
          if (check_all_flag ==1){
            $('.checkboxes').each(function(){
              // if ($(this)[0].checked == false ){
                $(this)[0].checked = true;
              });
          }
          else {
            $('.checkboxes').each(function(){
              // if ($(this)[0].checked == true ){
                $(this)[0].checked = false;
              // }
              });
          }


      console.log($('.checkboxes')[0]);

      });

      

      </script>
