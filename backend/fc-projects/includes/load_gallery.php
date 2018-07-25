<?php
  require '../../includes/dbConnect.php' ;
  include '../../includes/topMenu.php';
  include '../../includes/sideBar.php';


  $user_id = $_SESSION["user_id"];
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
                                                        <div class="caption" >
                                                            <i class="fa fa-image font-red"></i>
                                                            <span class="caption-subject font-red sbold uppercase">Image Gallery</span>
                                                        </div>
                                                        <button class="btn btn-primary pull-right select_img" >select</button>

                                                    </div>

                                                    <div  class="portlet-body gallery_container" >
                                                      <!-- <span class= "btn btn-primary toggle-slide">show/hide</span> -->

                                                      <form action="includes/upload_dropzone.php" class="dropzone dropzone-file-area" id="my-dropzone" style="width: auto; margin: 50px;" method="post" enctype="multipart/form-data">
                                                        <!-- <div class="fallback">
                                                          <input name="file" type="file" multiple />
                                                        </div> -->
                                                          <h3 class="sbold">Drop files here or click to upload</h3>

                                                          <p> This is just a demo dropzone. Selected files are not actually uploaded. </p>

                                                      </form>
<div class="mt-element-card mt-element-overlay">
                                        <div class='row'>



<!-- <div class='row'> -->

                                              <?php

                                              $query= "SELECT * FROM tbl_project_images WHERE project_id='$project_id'";

                                              $result = $db_conn->query($query);
                                              // $row = $result->fetch_assoc();
                                              $i = 0;
                                              while ($row = $result->fetch_assoc() ) {

                                                $id = $row['id'];
                                                $file_name = $row['name'];
                                                $file_type = $row['type'];
                                                $file_description = $row['description'];
                                                $file_size = $row['size'];
                                                $real_name = $row['real_name'];







                                              echo "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>
                                                      <div class='contain_img'>
                                                      <div data-toggle='modal' href='#modal_img$i' >
                                                      <span class='imgCheckbox0'>
                                                          <img id='img$i' class='imgcheck' style='height:188px;width:281px;' name = $file_name src='uploads/$project_id/img/$file_name' />
                                                      </span>
                                                      </div>
                                                      </div>

                                                "

                                                ;

                                                // <div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>
                                                // <div class='mt-card-item' style = 'border-top:none; width:100%; height:150px;'>
                                                //     <div class='mt-card-avatar mt-overlay-1'>
                                                //         <img name = $file_name src='includes/uploads/$file_name' />
                                                //         <div class='mt-overlay'>
                                                //             <ul class='mt-info'>
                                                //                 <li>
                                                //                     <a class='btn default btn-outline' data-toggle='modal' href='#modal_img$i'>
                                                //                         <i  style='font-size: 20px;'  class='fa fa-search-plus' ></i>
                                                //                     </a>
                                                //                 </li>
                                                //
                                                //             </ul>
                                                //         </div>
                                                //     </div>
                                                // </div>




                                                echo  "    <div class='modal fade' id='modal_img$i' tabindex='-1' role='dialog' aria-hidden='true' >
                                                                                  <div class='modal-dialog modal-lg'>
                                                                                      <div class='modal-content'>
                                                                                          <div class='modal-header'>
                                                                                              <button type='button' class='close close_modal' data-dismiss='modal' aria-hidden='true'></button>
                                                                                              <h4 class='modal-title font-red'  ><span class='fa fa-image font-red'> </span> Image</h4>
                                                                                          </div>
                                                                                          <div class='modal-body' style='position:relative;'>
                                                                                            <!--BEGIN FORMS  -->
                                                                                            <div class='portlet-body form'>
                                                                                              <form role='form' method='POST' action='includes/upload_image.php' enctype='multipart/form-data'>
                                                                                                <div class='form-body'>

                                                                                                <div class='row'>


                                                                                                    <div class='col-md-7'>
                                                                                                        <img src='uploads/$project_id/img/$file_name'  style='height:100%;width:100%'/>
                                                                                                        <div class='prev_modal btn btn-md default' style='position:absolute;left:10px;top:-34px;z-index:1;'><span class='fa fa-arrow-left'> </span></div>


                                                                                                    </div>
                                                                                                    <div class='col-md-5'>
                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                              <div class='form-control form-control-static'> $file_type</div>
                                                                                                              <label for='form_control_1'>File Type:</label>
                                                                                                          </div>
                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                              <div class='form-control form-control-static'> $file_size</div>
                                                                                                              <label for='form_control_1'>File Size:</label>
                                                                                                          </div>

                                                                                                          <div class='next_modal btn btn-md default' style='position:absolute;right:10px;top:-34px;'><span class='fa fa-arrow-right'> </span></div>

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

                                                                              </div>



                                              ";

                                              //


                                              $i = $i + 1;

                                            }


                                              ?>








                                          </div>
                                      </div>
                                    </div>
                                    </div>



                                  </div>
                      <!-- END CONTENT -->

                    </div>
                    <!-- <div class="modal fade" id="full-width" tabindex="-1" role="basic" aria-hidden="true"> -->


                    <!-- END CONTAINER -->
                    <?php
                    include '../../includes/footer.php' ;
                    ?>
                    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
                    <script src="../../assets/global/plugins/imgCheckbox/jquery.imgcheckbox.js" type="text/javascript"></script>

                    <script>



                    </script>
