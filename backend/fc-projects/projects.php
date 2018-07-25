<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';

  $_SESSION["last_url"]= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $u_id =$_SESSION["user_id"];


    function validateInput($data){
      $data = trim(stripcslashes(htmlspecialchars($data)));
      return $data;


    }

    $infoQuery = "SELECT * from tbl_user_info where u_id = '$u_id' and f_name != 'NULL' and l_name != 'NULL' and country != 'NULL' and city != 'NULL' and institution_id != 'NULL' " ;
    $i = $db_conn->query($infoQuery) ;
    // $i = $i->fetch_assoc();


?>

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->


                    <div class="portlet light">
<div class="portlet-title tabbable-line">
<div class="caption">
<!-- <i class="icon-fire font-red"></i> -->
<span class="title firecollect"> Projects </span>
<!-- <span class="caption-helper">more samples...</span> -->
</div>
<ul class="nav nav-tabs">
<li class="active">
<a href="#portlet_tab3" data-toggle="tab"> My Projects </a>
</li>
<li>
<a href="#portlet_tab2" data-toggle="tab"> Shared With Me </a>
</li>
<li >
<a href="#portlet_tab1" data-toggle="tab"> Trash </a>
</li>
</ul>
</div>
<div class="portlet-body">
<div class="tab-content">
<div class="tab-pane active" id="portlet_tab3">
<div >
<!-- <h4>Tab 1 Content</h4> -->
<div class="table-toolbar">
<?php
if(mysqli_num_rows($i) > 0)
{
  echo "<div class='row'>
      <div class='col-md-6'>
          <div class='btn-group'>
            <a href='add_project.php' >
              <button  class='btn firecollect'> Add Project
                  <i class='fa fa-plus'></i>
              </button>
            </a>
          </div>
      </div>
  </div>";
}

else
{
  echo "<div class='row'>
      <div class='col-md-6'>
          <div class='btn-group'>
              <button class='btn firecollect' id='missingInfo'> Add Project
                  <i class='fa fa-plus'></i>
              </button>
          </div>
      </div>
  </div>";
}

    ?>
</div>




<table class="table table-striped table-hover table-bordered projects_table" id="sample_editable_1">
    <thead>
        <tr>
            <th style="display: none "> ID </th>
            <th style="text-align: center;"> Title </th>
            <th style="text-align: center;"> Datasets </th>
            <th style="text-align: center;"> Collaborators </th>
            <th style="text-align: center;"> Status </th>
            <th style="text-align: center;"> Actions </th>
        </tr>
    </thead>
    <tbody>
      <!-- <script src="../assets/pages/scripts/table-datatables-editable.js" type="text/javascript"></script> -->

        <?php
        $query= "SELECT * FROM tbl_projects where u_id='$u_id' and deleted = 0";
        $result = $db_conn->query($query);

        // $row = $result->fetch_assoc();
        // echo $row['status'];
        while ($row = $result->fetch_assoc() ) {
          # code...
          $project_id = $row['id'];
          $title= $row['title'];
          $col = $db_conn->query("SELECT COUNT(*) from tbl_collaborators where p_id = '$project_id'");
          $col = $col->fetch_assoc() ;
          $num = $col['COUNT(*)'] ;
          // $period= $row['period'];

          $status= (int)$row['status'];
          $row_ds = $db_conn->query("SELECT COUNT(id) FROM `tbl_data_set` WHERE project_id='$project_id' and deleted = 0");
          $row_ds = $row_ds->fetch_assoc() ;

          $num_of_ds=$row_ds['COUNT(id)'];

          if ($status == 0 ){
          echo "
          <tr >
              <td style='display:none' class='id'>$project_id</td>
              <td class='clickable-row' width='30%' data-href='user_project.php?id=$project_id'><a href='user_project.php?id=$project_id'> $title</a> </td>

              <td class='clickable-row' data-href='user_project.php?id=$project_id' style='text-align: center;'> $num_of_ds </td>
              <td class='clickable-row' data-href='user_project.php?id=$project_id' style='text-align: center;'> $num </td>
              <td  style='text-align:center;'>
              <div id= '1' class='status_toggle '>
              <input type='checkbox' class='make-switch' data-on-text='Public' data-off-text='Private' data-size='small'  data-on-color='success' data-off-color='danger'>
              </div>
               </td>


              <td class='td_last' style='text-align:center;'>
                <a href='#basic' class='btn btn-icon-only green share' data-toggle='modal'>
                <i style='font-size:16px;' class=' fa fa-user-plus'></i></a>
                <a href='edit.php?id=$project_id' class='btn btn-icon-only blue'><i style='font-size:16px;' class='fa fa-pencil'></i></a>
                <a id='$project_id' href='javascript:;' class='btn btn-icon-only red delete_project'><i style='font-size:16px;' class=' fa fa-trash'></i></a>


              </td>
          </tr>
          ";}else{
            echo "
            <tr >
                <td style='display:none' class='id'>$project_id</td>
                <td class='clickable-row' width='30%' data-href='user_project.php?id=$project_id' ><a href='user_project.php?id=$project_id'> $title</a> </td>
                <td class='clickable-row' data-href='user_project.php?id=$project_id' style='text-align: center;'> $num_of_ds </td>
                <td class='clickable-row' data-href='user_project.php?id=$project_id' style='text-align: center;'> $num </td>
                <td  style='text-align:center;'>
                <div id='0' class='status_toggle '>
                <input type='checkbox' checked class='make-switch' data-on-text='Public' data-off-text='Private' data-size='small'  data-on-color='success' data-off-color='danger'>
                </div>
                </td>


                <td class='td_last' style='text-align:center;'>
                    <a href='#basic' class='btn btn-icon-only green share' data-toggle='modal'>
                    <i style='font-size:16px;' class=' fa fa-user-plus'></i></a>
                    <a href='edit.php?id=$project_id' class='btn btn-icon-only blue'><i style='font-size:16px;' class='fa fa-pencil'></i></a>
                    <a id='$project_id' href='javascript:;' class='btn btn-icon-only red delete_project'><i style='font-size:16px;' class=' fa fa-trash'></i></a>
                </td>
            </tr>
            ";
          }
        }


        ?>
    </tbody>
