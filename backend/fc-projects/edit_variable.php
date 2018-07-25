<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';




  $variable_id = $_GET['id'];

  $_SESSION['current_variable_id']=$variable_id;

  $query= "SELECT * FROM tbl_variables where id ='$variable_id'";

  $result = $db_conn->query($query);

  $row = $result->fetch_assoc();
    # code...
    $variable_name = $row['name'];
    $abbreviation = $row['abbreviation'];
    $data_type = $row['data_type'];
    $definition = $row['definition'];
    $unit = $row['unit_of_measurement'];
    $precision = $row['precision_of_measurement'];
    $variable_list = $row['variable_list'];
    $observations = $row['observations'];
    $missing_data_codes = $row['missing_data_codes'];
    $data_set_id = $row['data_set_id'];

    $query= "SELECT * FROM tbl_data_set where id ='$data_set_id'";
    $result = $db_conn->query($query);
    $row = $result->fetch_assoc();

    $data_set_name=$row['name'];





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

                                                            <span class="title firecollect">Edit Variable</span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                      <!--BEGIN PORTLET BODY  -->
                                                      <div class="portlet-body form">
                                                        <form role="form" method="post" action="includes/update_variable_info.php" id="form_sample_1">
                                                          <div class="form-body">

                                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>

                                                            <h4 style='margin-bottom:20px;' class= 'subject firecollect'>Data Set Related:<small  style='padding-left:10px;'><p class="text firecollect"><?php echo $data_set_name; ?></p></small></h4>
                                                            <span class="help-block">Variables will be created under this Data Set.</span>




                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                 <input required='true'  type="text" class="form-control" id="form_control_1" name="variable_name"  value="<?php echo $variable_name;?>">
                                                                 <label for="form_control_1">Name of Variable:</label>
                                                                 <span class="help-block">Enter the name of the variable.</span>
                                                             </div>

                                                             <div class="form-group form-md-line-input form-md-floating-label">
                                                                  <input   type="text" class="form-control" id="form_control_1" name="abbreviation"  value="<?php echo $abbreviation;?>" >
                                                                  <label for="form_control_1">Abbreviation(s):</label>
                                                                  <span class="help-block">List of abbreviations that may be found on the data files identifying the specified variable.</span>
                                                              </div>

                                                              <div class="row" style="margin-top:20px;">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                  <!-- <div class="col-md-2"> -->
                                                                    <label for="form-control" class="col-md-2" style="color:#999;font-size:16px;">Data Type:</label>

                                                                    <div class="col-md-2">
                                                                      <select  class="form-control input-small  popovers" name="data_type" style="margin-left:15px;" data-container="body" data-trigger="hover" data-placement="top" data-content=" " data-original-title="The format specification of the data found in the specified column. ">
                                                                        <option value="Alphanumeric" <?php if ($data_type === 'Alphanumeric') echo " selected='selected'";?> >Alphanumeric</option>
                                                                        <option value="Numeric | Integer" <?php if ($data_type === 'Numeric | Integer') echo " selected='selected'";?> >Numeric | Integer</option>
                                                                        <option value="Numeric | Decimal" <?php if ($data_type === 'Numeric | Decimal') echo " selected='selected'";?> >Numeric | Decimal</option>
                                                                        <option value="Logical" <?php if ($data_type === 'Logical') echo " selected='selected'";?> >Logical</option>
                                                                        <option value="Date" <?php if ($data_type === 'Date') echo " selected='selected'";?> >Date</option>
                                                                        <option value="Other" <?php if ($data_type === 'Other') echo " selected='selected'";?> >Other</option>
                                                                        <option value="Time" <?php if ($data_type === 'Time') echo " selected='selected'";?> >Time</option>


                                                                      </select>
                                                                    </div>
                                                                  <!-- </div> -->
                                                                </div>
                                                              </div>

                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <textarea   class="form-control" rows="3" name="definition" > <?php echo $definition;?></textarea>
                                                                   <label for="form_control_1">Definition:</label>
                                                                   <span class="help-block">A definition of the variable.</span>
                                                              </div>

                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <input   type="text" class="form-control" id="form_control_1" name="unit"  value="<?php echo $unit;?>">
                                                                   <label for="form_control_1">Unit of Measurement:</label>
                                                                   <span class="help-block">Indicate the unit of measurement using no abbreviations.</span>
                                                               </div>

                                                               <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <textarea   class="form-control" rows="3" name="precision"  ><?php echo $precision;?></textarea>
                                                                    <label for="form_control_1">Precision of Measurement:</label>
                                                                    <span class="help-block">Give error bounds and explain what they refer to (e.g that of determinations by instrument, among replicate samples at a single location, among locations within a given area, etc.).</span>
                                                               </div>

                                                               <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <textarea   class="form-control" rows="3" name="variable_list" > <?php echo $variable_list;?></textarea>
                                                                    <label for="form_control_1">Range or List of Variables:</label>
                                                                    <span class="help-block">The minimun and maximun values, or for categorical variables, a list of the possible variables or a reference to a file that list them.</span>
                                                               </div>

                                                               <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <textarea   class="form-control" rows="3" name="observations" > <?php echo $observations;?></textarea>
                                                                    <label for="form_control_1">Observations:</label>
                                                                    <span class="help-block">Any particular comment regarding the format, measurements, etc. of the data file.</span>
                                                               </div>

                                                               <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <textarea   class="form-control" rows="3" name="missing_data_codes" > <?php echo $missing_data_codes;?></textarea>
                                                                    <label for="form_control_1">Missing Data Codes:</label>
                                                                    <span class="help-block">A list of codes that identify how missing data is coded on the data file (e.g. empty space, dashes, zeros) such that a missing data can be differentiated from measured value of zero (e.g. 0.0).</span>
                                                               </div>






                                                      <!-- <button  class="btn btn-default popovers" data-container="body" data-trigger="hover" data-placement="top" data-content=" " data-original-title="Change project status to pubblic or private.">
                                                      <i  class=' fa fa-eye'></i></button> -->

                                                      <!-- <script>$('.fa-eye').click(function(){
                                                      $(this).toggleClass('glyphicon-chevron-up');</script> -->


                                                            <div class="form-actions">
                                                              <a class="col-md-offset-8 " href="<?php echo $_SESSION['last_url'];?>"><button type="button"  class="btn btn-lg dark btn-outline " >Cancel</button></a>
                                                              <button type="submit" class="btn btn-lg firecollect" name="edit_variable" >Apply Changes</button>
                                                            </div>




                                                          <!-- </div> -->
                                                        </form>
                                                      </div>
                                                      <!-- END FORMS -->



                                                      <!--END PORTLET BODY  -->
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
                                                                             <input  style="color:orange;" type="text" class="form-control" id="form_control_1" >
                                                                             <label for="form_control_1">Research Area of this Field of Study:</label>
                                                                             <span class="help-block">Type the name of the research area you want to add to this field of study.</span>
                                                                         </div>
                                                                         <div class="form-group form-md-line-input form-md-floating-label">
                                                                              <textarea   class="form-control" rows="3"></textarea>
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
