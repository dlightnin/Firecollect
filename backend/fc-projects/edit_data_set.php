<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';




  if ($_GET['id']){
  $data_set_id = $_GET['id'];
  $_SESSION['current_data_set_id']= $data_set_id;

}else{
  $data_set_id = $_SESSION['current_data_set_id'];


}

  $query= "SELECT * FROM tbl_data_set where id ='$data_set_id'";

  $result = $db_conn->query($query);

  $row = $result->fetch_assoc();
    # code...
    $data_set_name= $row['name'];
    $project_id = $row['project_id'];
    $description = $row['description'];
    $method = $row['method'];
    $times = $row['times'];
    $periodicity = $row['periodicity'];
    $period= $row['period'];
    $reference = $row['reference'];
    $cross_reference = $row['cross_reference'];
    $keywords = $row['keywords'];
    $observations = $row['observations'];
    $formula = $row['formula'];





    $query2 = "SELECT * FROM tbl_projects WHERE id='$project_id'";
    $result2 = $db_conn->query($query2);
    $row2 = $result2->fetch_assoc();
    $project_title = $row2['title'];

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
                                                            <span class="title firecollect">Edit Data Set</span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                      <!--BEGIN PORTLET BODY  -->

                                                      <!--BEGIN FORMS  -->
                                                      <div class="portlet-body form">
                                                        <form role="form" method="post" action="includes/update_data_set_info.php" id="form_sample_1">
                                                          <div class="form-body">
                                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>

                                                            <input  type="hidden" name="data_set_id" value="<?php echo $data_set_id; ?>">


                                                            <h4 style='margin-bottom:20px;' class='subject firecollect'>Project Related:<small class='text firecollect' style='padding-left:10px;'><?php echo $project_title; ?></small></h4>




                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                 <input  required='true'   type="text" class="form-control" id="form_control_1" name="data_set_name" value="<?php echo $data_set_name; ?>">
                                                                 <label for="form_control_1">Data Set Name:</label>
                                                                 <span class="help-block">Name to identify this data set...</span>
                                                             </div>

                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <textarea required='true' class="form-control" rows="3" name="data_set_description" ><?php echo $description;?></textarea>
                                                                   <label for="form_control_1">Description:</label>
                                                                   <span class="help-block">Type a description in detail about this Data Set.</span>
                                                              </div>


                                                              </div>


                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <textarea required='true'  class="form-control" rows="3" name="method" ><?php echo $method;?></textarea>
                                                                   <label for="form_control_1">Method:</label>
                                                                   <span class="help-block">Description of the methods used to collect and analyze the data and the type of analysis used.</span>
                                                              </div>




                                                              <div class='row' style='margin-top:40px;'>
                                                                <div class='form-group'>

                                                                    <label class='control-label col-md-2' style='color:#999;font-size:16px;'>Period:
                                                                      <span class="required">*</span>
                                                                    </label>
                                                                    <div class='col-md-4' id='datepicker'>
                                                                         <input required='true' type='text' class='form-control input-medium' name='datefilter2' value="<?php echo $period; ?>" />
                                                                        <span class='help-block'> </span>
                                                                    </div>
                                                                </div>
                                                              </div>

                                                              <div class="row" style="margin-top:20px;">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                  <!-- <div class="col-md-2"> -->
                                                                    <label for="form-control" class="col-md-2" style="color:#999;font-size:16px;">Periodicity of Sample:</label>
                                                                    <div class="col-md-2">
                                                                      <input  required='true'  type="text" id="form_control_1" class="form-control input-small  popovers" name="times" style="margin-left:15px;" data-container="body" data-trigger="hover" data-placement="top" data-content=" " data-original-title="*Numbers Only " value="<?php echo $times; ?>">
                                                                      <span class="help-block ">The period and periodicity and major temporal gaps or anomalies in the pattern of data collection.</span>
                                                                    </div><span class="col-md-1">Times</span>
                                                                    <div class="col-md-2">
                                                                      <select  class="form-control input-small " name="periodicity">
                                                                        <option value="Daily" <?php if ($periodicity === 'Daily') echo " selected='selected'";?> >Daily</option>
                                                                        <option value="Weekly" <?php if ($periodicity === 'Weekly') echo " selected='selected'";?> >Weekly</option>
                                                                        <option value="Monthly" <?php if ($periodicity === 'Monthly') echo " selected='selected'";?> >Monthly</option>
                                                                        <option value="Annually" <?php if ($periodicity === 'Annually') echo " selected='selected'";?> >Annually</option>

                                                                      </select>
                                                                    </div>

                                                                  <!-- </div> -->
                                                                </div>
                                                              </div>

                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <textarea required='true' class="form-control" rows="3" name="reference"><?php echo $reference;?></textarea>
                                                                   <label for="form_control_1">Reference:</label>
                                                                   <span class="help-block">Complete citations of publications, technical reports or grant proposals that were followed for methods, identifications of of species and/or site locations.</span>

                                                              </div>

                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <textarea required='true' class="form-control" rows="3" name="cross_reference"><?php echo $cross_reference;?></textarea>
                                                                   <label for="form_control_1">Cross Reference:</label>
                                                                   <span class="help-block">Reference to other data sets (catalogued or non-catalogued) that are related to this data set.</span>

                                                              </div>





                                                              <div class="row">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3" style="color:#999;font-size:16px;">Keywords:</label>
                                                                    <div class="col-md-6">
                                                                        <input  required='true'  type="text" class="form-control input-large"  data-role="tagsinput" name="keywords"  value="<?php echo $keywords; ?>">
                                                                    </div>
                                                                </div>
                                                              </div>



                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <textarea required='true' class="form-control" rows="3" name="observations"><?php echo $observations;?></textarea>
                                                                   <label for="form_control_1">Observations:</label>
                                                                   <span class="help-block">Any particular comment regarding the format, measurements, etc. of Data Set.</span>

                                                              </div>


                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <textarea required='true' class="form-control" rows="3" name="formula"> <?php echo $formula;?></textarea>
                                                                   <label for="form_control_1">Formula:</label>
                                                                   <span class="help-block">Any particular formula that you use on this Data Set.</span>

                                                              </div>



                                                            <div class="form-actions">
                                                            <a class="col-md-offset-8 " href="<?php echo $_SESSION['last_url'];?>"><button type="button"  class="btn btn-lg dark btn-outline  " >Cancel</button></a>
                                                            <button type="submit" class="btn firecollect btn-lg"  name="edit_data_set" >Apply Changes</button>

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
                                                                             <input  required='true'  style="color:orange;" type="text" class="form-control" id="form_control_1" >
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
      <script src="includes/js/daterangepicker.js"></script>
