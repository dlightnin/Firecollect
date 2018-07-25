<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';

  $_SESSION["last_url"]= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $user_id = $_SESSION["user_id"];

  if (isset($_GET['id'])){
    $data_set_id = $_GET['id'];
    $_SESSION['current_data_set_id']=$data_set_id;
  }
  else {

    $data_set_id=$_SESSION['current_data_set_id'];
  }

  $pr_res = $db_conn->query("SELECT * FROM tbl_data_set WHERE id='$data_set_id'");
  $pr_row = $pr_res->fetch_assoc() ;
  $project_id = $pr_row['project_id'];
  $_SESSION['current_project_id']= $project_id;


  $db_conn->query("UPDATE tbl_user set last_datafiles = '$data_set_id' where u_id = '$user_id'") ;



  $path = $db_conn->query("SELECT * FROM tbl_projects WHERE id='$project_id'");
  $path = $path->fetch_assoc() ;

  $owner_id = $path['u_id'] ;

  if($user_id != $owner_id)
  {
    $permissionQuery = "SELECT * from tbl_collaborators where user_id = '$user_id' and p_id = '$project_id'";
    $perm = $db_conn->query($permissionQuery) ;
    $perm = $perm->fetch_assoc() ;
  }

  $path2 = $db_conn->query("SELECT * FROM tbl_data_set WHERE id='$data_set_id'");
  $path2 = $path2->fetch_assoc() ;


  function human_filesize($bytes, $decimals = 2) {
      $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
      $factor = floor((strlen($bytes) - 1) / 3);
      return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
  }


