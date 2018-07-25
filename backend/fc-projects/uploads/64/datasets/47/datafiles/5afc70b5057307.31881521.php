<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';
  require_once "../includes/Classes/PHPExcel.php";



  $user_id = $_SESSION["user_id"];
  $project_id = $_SESSION['current_project_id'];
  $data_set_id=$_SESSION['current_data_set_id'];


  function human_filesize($bytes, $decimals = 2) {
      $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
      $factor = floor((strlen($bytes) - 1) / 3);
      return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
  }


function file_display($i,$id,$file_path,$file_size,$icon_class,$file_class,$count,$file_title){


    echo "<div id='df_space' class='col-lg-2 col-md-2 col-sm-6 col-xs-12'>

            <div class='datafile_border' data-toggle='modal' href='#modal_file$i'  >
            <a href='javascript:; ' style='position: absolute;' class='btn btn-icon-only red delete_single_df'>
            <i class='fa fa-remove'></i></a>

              <div id='progress$i' style='position:absolute; text-align:center; width:100%; top:0;'>
              <input id='$id' type='hidden' value='$count'>
              </div>
            <a class='datafile $file_class ' style='position:relative;'>
                    <i class='$icon_class' style='' ></i>

            </a>

            <i style='position: absolute;text-align:center;width:100%; bottom:15%;'>($file_size)</i>
            <a href='$file_path' download='$file_title' class='fa fa-download download_df' style='position: absolute;bottom:15%;'></a>


            <div class='df_title popovers' data-container='body' data-trigger='hover' data-placement='bottom' data-content='$file_title' ><span>$file_title</span></div>
            </div>";



}

?>

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">

                    <!-- BEGIN  PORTLET-->
                    <?php echo "
                    <div class ='before_portlet'>
                    <div class=' mobile_hide' style='margin-bottom:25px;'>

                    <a href='data_set_page.php'class='icon-btn '>
                      <i class='fa fa-database'></i>
                      <div> Dataset Page </div>
                    </a>

                    <a href='edit_data_set.php?id=$data_set_id' class='icon-btn '>
                     <i class='fa fa-edit'></i>
                     <div> Edit Data Set  </div>

                     </a>


                     <a href='copy_data_set.php' class='icon-btn  '>
                      <i class='fa fa-clone'></i>
                      <div> Copy Data Set </div>
                     </a>

                     <a href='' class='icon-btn  '>
                       <i class='fa fa-trash'></i>
                       <div> Delete Data Set </div>
                     </a>

                     <a href='add_variable.php' class='icon-btn  '>
                       <i class='fa fa-flask'></i>
                       <div> Add Variables </div>
                     </a>



                </div>
                <div class='mobile_menu'>
                <div class='btn-group'>
                                                                <button class='btn dark btn-lg dropdown-toggle pull-right' type='button' data-toggle='dropdown'> Actions
                                                                    <i class='fa fa-angle-down'></i>
                                                                </button>
                                                                <ul class='dropdown-menu' role='menu'>
                                                                    <li>
                                                                        <a href='data_set_page.php'> Dataset Page </a>

                                                                    </li>

                                                                    <li>
                                                                        <a href='edit_data_set.php?id=$data_set_id'> Edit Data Set </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href='copy_data_set.php'> Copy Data Set </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href='javascript:;'> Delete Data Set </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href='add_variable.php'> Add Variables </a>
                                                                    </li>



                                                                </ul>
                                                            </div>
                                                            </div>
                                                            </div>

                ";
                ?>


                    <div class="portlet light portlet-fit ">
                                                    <div class="portlet-title">
                                                        <div class="caption" >
                                                            <i class="fa fa-file font-red"></i>
                                                            <span class="caption-subject font-red sbold uppercase">Data Files</span>
                                                        </div>

                                                        <button class="btn btn-primary pull-right select_file" >select</button>
                                                        <span class= "btn green  pull-right upload_btn">upload</span>

                                                    </div>

                                                    <div  class="portlet-body gallery_container" >

                                                      <form action="includes/upload_datafile_dropzone.php" class="dropzone dropzone-file-area" id="my-dropzone" style="width: auto; margin: 50px;" method="post" enctype="multipart/form-data">
                                                        <!-- <div class="fallback ">
                                                          <input name="file" type="file" multiple />
                                                        </div> -->
                                                        <!-- <button id="dropzone-btn" class="btn btn-lg default">Upload</button> -->
                                                          <!-- <h3 class="sbold">Drop files here or click to upload</h3>

                                                          <p> This is just a demo dropzone. Selected files are not actually uploaded. </p> -->
                                                          <!-- <div class="text-center">
                                                            <input class='btn default ' name="file" type="file" multiple />

                                                          </div> -->

                                                      </form>
                                                      <!-- <div class="row"> -->
                                                          <!-- <div class="text-center  ">
                                                            <button class="btn btn-lg btn-warning dropzone_upload " >Upload</button>

                                                          </div> -->
                                                      <!-- </div> -->
                                      <div class="contain_datafiles" style="margin-top:20px;">
                                        <div class='row'>



