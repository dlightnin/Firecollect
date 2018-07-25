<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';

  function validateInput($data){
    $data = trim(stripcslashes(htmlspecialchars($data)));
    return $data;
  }

if (isset($_POST['data_set_id'])) {
  $data_set_id = validateInput($_POST['data_set_id']);
  $_SESSION['current_data_set_id']= $data_set_id;

}
else{
    $data_set_id = $_SESSION['current_data_set_id'];
}
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
                                                            <span class="title firecollect">Add Variables to Data Set </span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                      <!--BEGIN PORTLET BODY  -->

                                                      <!--BEGIN FORMS  -->
                                                      <div class="portlet-body form">
                                                        <form role="form" method="post" action="includes/save_variable_info.php" id="form_sample_1">
                                                          <div class="form-body">

                                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>

                                                            <h4 style='margin-bottom:20px;' class= 'subject firecollect'>Data Set Related:<small><p class='text firecollect' style='padding-left:15px; margin-top:10px;'><?php echo $data_set_name; ?></p></small></h4>





                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                 <input required='true'  type="text" class="form-control" id="form_control_1" name="variable_name" >
                                                                 <label for="form_control_1">Name of Variable:</label>
                                                                 <span class="help-block">Enter the name of the variable.</span>
                                                             </div>

                                                             <div class="form-group form-md-line-input form-md-floating-label">
                                                                  <input   type="text" class="form-control" id="form_control_1" name="abbreviation" >
                                                                  <label for="form_control_1">Abbreviation(s):</label>
                                                                  <span class="help-block">List of abbreviations that may be found on the data files identifying the specified variable.</span>
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
                                                                   <textarea  class="form-control" rows="3" name="definition" ></textarea>
                                                                   <label for="form_control_1">Definition:</label>
                                                                   <span class="help-block">A definition of the variable.</span>
                                                              </div>

                                                              <div class="form-group form-md-line-input form-md-floating-label">
                                                                   <input   type="text" class="form-control" id="form_control_1" name="unit" >
                                                                   <label for="form_control_1">Unit of Measurement:</label>
                                                                   <span class="help-block">Indicate the unit of measurement using no abbreviations.</span>
                                                               </div>

                                                               <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <textarea  class="form-control" rows="3" name="precision" ></textarea>
                                                                    <label for="form_control_1">Precision of Measurement:</label>
                                                                    <span class="help-block">Give error bounds and explain what they refer to (e.g that of determinations by instrument, among replicate samples at a single location, among locations within a given area, etc.).</span>
                                                               </div>

                                                               <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <textarea  class="form-control" rows="3" name="variable_list" ></textarea>
                                                                    <label for="form_control_1">Range or List of Variables:</label>
                                                                    <span class="help-block">The minimun and maximun values, or for categorical variables, a list of the possible variables or a reference to a file that list them.</span>
                                                               </div>

                                                               <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <textarea  class="form-control" rows="3" name="observations" ></textarea>
                                                                    <label for="form_control_1">Observations:</label>
                                                                    <span class="help-block">Any particular comment regarding the format, measurements, etc. of the data file.</span>
                                                               </div>

                                                               <div class="form-group form-md-line-input form-md-floating-label">
                                                                    <textarea  class="form-control" rows="3" name="missing_data_codes" ></textarea>
                                                                    <label for="form_control_1">Missing Data Codes:</label>
                                                                    <span class="help-block">A list of codes that identify how missing data is coded on the data file (e.g. empty space, dashes, zeros) such that a missing data can be differentiated from measured value of zero (e.g. 0.0).</span>
                                                               </div>






<!-- <button  class="btn btn-default popovers" data-container="body" data-trigger="hover" data-placement="top" data-content=" " data-original-title="Change project status to pubblic or private.">
  <i  class=' fa fa-eye'></i></button> -->

<!-- <script>$('.fa-eye').click(function(){
$(this).toggleClass('glyphicon-chevron-up');</script> -->


                                                            <div class="form-actions">
                                                              <a class="col-md-offset-8 " href="<?php echo $_SESSION['last_url'];?>"><button type="button"  class="btn btn-lg dark btn-outline  " >Cancel</button></a>
                                                              <button type="submit" class="btn firecollect btn-lg"  name="add_variable" >Add Variable</button>
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
                                                                             <input  style="color:orange;" type="text" class="form-control" id="form_control_1" >
                                                                             <label for="form_control_1">Research Area of this Field of Study:</label>
                                                                             <span class="help-block">Type the name of the research area you want to add to this field of study.</span>
                                                                         </div>
                                                                         <div class="form-group form-md-line-input form-md-floating-label">
                                                                              <textarea  class="form-control" rows="3"></textarea>
                                                                              <label for="form_control_1">Description:</label>
                                                                              <span class="help-block">Type a description about this research area to evaluate it.</span>

                                                                         </div>


















                                                                      </div>
                                                                    </form>
                                                                  </div>
                                                                  <!--FORMS END  -->






                                                                    </div>

                                                                <!-- <div class="modal-footer">
                                                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn " style="background-color:#FFA500; color:white;">Request New Research Area</button>
                                                                </div> -->
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
