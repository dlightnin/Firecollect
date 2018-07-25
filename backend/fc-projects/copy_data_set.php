<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';
  $u_id = $_SESSION['user_id'];

  $data_set_id = $_SESSION['current_data_set_id'];

  $query= "SELECT * FROM tbl_data_set where id ='$data_set_id'";

  $result = $db_conn->query($query);

  // $row = $result->fetch_assoc();
  // echo $row['status'];

  $row = $result->fetch_assoc();
    # code...
    $name= $row['name'];





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

                                                            <span class="title firecollect">Copy Data Set</span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                      <!--BEGIN PORTLET BODY  -->

                                                      <!--BEGIN FORMS  -->
                                                      <div class="portlet-body form">
                                                        <form role="form" method="post" action="includes/save_copy_data_set_info.php" id="form_sample_1">
                                                          <div class="form-body">




                                    <div class="form-group">
                                        <label for="single" class="form_control_1">Select Associated Project:</label>
                                        <select id="single" class="form-control select2" name="project_id">
                                      <?php
                                      $query2= "SELECT * FROM tbl_projects where u_id ='$u_id'";

                                      $result2 = $db_conn->query($query2);

                                      while ($row2 = $result2->fetch_assoc() ) {      # code...
                                        $title= $row2['title'];
                                        $project_id = $row2['id'];
                                        echo "
                                                <option value='$project_id'>$title</option>
                                                ";

                                      }


                                      ?>

                                  </select>
                                  <!-- <label for="form_control_1">Copy of Project:</label> -->
                              </div>


                                                             <div class="form-group form-md-line-input form-md-floating-label">
                                                                  <input  required='true' type="text" class="form-control copy_name" id="form_control_1" name="name" value="<?php echo "Copy of ".$name; ?>" >
                                                                  <label for="form_control_1">Name of Dataset:</label>
                                                                  <span class="help-block">Type a name to identify this Data Set.</span>
                                                              </div>


                                                            <div class="form-actions">
                                                              <a class="col-md-offset-8 " href="<?php echo $_SESSION['last_url'];?>"><button type="button"  class="btn btn-lg dark btn-outline " >Cancel</button></a>
                                                              <button type="submit" class="btn firecollect btn-lg" name="copy_data_set" >Copy Data Set</button>
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
      <script src="toggle.js" type="text/javascript"></script>
      <!-- <script>
        $("#single").change(function() {
          var project_copy = "Copy of "+String($('#single :selected').text());
          $(".copy_name").attr("value", project_copy);

        });
      </script> -->
