<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';


  $user_id = $_SESSION["user_id"];
  // $project_id = $_SESSION['current_project_id'];
  if (isset($_GET['id'])){
    $project_id = $_GET['id'];
    $_SESSION['current_project_id']=$project_id;
  }
  else {

    $project_id=$_SESSION['current_project_id'];
  }


  $path = $db_conn->query("SELECT * FROM tbl_projects WHERE id='$project_id'");
  $path = $path->fetch_assoc() ;


  function human_filesize($bytes, $decimals = 2) {
      $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
      $factor = floor((strlen($bytes) - 1) / 3);
      return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
  }

?>

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <div class='before_portlet'>

                    <div class=' mobile_hide' style='margin-bottom:25px;'>
                      <a id='back' class='icon-btn' onclick='window.history.back();'>
                        <i class='fa fa-arrow-left'></i>
                        <div> Back </div>
                      </a>
                    </div>
                    <!-- Path Start -->
                    <div class="page-bar">
                       <ul class="page-breadcrumb">
                           <li>
                               <?php echo "<a class='text firecollect'>".$path['title']."</a>" ; ?>

                           </li>

                       </ul>
                   </div>
                   <!-- Path End -->
                  </div>




                    <!-- END PAGE HEADER-->
                    <!-- BEGIN  PORTLET-->



                    <div class="portlet light portlet-fit ">
                                                    <div class="portlet-title">
                                                        <div class="caption" >

                                                            <span class="title firecollect">Image Gallery</span>
                                                        </div>

                                                        <button class="btn btn-primary pull-right select_img" >select</button>
                                                        <span class= "btn green  pull-right upload_btn">upload</span>

                                                    </div>

                                                    <div  class="portlet-body gallery_container" >

                                                      <form action="includes/upload_dropzone.php" class="dropzone dropzone-file-area" id="my-dropzone" style="width: auto; margin: 50px;" method="post" enctype="multipart/form-data">

                                                        <!-- <div class="fallback">
                                                          <input name="file" type="file" multiple />
                                                        </div> -->

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

                                                $file_size=  human_filesize($file_size);







                                              echo "<div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>
                                                      <div class='contain_img'>
                                                      <div data-toggle='modal' href='#modal_img$i' >
                                                          <img id='img$i' class='gallery' style='' name = $file_name src='uploads/$project_id/img/$file_name' />
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




                                                echo  "    <div class='modal fade modal_tag' id='modal_img$i' tabindex='-1' role='dialog' aria-hidden='true' >
                                                                                  <div class='modal-dialog modal-lg'>
                                                                                      <div class='modal-content'>
                                                                                          <div class='modal-header'>
                                                                                              <button type='button' class='close close_modal' data-dismiss='modal' aria-hidden='true'></button>
                                                                                              <div class='next_modal btn btn-default  pull-right'  style='margin-right:3%;'><span class='glyphicon glyphicon-chevron-right'> </span></div>
                                                                                              <div class='prev_modal btn btn-default pull-right' ><span class='glyphicon glyphicon-chevron-left'> </span></div>
                                                                                              <h4 class='modal-title font-red'  ><span class='fa fa-image font-red'> </span> Image</h4>
                                                                                          </div>
                                                                                          <div class='modal-body' style='position:relative;'>
                                                                                            <!--BEGIN FORMS  -->
                                                                                            <div class='portlet-body form'>
                                                                                              <form role='form' method='POST' action='includes/upload_image.php' enctype='multipart/form-data'>
                                                                                                <div class='form-body'>

                                                                                                <div class='row'>


                                                                                                    <div class='col-md-7'>
                                                                                                        <img src='uploads/$project_id/img/$file_name' style='height:100%;width:100%'/>


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
                    include '../includes/footer.php' ;
                    ?>
                    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
                    <script src="../assets/global/plugins/dropzone/dropzone.js" type="text/javascript"></script>
                    <script src="../assets/global/plugins/imgCheckbox/jquery.imgcheckbox.js" type="text/javascript"></script>

                    <script>
                    // $(document).on('mouseenter', '.modal-body', function(event) {
                    //     //do something
                    //     $(".prev_modal").css("display", "block");
                    //     $(".next_modal").css("display", "block");
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
                        var where = $(this).closest(".modal_tag").attr('id');
                        console.log("whereid",where);
                        var old_id= String(where);
                        old_id =  old_id.substr(9);
                        var new_id = parseInt(old_id);
                        // where.id="modal_img"+((num+1)%total_modals);
                        console.log("old id",old_id);
                        new_id = (new_id + 1)% total_modals;
                        new_id= String(new_id);
                        console.log("new  id",new_id);
                        // va
                        // console.log("old div", where);
                        // where.id= "modal_img"+(new_id);
                        new_id= "modal_img"+(new_id);
                        console.log("new where id ",new_id);
                        console.log("new div", where);

                        $("#modal_img"+ old_id).removeClass("in");
                        console.log("oldID","#modal_img"+ old_id);
                        $("#"+ String(new_id)).addClass("in");
                        $("#modal_img"+ String(old_id)).css("display","none");
                        $("#"+ String(new_id)).css("display","block");
                        console.log("where","#"+ String(old_id));
                    });

                    $(document).on("click", '.prev_modal', function(event) {

                      var where = $(this).closest(".modal_tag").attr('id');

                      console.log("whereid",where);
                      var old_id= String(where);
                      old_id =  old_id.substr(9);
                      var new_id = parseInt(old_id);
                      // where.id="modal_img"+((num+1)%total_modals);
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
                      // where.id= "modal_img"+(new_id);
                      new_id= "modal_img"+(new_id);
                      console.log("new where id ",new_id);
                      console.log("new div", where);

                      $("#modal_img"+ old_id).removeClass("in");
                      console.log("oldID","#modal_img"+ old_id);
                      $("#"+ String(new_id)).addClass("in");
                      $("#modal_img"+ String(old_id)).css("display","none");
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
                  if ($(" .fade").hasClass("in")){
                  if (!$(event.target).closest(".modal-content").length) {
                  $(".fade").removeClass("in ");
                  $(document.body).removeClass("modal-open");
                  $(".modal").css({"display":"none"});
                  $("div").removeClass("modal-backdrop ");
                  // console.log(this);
                  }
                  }
                  });



                    // select flag
                    var select_flag = 0;
                    // select/deselect all flag
                    var select_all_flag = 0 ;
                    $(document).on("click", '.select_img', function(event) {

                    // $(".select_img").click(function(){
                      select_flag = (select_flag + 1) % 2;
                      console.log("select_flag",select_flag);
                      // if select btn is pressed
                      if (select_flag==1){
                        $(".contain_img span").removeClass("imgChked");
                        $(".portlet-title").append(" <button class='btn btn-default pull-right delete_img ' >delete</button>  <button class='btn btn-default pull-right select_all' >select all</button>");
                        // <button class='btn btn-default pull-right move_img ' >move</button> pa despues
                        $(".contain_img div img").addClass("imgcheck ");
                        $(".contain_img div img").removeClass("gallery");
                        $(".contain_img div").removeAttr("data-toggle");
                        this.innerHTML = "Done";
                        // this.parentElement.children[1].innerHTML="upload";
                        console.log(this.parentElement.children[1].innerHTML);
                        upload_flag =1;
                        $(".dropzone").css("display","none");

                        $('.upload_btn').remove()


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
                        $(".portlet-title").append("<span class= 'btn green  pull-right upload_btn'>upload</span>")


                        $(".contain_img div img").removeClass("imgcheck ");
                        $(".contain_img div img").addClass("gallery ");
                        // $(".contain_img div img").css("opacity","0.7");
                        $(".contain_img div").attr("data-toggle", "modal");
                        $(".contain_img span").removeClass();

                      }
                     });


                      // console.log(($(".contain_img img").length));
                      // if (($(".imgChked").length )== ($(".contain_img img").length)) {
                      //   $(".select_all").html("<button class='btn btn-default pull-right select_all' >deselect all</button>");
                      // }else {
                      //   $(".select_all").html("<button class='btn btn-default pull-right select_all' >select all</button>");
                      //
                      // }
                      $(document).on("click", '.embed', function(event) {
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

                      // $(".contain_img").click(function () {
                      //    if (($(".imgChked").length )== ($(".contain_img img").length)) {
                      //      select_all_flag =1;
                      //      // $(".select_all").empty();
                      //     $(".select_all").text("deselect all");
                      //   }else {
                      //     select_all_flag=0;
                      //     // $(".select_all").empty();
                      //
                      //     $(".select_all").text("select all");
                      //
                      //   }
                      // });
                      $(document).on("click", '.select_all', function(event) {

                      // $(".select_all").click(function(){
                      // If no images are in the gallery
                      if ($(".contain_img").length==0){
                        alert("No image(s) available");

                      }
                      // if the gallery has any images
                      else{

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
                      }




                      });



                      $(document).on("click", '.delete_img', function(event) {

                      // $(".delete_img").click(function () {
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
                            data: {file_name:this.children[0].name,type:'img'},
                            success: function(data){
                              if (data != ''){
                              $(".mt-element-card ").load(String(window.location.href)+" .mt-element-card",
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
                                    $("img").removeClass("gallery");
                                    // $(".delete_img").addClass("disabled");
                                    // $(".move_img").addClass("disabled");
                                    select_all_flag=0;
                                    $(".select_all").text("select all");
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




                    </script>
