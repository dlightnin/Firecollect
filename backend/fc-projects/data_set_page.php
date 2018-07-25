<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';
  include 'includes/permissionFunctions.php';

$_SESSION["last_url"]= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $user_id = $_SESSION["user_id"];
  if ($_GET['id']){
  $data_set_id = $_GET['id'];
  $_SESSION['current_data_set_id']= $data_set_id;

}

else{
  $data_set_id = $_SESSION['current_data_set_id'];
}
$ds_status_id=$data_set_id;

$db_conn->query("UPDATE tbl_user set last_dataset = '$data_set_id' where u_id = '$user_id'") ;

  $query= "SELECT * FROM tbl_data_set where id ='$data_set_id'";

  $result = $db_conn->query($query);

  // $row = $result->fetch_assoc();
  // echo $row['status'];

  $row = $result->fetch_assoc();

  $data_set_name= $row['name'];
  $period= $row['period'];
  $description =$row['description'];
  $method =$row['method'];
  $times =$row['times'];
  $periodicity =$row['periodicity'];
  $reference =$row['reference'];
  $cross_reference =$row['cross_reference'];
  $keywords =$row['keywords'];
  $observations =$row['observations'];
  $formula =$row['formula'];
  $status=$row['status'];


  $project_id =$row['project_id'];

  $_SESSION['current_project_id']=$project_id;

  $query2 = "SELECT * FROM tbl_projects WHERE id='$project_id'";
  $result2 = $db_conn->query($query2);
  $row2 = $result2->fetch_assoc();
  $project_title = $row2['title'];
  $owner_id = $row2['u_id'];

  $perm = $db_conn->query("SELECT * From tbl_collaborators where p_id = '$project_id' and user_id = '$user_id'");
  $perm = $perm->fetch_assoc() ;
    # code...

?>

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->



                    <!-- END PAGE HEADER-->
                    <!-- BEGIN  PORTLET-->

                    <?php echo "
                    <div class ='before_portlet'>
                    <div class=' mobile_hide' style='margin-bottom:25px;'>
                    <a id='back' class='icon-btn' href='data_sets.php'>
                      <i class='fa fa-arrow-left'></i>
                      <div> Back </div>
                    </a>";


                    editDataset($user_id,$owner_id,$perm,$data_set_id) ;
                    copyDataset($user_id,$owner_id,$perm) ;
                    deleteDataset($user_id,$owner_id,$perm) ;
                    addVariable($user_id,$owner_id,$perm) ;
                    viewDatafiles($user_id,$owner_id,$perm) ;



                     // <a href='assignVariables.php?ds_id=$data_set_id' class='icon-btn  '>
                     //   <i class='fa fa-exchange'></i>
                     //   <div> Assign Variables </div>
                     // </a>








echo "
</div>
<div class='mobile_menu'>
<div class='btn-group'>
                                                                <button class='btn dark btn-lg dropdown-toggle pull-right' type='button' data-toggle='dropdown'> Actions
                                                                    <i class='fa fa-angle-down'></i>
                                                                </button>
                                                                <ul class='dropdown-menu' role='menu'>";

                                                                if($perm['edit_data_set'] == 1 or $owner_id == $user_id)
                                                                {
                                                                  echo "<li>
                                                                      <a href='datafiles.php'> View/Add Data Files </a>

                                                                  </li>
                                                                  <li>
                                                                      <a href='edit_data_set.php?id=$data_set_id'> Edit Data Set </a>
                                                                  </li>
                                                                  <li>
                                                                      <a href='copy_data_set.php'> Copy Data Set </a>
                                                                  </li>
                                                                  <li>
                                                                      <a href='add_variable.php'> Add Variables </a>
                                                                  </li>";
                                                                  // <li>
                                                                  //     <a href='assignVariables.php?ds_id=$data_set_id'> Assign Variables </a>
                                                                  // </li>
                                                                }


                                                                if($perm['delete_data_set'] == 1 or $owner_id == $user_id)
                                                                {
                                                                  echo "<li>
                                                                      <a id='$data_set_id' class='delete_dataset' href='javascript:;'> Delete Data Set </a>
                                                                  </li>" ;
                                                                }





                                                          echo "</ul>
                                                            </div>
                                                            </div>
                                                            </div>

";
?>

