<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';

  function validateInput($data){
    $data = trim(stripcslashes(htmlspecialchars($data)));
    return $data;


  }




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
                                                            <span class="title firecollect">Add Project</span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                      <!--BEGIN PORTLET BODY  -->

                                                      <!--BEGIN FORMS  -->
                                                      <div class="portlet-body form">
                                                        <form role="form" method="post" action="includes/saveProjectInfo.php" id="form_sample_1">
                                                          <div class="form-body">
                                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>


                                                <!-- <div class="form-group form-md-line-input">
                                                    <input type="text" class="form-control" id="form_control_1" name="email" placeholder="Enter your email">
                                                    <label for="form_control_1">Email
                                                        <span class="required">*</span>
                                                    </label>
                                                    <span class="help-block">Please enter your email...</span>
                                                </div> -->


                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                 <input  type="text" class="form-control" id="form_control_1" name="project_title" required='true' minlength='3' >
                                                                 <div class="form-control-focus"> </div>

                                                                 <label for="form_control_1">Project Title:
                                                                   <span class="required">*</span>
                                                                 </label>
                                                                 <span class="help-block">Project title goes here...</span>
                                                             </div>
                                                             <div class="form-group form-md-line-input form-md-floating-label">
                                                                  <input required='true' minlength='3'  type="text" class="form-control" id="form_control_1" name="short_name">
                                                                  <label for="form_control_1">Short Name:
                                                                    <span class="required">*</span>
                                                                  </label>
                                                                  <span class="help-block">Type a short name that identify this project. Can be an initial or pseudonym.</span>
                                                              </div>
                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <textarea required='true' class="form-control" rows="3" name="project_description" ></textarea>
                                                                   <label for="form_control_1">Description:
                                                                     <span class="required">*</span>
                                                                   </label>
                                                                   <span class="help-block">Type a description in detail about this Project.</span>
                                                              </div>
                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <input required='true' minlength='3'  type="text" class="form-control" id="form_control_1" name="contact_name">
                                                                   <label for="form_control_1">Contact Name:
                                                                     <span class="required">*</span>
                                                                   </label>
                                                                   <span class="help-block">Type the complete name of the contact of this project.</span>
                                                              </div>
                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <input required='true' email ='true' minlength='3' type="text" class="form-control " id="form_control_1" name="contact_email" >
                                                                   <label for="form_control_1">Contact Email:
                                                                     <span class="required">*</span>
                                                                   </label>
                                                                   <span class="help-block">Type the contact's email.</span>
                                                              </div>


                                                              <div class='row' style='margin-top:40px;'>
                                                                <div class='form-group'>

                                                                    <label class='control-label col-md-2' style='color:#999;font-size:16px;'>Period:
                                                                      <span class="required">*</span>
                                                                    </label>
                                                                    <div class='col-md-4' id='datepicker'>
                                                                         <input required='true' type='text' class='form-control input-medium' name='datefilter2' />
                                                                        <span class='help-block'> The staring date and end date of the project.</span>
                                                                    </div>
                                                                </div>
                                                              </div>

                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                  <input required='true' minlength='3' type="text" class="form-control" id="form_control_1" name="sponsor">
                                                                  <label for="form_control_1">Sponsor:
                                                                    <span class="required">*</span>
                                                                  </label>
                                                                  <span class="help-block">Write (separate with commas) the Sponsors of the Project.</span>
                                                              </div>











                                                <!-- <input required='true' minlength='3' type="checkbox" data-toggle="toggle" data-on="Public" data-off="Private">
                                                <script>
                                                  $(function() {
                                                    $('#toggle-two').bootstrapToggle({
                                                      on: 'Enabled',
                                                      off: 'Disabled'
                                                    });
                                                  })
                                                </script> -->


                                                <!-- <div class="row">
                                                  <div class="col-md-6"> -->
                                                  <!-- <div class="form-group">

                                                      <label class="control-label " style="color:#888888;font-size:16px;">Project Status:
                                                      </label> -->
                                                            <!-- <label for="project_status" class="control-label ">Project Status:  </label> -->

                                                            <!-- <button id="project_status" type="button" class="btn btn-default popovers col-md-offset-1" data-container="body" data-trigger="hover" data-placement="top" data-content=" " data-original-title="Change project status to Public or Private.">
                                                              <span style="font-size:30px; padding: 10px 0;" class="eyeToggle fa fa-eye-slash"></span>
                                                              <input type="hidden" name="status" value="0">
                                                            </button>
                                            </div> -->

<!-- <button  class="btn btn-default popovers" data-container="body" data-trigger="hover" data-placement="top" data-content=" " data-original-title="Change project status to pubblic or private.">
  <i  class=' fa fa-eye'></i></button> -->

<!-- <script>$('.fa-eye').click(function(){
$(this).toggleClass('glyphicon-chevron-up');</script> -->


                                                            <div class="form-actions">
                                                              <a class="col-md-offset-8 " href="<?php echo $_SESSION['last_url'];?>"><button type="button"  class="btn btn-lg dark btn-outline " >Cancel</button></a>
                                                              <button type="submit" class="btn btn-lg firecollect" name="add_project" >Add Project</button>
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
                                                                             <input style="color:orange;" type="text" class="form-control" id="form_control_1" >
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
                                                                    <button type="button" class="btn " style="background-color:#FFA500; color:white;">Request New Research Area</button>
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
      <script src="includes/js/daterangepicker.js"></script>
      <script src="includes/js/toggle.js" type="text/javascript"></script>
