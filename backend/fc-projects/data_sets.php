<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';
  $_SESSION["last_url"]= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $u_id = $_SESSION["user_id"];
  $_SESSION['current_data_set_id'] = $_GET['id'];





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
                      <span class="title firecollect"> Datasets</span>

                      </div>
                      <ul class="nav nav-tabs">
                      <li class="active">
                      <a href="#portlet_tab3" data-toggle="tab"> My Datasets </a>
                      </li>
                      <li>
                      <a href="#portlet_tab2" data-toggle="tab"> Shared Dataset </a>
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
                                                                          Add Data Set
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
                                                                              <h4 class="modal-title">Select Project </h4>
                                                                          </div>
                                                                          <div class="modal-body">
                                                                              <form action="#" class="form-horizontal">



                                                                                <div class="form-group">
                                                                                    <label class="control-label col-md-4">Select Associated Project</label>
                                                                                    <div class="col-md-8">
                                                                                        <select id="dropdown_dataset" class="form-control select2">
                                                                                          <?php
                                                                                          $query3= "SELECT * FROM tbl_projects WHERE deleted = 0  and u_id='$u_id' ";

                                                                                          $result3 = $db_conn->query($query3);
                                                                                            while ($row3 = $result3->fetch_assoc()) {
                                                                                              echo "<option value=".$row3['id'].">
                                                                                                    ".$row3['title']."
                                                                                                    </option>";
                                                                                            }
                                                                                           ?>

                                                                                        </select>
                                                                                    </div>
                                                                                </div>





                                                                                                              </form>
                                                                                     </div>
                                                                                     <div class="modal-footer">
                                                                                        <form id="myForm" method="post" action="add_data_set.php">
                                                                                          <!-- <a id="proceed_dataset" class="btn green" data-dismiss="modal" href="">Proceed</a> -->
                                                                                          <input id="hidden_input" type="hidden" name="project_id" value="">
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

                                                        <div class='modal fade modal-scroll modal_tag' id='modal_terms' tabindex='-1' role='dialog' aria-hidden='true' >
                                                                                          <div class='modal-dialog modal-lg' style='position:relative;' id='ea'>
                                                                                              <div class='modal-content'>
                                                                                                  <div class='modal-header'>
                                                                                                      <button type='button' class='close close_modal' data-dismiss='modal' aria-hidden='true'></button>


                                                                                                      <h4 class='modal-title font-red'  > Terms and Conditions:</h4>
                                                                                                      <span style='display:none' class='id'></span>


                                                                                                  </div>
                                                                                                  <div class='modal-body' >
                                                                                                    <!--BEGIN FORMS  -->
                                                                                                    <div class='portlet-body form'>
                                                                                                      <form role='form' method='POST' action='javascript:;' enctype='multipart/form-data'>
                                                                                                        <div class='form-body'>

                                                                                                        <div class='row'>


                                                                                                            <div class='col-md-12'>


                                                                                                                <div ><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                                                                                                </p></div>



                                                                                                                <div class='form-group form-md-checkboxes'>
                                                                                                                                                            <div class='md-checkbox-inline'>
                                                                                                                                                                <div class='md-checkbox has-success'>
                                                                                                                                                                    <input required type='checkbox' id='checkbox14' class='md-check'>
                                                                                                                                                                    <label for='checkbox14'>
                                                                                                                                                                        <span class='inc'></span>
                                                                                                                                                                        <span class='check'></span>
                                                                                                                                                                        <span class='box'></span> I have read and agree to these terms and conditions. </label>
                                                                                                                                                                </div>

                                                                                                                                                            </div>
                                                                                                                                                        </div>



                                                                                                                <button class='btn dark btn-outline' data-dismiss='modal' aria-hidden='true'>Close</button>
                                                                                                                <input id='change_status' class='btn green' type='submit' value='Agree'>
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


                                                        <table class="table table-striped table-hover table-bordered dataset_table" id="sample_editable_1">
                                                            <thead>
                                                                <tr>
                                                                    <th style="display:none">ID</th>
                                                                    <th style="text-align: center;"> Name </th>
                                                                    <th style="text-align: center;"> Data Files </th>
                                                                    <th style="text-align: center;"> Project </th>
                                                                    <th style="text-align: center;"> Status </th>

                                                                    <th style="text-align: center;"> Actions </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php
                                                                $query= "SELECT * FROM tbl_data_set WHERE deleted = 0 and project_id IN (SELECT distinct id FROM tbl_projects WHERE u_id='$u_id') ";

                                                                $result = $db_conn->query($query);

                                                                // $row = $result->fetch_assoc();
                                                                // echo $row['status'];

                                                                while ($row = $result->fetch_assoc() ) {
                                                                  # code...
                                                                  $data_set_id = $row['id'];
                                                                  $name= $row['name'];
                                                                  $period= $row['period'];
                                                                  $status = $row['status'];

                                                                  $project_id =$row['project_id'];

                                                                  $query2 = "SELECT * FROM tbl_projects WHERE id='$project_id'";
                                                                  $result2 = $db_conn->query($query2);
                                                                  $row2 = $result2->fetch_assoc();
                                                                  $project_title = $row2['title'];
                                                                  //Amount of data files
                                                                  $res_df = $db_conn->query("SELECT COUNT(id) FROM tbl_data_files WHERE data_set_id='$data_set_id'");
                                                                  $row_df = $res_df->fetch_assoc();
                                                                  $df_num = $row_df['COUNT(id)'];

                                                                  echo "
                                                                  <tr >
                                                                      <td style='display:none' class='id'>$data_set_id</td>
                                                                      <td class='clickable-row'  data-href='data_set_page.php?id=$data_set_id'><a href='data_set_page.php?id=$data_set_id'> $name</a> </td>
                                                                      <td class='clickable-row'  data-href='data_set_page.php?id=$data_set_id' style='text-align: center;'> $df_num </td>
                                                                      <td class='clickable-row'  data-href='data_set_page.php?id=$data_set_id'> $project_title </td>
                                                                      <td  style='text-align: center;'> ";
                                                                      if ($status == 0){
                                                                        echo "<div id= '1' class='status_toggle '>
                                                                        <input type='checkbox' class='make-switch' data-on-text='Public' data-off-text='Private' data-size='small'  data-on-color='success' data-off-color='danger'>
                                                                        </div> ";
                                                                      }
                                                                      else {
                                                                        echo "<div id='0' class='status_toggle '>
                                                                        <input type='checkbox' checked class='make-switch' data-on-text='Public' data-off-text='Private' data-size='small'  data-on-color='success' data-off-color='danger'>
                                                                        </div>";
                                                                      }

                                                                      echo "</td>


                                                                      <td style='text-align:center;'>
                                                                          <a href='edit_dataset.php?id=$data_set_id' class='btn btn-icon-only blue'><i style='font-size:16px;' class='fa fa-pencil'></i></a>
                                                                          <a id='$data_set_id' href='javascript:;' class='btn btn-icon-only red delete_dataset'><i style='font-size:16px;' class=' fa fa-trash'></i></a>
                                                                      </td>
                                                                  </tr>";
                                                                }



                                                                ?>
                                                            </tbody>
                                                        </table>





                                                    </div>
                                                    <div class="tab-pane" id="portlet_tab2">

                                                        <table class="table table-striped table-hover table-bordered shared_table" id="sample_editable_2">
                                                          <thead>
                                                              <tr>
                                                                  <th style="display:none">ID</th>
                                                                  <th style="text-align: center;"> Name </th>
                                                                  <th style="text-align: center;"> Project </th>
                                                                  <th style="text-align: center;"> Period</th>

                                                                  <th style="text-align: center;"> Actions </th>
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                            <?php
                                                              $res = $db_conn->query("SELECT ds.id,ds.name,ds.project_id, ds.period,p.title,c.edit_dataset,c.delete_dataset
                                                                               from tbl_data_set ds inner join tbl_projects p on
                                                                               ds.project_id = p.id inner join tbl_collaborators c on
                                                                               p.id = c.p_id
                                                                               where user_id = '$u_id' and ds.deleted = 0") ;





                                                              while($row_ds = $res->fetch_assoc())
                                                              {
                                                                $ds_project_id = $row_ds['project_id'] ;
                                                                $ds_id = $row_ds['id'] ;
                                                                $ds_name = $row_ds['name'] ;
                                                                $ds_period = $row_ds['period'] ;
                                                                $edit = $row_ds['edit_dataset'] ;
                                                                $del = $row_ds['delete_dataset'] ;
                                                                $project_title = $row_ds['title'] ;


                                                                echo " <tr><td style='display:none' class='id'>$ds_id</td>
                                                                 <td class='clickable-row'  data-href='data_set_page.php?id=$ds_id'><a href='data_set_page.php?id=$ds_id'> $ds_name</a> </td>
                                                                 <td class='clickable-row'  data-href='data_set_page.php?id=$ds_id'> $project_title </td>
                                                                 <td class='clickable-row'  data-href='data_set_page.php?id=$ds_id' style='text-align: center;'> $ds_period </td>


                                                                 <td style='text-align:center;'>";

                                                                 if($edit == 1)
                                                                 {
                                                                   echo "<a href='edit_dataset.php?id=$ds_id' class='btn btn-icon-only blue'><i style='font-size:16px;' class='fa fa-pencil'></i></a>" ;
                                                                 }

                                                                 else
                                                                 {
                                                                   echo "<a class='btn btn-icon-only blue disabled'><i style='font-size:16px;' class='fa fa-pencil '></i></a>" ;
                                                                 }

                                                                 if($del == 1)
                                                                 {
                                                                   echo "<a id='$data_set_id' href='javascript:;' class='btn btn-icon-only red delete_dataset'><i style='font-size:16px;' class=' fa fa-trash'></i></a>" ;
                                                                 }

                                                                 else
                                                                 {
                                                                   echo "<a class='btn btn-icon-only red disabled'><i style='font-size:16px;' class=' fa fa-trash'></i></a>" ;
                                                                 }
                                                                    echo "
                                                                 </td></tr>" ;
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
                                                                <th style="text-align: center;"> Project </th>
                                                                <th style="text-align: center;"> Period </th>

                                                                <th style="text-align: center;"> Actions </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $query= "SELECT * FROM tbl_data_set WHERE deleted = 1 and project_id IN (SELECT distinct id FROM tbl_projects WHERE u_id='$u_id') ";
                                                        $result = $db_conn->query($query);

                                                        // $row = $result->fetch_assoc();
                                                        // echo $row['status'];

                                                        while ($row = $result->fetch_assoc() ) {
                                                          # code...
                                                          $data_set_id = $row['id'];
                                                          $name= $row['name'];
                                                          $period= $row['period'];

                                                          $project_id =$row['project_id'];

                                                          $query2 = "SELECT * FROM tbl_projects WHERE id='$project_id'";
                                                          $result2 = $db_conn->query($query2);
                                                          $row2 = $result2->fetch_assoc();
                                                          $project_title = $row2['title'];


                                                          echo "
                                                          <tr >
                                                              <td style='display:none' class='id'>$data_set_id</td>
                                                              <td class='clickable-row'  data-href='data_set_page.php?id=$data_set_id'><a href='data_set_page.php?id=$data_set_id'> $name</a> </td>
                                                              <td class='clickable-row'  data-href='data_set_page.php?id=$data_set_id'> $project_title </td>
                                                              <td class='clickable-row'  data-href='data_set_page.php?id=$data_set_id' style='text-align: center;'> $period </td>



                                                              <td style='text-align:center;'>

                                                                  <a href='javascript:;' class='btn btn-icon-only blue restore_dataset'><i style='font-size:16px;' class=' fa fa-undo'></i></a>
                                                                  <a id='$data_set_id' href='javascript:;' class='btn btn-icon-only red delete_dataset'><i style='font-size:16px;' class=' fa fa-trash'></i></a>

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
      <!-- <script src="../assets/pages/scripts/table-datatables-editable2.js" type="text/javascript"></script> -->
      <script src="includes/js/statusToggle.js" type="text/javascript"></script>

      <script>
      // $(document).ready(function(){

      function replaceElement(element) {
          //retrieve updated table and replace it with the current one
          $.get(String(window.location.href), function (loaded_data) {
              loaded_data = $(loaded_data).find(element);
              $(element).closest(".dataTables_wrapper").replaceWith(loaded_data);
          // activate datatable functionality
              $(element  ).dataTable( {
                 aaSorting:[], 'searching': true,
                'lengthMenu': [[20, 50, 100, 200, -1], [20, 50, 100,200, "All"]]
              });
            });
      }

      $(document).on("click", '.restore_dataset', function(event) {
        var dataset_id =$(this).closest('tr ').find(".id")[0].innerHTML;
        console.log(dataset_id);
        var res = confirm("u sure?");
        if (res) {
          $.ajax({
            url: 'includes/restoreDataset.php',
            method: 'POST',
            // dataType:"text",
            data: {dataset_id : dataset_id},
            success: function(data){
              if (data != ''){
              replaceElement(".dataset_table ");
              replaceElement(".shared_table ");
              replaceElement(".trash_table ");
              // $(".trash_table").addClass("active");
              }
            }
          });
        }
      });

        $('#proceed_dataset').click(function(){
          var project_id = $('#dropdown_dataset :selected').val();
          $("#hidden_input").attr("value", project_id);




        });
        setStatusToggle("table","includes/updateDatasetStatus.php");

        $(document).on('ajaxComplete',function(){
          $('.make-switch').bootstrapSwitch();
          setStatusToggle("table","includes/updateDatasetStatus.php");
        });
        // });
      </script>