</table>
</div>
</div>
  <div class="tab-pane" id="portlet_tab2">
    <div>
      <table class="table table-striped table-hover table-bordered shared_table" id="sample_editable_2">
          <?php
            $query= "SELECT * FROM tbl_projects inner join tbl_collaborators on tbl_collaborators.p_id = tbl_projects.id  where deleted = 0 and user_id = '$u_id' ";
            // $perm = "SELECT * FROM tbl_collaborators where u_id='$u_id'";
            $result = $db_conn->query($query);
           ?>
          <thead>
              <tr>
                  <th style="display: none "> ID </th>
                  <th style="text-align: center;"> Title </th>
                  <th style="text-align: center;"> Datasets </th>

                  <th style="text-align: center;"> Status </th>

                  <th style="text-align: center;"> Actions </th>
              </tr>
          </thead>
          <tbody>
            <!-- <script src="../assets/pages/scripts/table-datatables-editable.js" type="text/javascript"></script> -->

              <?php


              // $row = $result->fetch_assoc();
              // echo $row['status'];
              while ($row = $result->fetch_assoc() ) {

                # code...
                $project_id = $row['id'];
                $title= $row['title'];
                // $period= $row['period'];
                $row_ds = $db_conn->query("SELECT COUNT(id) FROM `tbl_data_set` WHERE project_id='$project_id' and deleted = 0");
                $row_ds = $row_ds->fetch_assoc() ;

                $num_of_ds=$row_ds['COUNT(id)'];

                $status= (int)$row['status'];
                $edit = $row['edit_project'] ;

                if ($status == 0 ){
                echo "
                <tr >
                    <td style='display:none' class='id'>$project_id</td>
                    <td class='clickable-row' width='30%' data-href='user_project.php?id=$project_id'><a href='user_project.php?id=$project_id'> $title</a> </td>
                    <td class='clickable-row' data-href='user_project.php?id=$project_id' style='text-align: center;'> $num_of_ds </td>
                    <td class='clickable-row' data-href='user_project.php?id=$project_id' style='text-align:center;'>
                    <span class='label label-danger'> private </span>

                     </td>

                    " ;
                    if($edit == "1")
                    {
                      echo "<td class='td_last' style='text-align:center;'>
                      <a href='#basic' class='btn btn-icon-only green share disabled'>
                      <i style='font-size:16px;' class=' fa fa-user-plus'></i></a>
                      <a href='edit.php?id=$project_id' class='btn btn-icon-only blue'><i style='font-size:16px;' class='fa fa-pencil'></i></a>
                      <a href='javascript:;' class='btn btn-icon-only red disabled'><i style='font-size:16px;' class=' fa fa-trash'></i></a>                      </td> " ;
                    }
                    else {
                      echo "<td class='td_last' style='text-align:center;'>
                      <a href='#basic' class='btn btn-icon-only green share disabled'>
                      <i style='font-size:16px;' class=' fa fa-user-plus'></i></a>
                      <a href='' class='btn btn-icon-only blue disabled'><i style='font-size:16px;' class='fa fa-pencil'></i></a>
                      <a href='javascript:;' class='btn btn-icon-only red disabled '><i style='font-size:16px;' class=' fa fa-trash'></i></a>
                      </td> " ;
                    }

                echo "</tr>
                ";}else{
                  echo "
                  <tr >
                      <td style='display:none' class='id'>$project_id</td>
                      <td class='clickable-row' width='30%' data-href='user_project.php?id=$project_id' ><a href='user_project.php?id=$project_id'> $title</a> </td>
                      <td class='clickable-row' data-href='user_project.php?id=$project_id' style='text-align: center;'> $num_of_ds </td>

                      <td class='clickable-row' data-href='user_project.php?id=$project_id' style='text-align:center;'>
                       <span class='label label-success' >public </span>

                       </td>" ;


                       if($edit == "1")
                       {
                         echo "<td class='td_last' style='text-align:center;'>
                         <a href='#basic' class='btn btn-icon-only green share disabled' >
                         <i style='font-size:16px;' class=' fa fa-user-plus'></i></a>
                         <a href='edit.php?id=$project_id' class='btn btn-icon-only blue'><i style='font-size:16px;' class='fa fa-pencil'></i></a>
                         <a href='javascript:;' class='btn btn-icon-only red disabled '><i style='font-size:16px;' class=' fa fa-trash'></i></a>
                         </td> " ;
                       }
                       else {
                         echo "<td class='td_last' style='text-align:center;'>
                         <a href='#basic' class='btn btn-icon-only green share disabled'>
                         <i style='font-size:16px;' class=' fa fa-user-plus'></i></a>
                         <a href='' class='btn btn-icon-only disabled blue'><i style='font-size:16px;' class='fa fa-pencil'></i></a>
                         <a href='javascript:;' class='btn btn-icon-only red disabled'><i style='font-size:16px;' class=' fa fa-trash'></i></a>
                         </td> " ;
                       }
                  echo "</tr>
                  ";
                }
              }


              ?>
          </tbody>
      </table>

