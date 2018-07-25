



<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        <div class="scroll-to-top">
            <i class="icon-arrow-up"></i>
        </div>
    </div>


    <!-- VIEW DATAFILES MODAL START -->
    <div id="view_dfs_modal" class="modal fade" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Proceed to Data Files </h4>
                </div>
                <div class="modal-body">
                    <form action="#" class="form-horizontal">



                      <div class="form-group">
                          <label class="control-label col-md-4">Select Associated Dataset</label>
                          <div class="col-md-8">
                              <select id="dropdown_datafile" class="form-control select2">
                                <?php
                                $query3= "SELECT d.name,d.id FROM tbl_data_set d join tbl_projects p on d.project_id=p.id WHERE d.deleted = 0  and u_id='$user_id' ";

                                $result3 = $db_conn->query($query3);
                                  while ($row3 = $result3->fetch_assoc()) {
                                    echo "<option  value=".$row3['id'].">
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
                              <form id="myForm" method="post" action="#">
                                <!-- <a id="proceed_dataset" class="btn green" data-dismiss="modal" href="">Proceed</a> -->
                                <input id="hidden_input" type="hidden" name="project_id" value="">
                                <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Close</button>
                                <button id="proceed_datafile" class="btn green" >Proceed</button>
                              </form>
                           </div>
                       </div>
                   </div>
               </div>
               <!-- VIEW DATAFILES MODAL END -->

               <!-- VIEW GALLERY MODAL START -->
               <div id="view_gallery_modal" class="modal fade" role="dialog" aria-hidden="true">
                   <div class="modal-dialog">
                       <div class="modal-content">
                           <div class="modal-header">
                               <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                               <h4 class="modal-title">Proceed to Project Gallery </h4>
                           </div>
                           <div class="modal-body">
                               <form action="#" class="form-horizontal">



                                 <div class="form-group">
                                     <label class="control-label col-md-4">Select Project</label>
                                     <div class="col-md-8">
                                         <select id="dropdown_gallery" class="form-control select2">
                                           <?php

                                           $res_gal = $db_conn->query("SELECT title,id FROM tbl_projects WHERE deleted = 0  and u_id='$user_id' ");
                                             while ($row_gal = $res_gal->fetch_assoc()) {
                                               echo "<option  value=".$row_gal['id'].">
                                                     ".$row_gal['title']."
                                                     </option>";
                                             }
                                            ?>

                                         </select>
                                     </div>
                                 </div>





                                                               </form>
                                      </div>
                                      <div class="modal-footer">
                                         <form id="myForm" method="post" action="#">
                                           <!-- <a id="proceed_dataset" class="btn green" data-dismiss="modal" href="">Proceed</a> -->
                                           <input id="hidden_input" type="hidden" name="project_id" value="">
                                           <button class="btn dark btn-outline" data-dismiss="modal" aria-hidden="true">Close</button>
                                           <button id="proceed_gallery" class="btn green" >Proceed</button>
                                         </form>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- VIEW GALLERY MODAL END -->

  </div>
    <!-- END FOOTER -->


    <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<script src="../assets/global/plugins/ie8.fix.min.js"></script>
<![endif]-->
    <!-- BEGIN CORE PLUGINS -->

    <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/moment.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>


        <script src="../assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.mockjax.js" type="text/javascript"></script>

        <script src="../assets/global/plugins/bootstrap-typeahead/bootstrap3-typeahead.min.js" type="text/javascript"></script>

    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- <script src="../assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
            <script src="../assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script> -->


    <!-- form validation -->
    <script src="../assets/global/plugins/jquery-validation/js/jquery.validate.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-validation/js/additional-methods.js" type="text/javascript"></script>
    <!-- <script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script> -->
    <script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>

    <!-- <script src="../assets/global/plugins/dropzone/dropzone.js" type="text/javascript"></script> -->




    <!--file input  -->
    <script src="../assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

    <!-- select2  -->
    <!-- <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script> -->




    <script src="../assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>

    <!--ck editor  -->
    <script src="../assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>

    <script src="../assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- tags input -->
     <script src="../assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/progressBar.js" type="text/javascript"></script>



    <!-- data table editable -->
    <script src="../assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
    <script src="../assets/pages/scripts/table-datatables-editable.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/bootstrap-table/bootstrap-table.js" type="text/javascript"></script>
    <script src="../assets/pages/scripts/table-datatables-rowreorder.js" type="text/javascript"></script>





    <script src="../assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>


    <!-- data table editable end -->
    <!--BEGIN TOGGLE  -->

    <!-- <script src="bootstrap-toggle-master/js/bootstrap-toggle.js" type="text/javascript"></script> -->


    <!--END TOGGLE  -->
    <!-- tags input -->


    <!-- modal begin -->
    <!-- <script src="../assets/pages/scripts/ui-modals.min.js" type="text/javascript"></script> -->
    <script src="../assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <!-- modal end  -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->




    <script src="../assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>
    <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

    <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="../node_modules/chart.js/dist/Chart.js"></script>

    <script src="../assets/pages/scripts/components-multi-select.min.js" type="text/javascript"></script>

    <script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>

    <!-- <script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script> -->
    <script src="../assets/pages/scripts/daterangepicker.js" type="text/javascript"></script>

<!-- COMMENTED TO FIX FOOTER -->
    <!-- <script src="../assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
    <script src="../assets/pages/scripts/form-dropzone.js" type="text/javascript"></script> -->
    <!-- <script src="../fc-projects/includes/declarativeToggle.js" type="text/javascript"></script> -->

    <!-- ENCRYPTION STUFF -->


    <!-- <script src="../assets/pages/scripts/maps-google.min.js" type="text/javascript"></script> -->


    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <!-- <script src="../assets/pages/scripts/ui-sweetalert.js" type="text/javascript"></script> -->

    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="../assets/layouts/layout2/scripts/layout.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/layout2/scripts/demo.min.js" type="text/javascript"></script>
    <!--form validation -->

    <script src="../assets/pages/scripts/form-validation-md.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>

    <!-- <script src="../assets/pages/scripts/components-bootstrap-tagsinput.min.js" type="text/javascript"></script> -->

    <script src="../assets/pages/scripts/form-editable.min.js" type="text/javascript"></script>


    <!-- END THEME LAYOUT SCRIPTS -->
    <script>
    $(document).on("click", ".btn-accept", function () {
     // var myId = this.parentElement.children[0];
     // $(".modal-body #p_id").val( myId );
     console.log(this.parentElement);
     $( ".hide-invite" ).css( "display","none" );

     <?php require 'dbConnect.php' ;
     $query="DELETE FROM tbl_requests WHERE request_id = 5";
     $db_conn->query($query);

     ?>


     // As pointed out in comments,
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
    });



    $(document).on("click", '.btn-accept', function(event) {
      console.log(this.children[0].value,this.children[1].value);
      $.ajax({
        url: '../fc-user/includes/acceptInvitation.php',
        method: 'POST',
        // dataType:"text",
        data: {p_id:this.children[0].value,r_id:this.children[1].value},
        success: function(data){
          if (data != ''){
          $(".top-menu ").load( String(window.location.href) +" .top-menu",
              function () {
                console.log("invite accepted!", data);
              });
          }
        }
      });
    });
// INSERT INTO `tbl_requests`(`project_id`, `receiver_id`, `sender_id`) VALUES (25,24,47)

    $(document).on("click", '.btn-decline', function(event) {
      console.log(this.children[0].value);
      console.log(window.location.href);
      $.ajax({
        url: '../fc-user/includes/declineInvitation.php',
        method: 'POST',
        // dataType:"text",
        data: {r_id:this.children[0].value,load:true},
        success: function(data){
          if (data != ''){
          $(".top-menu ").load(String(window.location.href)+ " .top-menu",
              function () {
                console.log("invite declined!", data);
              });
          }
        }
      });
    });

    $(document).on("click", '#proceed_datafile', function(event) {
      // $("#view_dfs_modal").addClass("active");
      event.preventDefault();
      var proceed_df = $('#dropdown_datafile :selected').val();
      if (proceed_df){
        window.location = "http://136.145.54.38/~catec/firecollect_ts/backend/fc-projects/datafiles.php?id="+String(proceed_df);

      }
      else{alert("select an associated dataset");}

    });

    $(document).on("click", '#proceed_gallery', function(event) {
      // $("#view_dfs_modal").addClass("active");
      event.preventDefault();
      var proceed_gallery = $('#dropdown_gallery :selected').val();
      if (proceed_gallery){
        window.location = "http://136.145.54.38/~catec/firecollect_ts/backend/fc-projects/image_gallery.php?id="+String(proceed_gallery);

      }
      else{alert("select an associated project");}

    });

    // $("#view_dfs_modal")



    </script>




</body>

</html>