<!-- <div class='row'> -->

                                              <?php


                                              $query= "SELECT * FROM tbl_data_files WHERE data_set_id='$data_set_id'";

                                              $result = $db_conn->query($query);
                                              // $row = $result->fetch_assoc();
                                              $i = 0;
                                              while ($row = $result->fetch_assoc() ) {

                                                $id = $row['id'];
                                                $file_name = $row['file_name'];
                                                $file_title = $row['title'];
                                                $file_type = $row['file_type'];
                                                // $file_description = $row['description'];
                                                $file_size = $row['file_size'];
                                                $times = $row['times'];
                                                $periodicity_index = $row['periodicity'];
                                                $period = $row['period'];
                                                $software_name = $row['software_name'];
                                                $software_link = $row['software_link'];
                                                $variables = $row['variables'];
                                                $comments = $row['comments'];
                                                // $real_name = $row['real_name'];
                                                $file_size=  human_filesize($file_size);
                                                $file_path="uploads/$project_id/datasets/$data_set_id/datafiles/$file_name";

                                                $periodicity_array=array("Daily","Weekly","Monthly","Annually");


                                                $queryCount="SELECT COUNT(title) + COUNT(period) + COUNT(times) + COUNT(periodicity) + COUNT(file_type) +
                                                COUNT(file_size) + COUNT(software_name) + COUNT(software_link) +
                                                COUNT(variables) + COUNT(comments) AS total FROM tbl_data_files WHERE id = $id";

                                                $resultCount = $db_conn->query($queryCount);

                                                $rowCount = $resultCount->fetch_assoc();

                                                $count = $rowCount['total'];



                                                $last_mod = "".date("F d Y H:i:s.",filemtime("uploads/$project_id/datasets/$data_set_id/datafiles/$file_title"));



                                                //
                                                // <embed src='includes/datafile_uploads/$data_set_id/$file_title' width='800px' height='2100px' />
                                                // <img id='img$i' class='gallery' style='height:188px;width:281px;' name = $file_title src='includes/datafile_uploads/$data_set_id/$file_title' />
                                                // <embed src='includes/datafile_uploads/$data_set_id/$file_title' type='application/pdf' width='100%' height='100%'>


                                                if($file_type == "text/csv" or $file_type == "application/vnd.ms-excel" or $file_type == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
                                                {
                                                  file_display($i,$id,$file_path,$file_size,'fa fa-file-excel-o','excel',$count,$file_title);
                                                }

                                                else if($file_type == "application/pdf")
                                                {
                                                  file_display($i,$id,$file_path,$file_size,'fa fa-file-pdf-o','pdf',$count,$file_title);
                                                }

                                                else if($file_type == "application/msword" or $file_type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" )
                                                {
                                                  file_display($i,$id,$file_path,$file_size,'fa fa-file-word-o','word',$count,$file_title);

                                                }

                                                else if($file_type == "image/jpeg" or $file_type == "image/png" )
                                                {
                                                  file_display($i,$id,$file_path,$file_size,'fa fa-file-image-o','image-df',$count,$file_title);

                                                }
                                                else if($file_type == "text/plain"  )
                                                {
                                                  file_display($i,$id,$file_path,$file_size,'fa fa-file-text','file-df',$count,$file_title);


                                                }

                                                else
                                                {
                                                  file_display($i,$id,$file_path,$file_size,'fa fa-file','file-df',$count,$file_title);


                                                }



                                                echo  "<div class='modal fade modal-scroll modal_tag view' id='modal_file$i' tabindex='-1' role='dialog' aria-hidden='true' >
                                                                                  <div class='modal-dialog modal-lg' style='position:relative;' id='ea'>
                                                                                      <div class='modal-content'>
                                                                                          <div class='modal-header'>
                                                                                              <button type='button' class='close close_modal' data-dismiss='modal' aria-hidden='true'></button>
                                                                                              <button id='edit-toggle' class='btn btn-primary pull-right btn_df_edit ' >Edit</button>
                                                                                              <div class='next_modal btn btn-default  pull-right'  ><span class='glyphicon glyphicon-chevron-right'> </span></div>
                                                                                              <div class='prev_modal btn btn-default pull-right' ><span class='glyphicon glyphicon-chevron-left'> </span></div>

                                                                                              <h4 class='modal-title font-red'  ><span class='fa fa-file font-red'> </span> Data File Metadata</h4>


                                                                                          </div>
                                                                                          <div class='modal-body' >
                                                                                            <!--BEGIN FORMS  -->
                                                                                            <div class='portlet-body form'>
                                                                                              <form role='form' method='POST' action='includes/upload_file.php' enctype='multipart/form-data'>
                                                                                                <div class='form-body'>

                                                                                                <div class='row'>


                                                                                                    <div class='col-md-12'>


                                                                                                        <div class='form-group form-md-line-input'>
                                                                                                            <div id='file_title' class='form-control form-control-static'> $file_title</div>
                                                                                                            <label for='form_control_1'>Name of a Data File:</label>
                                                                                                        </div>

                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                              <div class='form-control form-control-static'> $file_type</div>
                                                                                                              <label for='form_control_1'>File Type:</label>
                                                                                                          </div>
                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                              <div class='form-control form-control-static'> $file_size</div>
                                                                                                              <label for='form_control_1'>File Size:</label>
                                                                                                          </div>
                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                              <div class='form-control form-control-static'> $last_mod</div>
                                                                                                              <label for='form_control_1'>Last Modified:</label>
                                                                                                          </div>



                                                                                                          <div id='replace_modal'>
                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                              <div id='period' class='form-control form-control-static'> $period</div>
                                                                                                              <label for='form_control_1'>Collection Time Period:</label>
                                                                                                          </div>
                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                              <div id='periodicity' class='form-control form-control-static'>$times times $periodicity_array[$periodicity_index]</div>
                                                                                                              <label for='form_control_1'>Periodicity of Sample:</label>
                                                                                                          </div>
                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                              <div id='software_name' class='form-control form-control-static'>$software_name</div>
                                                                                                              <label for='form_control_1'>Software Name:</label>
                                                                                                          </div>
                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                              <div id='software_link' class='form-control form-control-static'>$software_link</div>
                                                                                                              <label for='form_control_1'>Software Link:</label>
                                                                                                          </div>

                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                              <div id='comments' class='form-control form-control-static'>$comments</div>
                                                                                                              <label for='form_control_1'>Comments:</label>
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
                                                                              </div>

                                                                              <div class='modal fade modal-scroll modal_tag edit_mode' id='modal_edit$i' tabindex='-1' role='dialog' aria-hidden='true' >
                                                                                                                <div class='modal-dialog modal-lg' style='position:relative;' id='ea'>
                                                                                                                    <div class='modal-content'>
                                                                                                                        <div class='modal-header'>

                                                                                                                            <button id='view-toggle' class='btn btn-primary pull-right ' >Cancel</button>
                                                                                                                            <button id='view-toggle' class='btn green pull-right btn_df_apply ' value = '$id'>Apply</button>

                                                                                                                            <h4 class='modal-title font-red'  ><span class='fa fa-file font-red'> </span> Data File Metadata</h4>


                                                                                                                        </div>
                                                                                                                        <div class='modal-body' >
                                                                                                                          <!--BEGIN FORMS  -->
                                                                                                                          <div class='portlet-body form'>
                                                                                                                            <form role='form' method='POST' action='includes/upload_file.php' enctype='multipart/form-data'>
                                                                                                                              <div class='form-body'>

                                                                                                                              <div class='row'>


                                                                                                                                  <div class='col-md-12'>





                                                                                                                                                                                                    <div class='form-group form-md-line-input form-md-floating-label'>
                                                                                                                                                                                                         <input  type='text' class='form-control' id='form_control_1' name='title' value='$file_title' >
                                                                                                                                                                                                         <label for='form_control_1'>Data File Identifier:</label>
                                                                                                                                                                                                         <span class='help-block'>A descriptive name of the file.</span>
                                                                                                                                                                                                     </div>

                                                                                                                                                                                                     <div class='row' style='margin-top:40px;'>
                                                                                                                                                                                                       <div class='form-group'>

                                                                                                                                                                                                           <label class='control-label col-md-2' style='color:#999;font-size:16px;'>Collection Time Period: </label>
                                                                                                                                                                                                           <div class='col-md-4' id='datepicker'>
                                                                                                                                                                                                                <input type='text' class='form-control' name='datefilter' value='$period'/>
                                                                                                                                                                                                               <span class='help-block'> The first and last day in which data was gathered.</span>
                                                                                                                                                                                                           </div>
                                                                                                                                                                                                       </div>
                                                                                                                                                                                                     </div>
                                                                                                                                                                                                     <div class='row' style='margin-top:20px;'>
                                                                                                                                                                                                       <div class='form-group form-md-line-input form-md-floating-label'>
                                                                                                                                                                                                           <label for='form-control' class='col-md-2' style='color:#999;font-size:16px;'>Periodicity of Sample:</label>
                                                                                                                                                                                                           <div class='col-md-2'>
                                                                                                                                                                                                             <input type='text' id='form_control_1' class='form-control input-small  popovers' name='times' value = '$times' style='margin-left:15px;' data-container='body' data-trigger='hover' data-placement='top' data-content=' ' data-original-title='*Numbers Only '>
                                                                                                                                                                                                             <span class='help-block '>Frequency of data gathering.</span>
                                                                                                                                                                                                           </div><span class='col-md-1'>Times</span>
                                                                                                                                                                                                           <div class='col-md-2'>
                                                                                                                                                                                                             <select  class='form-control input-small ' name='periodicity'>
                                                                                                                                                                                                                 <option value='$periodicity_index'>$periodicity_array[$periodicity_index]</option>
                                                                                                                                                                                                                 <option value='0'>Daily</option>
                                                                                                                                                                                                                 <option value='1'>Weekly</option>
                                                                                                                                                                                                                 <option value='2'>Monthly</option>
                                                                                                                                                                                                                 <option value='3'>Annually</option>
                                                                                                                                                                                                             </select>
                                                                                                                                                                                                           </div>

                                                                                                                                                                                                       </div>
                                                                                                                                                                                                     </div>






                                                                                                                                                                                                     <div class='row' style='margin-top:20px;'>

                                                                                                                                                                                                             <div class='form-group'>
                                                                                                                                                                                                             <div class='col-md-2' >
                                                                                                                                                                                                             <label for='form-control' style='color:#999;font-size:16px;'>Variables:</label>
                                                                                                                                                                                                             </div>
                                                                                                                                                                                                             <div class='col-md-8' >
                                                                                                                                                                                                                <select class='form-control select2-multiple' multiple name ='variables'>";

                                                                                                                                                                                                               $query3= "SELECT * FROM tbl_variables WHERE  data_set_id=$data_set_id ";

                                                                                                                                                                                                               $result3 = $db_conn->query($query3);
                                                                                                                                                                                                                 while ($row3 = $result3->fetch_assoc()) {
                                                                                                                                                                                                                   echo "<option value=".$row3['id'].">
                                                                                                                                                                                                                         ".$row3['name']."
                                                                                                                                                                                                                         </option>";
                                                                                                                                                                                                                 }


                                                                                                                                                                                                             echo"</select>
                                                                                                                                                                                                             </div>
                                                                                                                                                                                                     </div></div>








                                                                                                                                                                                                <div class='row' >
                                                                                                                                                                                                  <div class='form-group form-md-line-input form-md-floating-label'>
                                                                                                                                                                                                      <label for='form-control' class='col-md-2' style='color:#999;font-size:16px;'>Software Information:</label>
                                                                                                                                                                                                      <div class='col-md-3'>
                                                                                                                                                                                                      <label for='form-control'  style='color:#999;font-size:16px;'>Software Name:</label>

                                                                                                                                                                                                        <input type='text'  class='form-control input-small  popovers' name='software_name' style='margin-left:15px;' value='$software_name'>
                                                                                                                                                                                                        <span class='help-block '>Information of the software that you need to open this file.</span>
                                                                                                                                                                                                      </div>
                                                                                                                                                                                                      <div class='col-md-4'>
                                                                                                                                                                                                      <label for='form-control'  style='color:#999;font-size:16px;'>Software Resource Link:</label>
                                                                                                                                                                                                        <input type='text'  class='form-control input-small  popovers' name='software_link' style='margin-left:15px;' value='$software_link' >
                                                                                                                                                                                                        <span class='help-block '>Information of the software that you need to open this file.</span>
                                                                                                                                                                                                      </div>

                                                                                                                                                                                                  </div>
                                                                                                                                                                                                </div>

                                                                                                                                                                                                       <div class='form-group form-md-line-input form-md-floating-label'>
                                                                                                                                                                                                            <textarea class='form-control' rows='3' name='comments' >$comments</textarea>
                                                                                                                                                                                                            <label for='form_control_1'>Comments:</label>
                                                                                                                                                                                                            <span class='help-block'>Any particular comment regarding the format, measurements, etc. of the data file.</span>
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
                                                                                                            </div>

                                                                              </div>


                                              ";

                                              //




                                            // }



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
                    include '../includes/footer.php' ;

                    ?>
                    <script src="../assets/global/plugins/dropzone/data-file-dropzone.js" type="text/javascript"></script>
                    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
                    <script src="../assets/global/plugins/imgCheckbox/jquery.imgcheckbox.js" type="text/javascript"></script>
                    <script>
                    df_titles();
                    function del_from_list(list,val){
                      // temp =[];
                      for (i = 0; i < list.length; i++){
                        // delete val from list
                        if (list[i]==val){
                          list[i]=null;
                        }
                      }
                      // console.log(list);
                      // return temp;
                    }
                    function update_array(list){
                      temp =[];
                      for (i = 0; i < list.length; i++){
                        // if array
                        if (list[i]!=null){

                          temp.push(list[i]);
                        }
                      }
                      return temp;
                    }
                    function update_ids_list(list,val){
                      // temp =[];
                      for (i = 0; i < list.length; i++){
                        // delete val from list
                        if (list[i]){
                            console.log("before replacement:",$(list[i]).attr("id"));
                            $(list[i]).attr("id",val+String(i));
                            console.log("after replacement:",$(list[i]).attr("id"));
                          }
                      }
                    }
                    // REDUNDANT
                    function replace_attrs(selector,attr,id){
                      var i = 0 ;
                      $(selector).each(function () {
                          $(this).attr(attr, id+String(i));
                          i = i + 1;
                      });
                    }
                    // $(document).on("hover", '.modal', function(event) {
                    //   $(".prev_modal").css("display", "block");
                    //   $(".next_modal").css("display", "block");
                    // // },function(){
                    // //   $(".prev_modal").css("display", "none");
                    // //   $(".next_modal").css("display", "none");
                    // });
                    var all_modal_edit_ids = [];
                    var all_modal_view_ids = [];
                    var all_progress_ids = [];
                    // $(document).on('onload', '.modal-body', function(event) {
                    // store all edit modal id's
                    $(".edit_mode").each(function () {
                        all_modal_edit_ids.push("#"+String($(this).attr('id')));
                    });
                    console.log(all_modal_edit_ids);
                    // store all view modal id's
                    $(".view").each(function () {
                        all_modal_view_ids.push("#"+String($(this).attr('id')));
                    });
                    console.log(all_modal_view_ids);
                    // store all progress bar div id's
                    $(".datafile_border>div").each(function () {
                        all_progress_ids.push("#"+String($(this).attr('id')));
                    });
                    console.log(all_progress_ids);

                    function df_titles(){

                        // $(document).on('ready', function(event) {
                            $(".df_title span").each(function () {
                              var title = this.innerHTML;
                              var title_length = this.innerHTML.length;
                              console.log(title_length);
                                  if(title_length>15){
                                    this.innerHTML = title.substr(0,20) + "...";
                                  }
                                  // this.parentElement ="<div class='df_title popovers' data-toggle='popover' data-placement='bottom' data-content='"+ title+"' ><span>"+title +"</span></div>";
                                  // $(this).popover();
                            });
                          // });
                    }

                    $(document).on('ajaxComplete',function(){
                      df_titles();
                      $(".df_title").popover();

                    });
                    // });
                    // $(document).on('mouseenter', '.modal-body', function(event) {
                    //     //do something
                    //     var where = String($(this).closest(".modal_tag").attr('id'));
                    //       var id_name =  where.substr(0,10);
                    //       if (id_name == 'modal_file'){
                    //     $(".prev_modal").css("display", "block");
                    //     $(".next_modal").css("display", "block");
                    //   }
                    // });
                    // $(document).on('mouseleave', '.modal-body', function(event) {
                    //     //do something
                    //       $(".prev_modal").css("display", "none");
                    //       $(".next_modal").css("display", "none");
                    // });

                    // $(document).on("click", ":not(.modal-content, .modal-content *)", function(e){
                    //     console.log(this);
                    //     // e.stopPropagation();
                    // });​​​​​​​
                    // $(document).ready(function(){
                    var upload_flag =1;
                    $(document).on("click", '.upload_btn', function(event) {

                      // $(".upload_btn").click(function(){
                        upload_flag = (upload_flag+1)%2;
                        if (upload_flag ==1){
                          this.innerHTML="upload";
                          $(".dropzone").css("display","none");

                        }
                        else {
                          this.innerHTML="hide";
                          $(".dropzone").css("display","block");

                        }
                          // $(".dropzone").slideToggle("slow");
                      // });
                      // $(".dropzone").css("this","hide");

                    });
                    var total_modals= <?php echo $i; ?>;
                    // console.log("total_modals",total_modals);
                    $(document).on("click", '.next_modal', function(event) {
                        // alert("new link clicked!");
                        // var where= this.parentElement.parentElement.parentElement.parentElement.
                        // parentElement.parentElement.parentElement.parentElement.parentElement;
                        // var tag = $(this).closest(".modal_tag").hasClass('in');
                        // console.log("tag",tag);
                        var where = $(this).closest(".modal_tag").attr('id');
                        console.log("whereid",where);
                        var old_id= String(where);
                        // var id_name =  old_id.substr(0,10);
                        // var modal_mode = (id_name == 'modal_file')
                        // console.log("is it in view mode",modal_mode);
                        old_id =  old_id.substr(10);
                        var new_id = parseInt(old_id);
                        // where.id="modal_file".concat((num+1)%total_modals);
                        console.log("old id",old_id);
                        new_id = (new_id + 1)% total_modals;
                        new_id= String(new_id);
                        console.log("new  id",new_id);
                        // va
                        // console.log("old div", where);
                        // where.id= "modal_file".concat(new_id);
                        new_id= "modal_file".concat(new_id);
                        console.log("new where id ",new_id);
                        console.log("new div", where);

                        $("#modal_file"+ old_id).removeClass("in");
                        console.log("oldID","#modal_file"+ old_id);
                        $("#"+ String(new_id)).addClass("in");
                        $("#modal_file"+ String(old_id)).css("display","none");
                        $("#"+ String(new_id)).css("display","block");
                        console.log("where","#"+ String(old_id));
                    });

                    $(document).on("click", '.prev_modal', function(event) {

                      var where = $(this).closest(".modal_tag").attr('id');

                      console.log("whereid",where);
                      var old_id= String(where);
                      old_id =  old_id.substr(10);
                      var new_id = parseInt(old_id);
                      // where.id="modal_file".concat((num+1)%total_modals);
                      console.log("old id",old_id);
                      if (new_id == 0){
                        new_id=total_modals-1;
                        console.log("after if id",new_id);
                      }else{
                        new_id = (new_id - 1)% total_modals;

                      }
                      new_id= String(new_id);
                      console.log("new  id",new_id);
                      // va
                      // console.log("old div", where);
                      // where.id= "modal_file".concat(new_id);
                      new_id= "modal_file".concat(new_id);
                      console.log("new where id ",new_id);
                      console.log("new div", where);

                      $("#modal_file"+ old_id).removeClass("in");
                      console.log("oldID","#modal_file"+ old_id);
                      $("#"+ String(new_id)).addClass("in");
                      $("#modal_file"+ String(old_id)).css("display","none");
                      $("#"+ String(new_id)).css("display","block");
                      console.log("where","#"+ String(old_id));


});


$(document).on("click", '.close_modal', function(event) {
  $(".fade").removeClass("in ");

  $("div").removeClass("modal-backdrop ");

  $(document.body).removeClass("modal-open");
  console.log(document.body);
  $(".modal").css({
    // "transition": "all 2s",
    // "opacity":"0.",

    "display":"none"
  });
});
// close modal if click on the outside
$(document).click(function(event) {
  // var where = String($(this).closest(".modal_tag").attr('id'));
  //   var id_name =  where.substr(0,10);
  //   if (id_name == 'modal_file'){
  // var el = document.querySelector(".modal_tag.fade.in");
  // console.log("active modal",el);
  // if its in view mode ,close modal when outside click occurs
  if( $(".modal_tag.fade.in").hasClass("view") ){
  if ($(" .fade").hasClass("in")){
    if (!$(event.target).closest(".modal-lg").length) {

        $(".fade").removeClass("in ");
        $(document.body).removeClass("modal-open");
         $(".modal").css({"display":"none"});
         $("div").removeClass("modal-backdrop ");
// console.log(this);
    }
  }
}
});

$(document).on("click", '.btn_df_apply', function(event) {
  // var el = document.querySelector(".modal_tag.fade.in").find("input[name='title']")
// store each form value in Variables
console.log(this.value);
var datafile_id = this.value;
var modal_id = String($(this).closest(".modal_tag").attr('id'));
modal_id = modal_id.substr(10);
modal_file_id ="#modal_file" + modal_id;
modal_edit_id ="#modal_edit" + modal_id;

var title =$(".modal_tag.fade.in").find("input[name='title']")[0].value;
var datefilter = $(".modal_tag.fade.in").find("input[name='datefilter']")[0].value;
var times =$(".modal_tag.fade.in").find("input[name='times']")[0].value;
var index = $(".modal_tag.fade.in").find("select[name='periodicity']")[0].value;
var periodicity = $(".modal_tag.fade.in").find("select[name='periodicity']")[0].value;
// var periodicity = $(".modal_tag.fade.in").find("select[name='periodicity']")[0].options[index].text;
// index = $(".modal_tag.fade.in").find("select[name='data_type']")[0].selectedIndex;
//
// var data_type =$(".modal_tag.fade.in").find("select[name='data_type']")[0].options[index].text;
// var definition =$(".modal_tag.fade.in").find("textarea[name='definition']")[0].value;
var software_name = $(".modal_tag.fade.in").find("input[name='software_name']")[0].value;
var software_link = $(".modal_tag.fade.in").find("input[name='software_link']")[0].value;
var variables = $(".modal_tag.fade.in").find("select[name='variables']")[0];
variables = $('.modal_tag.fade.in .select2-multiple').val();
var comments = $(".modal_tag.fade.in").find("textarea[name='comments']")[0].value;



  console.log(title);
  console.log(datefilter);
  console.log(times);
  console.log(periodicity);
  console.log(software_name);
  console.log(software_link);
  console.log(variables);
  console.log(comments);
  console.log(modal_file_id);
  console.log(modal_edit_id);


  // var load_modal_file = " " + modal_file_id;
  // console.log("load edit",load_modal_file);

    $.ajax({
      url: 'includes/updateDataFileInfo.php',
      method: 'POST',
      // dataType:"text",
      data: {datafile_id:datafile_id, title:title,period:datefilter,times:times,periodicity:periodicity,
        software_name:software_name,software_link:software_link,variables:JSON.stringify(variables),comments:comments},
      success: function(data){
        if (data != ''){
          console.log(data);
          var periodicity_array= ["Daily","Weekly","Monthly","Annually"];
          $(modal_file_id).find("#file_title")[0].innerHTML = title ;
          $(modal_file_id).find("#period")[0].innerHTML = datefilter ;
          $(modal_file_id).find("#periodicity")[0].innerHTML = times + " times " + periodicity_array[periodicity];
          $(modal_file_id).find("#software_name")[0].innerHTML = software_name ;
          $(modal_file_id).find("#software_link")[0].innerHTML = software_link ;
          $(modal_file_id).find("#comments")[0].innerHTML = comments ;
          $(modal_file_id).closest("#df_space").find(".df_title")[0].innerHTML = title ;

          // array of form values
          var formValues= [title,datefilter,times,periodicity,software_name,software_link,variables,comments];
          var countVal =0;
          // count how many forms are filled
          for (i = 0; i < formValues.length; i++){
            if (formValues[i]){
              countVal = countVal+1;
              console.log(countVal);
            }
          }
          // progress bar value
          var setVal = (countVal+3)/10;
          // if all forms are filles
          if (setVal == 1){
            // console.log('progress bar :10',progressBars[parseInt(modal_id)]._opts.color='red');
                //make new bar object and replace the progress bar
                var new_id = '#progress' + String(modal_id);
                progressBars[parseInt(modal_id)].destroy();
                progressBars[parseInt(modal_id)] = addBar(setVal,'#1BBC9B',new_id);
                // progressBars[parseInt(modal_id)].style.fill='yellow';
                // console.log($(new_id).css('color','red'));
            }
            else{
                var new_id = '#progress' + String(modal_id);
                progressBars[parseInt(modal_id)].destroy();
                progressBars[parseInt(modal_id)] = addBar(setVal,'#ACB5C3',new_id);
            }
          // update progress bar with new value
          progressBars[parseInt(modal_id)].set(setVal);



          // $(modal_file_id).load(String(window.location.href)+ " " + String(modal_file_id) );

          // $(modal_edit_id).load(String(window.location.href)+ " " + String(modal_edit_id) );
        //     function () {
        //       console.log("image deleted!", data);
        //       // var count_img = 0;
        //       // $(".contain_img").each(function () {
        //       //   count_img= count_img+1;
        //       //   }
        //       //   console.log("count_img",count_img);
        //       total_modals = $(" .embed").length;
        //       console.log("images",total_modals);
        //       $(".contain_img div img").imgCheckbox();
        //       $(".contain_img div").removeAttr("data-toggle");
        //       // $(".delete_df").addClass("disabled");
        //       // $(".move_img").addClass("disabled");
        //       select_all_flag=0;
        //       $(".select_all").text("select all");
        //       console.log("select_flag",select_flag);
        //     });

        }

      }
    });
});



                    // select flag
                    var select_flag = 0;
                    // select/deselect all flag
                    var select_all_flag = 0 ;
                    $(document).on("click", '.select_file', function(event) {

                    // $(".select_file").click(function(){
                      select_flag = (select_flag + 1) % 2;
                      console.log("select_flag",select_flag);
                      // if select btn is pressed
                      if (select_flag==1){
                        // remove download links
                        $("a[download]").removeClass("fa fa-download download_df");
                        //display delete button for file
                        $(".delete_single_df").css("display","block");

                        // $(".datafile_border span").removeClass("imgChked");
                        // append delete , select all and move buttons
                        $(".portlet-title").append(" <button class='btn btn-default pull-right delete_df ' >delete</button> <button class='btn btn-default pull-right select_all' >select all</button>");
                        // <button class='btn btn-default pull-right move_img ' >move</button>
                        // $(".contain_img div img").addClass("imgcheck ");
                        // $(".contain_img div img").removeClass("gallery");
                        $(".datafile_border").removeAttr("data-toggle");
                        // change text on button to done
                        this.innerHTML = "Done";
                        // this.parentElement.children[1].innerHTML="upload";
                        // console.log(this.parentElement.children[1].innerHTML);
                        upload_flag =1;
                        // hide dropzone
                        $(".dropzone").css("display","none");
                        // remove upload button
                        $('.upload_btn').remove()
                        // hide progress bars
                        for (i = 0; i < progressBars.length; i++){
                            $("#progress"+String(i)).css("display","none");
                          }

                        $(".datafile_border").addClass('select_df_mode');


                        // $(".portlet-body").load(location.href + " .portlet-body");
                        // console.log(location.href);
                        // if the span exists and imgCheckbox has already been activated
                        // if ($(".datafile_border span").length >1){
                        //   // add class
                        //   $(".datafile_border span").removeClass();
                        //   $(".datafile_border span").addClass("imgCheckbox0");
                        //
                        // }else  {
                        //   // activate imgcheckbox plugin
                        //   $(".datafile_border .datafile").imgCheckbox();
                        // }
                        // if ($(".datafile_border ").hasClass()


                      }
                      // j !=1
                      else {
                        // show progress bars
                        for (i = 0; i < progressBars.length; i++){
                            $("#progress"+String(i)).css("display","block");
                          }
                        // add download links
                        $("a[download]").addClass("fa fa-download download_df");
                        //hide delete button for file
                        $(".delete_single_df").css("display","none");
                        // change button text to select
                        this.innerHTML = "Select";
                        // remove select_df_mode class from each file block
                        $(".datafile_border").removeClass('select_df_mode');
                        // remove delete, select all and move buttons
                        $(".select_all").remove();
                        $(".delete_df").remove();
                        $(".move_img").remove();
                        // add upload button
                        $(".portlet-title").append("<span class= 'btn green  pull-right upload_btn'>upload</span>")


                        $(".datafile_border ").removeClass("selekted ");
                        // $(".contain_img div img").addClass("gallery ");
                        // $(".contain_img div img").css("opacity","0.7");
                        // add data toggle for modals
                        $(".datafile_border").attr("data-toggle", "modal");
                        // $(".datafile_border span").removeClass();

                      }
                     });


                      // console.log(($(".contain_img img").length));
                      // if (($(".imgChked").length )== ($(".contain_img img").length)) {
                      //   $(".select_all").html("<button class='btn btn-default pull-right select_all' >deselect all</button>");
                      // }else {
                      //   $(".select_all").html("<button class='btn btn-default pull-right select_all' >select all</button>");
                      //
                      // }
                      // if all files are selected, change button to deselect all, else select all
                      $(document).on("click", '.select_df_mode', function(event) {
                        if(select_all_flag =1){
                        if ($(this).hasClass('selekted')==false){
                          $(this).addClass('selekted');
                          //hide delete button for file
                          // $(".delete_single_df").css("display","none");
                          $(this).find(".delete_single_df").css("display","none");
                        }
                        else{
                          $(this).removeClass('selekted');
                          //display delete button for file
                          $(this).find(".delete_single_df").css("display","block");

                        }
                      }
                        if (($(".selekted").length )== ($(".datafile_border").length)) {
                          select_all_flag =1;
                          // $(".select_all").empty();
                         $(".select_all").text("deselect all");
                       }else {
                         select_all_flag=0;
                         // $(".select_all").empty();

                         $(".select_all").text("select all");

                       }
                      });


                      $(document).on("click", '.select_all', function(event) {

                      // $(".select_all").click(function(){
                      // If no images are in the gallery
                      // if ($(".selekted").length==0){
                      //   alert("No image(s) available");
                      //
                      // }

                      // if the gallery has any images
                      // else{

                        select_all_flag = (select_all_flag + 1) % 2;
                        if (select_all_flag == 1){
                          $(".datafile_border").addClass("selekted");
                          this.innerHTML='deselect all';
                          //hide delete button for file
                          $(".delete_single_df").css("display","none");
                          // $(".delete_df").removeClass("disabled");
                          // $(".move_img").removeClass("disabled");

                        }else {
                          $(".datafile_border ").removeClass("selekted");
                          this.innerHTML='select all';
                          //hide delete button for file
                          $(".delete_single_df").css("display","block");
                          // $(".delete_df").addClass("disabled");
                          // $(".move_img").addClass("disabled");

                        }
                      // }
                    });


                    $(document).on("click", '.delete_single_df', function(event) {
                        var result = confirm("Are you sure?")
                        // var df_id_num;
                      if (result == 1){
                          // find datafile id
                          var file_id = $(this).closest(".datafile_border").find("input").attr("id");
                          console.log("file_id",file_id);
                          // LAST THING I DID
                        $.ajax({
                          url: 'includes/delete_df_dropzone_file.php',
                          method: 'POST',
                          // dataType:"text",
                          data: {file_id:file_id},
                          success: function(data){
                            if (data != ''){
                              console.log(data);

                            }

                          }
                        });//after ajax

                          $(".contain_datafiles ").load(String(window.location.href)+" .contain_datafiles",function(){
                            // if (del_count == $(".datafile_border").length);
                            // update amount of total_modals for modal traversal
                              total_modals = $(".datafile_border").length;
                              // new progress bars array
                              var newBars=[];
                              // current counter for each loop
                                var current = 0;
                                $(".datafile_border").each(function () {
                                  // retrieve id for progress bar
                                  var prog_id =$(this).find(" div").attr("id");
                                  console.log("prog_id",prog_id);
                                      var id = "#progress"+String(current) ;
                                      // var count = document.getElementById('progress'+String(i)).value ;
                                      var selector = id+">input" ;
                                      var count = $(selector).val() ;

                                      if(count == 10)
                                      {
                                        var color = '#1BBC9B' ;
                                      }
                                      else{
                                        var color = '#ACB5C3';
                                      }
                                      if (progressBars[current])
                                          progressBars[current].destroy();
                                      // create and store new prgress bar
                                      newBars.push( addBar(count,color,id));
                                      current = current + 1;
                                  });
                                  // replace progress bars with new array of bars
                                  progressBars=newBars;
                                  //CHANGE Blocks to select mode
                                  for (i = 0; i < progressBars.length; i++){
                                      $("#progress"+String(i)).css("display","none");
                                    }

                                  $(".datafile_border").addClass('select_df_mode');
                                  $("a[download]").removeClass("fa fa-download download_df");
                                  $(".datafile_border").removeAttr("data-toggle");
                                  $(".delete_single_df").css("display","block");
                                  // df_titles();

                          });

                        }//if end
                    });


                      $(document).on("click", '.delete_df', function(event) {

                      // $(".delete_df").click(function () {
                        if ($(".datafile_border").hasClass("selekted")==false){
                          alert("No file(s) selected")
                        }
                        else {
                          var result = confirm("Are you sure?")
                          var df_id_num;
                          // var current =0;
                          var del_count = 0;


                          // console.log(this.closest('.datafile_borde>input').attr('id'));

                        console.log("hey");
                        if (result == 1){
                          $(".selekted").each(function () {
                            // find datafile id
                            var file_id = $(this).find("input").attr("id");
                            // LAST THING I DID
                          $.ajax({
                            url: 'includes/delete_df_dropzone_file.php',
                            method: 'POST',
                            // dataType:"text",
                            data: {file_id:file_id},
                            success: function(data){
                              if (data != ''){
                                del_count = del_count + 1;
                                console.log(data);

                              // $(".contain_datafiles ").load(String(window.location.href)+" .contain_datafiles",
                              //     function () {
                                    // console.log("image deleted!", data);
                                    // var count_img = 0;
                                    // $(".contain_img").each(function () {
                                    //   count_img= count_img+1;
                                    //   }
                                    //   console.log("count_img",count_img);
                                    // selected datafile block to be deleted
                                    // var selector_del=".datafile_border input[id='"+String(file_id)+"']";
                                    // console.log("after ajax",(selector_del));
                                    // // id number to delete modals
                                    // df_id_num = $(selector_del).closest(".datafile_border div")[0].id;
                                    // df_id_num = df_id_num.substr(8);
                                    // console.log("df_id_num",df_id_num);
                                    // var modal_edit = "#modal_edit" + df_id_num;
                                    // var modal_view = "#modal_file" + df_id_num;
                                    // var progress_id = "#progress" + df_id_num;
                                    //
                                    // console.log(modal_edit,modal_view);
                                    // console.log("modal_edit length before remove",$(modal_edit).length);
                                    // // remove datafile block from DOM
                                    // $(selector_del).closest("#df_space").remove();
                                    // // delete modals associated to deleted datafile
                                    // // $(modal_edit).remove();
                                    // console.log("modal_edit length after remove",$(modal_edit).length);
                                    // // $(modal_view).remove();
                                    // // update to current amount of modals
                                    // total_modals = $(" .datafile_border").length;
                                    // console.log("current # of files:",total_modals);
                                    // // remove
                                    // del_from_list(all_modal_edit_ids,modal_edit);
                                    // del_from_list(all_modal_view_ids,modal_view);
                                    // del_from_list(all_progress_ids,progress_id);
                                    // // remove
                                    //
                                    // // UPDATE PROGRESS BAR CONTAINER
                                    // // var progressBar = new ProgressBar.Circle('#container', {
                                    // //     strokeWidth: 2
                                    // // });
                                    // progressBars[df_id_num]=null;
                                    //
                                    //
                                    // all_modal_edit_ids= update_array(all_modal_edit_ids);
                                    // all_modal_view_ids= update_array(all_modal_view_ids);
                                    // // FOR AJAX
                                    // all_progress_ids= update_array(all_progress_ids);
                                    // console.log("all_modal_edit_ids= update_array",all_modal_edit_ids);
                                    // console.log("all_modal_view_ids= update_array",all_modal_view_ids);
                                    // console.log("all_progress_ids= update_array",all_progress_ids);
                                    //
                                    //
                                    // // update all of the ids in the DOM
                                    // update_ids_list(all_modal_edit_ids,"modal_edit");
                                    // update_ids_list(all_modal_view_ids,"modal_file");
                                    // // FOR AJAX
                                    // update_ids_list(all_progress_ids,"progress");
                                    // // replace the attributes of DOM elements that reference each other with IDs
                                    // // replace_attrs(".datafile_border","href","#modal_file");
                                    // // replace_attrs(".view.modal_tag","id","modal_file");
                                    // // replace_attrs(".edit_mode","id","modal_edit");
                                    //
                                    //
                                    // progressBars= update_array(progressBars);
                                    //
                                    //
                                    //
                                    //     var id = "#progress"+String(current) ;
                                    //     // var count = document.getElementById('progress'+String(i)).value ;
                                    //     var selector = id+">input" ;
                                    //     var count = $(selector).val() ;
                                    //
                                    //     if(count == 10)
                                    //     {
                                    //       var color = '#1BBC9B' ;
                                    //     }
                                    //     else{
                                    //       var color = '#ACB5C3';
                                    //     }
                                    //
                                    //     // Declaration of bar with id progress.
                                    //   // console.log("$(this).find('.modal_tag.view').attr('id')", $(this).find(".modal_tag.view").attr("id"));
                                    //   //   $(this).find(".modal_tag.view").attr("id","modal_file"+String(current));
                                    //   //   $(this).find(".modal_tag.edit_mode").attr("id","modal_edit"+String(current));
                                    //   //   $(this).attr("href","modal_file"+String(current));
                                    //     progressBars[current].destroy();
                                    //     progressBars[current] = addBar(count,color,id);
                                    //
                                    //
                                    //   current= current +1;




                                    // $(".datafile_border").removeAttr("data-toggle");
                                    // $(".")

                                    // $(".delete_df").addClass("disabled");
                                    // $(".move_img").addClass("disabled");
                                    // select_all_flag=1;
                                    // $(".select_all").text("select all");
                                    // console.log("select_flag",select_flag);

                                  // });

                              }

                            }
                            // dataType: dataType
                          });//after ajax

                            $(".contain_datafiles ").load(String(window.location.href)+" .contain_datafiles",function(){
                              // if (del_count == $(".datafile_border").length);
                              // update amount of total_modals for modal traversal
                                total_modals = $(".datafile_border").length;
                                // new progress bars array
                                var newBars=[];
                                // current counter for each loop
                                  var current = 0;
                                  $(".datafile_border").each(function () {
                                    // retrieve id for progress bar
                                    var prog_id =$(this).find(" div").attr("id");
                                    console.log("prog_id",prog_id);


                                        var id = "#progress"+String(current) ;
                                        // var count = document.getElementById('progress'+String(i)).value ;
                                        var selector = id+">input" ;
                                        var count = $(selector).val() ;

                                        if(count == 10)
                                        {
                                          var color = '#1BBC9B' ;
                                        }
                                        else{
                                          var color = '#ACB5C3';
                                        }
                                        console.log("inside each after ajax");

                                        // Declaration of bar with id progress.
                                      // console.log("$(this).find('.modal_tag.view').attr('id')", $(this).find(".modal_tag.view").attr("id"));
                                      //   $(this).find(".modal_tag.view").attr("id","modal_file"+String(current));
                                      //   $(this).find(".modal_tag.edit_mode").attr("id","modal_edit"+String(current));
                                      //   $(this).attr("href","modal_file"+String(current));
                                        if (progressBars[current])
                                            progressBars[current].destroy();
                                        // create and store new prgress bar
                                        newBars.push( addBar(count,color,id));
                                        current = current + 1;
                                    });
                                    // replace progress bars with new array of bars
                                    progressBars=newBars;
                                    //CHANGE Blocks to select mode
                                    for (i = 0; i < progressBars.length; i++){
                                        $("#progress"+String(i)).css("display","none");
                                      }

                                    $(".datafile_border").addClass('select_df_mode');
                                    $("a[download]").removeClass("fa fa-download download_df");
                                    $(".datafile_border").removeAttr("data-toggle");
                                    $(".delete_single_df").css("display","block");
                                    // df_titles();


                                // }






                            });


                          // if deletion was succesful
                          // if (del_count){

// console.log("progressBars",progressBars);








                          // }//end if

                        });
                        // select_flag=1;
                        // remove deleted elements from array that contains all ids


                        // #modal_edit

                        // use index of deleted id
                          // delete val from progressBars

                        //
                        //   temp =[];
                        //   for (i = parseInt(df_id_num); i < progressBars.length; i++){
                        //     // if array
                        //     if (progressBars[i]!=null){
                        //
                        //       temp.push(progressBars[i]);
                        //     }
                        //   }
                        //   progressBars= temp;

                        // CANNOT DOWNLOAD
                        // CREATE NEW PROGRESS BARS
                        //   var  current=0;
                        // $(".datafile_border").each(function () {
                        //   // replace progress bars
                        //   if (current > parseInt(df_id_num)){
                        //     var id = "#progress"+String(current) ;
                        //     // var count = document.getElementById('progress'+String(i)).value ;
                        //     var selector = id+">input" ;
                        //     var count = $(selector).val() ;
                        //
                        //     if(count == 10)
                        //     {
                        //       var color = '#1BBC9B' ;
                        //     }
                        //     else{
                        //       var color = '#ACB5C3';
                        //     }
                        //
                        //     // Declaration of bar with id progress.
                        //   console.log("$(this).find('.modal_tag.view').attr('id')", $(this).find(".modal_tag.view").attr("id"));
                        //     $(this).find(".modal_tag.view").attr("id","modal_file"+String(current));
                        //     $(this).find(".modal_tag.edit_mode").attr("id","modal_edit"+String(current));
                        //     $(this).attr("href","modal_file"+String(current));
                        //   progressBars[current] = addBar(count,color,id);
                        //
                        //
                        //   current= current +1;
                        //
                        //
                        //   }
                        //
                        // });
                      }//if end
                    }


                      });
// var edit_flag = 0;
$(document).on('click','#edit-toggle', function (event) {

    var selector = String($(this).closest('.modal_tag').attr('id'));
    var num_id =  selector.substr(10);
    var new_id = "modal_edit" + num_id;
    $("#modal_file"+ num_id).removeClass("in");
    // console.log("oldID","#modal_file"+ old_id);
    $("#"+ String(new_id)).addClass("in");
    $("#modal_file"+ String(num_id)).css("display","none");
    $("#"+ String(new_id)).css("display","block");
  });
  $(document).on('click','#view-toggle', function (event) {
    var selector = String($(this).closest('.modal_tag').attr('id'));
    var num_id =  selector.substr(10);
    var new_id = "modal_file" + num_id;
    $("#modal_edit"+ num_id).removeClass("in");
    $("#"+ String(new_id)).addClass("in");
    $("#modal_edit"+ String(num_id)).css("display","none");
    $("#"+ String(new_id)).css("display","block");




});
                    $(document).on('click', '.delete_single_df', function(event) {
                      event.stopPropagation();
                    });
                      $(document).on('click', '.download_df', function(event) {
                        event.stopPropagation();
  });
  $(document).on('click', ' .prev.available , .next.available', function(event) {
    // event.preventDefault();

    event.stopPropagation();
  });



var progressBars=[];
                    </script>



<script src="includes/js/daterangepicker.js" type="text/javascript"></script>

<script src="includes/js/progressBar.js" type="text/javascript"></script>
