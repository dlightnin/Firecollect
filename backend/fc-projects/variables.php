<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';

  $_SESSION["last_url"]= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $u_id = $_SESSION["user_id"];
  // $_SESSION['current_data_set_id'] = $_GET['id'];


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


                    <!-- BEGIN  PORTLET-->
                    <div class="portlet light">
                      <div class="portlet-title tabbable-line">
                      <div class="caption">
                      <span class="title firecollect"> Variables</span>

                      </div>
                      <ul class="nav nav-tabs">
                      <li class="active">
                      <a href="#portlet_tab3" data-toggle="tab"> My Variables </a>
                      </li>

                      <li >
                      <a href="#portlet_tab1" data-toggle="tab"> Trash </a>
                      </li>
                      </ul>
                      </div>
                                                    <div class="portlet-body">
                                                      <div class="tab-content">
                                                      <div class="tab-pane active" id="portlet_tab3">

                                                        <div class="table-toolbar">

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="btn-group">
                                                                      <a  class="btn firecollect" data-toggle='modal' href='#add_data_set' >
                                                                        <!-- <button  class="btn "   style="background-color:#FFA500; color: white;">  -->
                                                                          Add Variable
                                                                            <i class="fa fa-plus"></i>
                                                                        <!-- </button> -->
                                                                      </a>
                                                                    </div>
                                                                </div>


                                                              <!-- modal begin -->
                                                              <div id="add_data_set" class="modal fade" role="dialog" aria-hidden="true">
                                                                  <div class="modal-dialog">
                                                                      <div class="modal-content">
                                                                          <div class="modal-header">
                                                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                              <h4 class="modal-title">Select Dataset </h4>
                                                                          </div>
                                                                          <div class="modal-body">
                                                                              <form action="#" class="form-horizontal">

                                                                                <div class="row">

                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-4">Select Associated Dataset</label>
                                                                                    <div class="col-md-8">
                                                                                        <select id="dropdown_dataset" class="form-control select2">
                                                                                          <?php
                                                                                          $query3= "SELECT * FROM tbl_data_set WHERE deleted = 0 and project_id IN (SELECT distinct id FROM tbl_projects WHERE u_id='$u_id') ";;

                                                                                          $result3 = $db_conn->query($query3);
                                                                                            while ($row3 = $result3->fetch_assoc()) {
                                                                                              echo "<option value=".$row3['id'].">
                                                                                                    ".$row3['name']."
                                                                                                    </option>";
                                                                                            }
                                                                                           ?>

                                                                                        </select>
                                                                                    </div>
                                                                                </div>





                                                                                                              </form>
                                                                                     </div>
                                                                                     <div class="modal-footer">
                                                                                        <form id="myForm" method="post" action="add_variable.php">
                                                                                          <!-- <a id="proceed_dataset" class="btn green" data-dismiss="modal" href="">Proceed</a> -->
                                                                                          <input id="hidden_input" type="hidden" name="data_set_id" value="">
                                                                                          <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Close</button>
                                                                                          <input id="proceed_dataset" class="btn green" type="submit" value="Proceed">
                                                                                        </form>
                                                                                     </div>
                                                                                 </div>
                                                                             </div>
                                                                         </div>

















                                                                                                          <!-- <div class="modal-footer">
                                                                                                              <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                                                              <a  class="btn green" >Proceed</a>
                                                                                                          </div> -->

                                                              <!--modal end  -->



                                                            </div>
                                                        </div>
                                                        <div class="contain_modals"></div>




                                                        <table class="table table-striped table-hover table-bordered variable_table" id="sample_editable_1">
                                                            <thead>
                                                                <tr>
                                                                    <th style="display:none">ID</th>
                                                                    <th style="text-align: center;"> Name </th>
                                                                    <th style="text-align: center;"> Data Type </th>
                                                                    <th style="text-align: center;"> Associated Dataset </th>

                                                                    <th style="text-align: center;"> Actions </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                              <?php
                                                              $query="SELECT * FROM tbl_variables WHERE deleted = 0 and data_set_id IN (SELECT distinct id FROM tbl_data_set WHERE project_id in (SELECT distinct id FROM tbl_projects WHERE u_id='$u_id')) ";

                                                              $result = $db_conn->query($query);

                                                              $i=0;

                                                              while ($row = $result->fetch_assoc() ) {
                                                                # code...
                                                                $variable_id = $row['id'];
                                                                $name= $row['name'];
                                                                $data_type= $row['data_type'];
                                                                $abbreviation = $row['abbreviation'];
                                                                $definition = $row['definition'];
                                                                $unit = $row['unit_of_measurement'];
                                                                $precision = $row['precision_of_measurement'];
                                                                $variable_list = $row['variable_list'];
                                                                $observations = $row['observations'];
                                                                $missing_data_codes = $row['missing_data_codes'];
                                                                $data_set_id = $row['data_set_id'];

                                                                $data_set_id =$row['data_set_id'];

                                                                $result2 = $db_conn->query("SELECT * FROM tbl_data_set WHERE id='$data_set_id'");
                                                                $row2 = $result2->fetch_assoc();
                                                                $data_set_id = $row2['id'];
                                                                $assoc_ds = $row2['name'];


                                                                echo "
                                                                <tr >
                                                                <td style='display:none' class='id'>$variable_id</td>
                                                                <td class='' style='' > <a data-toggle='modal' href='#modal_ds$i' >$name </a>  </td>
                                                                <td class=''   style='text-align: center;'> $data_type </td>
                                                                <td class='' style='text-align: center;'> <a href='data_set_page.php?id=$data_set_id' >$assoc_ds </a> </td>


                                                                    <td style='text-align:center;'>
                                                                        <a href='edit_variable.php?id=$variable_id' class='btn btn-icon-only blue'><i style='font-size:16px;' class='fa fa-pencil'></i></a>
                                                                        <a href='javascript:;' class='btn btn-icon-only red delete_variable'><i style='font-size:16px;' class=' fa fa-trash'></i></a>
                                                                    </td>
                                                                </tr>";


                                                                  # code...

                                                                //modal
                                                                echo "<div class='modal fade modal-scroll modal_tag' id='modal_ds$i' tabindex='-1' role='dialog' aria-hidden='true' >
                                                                                                  <div class='modal-dialog modal-lg' style='position:relative;' id='ea'>
                                                                                                      <div class='modal-content'>
                                                                                                          <div class='modal-header'>
                                                                                                              <button type='button' class='close close_modal' data-dismiss='modal' aria-hidden='true'></button>


                                                                                                              <h4 class='modal-title font-red'  > Variable Metadata</h4>


                                                                                                          </div>
                                                                                                          <div class='modal-body' >
                                                                                                            <!--BEGIN FORMS  -->
                                                                                                            <div class='portlet-body form'>
                                                                                                              <form role='form' method='POST' action='includes/upload_file.php' enctype='multipart/form-data'>
                                                                                                                <div class='form-body'>

                                                                                                                <div class='row'>


                                                                                                                    <div class='col-md-12'>


                                                                                                                        <div class='form-group form-md-line-input'>
                                                                                                                            <div id='file_title' class='form-control form-control-static'> $name</div>
                                                                                                                            <label for='form_control_1'>Variable Name:</label>
                                                                                                                        </div>

                                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                                              <div class='form-control form-control-static'> $assoc_ds</div>
                                                                                                                              <label for='form_control_1'>Associated Dataset:</label>
                                                                                                                          </div>
                                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                                              <div class='form-control form-control-static'> $abbreviation</div>
                                                                                                                              <label for='form_control_1'>Abbreviation(s):</label>
                                                                                                                          </div>
                                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                                              <div class='form-control form-control-static'> $data_type</div>
                                                                                                                              <label for='form_control_1'>Data Type:</label>
                                                                                                                          </div>



                                                                                                                          <div id='replace_modal'>


                                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                                              <div id='software_name' class='form-control form-control-static'>$unit</div>
                                                                                                                              <label for='form_control_1'>Unit of Measurement:</label>
                                                                                                                          </div>
                                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                                              <div id='software_link' class='form-control form-control-static'>$precision</div>
                                                                                                                              <label for='form_control_1'>precision of Measurement:</label>
                                                                                                                          </div>

                                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                                              <div id='comments' class='form-control form-control-static'>$variable_list</div>
                                                                                                                              <label for='form_control_1'>Range or List of Variables:</label>
                                                                                                                          </div>

                                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                                              <div id='comments' class='form-control form-control-static'>$observations</div>
                                                                                                                              <label for='form_control_1'>Observations:</label>
                                                                                                                          </div>

                                                                                                                          <div class='form-group form-md-line-input'>
                                                                                                                              <div id='comments' class='form-control form-control-static'>$missing_data_codes</div>
                                                                                                                              <label for='form_control_1'>Missing Data Codes:</label>
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
                                                                                              </div>";

                                                                $i = $i + 1;
                                                              }





                                                              ?>
                                                            </tbody>
                                                        </table>





                                                    </div>

                                                    <div class="tab-pane" id="portlet_tab1">
                                                      <table class="table table-striped table-hover table-bordered trash_table" id="sample_editable_3">
                                                        <thead>
                                                            <tr>
                                                                <th style="display:none">ID</th>
                                                                <th style="text-align: center;"> Name </th>
                                                                <th style="text-align: center;"> Data Type </th>
                                                                <th style="text-align: center;"> Associated Dataset </th>

                                                                <th style="text-align: center;"> Actions </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                          <?php
                                                          $query="SELECT * FROM tbl_variables WHERE deleted = 1 and data_set_id IN (SELECT distinct id FROM tbl_data_set WHERE project_id in (SELECT distinct id FROM tbl_projects WHERE u_id='$u_id')) ";

                                                          $result = $db_conn->query($query);

                                                          // $row = $result->fetch_assoc();
                                                          // echo $row['status'];

                                                          while ($row = $result->fetch_assoc() ) {
                                                            # code...
                                                            $variable_id = $row['id'];
                                                            $name= $row['name'];
                                                            $data_type= $row['data_type'];

                                                            $data_set_id =$row['data_set_id'];

                                                            $result2 = $db_conn->query("SELECT * FROM tbl_data_set WHERE id='$data_set_id'");
                                                            $row2 = $result2->fetch_assoc();
                                                            $data_set_id = $row2['id'];
                                                            $assoc_ds = $row2['name'];


                                                            echo "
                                                            <tr >
                                                            <td style='display:none' class='id'>$variable_id</td>
                                                            <td class=''  > $name </td>
                                                            <td class=''   style='text-align: center;'> $data_type </td>
                                                            <td class='' style='text-align: center;'> <a href='data_set_page.php?id=$data_set_id' >$assoc_ds </a> </td>


                                                                <td style='text-align:center;'>
                                                                    <a  class='btn btn-icon-only blue restore_variable'><i style='font-size:16px;' class='fa fa-undo '></i></a>
                                                                    <a href='javascript:;' class='btn btn-icon-only red delete_variable'><i style='font-size:16px;' class=' fa fa-trash'></i></a>
                                                                </td>
                                                            </tr>";
                                                          }



                                                          ?>
                                                      </tbody>
                                                      </table>
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

        <!-- END CONTAINER -->
      <?php
        include '../includes/footer.php' ;
      ?>
      <script src="includes/clickable_row.js" type="text/javascript"></script>
      <script src="../assets/pages/scripts/table-datatables-editable2.js" type="text/javascript"></script>
      <script>
      $(document).ready(function(){
          $(".contain_modals").append($(".modal_tag"));
      });



      $(document).on("click", '.restore_variable', function(event) {
        var variable_id =$(this).closest('tr ').find(".id")[0].innerHTML;
        console.log(variable_id);
        var res = confirm("u sure?");
        if (res) {
          $.ajax({
            url: 'includes/restoreVariable.php',
            method: 'POST',
            // dataType:"text",
            data: {variable_id : variable_id},
            success: function(data){
              if (data != ''){
              replaceElement(".variable_table ");
              // replaceElement(".shared_table ");
              replaceElement(".trash_table ");
              // $(".trash_table").addClass("active");

              var total_modals=$(".modal_tag").length;
              console.log("total_modals",total_modals);
              // update modals
              $.get(String(window.location.href), function (loaded_data) {
                  loaded_data = $(loaded_data).find(".modal_tag");
                  $(".contain_modals").empty();
                  $(".contain_modals").append(loaded_data);
                });
                // $(".contain_modals ").load(String(window.location.href)+" .contain_modals");


              }
            }
          });
        }
      });

        $('#proceed_dataset').click(function(){
          var project_id = $('#dropdown_dataset :selected').val();
          $("#hidden_input").attr("value", project_id);




        });
        // });
      </script>