function file_display($i,$id,$download_link,$file_size,$icon_class,$file_class,$count,$file_title,$perm,$owner_id,$user_id){


    echo "<div id='df_space' class='col-lg-2 col-md-2 col-sm-6 col-xs-12'>

            <div class='datafile_border' data-toggle='modal' href='#modal_file$i'  >";
            if($perm['delete_datafile'] == 1 or $owner_id == $user_id)
            {
              echo "<a href='javascript:; ' style='position: absolute;' class='btn btn-icon-only red delete_single_df'>
              <i class='fa fa-remove'></i></a>";
            }

            echo "  <div id='progress$i' style='position:absolute; text-align:center; width:100%; top:0;'>
              <input id='$id' type='hidden' value='$count'>
              </div>
            <a class='datafile $file_class ' style='position:relative;'>
                    <i class='$icon_class' style='' ></i>

            </a>

            <i style='position: absolute;text-align:center;width:100%; bottom:20%;'>($file_size)</i>";
            if($perm['download_datafile'] == 1 or $owner_id == $user_id)
            {
             echo "<a href='$download_link' download='$file_title' class='fa fa-download download_df' style='position: absolute;bottom:21%;'></a>";
            }

            echo "
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
                <div class='page-bar'>
                   <ul class='page-breadcrumb'>
                       <li>
                           <a class='text firecollect'>".$path['title']."</a>
                           <i class='fa fa-angle-right'></i>
                       </li>
                       <li>
                        <a class='text firecollect'>".$path2['name']."</a>
                       </li>

                   </ul>
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
                                                            <span class="title firecollect">Data Files</span>
                                                        </div>
                                                        <span class= "btn btn-default  pull-right view_mode"><i style="font-size:120%; display:inline;" class="fa fa-th-large"></i></span>

                                                        <span class="btn btn-primary pull-right select_file" style="display:none;">select</span>

                                                        <?php
                                                          if($perm['delete_datafile'] == 1 or $owner_id == $user_id)
                                                          {
                                                            echo "<span id='df_del' class='btn btn-default pull-right delete_df_check' >delete</span>" ;
                                                          }
                                                        ?>

                                                        <span id='df_sel' class='btn btn-default pull-right '  style="display:none;">select all</span>

                                                        <?php
                                                          if($perm['upload_datafile'] == 1 or $owner_id == $user_id)
                                                          {
                                                            echo "<span class= 'btn green  pull-right upload_btn'>upload</span>";
                                                          }
                                                          ?>
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
                                        <div class="row">
                                          <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'><div class="contain_df_table">
                                            </div></div>
                                        </div>
                                        <div class='row'>






<!-- <div class='row'> sample_1-->
<table class='table table-striped table-hover table-checkable table-bordered df_table' id='sample_editable_1'>
    <thead>
        <tr>
          <th style='display:none'></th>
          <th id='checkbox_col' class="sorting_disabled" ><label class="mt-checkbox mt-checkbox-single mt-checkbox-outline ">
                                                        <input id="df_check_all" type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                                        <span></span>
                                                    </label></th>
            <th style='text-align: center;'> Name </th>
            <th style='text-align: center;'> File Type </th>
            <th style='text-align: center;'> File Size </th>

            <th style='text-align: center;'> Actions </th>
        </tr>
    </thead>
    <tbody>
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
                                                // $periodicity_index = $row['periodicity'];
                                                $periodicity = $row['periodicity'];
                                                $period = $row['period'];
                                                $software_name = $row['software_name'];
                                                $software_link = $row['software_link'];
                                                $variables = $row['variables'];
                                                $comments = $row['comments'];
                                                $last_mod = $row['last_mod'];
                                                $download_link = $row['download_link'];
                                                // $real_name = $row['real_name'];
                                                $file_size=  human_filesize($file_size);
                                                // $file_path="uploads/$project_id/datasets/$data_set_id/datafiles/$file_name";

                                                $periodicity_array=array("Daily","Weekly","Monthly","Annually");


                                                $queryCount="SELECT COUNT(title) + COUNT(period) + COUNT(times) + COUNT(periodicity) + COUNT(file_type) +
                                                COUNT(file_size) + COUNT(software_name) + COUNT(software_link) +
                                                COUNT(variables) + COUNT(comments) + COUNT(last_mod) AS total FROM tbl_data_files WHERE id = $id";

                                                $resultCount = $db_conn->query($queryCount);

                                                $rowCount = $resultCount->fetch_assoc();

                                                $count = $rowCount['total'];



                                                // $last_mod = "".date("F d Y H:i:s.",filemtime("uploads/$project_id/datasets/$data_set_id/datafiles/$file_title"));



                                                //
                                                // <embed src='includes/datafile_uploads/$data_set_id/$file_title' width='800px' height='2100px' />
                                                // <img id='img$i' class='gallery' style='height:188px;width:281px;' name = $file_title src='includes/datafile_uploads/$data_set_id/$file_title' />
                                                // <embed src='includes/datafile_uploads/$data_set_id/$file_title' type='application/pdf' width='100%' height='100%'>


                                                if($file_type == "text/csv" or $file_type == "application/vnd.ms-excel" or $file_type == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
                                                {
                                                  file_display($i,$id,$download_link,$file_size,'fa fa-file-excel-o','excel',$count,$file_title,$perm, $owner_id,$user_id);
                                                }

                                                else if($file_type == "application/pdf")
                                                {
                                                  file_display($i,$id,$download_link,$file_size,'fa fa-file-pdf-o','pdf',$count,$file_title,$perm, $owner_id,$user_id);
                                                }

                                                else if($file_type == "application/msword" or $file_type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" )
                                                {
                                                  file_display($i,$id,$download_link,$file_size,'fa fa-file-word-o','word',$count,$file_title,$perm, $owner_id,$user_id);

                                                }

                                                else if($file_type == "image/jpeg" or $file_type == "image/png" )
                                                {
                                                  file_display($i,$id,$download_link,$file_size,'fa fa-file-image-o','image-df',$count,$file_title,$perm, $owner_id,$user_id);

                                                }
                                                else if($file_type == "text/plain"  )
                                                {
                                                  file_display($i,$id,$download_link,$file_size,'fa fa-file-text','file-df',$count,$file_title,$perm, $owner_id,$user_id);


                                                }


                                                else if($file_type == "audio/mp3"  )
                                                {
                                                  file_display($i,$id,$download_link,$file_size,'fa fa-file-audio-o','file-df',$count,$file_title,$perm, $owner_id,$user_id);


                                                }

                                                else
                                                {
                                                  file_display($i,$id,$download_link,$file_size,'fa fa-file-o','file-df',$count,$file_title,$perm, $owner_id,$user_id);


                                                }

                                                //Generate table rows for df_table
                                                echo "
                                                <tr >
                                                <td style='display:none' class='id'>$id</td>
                                                <td style='text-align: center;' class='check_file'>
                                                <div class='form-group form-md-checkboxes'>
                                                <label class='mt-checkbox mt-checkbox-single mt-checkbox-outline'>
                                                        <input type='checkbox' class='checkboxes'  value='$i' />
                                                        <span></span>
                                                    </label>

                                                </td>
                                                <td class='col_ellipsis' style='' > <a id='df_tbl$i' data-toggle='modal' href='#modal_file$i' >$file_title </a>  </td>
                                                <td class='col_ellipsis'   style='text-align: center;'> $file_type </td>
                                                <td class='' style='text-align: center;'>$file_size </td>


                                                    <td style='text-align:center;'>
                                                    <a data-toggle='modal' href='#modal_file$i' class='btn green btn-icon-only' ;bottom:21%;'> <i style='font-size:16px; text-decoration:none; color:white;' class=' fa fa-info-circle'></i>    </a>";
                                                    if($perm['download_datafile'] == 1 or $owner_id == $user_id)
                                                    {
                                                      echo "<a href='$download_link' download='$file_title' class='btn btn-success btn-icon-only' ;bottom:21%;'> <i style='font-size:16px; text-decoration:none; color:white;' class=' fa fa-download'></i> </a>";
                                                    }

                                                    if($perm['delete_datafile'] == 1 or $owner_id == $user_id)
                                                    {
                                                      echo "<a href='javascript:;' class='btn btn-icon-only red delete_df_row'><i style='font-size:16px;' class=' fa fa-trash'></i></a>";
                                                    }
                                                  echo "
                                                    </td>
                                                </tr>";

                                                echo  "<div class='modal fade modal-scroll modal_tag view' id='modal_file$i' tabindex='-1' role='dialog' aria-hidden='true' >
                                                                                  <div class='modal-dialog modal-lg' style='position:relative;' id='ea'>
                                                                                      <div class='modal-content'>
                                                                                          <div class='modal-header'>
                                                                                              <button type='button' class='close close_modal' data-dismiss='modal' aria-hidden='true'></button>
                                                                                              <button id='edit-toggle' class='btn btn-primary pull-right btn_df_edit ' >Edit</button>
                                                                                              <div class='next_modal btn btn-default  pull-right'  ><span class='glyphicon glyphicon-chevron-right'> </span></div>
                                                                                              <div class='prev_modal btn btn-default pull-right' ><span class='glyphicon glyphicon-chevron-left'> </span></div>

                                                                                              <h4 class='modal-title font-red'  > File Metadata</h4>


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
                                                                                                              <div id='periodicity' class='form-control form-control-static'>$times times $periodicity</div>
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

                                                                                                                            <h4 class='modal-title font-red'  > Data File Metadata</h4>


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
                                                                                                                                                                                                                <input id='datefilter' type='text' class='form-control' name='datefilter' value='$period'/>
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
                                                                                                                                                                                                             <option value='Daily' "; if ($periodicity === 'Daily'){ echo " selected='selected'";} echo " >Daily</option>";

                                                                                                                                                                                                             echo "<option value='Weekly' "; if ($periodicity === 'Weekly') {echo " selected='selected' ";} echo " >Weekly</option>";

                                                                                                                                                                                                             echo "<option value='Monthly' "; if ($periodicity === 'Monthly') {echo " selected='selected' ";} echo " >Monthly</option>";

                                                                                                                                                                                                             echo "<option value='Annually' "; if ($periodicity === 'Annually') {echo " selected='selected' ";} echo " >Annually</option>";

                                                                                                                                                                                                             echo"
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

                                                                                                                                                                                                               $var_array = json_decode($variables);


                                                                                                                                                                                                               $result3 = $db_conn->query($query3);
                                                                                                                                                                                                                 while ($row3 = $result3->fetch_assoc()) {
                                                                                                                                                                                                                   $var_id = $row3['id'];
                                                                                                                                                                                                                   $var_name = $row3['name'];

                                                                                                                                                                                                                         echo "<option value='$var_id'";
                                                                                                                                                                                                                         //If variables are already in database, mark as selected
                                                                                                                                                                                                                          if (in_array($var_id, $var_array)){
                                                                                                                                                                                                                          echo " selected='selected' ";
                                                                                                                                                                                                                          }
                                                                                                                                                                                                                         echo ">$var_name</option>";

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

                                          </tbody>
                                      </table>


                                          </div>
                                          <!-- ^END CONTAIN DATAFILES  -->


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
                    <script src="includes/js/table_view_funcs.js" type="text/javascript"></script>
                    <script>
                    var last_mod ;
                    // df_titles();
                    function fix_filled_forms(){
                      // if df has name value, then focus on input
                      $("input[name='title']").each(function () {
                        if ($(this)[0].value!="")
                          $(this).addClass("edited");});
                      // if df has comments value, then focus on input
                      $("textarea[name='comments']").each(function () {
                        if ($(this)[0].value!="")
                          $(this).addClass("edited");});
                    }
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



                    var del_arr = [];
                    function delete_df(){
                      var jsonString = JSON.stringify(del_arr);
                      $.ajax({
                        url: 'includes/delete_df_dropzone_file.php',
                        method: 'POST',
                        data: {del_arr:jsonString},
                        success: function(data){
                          // if (data != ''){
                            // console.log(data);
                            $(document).ready(function(){



                                                  $(".contain_datafiles ").load(String(window.location.href)+" .contain_datafiles",function(){
                                                    // if (del_count == $(".datafile_border").length);
                                                    // update amount of total_modals for modal traversal
                                                      total_modals = $(".datafile_border").length;
                                                      fix_filled_forms();
                                                      //NO BARS EDIT START
                                                      // new progress bars array
                                                      // var newBars=[];
                                                      // // current counter for each loop
                                                      //   var current = 0;
                                                      //   $(".datafile_border").each(function () {
                                                      //     // retrieve id for progress bar
                                                      //     var prog_id =$(this_).find(" div").attr("id");
                                                      //     console.log("prog_id",prog_id);
                                                      //         var id = "#progress"+String(current) ;
                                                      //         // var count = document.getElementById('progress'+String(i)).value ;
                                                      //         var selector = id+">input" ;
                                                      //         var count = $(selector).val() ;
                                                      //
                                                      //         if(count == 11)
                                                      //         {
                                                      //           var color = '#1BBC9B' ;
                                                      //         }
                                                      //         else{
                                                      //           var color = '#ACB5C3';
                                                      //         }
                                                      //         if (progressBars[current])
                                                      //             progressBars[current].destroy();
                                                      //         // create and store new prgress bar
                                                      //         newBars.push( addBar(count,color,id));
                                                      //         current = current + 1;
                                                      //     });
                                                      //     // replace progress bars with new array of bars
                                                      //     progressBars=newBars;
                                                      //     //CHANGE Blocks to select mode
                                                      //     for (i = 0; i < progressBars.length; i++){
                                                      //         $("#progress"+String(i)).css("display","none");
                                                      //       }
                                                      //NO BARS EDIT END



                                                          if (view_flag == 1){
                                                            select_flag = 0;
                                                            $(".datafile_border").css("display","none");
                                                            $(".df_table").closest("#sample_editable_1_wrapper").css("display","block");
                                                            $(".df_table").css("display","table");
                                                            if ($("#sample_editable_1_wrapper").length==0){
                                                              $(".df_table"  ).dataTable( {
                                                                 aaSorting:[], 'searching': true,
                                                                'lengthMenu': [[20, 50, 100, 200, -1],[20, 50, 100,200, "All"]]
                                                              });
                                                              $(".contain_df_table").append($("#sample_editable_1_wrapper"));

                                                            }


                                                          }
                                                          else {
                                                            $(".df_table").closest("#sample_editable_1_wrapper").css("display","none");
                                                            $(".df_table").css("display","none");
                                                            $(".datafile_border").css("display","block");
                                                            select_flag = 1;
                                                            $(".datafile_border").addClass('select_df_mode');
                                                            $(".datafile_border a[download]").removeClass("fa fa-download download_df");
                                                            $(".datafile_border").removeAttr("data-toggle");
                                                            $(".delete_single_df").css("display","block");

                                                          }

                                                          // df_titles();

                                                  });

                                                  // if(view_flag ==1){
                                                  //   select_flag = 0;}
                                                  //   else{
                                                  //     select_flag = 1;
                                                  //     $(".datafile_border").addClass('select_df_mode');
                                                  //     $(".datafile_border a[download]").removeClass("fa fa-download download_df");
                                                  //     $(".datafile_border").removeAttr("data-toggle");
                                                  //     $(".delete_single_df").css("display","block");
                                                  //   }
                                                  swal({title:"Deleted!",
                                                  text:"Successfully deleted.",
                                                  type:"success",
                                                  showConfirmButton: false,
                                                  timer:1500});

                          // }
                        });
                        }
                      });


                    }

                    var all_modal_edit_ids = [];
                    var all_modal_view_ids = [];
                    // var all_progress_ids = [];
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
                    // $(".datafile_border>div").each(function () {
                    //     all_progress_ids.push("#"+String($(this).attr('id')));
                    // });
                    // console.log(all_progress_ids);

                    function df_titles(){

                        // $(document).on('ready', function(event) {
                            $(".df_title span").each(function () {
                              var title = this.innerHTML;
                              var title_length = this.innerHTML.length;
                              console.log(title_length);
                                  if(title_length>15){
                                    this.innerHTML = title.substr(0,15) + "...";
                                  }
                                  // this.parentElement ="<div class='df_title popovers' data-toggle='popover' data-placement='bottom' data-content='"+ title+"' ><span>"+title +"</span></div>";
                                  // $(this).popover();
                            });
                          // });
                    }



                    // $(document).on('click',"#datefilter", function(){
                    //     $(this).datepicker();
                    // });​

                    $(document).on("focus", 'input[name="datefilter"]', function(event) {
                      $(this).daterangepicker({
                              autoUpdateInput: false,
                              locale: {
                                  cancelLabel: 'Clear'
                              },
                              parentEl: ".modal-lg",
                              autoApply: true
                      });

                      $(this).on('apply.daterangepicker', function(ev, picker) {
                          $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
                      });

                      $(this).on('cancel.daterangepicker', function(ev, picker) {
                          $(this).val('');
                      });
                    });

                    $(document).on('ajaxComplete',function(){
                      // df_titles();
                      $(".df_title").popover();
                      // $(".select2-multiple").select2("destroy");
                      $(".select2-multiple").select2({width:"100%"});
                      // activateDatepicker();


                      // // if df has name value, then focus on input
                      // $("input[name='title']").each(function () {
                      //   if ($(this)[0].value!="")
                      //     $(this).addClass("edited");});
                      // // if df has comments value, then focus on input
                      // $("textarea[name='comments']").each(function () {
                      //   if ($(this)[0].value!="")
                      //     $(this).addClass("edited");});

                          // $(".contain_df_table").append($(".df_table"));

                          // $(".df_table"  ).dataTable( {
                          //    aaSorting:[], 'searching': true,
                          //   'lengthMenu': [[5,10, 15, 20, -1], [5,10, 15, 20, 'All']]
                          // });

                          // $(".dataTables_wrapper").css("display","none");






                    });

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
//used to change df_block title after edit
var df_block = "#progress"+ String(modal_id);
//used to change df_table_cell title after edit
var df_tbl="#df_tbl"+ String(modal_id);
modal_file_id ="#modal_file" + modal_id;
modal_edit_id ="#modal_edit" + modal_id;

var title =$(".modal_tag.fade.in").find("input[name='title']")[0].value;
var datefilter = $(".modal_tag.fade.in").find("input[name='datefilter']")[0].value;
var times =$(".modal_tag.fade.in").find("input[name='times']")[0].value;
// var index = $(".modal_tag.fade.in").find("select[name='periodicity']")[0].value;
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
          $(modal_file_id).find("#periodicity")[0].innerHTML = times + " times " + periodicity;
          $(modal_file_id).find("#software_name")[0].innerHTML = software_name ;
          $(modal_file_id).find("#software_link")[0].innerHTML = software_link ;
          $(modal_file_id).find("#comments")[0].innerHTML = comments ;


          fix_filled_forms();
          $(df_block).closest("#df_space").find(".df_title")[0].innerHTML = title ;
          $(df_tbl)[0].innerHTML= title;
          // $(modal_file_id).closest("#df_space").find(".df_title")[0].innerHTML = title ;
          // console.log("df_title?",$(modal_file_id)[0]);

          //NO BARS EDIT START

          // // array of form values
          // var formValues= [title,datefilter,times,periodicity,software_name,software_link,variables,comments];
          // var countVal =0;
          // // count how many forms are filled
          // for (i = 0; i < formValues.length; i++){
          //   if (formValues[i]){
          //     countVal = countVal+1;
          //     console.log(countVal);
          //   }
          // }
          // // progress bar value
          // var setVal = (countVal+3)/11;
          // // if all forms are filled
          // if (setVal == 1){
          //       //make new bar object and replace the progress bar
          //       var new_id = '#progress' + String(modal_id);
          //       progressBars[parseInt(modal_id)].destroy();
          //       progressBars[parseInt(modal_id)] = addBar(setVal,'#1BBC9B',new_id);
          //   }
          //   else{
          //       var new_id = '#progress' + String(modal_id);
          //       progressBars[parseInt(modal_id)].destroy();
          //       progressBars[parseInt(modal_id)] = addBar(setVal,'#ACB5C3',new_id);
          //   }
          // // update progress bar with new value
          // progressBars[parseInt(modal_id)].set(setVal);
          //NO BARS EDIT END


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
                        $(".datafile_border a[download]").removeClass("fa fa-download download_df");
                        //display delete button for file
                        $(".delete_single_df").css("display","block");

                        // $(".datafile_border span").removeClass("imgChked");
                        // append delete , select all and move buttons
                        // $(".portlet-title").append(" ");
                        $('#df_del, #df_sel').css("display","inline-block");
                        // <button class='btn btn-default pull-right move_img ' >move</button>
                        // $(".contain_img div img").addClass("imgcheck ");
                        // $(".contain_img div img").removeClass("gallery");
                        $(".datafile_border").removeAttr("data-toggle");
                        $(".view_mode").css("display","none");
                        // change text on button to done
                        this.innerHTML = "Done";
                        // this.parentElement.children[1].innerHTML="upload";
                        // console.log(this.parentElement.children[1].innerHTML);
                        upload_flag =1;
                        // hide dropzone
                        $(".dropzone, .upload_btn").css("display","none");
                        // remove upload button
                        // $('.upload_btn').remove()
                        //NO BARS EDIT START
                        // hide progress bars
                        // for (i = 0; i < progressBars.length; i++){
                        //     $("#progress"+String(i)).css("display","none");
                        //   }
                        //NO BARS EDIT END

                        $(".datafile_border").addClass('select_df_mode');

                        // $("#checkbox_col").css("display","table-cell");
                        // $(".check_file").css("display","table-cell");

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
                        //NO BARS EDIT START
                        // for (i = 0; i < progressBars.length; i++){
                        //     $("#progress"+String(i)).css("display","block");
                        //   }
                          //NO BARS EDIT END
                        // add download links
                        $(".datafile_border a[download]").addClass("fa fa-download download_df");
                        //hide delete button for file
                        $(".delete_single_df").css("display","none");
                        // change button text to select
                        this.innerHTML = "Select";
                        // remove select_df_mode class from each file block
                        $(".datafile_border").removeClass('select_df_mode');
                        // remove delete, select all and move buttons
                        // $(".select_all").remove();
                        // $(".delete_df").remove();
                        $(".move_img").remove();
                        $('#df_del, #df_sel').css("display","none");
                        // add upload button
                        // $(".portlet-title").append("")
                        $(".upload_btn").css("display","inline-block");

                        $(".datafile_border ").removeClass("selekted ");
                        // $(".contain_img div img").addClass("gallery ");
                        // $(".contain_img div img").css("opacity","0.7");
                        // add data toggle for modals
                        $(".datafile_border").attr("data-toggle", "modal");

                        $(".view_mode").css("display","inline-block");

                        // $("#checkbox_col").css("display","none");
                        // $(".check_file").css("display","none");

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

                    var this_;
                    $(document).on("click", '.delete_single_df, .delete_df_row', function(event) {
                        // var result = confirm("Are you sure?")
                        this_ = this;



                        // var df_id_num;
                      // if (result == 1){
                        swal({
                            title: "Are you sure?",
                            text: "Your file(s) will be deleted.",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Yes, delete it!",
                            closeOnConfirm: false,
                            dangerMode: true,
                          },
                            function(isConfirm) {
                              if (isConfirm)
                              {

                                // find datafile id
                                var del = $(this_).closest("tr").find(".id").text();
                                // if id taken from table
                                if (del){
                                  var file_id = del;
                                }
                                else {
                                  // id taken from datafile block
                                  var file_id = $(this_).closest(".datafile_border").find("input").attr("id");

                                }


                                console.log("file_id",file_id);
                                // LAST THING I DID
                                del_arr.push(file_id);

                        delete_df();//after ajax
                        // $(this_).parents('tr').remove();


                        // var jsonString = JSON.stringify(del_arr);
                        // $.ajax({
                        //   url: 'includes/delete_df_dropzone_file.php',
                        //   method: 'POST',
                        //   data: {file_id:file_id},
                        //   success: function(data){
                        //     var tabl = $('.df_table').DataTable();
                        //     tabl
                        //     .row( $(this_).parents('tr') )
                        //     .remove()
                        //     .draw(false);
                        //     console.log(data);
                        //     swal({title:"Deleted!",
                        //     text:"Successfully deleted.",
                        //     type:"success",
                        //     showConfirmButton: false,
                        //     timer:1500});
                        //
                        //
                        //   }
                        // });


                        // }//if end
                          }

                        }
                      );

                    });


                      $(document).on("click", '.delete_df', function(event) {

                      // $(".delete_df").click(function () {
                        if ($(".datafile_border").hasClass("selekted")==false ){
                          alert("No file(s) selected")
                        }
                        else {

                          // var result = confirm("Are you sure?")
                          swal({
                              title: "Are you sure?",
                              text: "Your file(s) will be deleted.",
                              type: "warning",
                              showCancelButton: true,
                              confirmButtonClass: "btn-danger",
                              confirmButtonText: "Yes, delete it!",
                              closeOnConfirm: false,
                              dangerMode: true,
                            },
                              function(isConfirm) {
                                if (isConfirm)
                                {
                          var df_id_num;
                          // var current =0;
                          var del_count = 0;


                          // console.log(this.closest('.datafile_borde>input').attr('id'));

                        console.log("hey");
                        // if (result == 1){
                          $(".selekted").each(function () {
                            // find datafile id
                            var file_id = $(this).find("input").attr("id");
                            // LAST THING I DID
                            var this_ = this;
                            del_arr.push(file_id);
                          // delete_df();//after ajax



                        });
                        delete_df();//


                      // }//if end
                      }
                    }
                  );
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


  //NO BARS EDIT START
// var progressBars=[];
//NO BARS EDIT END


                    </script>



<script src="includes/js/daterangepicker.js" type="text/javascript"></script>
<!-- NO BARS EDIT START -->
<!-- <script src="includes/js/progressBar.js" type="text/javascript"></script> -->
<!-- NO BARS EDIT END -->