</div>
</div>
<div class='modal fade modal-scroll modal_tag' id='modal_terms' tabindex='-1' role='dialog' aria-hidden='true' >
                                  <div class='modal-dialog modal-lg' style='position:relative;' id='ea'>
                                      <div class='modal-content'>
                                          <div class='modal-header'>
                                              <button type='button' class='close close_modal' data-dismiss='modal' aria-hidden='true'></button>


                                              <h4 class='title firecollect'  > Terms and Conditions:</h4>
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
<div class="tab-pane" id="portlet_tab1">
  <table class="table table-striped table-hover table-bordered trash_table" id="sample_editable_3">
      <thead>
          <tr>
              <th style="display: none "> ID </th>
              <th style="text-align: center;"> Title </th>
              <th style="text-align: center;"> Datasets </th>

              <th style="text-align: center;"> Status </th>
              <th style="text-align: center;"> Actions </th>
          </tr>
      </thead>
      <tbody>
        <!-- <script src="../assets/pages/scripts/table-datatables-editable.js" type="text/javascript"></script> -->

          <?php
          $query= "SELECT * FROM tbl_projects where u_id='$u_id' and deleted = 1";

          $result = $db_conn->query($query);

          // $row = $result->fetch_assoc();
          // echo $row['status'];
          while ($row = $result->fetch_assoc() ) {
            # code...
            $project_id = $row['id'];
            $title= $row['title'];
            // $period= $row['period'];
            $row_ds = $db_conn->query("SELECT COUNT(id) FROM `tbl_data_set` WHERE project_id='$project_id' and deleted = 0");
            $row_ds = $row_ds->fetch_assoc() ;

            $num_of_ds=$row_ds['COUNT(id)'];
            $status= (int)$row['status'];

            if ($status == 0 ){
            echo "
            <tr >
                <td style='display:none' class='id'>$project_id</td>
                <td> $title </td>
                <td style='text-align: center;'> $num_of_ds </td>

                <td style='text-align:center;'>
                <span class='label label-danger'> private </span>

                 </td>


                <td class='td_last' style='text-align:center;'>
                  <a href='javascript:;' class='btn btn-icon-only blue restore_project'><i style='font-size:16px;' class=' fa fa-undo '></i></a>
                  <a id='$project_id' href='javascript:;' class='btn btn-icon-only red delete_project'><i style='font-size:16px;' class=' fa fa-trash'></i></a>

                </td>
            </tr>
            ";}else{
              echo "
              <tr class='tr' >
                  <td style='display:none' class='id'>$project_id</td>
                  <td> $title </td>
                  <td style='text-align: center;'> $num_of_ds </td>

                  <td style='text-align:center;'>
                   <span class='label label-success' >public </span>

                   </td>


                   <td class='td_last' style='text-align:center;'>
                     <a href='javascript:;' class='btn btn-icon-only blue restore_project'><i style='font-size:16px;' class=' fa fa-undo '></i></a>
                     <a id='$project_id'  href='javascript:;' class='btn btn-icon-only red delete_project'><i style='font-size:16px;' class=' fa fa-trash'></i></a>

                   </td>
              </tr>
              ";
            }
          }


          ?>
      </tbody>
  </table>
