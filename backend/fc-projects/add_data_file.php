<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';

  function validateInput($data){
    $data = trim(stripcslashes(htmlspecialchars($data)));
    return $data;
  }


    $data_set_id = $_SESSION['current_data_set_id'];

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
                                                            <i class="icon-plus font-red"></i>
                                                            <span class="caption-subject font-red sbold uppercase">Create Data Files </span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                      <!--BEGIN PORTLET BODY  -->

                                                      <!--BEGIN FORMS  -->
                                                      <div class="portlet-body form">
                                                        <form role="form" method="post" action="includes/save_variable_info.php">
                                                          <div class="form-body">

                                                            <h4 style='margin-bottom:20px;' class= 'caption-subject font-grey-gallery sbold uppercase'>Data Set Related:<small class='small grey-cascade' style='padding-left:10px;'><?php echo $data_set_name; ?></small></h4>
                                                            <span style='margin-bottom:40px;' class="help-block">Variables will be created under this Data Set.</span>

                                                            <div class="row">

                                                                <div class="form-group">
                                                                  <label class="control-label col-md-3" style="color:#999;font-size:16px;">Upload file: </label>
                                                                  <div class="col-md-3">
                                                                      <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                          <div class="input-group input-large">
                                                                              <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                                                  <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                                                  <span class="fileinput-filename"> </span>
                                                                              </div>
                                                                              <span class="input-group-addon btn default btn-file">
                                                                                  <span class="fileinput-new"> Select file </span>
                                                                                  <span class="fileinput-exists"> Change </span>
                                                                                  <input type="file" name="file"> </span>
                                                                              <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                          </div>




                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                 <input  type="text" class="form-control" id="form_control_1" name="variable_name" >
                                                                 <label for="form_control_1">Name of Data File:</label>
                                                                 <span class="help-block">A descriptive name of the file.</span>
                                                             </div>

                                                             <div class="row" style="margin-top:40px;">
                                                               <div class="form-group">

                                                                   <label class="control-label col-md-2" style="color:#999;font-size:16px;">Collection Time Period: </label>
                                                                   <div class="col-md-4">
                                                                       <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                                                           <input type="text" class="form-control" name="start_date">
                                                                           <span class="input-group-addon"> to </span>
                                                                           <input type="text" class="form-control" name="end_date"> </div>
                                                                       <!-- /input-group -->
                                                                       <span class="help-block"> The first and last day in which data was gathered.</span>
                                                                   </div>
                                                               </div>
                                                             </div>
                                                             <div class="row" style="margin-top:20px;">
                                                               <div class="form-group form-md-line-input form-md-floating-label">
                                                                 <!-- <div class="col-md-2"> -->
                                                                   <label for="form-control" class="col-md-2" style="color:#999;font-size:16px;">Periodicity of Sample:</label>
                                                                   <div class="col-md-2">
                                                                     <input type="text" id="form_control_1" class="form-control input-small  popovers" name="times" style="margin-left:15px;" data-container="body" data-trigger="hover" data-placement="top" data-content=" " data-original-title="*Numbers Only ">
                                                                     <span class="help-block ">Frequency of data gathering.</span>
                                                                   </div><span class="col-md-1">Times</span>
                                                                   <div class="col-md-2">
                                                                     <select  class="form-control input-small " name="periodicity">
                                                                         <option>Daily</option>
                                                                         <option>Weekly</option>
                                                                         <option>Monthly</option>
                                                                         <option>Annually</option>
                                                                     </select>
                                                                   </div>

                                                                 <!-- </div> -->
                                                               </div>
                                                             </div>

                                                              <div class="row" style="margin-top:20px;">
                                                                <div class="form-group form-md-line-input form-md-floating-label">
                                                                  <!-- <div class="col-md-2"> -->
                                                                    <label for="form-control" class="col-md-2" style="color:#999;font-size:16px;">Data Type:</label>

                                                                    <div class="col-md-2">
                                                                      <select  class="form-control input-small  popovers" name="data_type" style="margin-left:15px;" data-container="body" data-trigger="hover" data-placement="top" data-content=" " data-original-title="The format specification of the data found in the specified column. ">
                                                                          <option>Alphanumeric</option>
                                                                          <option>Numeric | Integer</option>
                                                                          <option>Numeric | Decimal</option>
                                                                          <option>Logical</option>
                                                                          <option>Date</option>
                                                                          <option>Other</option>
                                                                          <option>Time</option>

                                                                      </select>
                                                                    </div>
                                                                  <!-- </div> -->
                                                                </div>
                                                              </div>

                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <textarea class="form-control" rows="3" name="definition" ></textarea>
                                                                   <label for="form_control_1">Definition:</label>
                                                                   <span class="help-block">A definition of the variable.</span>
                                                              </div>

                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <input  type="text" class="form-control" id="form_control_1" name="unit" >
                                                                   <label for="form_control_1">Unit of Measurement:</label>
                                                                   <span class="help-block">Indicate the unit of measurement using no abbreviations.</span>
                                                               </div>

                                                               <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <textarea class="form-control" rows="3" name="precision" ></textarea>
                                                                    <label for="form_control_1">Precision of Measurement:</label>
                                                                    <span class="help-block">Give error bounds and explain what they refer to (e.g that of determinations by instrument, among replicate samples at a single location, among locations within a given area, etc.).</span>
                                                               </div>

                                                               <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <textarea class="form-control" rows="3" name="variable_list" ></textarea>
                                                                    <label for="form_control_1">Range or List of Variables:</label>
                                                                    <span class="help-block">The minimun and maximun values, or for categorical variables, a list of the possible variables or a reference to a file that list them.</span>
                                                               </div>

                                                               <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <textarea class="form-control" rows="3" name="observations" ></textarea>
                                                                    <label for="form_control_1">Observations:</label>
                                                                    <span class="help-block">Any particular comment regarding the format, measurements, etc. of the data file.</span>
                                                               </div>

                                                               <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <textarea class="form-control" rows="3" name="missing_data_codes" ></textarea>
                                                                    <label for="form_control_1">Missing Data Codes:</label>
                                                                    <span class="help-block">A list of codes that identify how missing data is coded on the data file (e.g. empty space, dashes, zeros) such that a missing data can be differentiated from measured value of zero (e.g. 0.0).</span>
                                                               </div>






<!-- <button  class="btn btn-default popovers" data-container="body" data-trigger="hover" data-placement="top" data-content=" " data-original-title="Change project status to pubblic or private.">
  <i  class=' fa fa-eye'></i></button> -->

<!-- <script>$('.fa-eye').click(function(){
$(this).toggleClass('glyphicon-chevron-up');</script> -->



                                                            <a class="col-md-offset-8 " href="data_sets.php"><button type="button"  class="btn btn-lg dark btn-outline  " >Cancel</button></a>
                                                            <button type="submit" class="btn btn-lg  " style="background-color:#FFA500; color:white;" name="add_variable" >Submit</button>





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
                                                                              <textarea class="form-control" rows="3"></textarea>
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
      <script src="toggle.js" type="text/javascript"></script>
