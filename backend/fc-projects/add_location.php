<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';

  $project_id = $_SESSION['current_project_id'];


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

                                                            <span class="title firecollect">Project Map</span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                      <!--BEGIN PORTLET BODY  -->
                                                      <div class="alert alert-success display-show"><b>Drag</b> the marker to obtain coordinates.
                                                      <button class="close" data-close="alert"></button>  </div>

                                                      <!--BEGIN FORMS  -->
                                                      <div class="portlet-body form">
                                                        <form role="form" method="post" action="includes/save_map_info.php" id="form_sample_1">
                                                          <div class="form-body">
                                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>

                                                            <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">

                                                            <div id='map' style='height:400px;width:100%;margin-bottom:40px;padding:0;' ></div>


                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                 <input required='true' type="text" class="form-control " id="form_control_1" name="location" value="">
                                                                 <label for="form_control_1">Location:</label>
                                                                 <span class="help-block">Location of the project...</span>
                                                             </div>


                                                            <!-- <div class="row" >
                                                              <div > -->

                                                                  <div class="form-group form-md-line-input form-md-floating-label ">
                                                                    <input number='true' required='true'  type="text" id="form_control_1" class="form-control  marker_latitude  " name="latitude" >
                                                                    <label for="form_control_1" >Latitude:</label>
                                                                  </div>
                                                                  <div class="form-group form-md-line-input form-md-floating-label ">
                                                                    <input number='true' required='true'  type="text" id="form_control_1" class="form-control   marker_longitude " name="longitude" >
                                                                    <label for="form_control_1" >Longitude:</label>
                                                                  </div>


                                                              <!-- </div>
                                                            </div> -->





                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                 <textarea required="true" class="form-control" name="description" rows="3"></textarea>
                                                                 <label for="form_control_1">Description:</label>
                                                                 <!-- <span class="help-block">Type a description about location.</span> -->

                                                            </div>


                                                            <div class="form-actions">
                                                              <a class="col-md-offset-8 " href="<?php echo $_SESSION['last_url'];?>"><button type="button"  class="btn btn-lg dark btn-outline " >Cancel</button></a>
                                                              <button type="submit" class="btn btn-lg firecollect"  name="add_marker" >Add Location</button>
                                                            </div>




                                                          <!-- </div> -->
                                                        </form>
                                                      </div>
                                                      <!-- END FORMS -->



                                                      <!--END PORTLET BODY  -->
                                                    </div>
                                                </div>
                    <!-- END PORTLET -->


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
      <script src="includes/google_map_functions.js" type="text/javascript"></script>
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9qbfEbiRczyw1stXbs0YMe2TVUCuMwTQ&callback=initMap" ></script>