</div>
</div>
</div>
</div>
<?php
  include 'includes/inviteCollaborators.php' ;

 ?>
                    <!-- BEGIN  PORTLET-->


                                                                    <script>
                                                                  //   $("#table tr").click(function(){
                                                                  //     $(this).addClass('selected');
                                                                  //     var value=$(this).find('td:first').html();
                                                                  //     alert(value);
                                                                  // });
                                                                </script>
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
      <script src="includes/js/statusToggle.js" type="text/javascript"></script>

      <script>
        var inv = "<?php echo $_SESSION['invited'] ; ?>" ;
        if( inv == "1" )
        {
          swal({
              position: 'top-right',
              type: 'success',
              title: 'Your invitations have been sent!',
              showConfirmButton: false,
              timer: 1500
            });

        }

        $('#missingInfo').on("click", function(){
          swal({
              type: 'warning',
              title: 'Cannot create project.',
              text: 'Please fill out your personal information before creating a new project.',
              showConfirmButton: true,

            });

        });
      </script>
      <?php
        unset($_SESSION['invited']) ;
       ?>

       <script>
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
               // last call is true: activates portlet tab
               // if (lastCall) {
                 // $(".tab-pane ").removeClass("active");
                 // $(element).addClass("active");
//       var total = String($(element +" tr").length -1);
//       var showing = String((total<=5) ? total : 5);
// $(element).closest(".dataTables_wrapper").find(".dataTables_info")[0].innerHTML="Showing 1 to "+showing+" of "+total+" entries";
               // }
             });
       }

         $('#multi-append').select2({
           placeholder: "Please select a country"
         });

         $(document).on("click", '.restore_project', function(event) {
           var project_id =$(this).closest('tr ').find(".id")[0].innerHTML;
           console.log(project_id);
           var res = confirm("u sure?");
           if (res) {
             $.ajax({
               url: 'includes/restore_project.php',
               method: 'POST',
               // dataType:"text",
               data: {project_id : project_id},
               success: function(data){
                 if (data != ''){
                 // $("#portlet_tab1 ").load(String(window.location.href)+" #portlet_tab1",
                 //     function () {
                 //       console.log("project restored!", data);
                 //
                 //     });
                 //    $("#portlet_tab3 ").load(String(window.location.href)+" #portlet_tab3");
                 replaceElement(".projects_table ");
                 replaceElement(".shared_table ");
                 replaceElement(".trash_table ");
                 // $(".trash_table").addClass("active");

                 // $( ".nav-tabs" ).tabs({ active: 1 });
                 // $( ".nav-tabs" ).tabs( "option", "active", 1 );



                 }
               }
               // dataType: dataType
             });
           }

         });


         // function change_status_btn(new_id,remove,add,btn_txt,drop_txt )
         //       {$(".status_toggle")[0].id = new_id;
         //       $(".status_toggle button").removeClass(remove);
         //       $(".status_toggle button").addClass(add);
         //       $(".status_toggle").find("button")[0].innerHTML=btn_txt;
         //       $(".status_toggle").find("a")[0].innerHTML=drop_txt ;}




         $(document).on( 'ready',function(){
           $('.select2-search__field')[0].placeholder="Select Collaborators";

                    });

      setStatusToggle("table","includes/updateStatus.php");

      $(document).on('ajaxComplete',function(){
        $('.make-switch').bootstrapSwitch();
        setStatusToggle("table","includes/updateStatus.php");

      });
       </script>

      <script src="includes/clickable_row.js" type="text/javascript"></script>