<div class='modal fade modal-scroll modal_tag' id='modal_terms' tabindex='-1' role='dialog' aria-hidden='true' >
                                  <div class='modal-dialog modal-lg' style='position:relative;' id='ea'>
                                      <div class='modal-content'>
                                          <div class='modal-header'>
                                              <button type='button' class='close close_modal' data-dismiss='modal' aria-hidden='true'></button>


                                              <h4 class='modal-title font-red'  > Terms and Conditions:</h4>
                                              <span style='display:none' class='id'><?php echo $data_set_id; ?></span>


                                          </div>
                                          <div class='modal-body' >
                                            <!--BEGIN FORMS  -->
                                            <div class='portlet-body form'>
                                              <form role='form' method='POST' action='javascript:;' enctype='multipart/form-data'>
                                                <div class='form-body'>

                                                <div class='row'>


                                                    <div class='col-md-12'>


                                                        <div ><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                        </p></div>



                                                        <div class='form-group form-md-checkboxes'>
                                                                                                    <div class='md-checkbox-inline'>
                                                                                                        <div class='md-checkbox has-success'>
                                                                                                            <input required type='checkbox' id='checkbox14' class='md-check'>
                                                                                                            <label for='checkbox14'>
                                                                                                                <span class='inc'></span>
                                                                                                                <span class='check'></span>
                                                                                                                <span class='box'></span> I have read and agree to these terms and conditions. </label>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>



                                                        <button class='btn dark btn-outline' data-dismiss='modal' aria-hidden='true'>Close</button>
                                                        <input id='change_status' class='btn green' type='submit' value='Agree'>
                                                    </div>

                                                </div>

                                                </div>

                                              </form>
                                            </div>
                                            <!--FORMS END  -->
                                              </div>
                                      </div>
                                  </div>
                              </div>


                                                <div class="row">
                                                  <div class="col-md-12">
                                                    <div class="portlet light portlet-fit ">
                                                                                    <div class="portlet-title">
                                                                                        <div class="caption">
                                                                                            <span class="title firecollect">Data Set Information</span>
                                                                                        </div>
                                                                                        <div class="tools">
                                                                                          <a href="" class="collapse" data-original-title="" title=""> </a>
                                                                                        </div>
                                                                                        <?php
                                                                                          changeStatusDataset($user_id,$owner_id,$perm,$status) ;
                                                                                        ?>

                                                                                    </div>

                                                                                    <div class="portlet-body">
                                                                                      <!--BEGIN PORTLET BODY  -->




                                                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold'>Data Set:<p class='text firecollect' style='padding-left:10px;'><?php echo $data_set_name;?></p></h4>
                                                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold'>Project:<p class='text firecollect' style='padding-left:10px;'><a href="user_project?id=<?php echo $project_id;?>" ><?php echo $project_title;?></a></p></h4>
                                                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold'>Method:<p class='text firecollect' style='padding-left:10px;'><?php echo $method;?></p></h4>
                                                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold'>Period:<p class='text firecollect' style='padding-left:10px;'><?php echo $period;?></p></h4>

                                                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold'>Reference:<p class='text firecollect' style='padding-left:10px;'><?php echo $reference;?></p></h4>
                                                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold'>Cross Reference:<p class='text firecollect' style='padding-left:10px;'><?php echo $cross_reference;?></p></h4>

                                                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold'>Keywords:<p class='text firecollect' style='padding-left:10px;'><?php echo $keywords;?></p></h4>
                                                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold'>Related Publications:<p class='text firecollect' style='padding-left:10px;'><?php echo $publications;?></p></h4>
                                                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold'>Dissemination:<p class='text firecollect' style='padding-left:10px;'><?php echo $dissemination;?></p></h4>
                                                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold'>Observations:<p class='text firecollect' style='padding-left:10px;'><?php echo $observations;?></p></h4>
                                                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold'>Formula:<p class='text firecollect' style='padding-left:10px;'><?php echo $formula;?></p></h4>
                                                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold'>Description:<p class='text firecollect' style='padding-left:10px;'><?php echo $description;?></p></h4>


                                                                                      </div>









                                                                                      <!--END PORTLET BODY  -->
                                                                                    </div>

                                                  </div>
                                                  <div class="col-md-12">
                                                    <div class="portlet light portlet-fit ">
                                                                                    <div class="portlet-title">
                                                                                        <div class="caption">
                                                                                            <span class="title firecollect">Variables</span>
                                                                                        </div>
                                                                                        <div class="tools">
                                                                                          <a href="" class="collapse" data-original-title="" title=""> </a>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="portlet-body">
                                                                                      <!--BEGIN PORTLET BODY  -->
                                                                                      <div class="btn-group " style="margin-bottom:20px;">
                                                                                        <?php
                                                                                        if($perm['add_variable'] == 1 or $owner_id == $user_id)
                                                                                        {
                                                                                          echo "<a href='add_variable.php' >
                                                                                            <button id='sample_editable_1_2_new' class='btn firecollect '> Add Variable
                                                                                                <i class='fa fa-plus'></i>
                                                                                            </button>
                                                                                          </a>";
                                                                                        }
                                                                                        ?>
                                                                                  </div>
                                                                                  <div class="contain_modals"></div>


                                                                                      <table class="table table-striped table-hover table-bordered variable_table" id="sample_editable_1">
                                                                                          <thead>
                                                                                              <tr>
                                                                                                  <th style="display:none">ID</th>
                                                                                                  <th style="text-align: center;"> Name </th>
                                                                                                  <th style="text-align: center;"> Data Type </th>

                                                                                                  <th style="text-align: center;"> Actions </th>
                                                                                              </tr>
                                                                                          </thead>
                                                                                          <tbody>

                                                                                            <?php
                                                                                            $query="SELECT * FROM tbl_variables WHERE data_set_id ='$data_set_id' and deleted = '0'";

                                                                                            $result = $db_conn->query($query);

                                                                                            $i=0;

                                                                                            while ($row = $result->fetch_assoc() ) {
                                                                                              # code...
                                                                                              $variable_id = $row['id'];
                                                                                              $name= $row['name'];
                                                                                              $data_type= $row['data_type'];
                                                                                              $abbreviation = $row['abbreviation'];
                                                                                              $definition = $row['definition'];
                                                                                              $unit = $row['unit_of_measurement'];
                                                                                              $precision = $row['precision_of_measurement'];
                                                                                              $variable_list = $row['variable_list'];
                                                                                              $observations = $row['observations'];
                                                                                              $missing_data_codes = $row['missing_data_codes'];
                                                                                              $data_set_id = $row['data_set_id'];

                                                                                              $data_set_id =$row['data_set_id'];

                                                                                              $result2 = $db_conn->query("SELECT * FROM tbl_data_set WHERE id='$data_set_id'");
                                                                                              $row2 = $result2->fetch_assoc();
                                                                                              $data_set_id = $row2['id'];
                                                                                              $assoc_ds = $row2['name'];


                                                                                              echo "
                                                                                              <tr >
                                                                                              <td style='display:none' class='id'>$variable_id</td>
                                                                                              <td class='' style='' > <a data-toggle='modal' href='#modal_ds$i' >$name </a>  </td>
                                                                                              <td class=''   style='text-align: center;'> $data_type </td>


                                                                                                  <td style='text-align:center;'>";

                                                                                                      editVariables($user_id,$owner_id,$perm,$variable_id) ;
                                                                                                      deleteVariables($user_id,$owner_id,$perm) ;

                                                                                                      echo "

                                                                                                  </td>
                                                                                              </tr>";


                                                                                                # code...

                                                                                              //modal
                                                                                              echo "<div class='modal fade modal-scroll modal_tag' id='modal_ds$i' tabindex='-1' role='dialog' aria-hidden='true' >
                                                                                                                                <div class='modal-dialog modal-lg' style='position:relative;' id='ea'>
                                                                                                                                    <div class='modal-content'>
                                                                                                                                        <div class='modal-header'>
                                                                                                                                            <button type='button' class='close close_modal' data-dismiss='modal' aria-hidden='true'></button>


                                                                                                                                            <h4 class='modal-title font-red'  > Variable Metadata</h4>


                                                                                                                                        </div>
                                                                                                                                        <div class='modal-body' >
                                                                                                                                          <!--BEGIN FORMS  -->
                                                                                                                                          <div class='portlet-body form'>
                                                                                                                                            <form role='form' method='POST' action='includes/upload_file.php' enctype='multipart/form-data'>
                                                                                                                                              <div class='form-body'>

                                                                                                                                              <div class='row'>


                                                                                                                                                  <div class='col-md-12'>


                                                                                                                                                      <div class='form-group form-md-line-input'>
                                                                                                                                                          <div id='file_title' class='form-control form-control-static'> $name</div>
                                                                                                                                                          <label for='form_control_1'>Variable Name:</label>
                                                                                                                                                      </div>

                                                                                                                                                        <div class='form-group form-md-line-input'>
                                                                                                                                                            <div class='form-control form-control-static'> $assoc_ds</div>
                                                                                                                                                            <label for='form_control_1'>Associated Dataset:</label>
                                                                                                                                                        </div>
                                                                                                                                                        <div class='form-group form-md-line-input'>
                                                                                                                                                            <div class='form-control form-control-static'> $abbreviation</div>
                                                                                                                                                            <label for='form_control_1'>Abbreviation(s):</label>
                                                                                                                                                        </div>
                                                                                                                                                        <div class='form-group form-md-line-input'>
                                                                                                                                                            <div class='form-control form-control-static'> $data_type</div>
                                                                                                                                                            <label for='form_control_1'>Data Type:</label>
                                                                                                                                                        </div>



                                                                                                                                                        <div id='replace_modal'>


                                                                                                                                                        <div class='form-group form-md-line-input'>
                                                                                                                                                            <div id='software_name' class='form-control form-control-static'>$unit</div>
                                                                                                                                                            <label for='form_control_1'>Unit of Measurement:</label>
                                                                                                                                                        </div>
                                                                                                                                                        <div class='form-group form-md-line-input'>
                                                                                                                                                            <div id='software_link' class='form-control form-control-static'>$precision</div>
                                                                                                                                                            <label for='form_control_1'>precision of Measurement:</label>
                                                                                                                                                        </div>

                                                                                                                                                        <div class='form-group form-md-line-input'>
                                                                                                                                                            <div id='comments' class='form-control form-control-static'>$variable_list</div>
                                                                                                                                                            <label for='form_control_1'>Range or List of Variables:</label>
                                                                                                                                                        </div>

                                                                                                                                                        <div class='form-group form-md-line-input'>
                                                                                                                                                            <div id='comments' class='form-control form-control-static'>$observations</div>
                                                                                                                                                            <label for='form_control_1'>Observations:</label>
                                                                                                                                                        </div>

                                                                                                                                                        <div class='form-group form-md-line-input'>
                                                                                                                                                            <div id='comments' class='form-control form-control-static'>$missing_data_codes</div>
                                                                                                                                                            <label for='form_control_1'>Missing Data Codes:</label>
                                                                                                                                                        </div>




                                                                                                                                                        </div>




                                                                                                                                                  </div>

                                                                                                                                              </div>

                                                                                                                                              </div>

                                                                                                                                            </form>
                                                                                                                                          </div>
                                                                                                                                          <!--FORMS END  -->
                                                                                                                                            </div>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>";

                                                                                              $i = $i + 1;
                                                                                            }





                                                                                            ?>
                                                                                          </tbody>
                                                                                      </table>




                                                                                      </div>









                                                                                      <!--END PORTLET BODY  -->
                                                                                    </div>
                                                  </div>

                                                </div>

                                                </div>
                    <!-- END PORTLET -->
                    <!-- modal begin -->
                    <div class="modal fade" id="modal_file" tabindex="-1" role="basic" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">Add Image</h4>
                                                                </div>
                                                                <div class="modal-body">

                                                                  <!--BEGIN FORMS  -->
                                                                  <div class="portlet-body form">
                                                                    <form role="form" method="POST" action="includes/upload_data_file.php" enctype="multipart/form-data">
                                                                      <div class="form-body">

                                                                        <div class="form-group form-md-line-input has-info form-md-floating-label  " >
                                                                          <div class="fileinput fileinput-new" data-provides="fileinput">
                                                      <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                                                      <div>
                                                          <span class="btn red btn-outline btn-file">
                                                              <span class="fileinput-new"> Select image </span>
                                                              <span class="fileinput-exists"> Change </span>
                                                              <input type="file" name="project_image"> </span>
                                                          <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                      </div>
                                                  </div>



                                                                        </div>







                                                                      </div>

                                                                      <div class="modal-footer">
                                                                          <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                          <button type="submit" class="btn " name="save_image" style="background-color:#FFA500; color:white;">Confirm Image</button>

                                                                      </div>
                                                                    </form>
                                                                  </div>
                                                                  <!--FORMS END  -->






                                                                    </div>


                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                    <!--modal end  -->

                                </div>
                            </div>
                        </div>
                        <!-- END CONTENT BODY -->
                    </div>
                    <!-- END CONTENT -->



                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->
      <?php
        include '../includes/footer.php' ;
      ?>
      <script src="includes/js/statusToggle.js" type="text/javascript"></script>

      <script>
      $(document).ready(function(){
          $(".contain_modals").append($(".modal_tag"));
      });

      setStatusToggle("page","includes/updateDatasetStatus.php");


      </script>
