<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';


  $project_id = $_GET['id'];
  $_SESSION['current_project_id']= $project_id;
  $query= "SELECT * FROM tbl_projects where id ='$project_id'";

  $result = $db_conn->query($query);

  // $row = $result->fetch_assoc();
  // echo $row['status'];

  $row = $result->fetch_assoc();
    # code...
    $project_title= $row['title'];
    $short_name = $row['short_name'];
    $description = $row['description'];
    $contact_name = $row['contact_name'];
    $contact_email = $row['contact_email'];
    $sponsor = $row['sponsor'];
    $status = $row['status'];
    // $research_area = $row['research_area'];
    $period= $row['period'];


?>

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->



                    <!-- END PAGE HEADER-->
                    <!-- BEGIN  PORTLET-->
                    <div class="portlet light portlet-fit ">
                                                    <div class="portlet-title">
                                                        <div class="caption">

                                                            <span class="title firecollect">Edit Project</span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                      <!--BEGIN PORTLET BODY  -->

                                                      <!--BEGIN FORMS  -->
                                                      <div class="portlet-body form">
                                                        <form role="form" method="post" action="includes/updateProjectInfo.php" id="form_sample_1">
                                                          <div class="form-body">
                                                            <div class="alert alert-danger display-hide">
                                                            <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>

                                                            <input  type="hidden" name="project_id" value="<?php echo $project_id; ?>">


                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                 <input required='true'  type="text" class="form-control" id="form_control_1" name="project_title" value="<?php echo $project_title; ?>">
                                                                 <label for="form_control_1">Project Title:</label>
                                                                 <span class="help-block">Project title goes here...</span>
                                                             </div>
                                                             <div class="form-group form-md-line-input form-md-floating-label">
                                                                  <input required='true'  type="text" class="form-control" id="form_control_1" name="short_name" value="<?php echo $short_name; ?>" >
                                                                  <label for="form_control_1">Short Name:</label>
                                                                  <span class="help-block">Type a short name that identify this project. Can be an initial or pseudonym.</span>
                                                              </div>
                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <textarea required='true' class="form-control" rows="3" name="project_description"  ><?php echo $description; ?></textarea>
                                                                   <label for="form_control_1">Description:</label>
                                                                   <span class="help-block">Type a description in detail about this Project.</span>
                                                              </div>
                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <input required='true'  type="text" class="form-control" id="form_control_1" name="contact_name" value="<?php echo $contact_name; ?>" >
                                                                   <label for="form_control_1">Contact Name:</label>
                                                                   <span class="help-block">Type the complete name of the contact of this project.</span>
                                                              </div>
                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <input required='true' email='true' type="text" class="form-control" id="form_control_1" name="contact_email" value="<?php echo $contact_email; ?>">
                                                                   <label for="form_control_1">Contact Email:</label>
                                                                   <span class="help-block">Type the contact's email.</span>
                                                              </div>

                                                              <div class='row' style='margin-top:40px;'>
                                                                <div class='form-group'>

                                                                    <label class='control-label col-md-2' style='color:#999;font-size:16px;'>Period:
                                                                    </label>
                                                                    <div class='col-md-4' id='datepicker'>
                                                                         <input required='true' type='text' class='form-control input-medium' name='datefilter2' value="<?php echo $period; ?>" />
                                                                        <span class='help-block'> The staring date and end date of the project.</span>
                                                                    </div>
                                                                </div>
                                                              </div>

                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                  <input required='true' type="text" class="form-control" id="form_control_1" name="sponsor" value="<?php echo $sponsor; ?>">
                                                                  <label for="form_control_1">Sponsor: </label>
                                                                  <span class="help-block">Write (separate with commas) the Sponsors of the Project.</span>
                                                              </div>











                                                <!-- <input required='true' type="checkbox" data-toggle="toggle" data-on="Public" data-off="Private">
                                                <script>
                                                  $(function() {
                                                    $('#toggle-two').bootstrapToggle({
                                                      on: 'Enabled',
                                                      off: 'Disabled'
                                                    });
                                                  })
                                                </script> -->
                                        

                                                <!-- <div class="form-group">

                                                    <label class="control-label " style="color:#888888;font-size:16px;">Project Status: </label>
                                                          <button id="project_status" type="button" class="btn btn-default popovers col-md-offset-1" data-container="body" data-trigger="hover" data-placement="top" data-content=" " data-original-title="Change project status to Public or Private.">
                                                            <span style="font-size:30px; padding: 10px 0;" class="eyeToggle fa fa-eye"></span>
                                                            <input required='true' type="hidden" name="status" value="1">
                                                          </button>
                                              </div> -->


                                                            <div class="form-actions">
                                                              <a class="col-md-offset-8 " href="<?php echo $_SESSION['last_url'];?>"><button type="button"  class="btn btn-lg dark btn-outline" >Cancel</button></a>
                                                              <button type="submit" class="btn firecollect btn-lg" name="edit_project" >Apply Changes</button>
                                                            </div>




                                                          <!-- </div> -->
                                                        </form>
                                                      </div>
                                                      <!-- END FORMS -->



                                                      <!--END PORTLET BODY  -->
                                                    </div>
                                                </div>
                    <!-- END PORTLET -->
                    <!-- modal begin -->
                    <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">Add New Research Areas</h4>
                                                                </div>
                                                                <div class="modal-body">

                                                                  <!--BEGIN FORMS  -->
                                                                  <div class="portlet-body form">
                                                                    <form role="form">
                                                                      <div class="form-body">

                                                                        <div class="form-group form-md-line-input has-info form-md-floating-label " >
                                                                            <select class="form-control" id="form_control_1">
                                                                                <option value=""></option>
                                                                                <option value="1">Option 1</option>
                                                                                <option value="2">Option 2</option>
                                                                                <option value="3">Option 3</option>
                                                                                <option value="4">Option 4</option>
                                                                            </select>

                                                                            <label for="form_control_1">Field of Study:</label>
                                                                        </div>
                                                                        <div class="form-group form-md-line-input form-md-floating-label">
                                                                             <input required='true' style="color:orange;" type="text" class="form-control" id="form_control_1" >
                                                                             <label for="form_control_1">Research Area of this Field of Study:</label>
                                                                             <span class="help-block">Type the name of the research area you want to add to this field of study.</span>
                                                                         </div>
                                                                         <div class="form-group form-md-line-input form-md-floating-label">
                                                                              <textarea required='true' class="form-control" rows="3"></textarea>
                                                                              <label for="form_control_1">Description:</label>
                                                                              <span class="help-block">Type a description about this research area to evaluate it.</span>

                                                                         </div>


















                                                                      </div>
                                                                    </form>
                                                                  </div>
                                                                  <!--FORMS END  -->






                                                                    </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn " style="background-color:#FFA500; color:white;">Request New Research Area</button>
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
      <script src="includes/js/toggle.js" type="text/javascript"></script>
      <script src="includes/js/daterangepicker.js"></script>
