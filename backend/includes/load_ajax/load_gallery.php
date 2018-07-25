<?php
  require '../dbConnect.php' ;
  include '../topMenu.php';
  include '../sideBar.php';


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
                                                      <span class= "btn green toggle-slide">upload</span>

                                                      <form action="includes/upload_dropzone.php" class="dropzone dropzone-file-area" id="my-dropzone" style="width: auto; margin: 50px;" method="post" enctype="multipart/form-data">

                                                        <!-- <div class="fallback">
                                                          <input name="file" type="file" multiple />
                                                        </div> -->
                                                          <h3 class="sbold">Drop files here or click to upload</h3>

                                                          <p> This is just a demo dropzone. Selected files are not actually uploaded. </p>
                                                          <!-- <div class="text-center">
                                                            <input class='btn default ' name="file" type="file" multiple />

                                                          </div> -->

                                                      </form>
                                                      <!-- <div class="row"> -->
                                                          <!-- <div class="text-center  ">
                                                            <button class="btn btn-lg btn-warning dropzone_upload " >Upload</button>

                                                          </div> -->
                                                      <!-- </div> -->
<div class="mt-element-card mt-element-overlay" style="margin-top:20px;">
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
                                                          <img id='img$i' class='imgcheck' style='height:188px;width:281px;' name = $file_name src='../../fc-projects/includes/uploads/$project_id/$file_name' />
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
                                                                                                        <img src='../../fc-projects/includes/uploads/$project_id/$file_name'  style='height:100%;width:100%'/>
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
                    include '../footer.php' ;
                    ?>
                    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
                    <script src="../../assets/global/plugins/imgCheckbox/jquery.imgcheckbox.js" type="text/javascript"></script>

                    <script>
                    $(".contain_img div img").imgCheckbox();
                    $(".contain_img span").removeClass();
                    $(".contain_img span").addClass("imgCheckbox0");
                    $(".contain_img div").removeAttr("data-toggle");


                    // $(document).ready(function(){
                    var w =1;
                      $(".toggle-slide").click(function(){
                        w = (w+1)%2;
                        if (w ==1){
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

                    $(document).on("click", '.next_modal', function(event) {
                        alert("new link clicked!");
                        var where= this.parentElement.parentElement.parentElement.parentElement.
                        parentElement.parentElement.parentElement.parentElement.parentElement;
                        console.log("whereid",where.id);
                        var old_id= String(where.id);
                        old_id =  old_id.substr(9,10);
                        var new_id = parseInt(old_id);
                        // where.id="modal_img".concat((num+1)%total_modals);
                        console.log("old id",old_id);
                        new_id = (new_id + 1)% total_modals;
                        new_id= String(new_id);
                        console.log("new  id",new_id);
                        // va
                        // console.log("old div", where);
                        // where.id= "modal_img".concat(new_id);
                        new_id= "modal_img".concat(new_id);
                        console.log("new where id ",new_id);
                        console.log("new div", where);

                        $("#modal_img"+ old_id).removeClass("in");
                        console.log("oldID","#modal_img"+ old_id);
                        $("#"+ String(new_id)).addClass("in");
                        $("#modal_img"+ String(old_id)).css("display","none");
                        $("#"+ String(new_id)).css("display","block");
                        console.log("where","#"+ String(old_id));
                    });

                    $(document).on("click", '.next_modal', function(event) {

                      var where= this.parentElement.parentElement.parentElement.parentElement.
                      parentElement.parentElement.parentElement.parentElement.parentElement;
                      console.log("whereid",where.id);
                      var old_id= String(where.id);
                      old_id =  old_id.substr(9,10);
                      var new_id = parseInt(old_id);
                      // where.id="modal_img".concat((num+1)%total_modals);
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
                      // where.id= "modal_img".concat(new_id);
                      new_id= "modal_img".concat(new_id);
                      console.log("new where id ",new_id);
                      console.log("new div", where);

                      $("#modal_img"+ old_id).removeClass("in");
                      console.log("oldID","#modal_img"+ old_id);
                      $("#"+ String(new_id)).addClass("in");
                      $("#modal_img"+ String(old_id)).css("display","none");
                      $("#"+ String(new_id)).css("display","block");
                      console.log("where","#"+ String(old_id));


});
                    // $(".next_modal").click(function(){
                    //       var where= this.parentElement.parentElement.parentElement.parentElement.
                    //       parentElement.parentElement.parentElement.parentElement.parentElement;
                    //       console.log("whereid",where.id);
                    //       var old_id= String(where.id);
                    //       old_id =  old_id.substr(9,10);
                    //       var new_id = parseInt(old_id);
                    //       // where.id="modal_img".concat((num+1)%total_modals);
                    //       console.log("old id",old_id);
                    //       new_id = (new_id + 1)% total_modals;
                    //       new_id= String(new_id);
                    //       console.log("new  id",new_id);
                    //       // va
                    //       // console.log("old div", where);
                    //       // where.id= "modal_img".concat(new_id);
                    //       new_id= "modal_img".concat(new_id);
                    //       console.log("new where id ",new_id);
                    //       console.log("new div", where);
                    //
                    //       $("#modal_img"+ old_id).removeClass("in");
                    //       console.log("oldID","#modal_img"+ old_id);
                    //       $("#"+ String(new_id)).addClass("in");
                    //       $("#modal_img"+ String(old_id)).css("display","none");
                    //       $("#"+ String(new_id)).css("display","block");
                    //       console.log("where","#"+ String(old_id));
                    //
                    //
                    //
                    // });


                    //
                    // $(".prev_modal").click(function(){
                    //       var where= this.parentElement.parentElement.parentElement.parentElement.
                    //       parentElement.parentElement.parentElement.parentElement.parentElement;
                    //       console.log("whereid",where.id);
                    //       var old_id= String(where.id);
                    //       old_id =  old_id.substr(9,10);
                    //       var new_id = parseInt(old_id);
                    //       // where.id="modal_img".concat((num+1)%total_modals);
                    //       console.log("old id",old_id);
                    //       if (new_id == 0){
                    //         new_id=total_modals-1;
                    //         console.log("after if id",new_id);
                    //       }else{
                    //         new_id = (new_id - 1)% total_modals;
                    //
                    //       }
                    //       new_id= String(new_id);
                    //       console.log("new  id",new_id);
                    //       // va
                    //       // console.log("old div", where);
                    //       // where.id= "modal_img".concat(new_id);
                    //       new_id= "modal_img".concat(new_id);
                    //       console.log("new where id ",new_id);
                    //       console.log("new div", where);
                    //
                    //       $("#modal_img"+ old_id).removeClass("in");
                    //       console.log("oldID","#modal_img"+ old_id);
                    //       $("#"+ String(new_id)).addClass("in");
                    //       $("#modal_img"+ String(old_id)).css("display","none");
                    //       $("#"+ String(new_id)).css("display","block");
                    //       console.log("where","#"+ String(old_id));
                    //
                    // });

                    $(".close_modal").click(function(){
                      $("div").removeClass("modal-backdrop fade in");
                      $(document.body).removeClass("modal-open");
                      console.log(document.body);
                      $(".modal").css({
                        // "transition": "all 2s",
                        // "opacity":"0.",

                        "display":"none"


                      });



                      // $("modal fade").removeClass("in");


                    //
                      // for (var i = 0; i < total_modals.length; i++) {
                      //   $("#modal_img"+ String(i)).removeClass("in");
                      //   $("#modal_img"+ String(i)).css("display","none");
                      //   // document.body.removeClass("modal-open");
                      //
                      // console.log("THIS",this);                    }
                    //
                    });

                    // use imagCheckBox plugin


                    // select flag
                    var select_flag = 0;
                    // select/deselect all flag
                    var select_all_flag = 0 ;
                    $(".select_img").click(function(){
                      select_flag = (select_flag + 1) % 2;
                      console.log("select_flag",select_flag);
                      // if select btn is pressed
                      if (select_flag==1){
                        $(".contain_img span").removeClass("imgChked");
                        $(".portlet-title").append(" <button class='btn btn-default pull-right delete_img ' >delete</button> <button class='btn btn-default pull-right move_img ' >move</button> <button class='btn btn-default pull-right select_all' >select all</button>");

                        $(".contain_img div img").addClass("imgcheck ");
                        $(".contain_img div img").removeClass("gallery");
                        $(".contain_img div").removeAttr("data-toggle");
                        this.innerHTML = "Done";
                        // $(".portlet-body").load(location.href + " .portlet-body");
                        // console.log(location.href);
                        // if the span exists and imgCheckbox has already been activated
                        if ($(".contain_img span").length >1){
                          // add class
                          $(".contain_img span").removeClass();
                          $(".contain_img span").addClass("imgCheckbox0");

                        }else  {
                          // activate imgcheckbox plugin
                          $(".contain_img div img").imgCheckbox();
                        }



                      }
                      // j !=1
                      else {
                        this.innerHTML = "Select";
                        $(".select_all").remove();
                        $(".delete_img").remove();
                        $(".move_img").remove();

                        $(".contain_img div img").removeClass("imgcheck ");
                        $(".contain_img div img").addClass("gallery ");
                        // $(".contain_img div img").css("opacity","0.7");
                        $(".contain_img div").attr("data-toggle", "modal");
                        $(".contain_img span").removeClass();

                      }

                      // console.log(($(".contain_img img").length));
                      // if (($(".imgChked").length )== ($(".contain_img img").length)) {
                      //   $(".select_all").html("<button class='btn btn-default pull-right select_all' >deselect all</button>");
                      // }else {
                      //   $(".select_all").html("<button class='btn btn-default pull-right select_all' >select all</button>");
                      //
                      // }

                      $(".contain_img").click(function () {
                         if (($(".imgChked").length )== ($(".contain_img img").length)) {
                           select_all_flag =1;
                           // $(".select_all").empty();
                          $(".select_all").text("deselect all");
                        }else {
                          select_all_flag=0;
                          // $(".select_all").empty();

                          $(".select_all").text("select all");

                        }
                      });

                      $(".select_all").click(function(){
                        select_all_flag = (select_all_flag + 1) % 2;
                        if (select_all_flag == 1){
                          $(".contain_img span").addClass("imgChked");
                          this.innerHTML='deselect all';
                          // $(".delete_img").removeClass("disabled");
                          // $(".move_img").removeClass("disabled");

                        }else {
                          $(".contain_img span").removeClass("imgChked");
                          this.innerHTML='select all';
                          // $(".delete_img").addClass("disabled");
                          // $(".move_img").addClass("disabled");

                        }



                      });



                      // disable/enable delete button after img click
                      // $(".contain_img").click(function(){
                      //   if ($(".contain_img span").hasClass("imgChked")){
                      //     // $(".delete_img").removeClass("disabled");
                      //     // $(".move_img").removeClass("disabled");
                      //   }
                      //   else {
                      //     // $(".delete_img").addClass("disabled");
                      //     // $(".move_img").addClass("disabled");
                      //
                      //   }
                      //
                      //
                      // });

                      $(".delete_img").click(function () {
                        if ($(".contain_img span").hasClass("imgChked")==false){
                          alert("No image(s) selected")
                        }
                        else {
                          var result = confirm("Are you sure?")
                        }
                        console.log("hey");
                        if (result == 1){
                          $(".imgChked").each(function () {
                          console.log(this.children[0].name);
                          $.ajax({
                            url: 'includes/delete_dropzone_file.php',
                            method: 'POST',
                            // dataType:"text",
                            data: {file_name:this.children[0].name,load:true},
                            success: function(data){
                              if (data != ''){
                              $(".mt-element-card ").load("load_gallery.php .mt-element-card",
                                  function () {
                                    console.log("image deleted!", data);
                                    // var count_img = 0;
                                    // $(".contain_img").each(function () {
                                    //   count_img= count_img+1;
                                    //   }
                                    //   console.log("count_img",count_img);
                                    total_modals = $(".contain_img img").length;
                                    console.log("images",total_modals);
                                    $(".contain_img div img").imgCheckbox();
                                    $(".contain_img div").removeAttr("data-toggle");
                                    // $(".delete_img").addClass("disabled");
                                    // $(".move_img").addClass("disabled");

                                    console.log("select_flag",select_flag);
                                  });

                              }

                            }
                            // dataType: dataType
                          });

                        });
                        // select_flag=1;

                      }//if end


                      });


                    });








////////////////////////////////////////////////////////////////////////////////////////////////////////////
// BACKUP script
//
// var select_flag = 0;
// // select/deselect all flag
// var k = 0 ;
// $(".select_img").click(function(){
//   select_flag = (select_flag + 1) % 2;
//   console.log("select_flag",select_flag);
//   // if select btn is pressed
//   if (select_flag==1){
//     $(".contain_img span").removeClass("imgChked");
//     $(".portlet-title").append(" <button class='btn btn-default pull-right delete_img disabled' >delete</button> <button class='btn btn-default pull-right move_img disabled' >move</button> <button class='btn btn-default pull-right select_all' >select all</button>");
//
//     $(".contain_img div img").addClass("imgcheck ");
//     $(".contain_img div img").removeClass("gallery");
//     $(".contain_img div").removeAttr("data-toggle");
//     this.innerHTML = "Done";
//     // $(".portlet-body").load(location.href + " .portlet-body");
//     // console.log(location.href);
//     // if the span exists and imgCheckbox has already been activated
//     if ($(".contain_img span").length >1){
//       // add class
//       $(".contain_img span").addClass("imgCheckbox0");
//
//     }else  {
//       // activate imgcheckbox plugin
//       $(".contain_img div img").imgCheckbox();
//     }
//
//
//
//   }
//   // select_flag !=1
//   else {
//     this.innerHTML = "Select";
//     $(".select_all").remove();
//     $(".delete_img").remove();
//     $(".move_img").remove();
//
//     $(".contain_img div img").removeClass("imgcheck ");
//     $(".contain_img div img").addClass("gallery ");
//     // $(".contain_img div img").css("opacity","0.7");
//     $(".contain_img div").attr("data-toggle", "modal");
//     $(".contain_img span").removeClass("imgCheckbox0 imgChked ");
//
//   }
//
//
//   $(".select_all").click(function(){
//     k = (k + 1) % 2;
//     if (k == 1){
//       $(".imgCheckbox0").addClass("imgChked");
//       this.innerHTML='deselect all';
//       $(".delete_img").removeClass("disabled");
//       $(".move_img").removeClass("disabled");
//
//     }else {
//       $(".imgCheckbox0").removeClass("imgChked");
//       this.innerHTML='select all';
//       $(".delete_img").addClass("disabled");
//       $(".move_img").addClass("disabled");
//
//     }
//
//
//
//   });
//
//   // disable/enable delete button after img click
//   $(".contain_img").click(function(){
//     if ($(".imgCheckbox0").hasClass("imgChked")){
//       $(".delete_img").removeClass("disabled");
//       $(".move_img").removeClass("disabled");
//     }
//     else {
//       $(".delete_img").addClass("disabled");
//       $(".move_img").addClass("disabled");
//
//     }
//
//
//   });
//
//   $(".delete_img").click(function () {
//     var result = confirm("Are you sure?")
//     console.log("hey");
//     if (result == 1){
//       $(".imgChked").each(function () {
//       console.log(this.children[0].name);
//       $.ajax({
//         url: 'includes/delete_dropzone_file.php',
//         method: 'POST',
//         // dataType:"text",
//         data: {file_name:this.children[0].name,load:true},
//         success: function(data){
//           if (data != ''){
//           $(".mt-element-card ").load("load_gallery.php .mt-element-card",
//               function () {
//                 console.log("image deleted!", data);
//                 // var count_img = 0;
//                 // $(".contain_img").each(function () {
//                 //   count_img= count_img+1;
//                 //   }
//                 //   console.log("count_img",count_img);
//                 total_modals = $(".contain_img img").length;
//                 console.log("images",total_modals);
//                 $(".contain_img div img").imgCheckbox();
//                 $(".contain_img div").removeAttr("data-toggle");
//                 $(".delete_img").addClass("disabled");
//                 $(".move_img").addClass("disabled");
//
//                 console.log("j",j);
//               });
//           //
//           // $.get('includes/load_gallery.php', function(result){
//           //     $result = $(result);
//           //     $(".mt-element-card").empty();
//           //     $result.find('.mt-element-card').appendTo('.mt-element-card');
//           //     // $result.find('script').appendTo('#new_content');
//           // }, 'html');
//           }
//
//         }
//         // dataType: dataType
//       });
//
//     });
//     j=1;
//   }//if end
//
//
//   });
//
//   // if ($(".imgCheckbox0").hasClass("imgChked")){
//   //     $(".delete_img").removeClass("disabled");
//   // }
//   // else {
//   //   $(".delete_img").addClass("disabled");
//   //
//   // }
//
// });






                    </script>
