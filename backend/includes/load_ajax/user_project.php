<?php
  require '../dbConnect.php' ;
  include '../topMenu.php';
  include '../sideBar.php';


  $user_id = $_SESSION["user_id"];
  // $project_id = $_GET['id'];
  $project_id=$_SESSION['current_project_id'];
  $query= "SELECT * FROM tbl_projects where id ='$project_id'";

  $result = $db_conn->query($query);

  // $row = $result->fetch_assoc();
  // echo $row['status'];

  $row = $result->fetch_assoc();



    # code...
    $id = $row['id'];
    $owner_id = $row['u_id'];
    $project_title= $row['title'];
    $short_name = $row['short_name'];
    $description = $row['description'];
    $contact_name = $row['contact_name'];
    $contact_email = $row['contact_email'];
    $sponsor = $row['sponsor'];
    $status = $row['status'];
    $research_area = $row['research_area'];
    $start_date= $row['starting_date'];
    $end_date= $row['end_date'];


    $query2= "SELECT * FROM tbl_user_info WHERE u_id='$user_id'";
    $result = $db_conn->query($query2);
    $row = $result->fetch_assoc();
    $full_name= $row['f_name'].' '.$row['l_name'];

// retrieve markers from database
    $markers = array();
    $query= "SELECT * FROM tbl_map where project_id ='$project_id'";
    $result = $db_conn->query($query);

    $i=0;

    if($user_id != $owner_id)
    {
      $permissionQuery = "SELECT * from tbl_collaborators where user_id = '$user_id' and p_id = '$project_id'";
      $perm = $db_conn->query($permissionQuery) ;
      $perm = $perm->fetch_assoc() ;
    }


    while ($row = $result->fetch_assoc() ) {
      $location= $row['location'];
      $latitude= $row['latitude'];
      $longitude=$row['longitude'];
      $marker_description= $row['description'];

      $markers[$i]=array();
      array_push($markers[$i],$location,$latitude,$longitude,$marker_description);
      $i= $i + 1 ;

    }
    $locations = json_encode($markers);


?>

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                  <div class="row">
                    <!-- <div class="col-md-12"> -->
                    <!-- BEGIN PAGE HEADER-->



                    <!-- END PAGE HEADER-->
                    <!-- BEGIN  PORTLET-->

                    <?php echo "


                    <div class ='before_portlet'>
                    <div class='mobile_hide' style='margin-bottom:25px;margin-left:15px;'>

                    <a href='image_gallery.php' class=' icon-btn  '>
                      <i class='fa fa-eye'></i>
                      <div> View/Add Images </div>
                    </a>" ;


                    if($user_id == $owner_id or $perm['edit_id'] == 1)
                    {
                      echo "<a href='edit.php?id=$id' class=' icon-btn '>
                       <i class='fa fa-edit'></i>
                       <div> Edit Project  </div>

                       </a>";
                    }

                    if($user_id == $owner_id)
                    {
                      echo "<a href='copy_project.php' class=' icon-btn  '>
                       <i class='fa fa-clone'></i>
                       <div> Copy Project </div>
                      </a>

                      <a href='' class=' icon-btn  '>
                        <i class='fa fa-trash'></i>
                        <div> Delete Project </div>
                      </a>

                      <a href='#basic' class=' icon-btn' data-toggle='modal' >
                        <i class='fa fa-user-plus'></i>
                        <div> Invite User </div>
                      </a>

                      <a href='projectSettings.php?project=".$id."' class=' icon-btn  '>
                        <i class='fa fa-gear'></i>
                        <div> Permissions </div>
                      </a>" ;
                    }

                    if($user_id == $owner_id or $perm['add_data_set'] == 1)
                    {
                      echo "<a href='add_data_set.php?id=$id' class=' icon-btn '>
                            <i class='fa fa-database'></i>
                            <div> Add Data Set </div>
                            </a>" ;
                    }




                    if($user_id == $owner_id or $perm['edit_project'] == 1)
                    {
                     echo "<a href='add_location.php' class=' icon-btn'>
                           <i class='fa fa-map-marker'></i>
                           <div>Add Location </div>
                           </a>" ;
                    }
                    echo "
                          </div>
                          <div class='mobile_menu' style='margin-right:15px;'>
                          <div class='btn-group'>
                                                                <button class='btn dark btn-lg dropdown-toggle pull-right' type='button' data-toggle='dropdown'> Actions
                                                                    <i class='fa fa-angle-down'></i>
                                                                </button>
                                                                <ul class='dropdown-menu' role='menu'>
                                                                    <li>
                                                                        <a href='image_gallery.php'> View/Add Images </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href='edit.php?id=$id'> Edit Project </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href='copy_project.php'> Copy Project </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href='javascript:;'> Delete Project </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href='#basic' data-toggle='modal'> Invite User </a>
                                                                    </li>


                                                                    <li>
                                                                        <a href='add_data_set.php?id=$id'> Add Data Set </a>
                                                                    </li>


                                                                    <li>
                                                                        <a href='add_location.php'> Add Location </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            </div>
</div>
";


?>
<!-- <div class="row"> -->

                  <div class="col-md-4  ">
                    <div class="portlet light portlet-fit ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <i class="icon-fire font-red"></i>
                                                            <span class="caption-subject font-red sbold ">Project Information</span>
                                                        </div>

                                                    </div>

                                                    <div class="portlet-body">
                                                      <!--BEGIN PORTLET BODY  -->



                                                          <!-- <div class='row'> -->
                                                            <!-- <div class='col-md-5'> -->


                                                              <?php
                                                                echo "
                                                              <h4 style='margin-bottom:20px;' class= 'caption-subject font-red-thunderbird sbold '>Title:<p class=' font-grey-gallery' style='padding-left:10px;'>$project_title</p></h4>
                                                              <h4 style='margin-bottom:20px;' class= 'caption-subject font-red-thunderbird sbold '>Principal Investigator:<p class=' font-grey-gallery' style='padding-left:10px;'>$full_name</p></h4>
                                                              <h4 style='margin-bottom:20px;' class= 'caption-subject font-red-thunderbird sbold '>Short Name:<p class=' font-grey-gallery' style='padding-left:10px;'>$short_name</p></h4>
                                                              <h4 style='margin-bottom:20px;' class= 'caption-subject font-red-thunderbird sbold '>Contact Name:<p class=' font-grey-gallery' style='padding-left:10px;'>$contact_name</p></h4>
                                                              <h4 style='margin-bottom:20px;' class= 'caption-subject font-red-thunderbird sbold '>Contact Email:<p class=' font-grey-gallery' style='padding-left:10px;'>$contact_email</p></h4>
                                                              <h4 style='margin-bottom:20px;' class= 'caption-subject font-red-thunderbird sbold '>Sponsor:<p class=' font-grey-gallery' style='padding-left:10px;'>$sponsor</p></h4>";
                                                              if ($status == 0){
                                                              echo"<h4 style='margin-bottom:20px;' class= 'caption-subject font-red-thunderbird sbold '>Status:<p class=' font-grey-gallery' style='padding-left:10px;'>private</p></h4>";
                                                            }else {
                                                              echo"<h4 style='margin-bottom:20px;' class= 'caption-subject font-red-thunderbird sbold '>Status:<p class=' font-grey-gallery' style='padding-left:10px;'>public</p></h4>";
                                                            }
                                                              echo " <h4 style='margin-bottom:20px;' class= 'caption-subject font-red-thunderbird sbold '>Research Area:<p class=' font-grey-gallery' style='padding-left:10px;'>$research_area</p></h4>
                                                              <h4 style='margin-bottom:20px;' class= 'caption-subject font-red-thunderbird sbold '>Start Date:<p class=' font-grey-gallery' style='padding-left:10px;'>$start_date</p></h4>
                                                              <h4 style='margin-bottom:20px;' class= 'caption-subject font-red-thunderbird sbold '>End Date:<p class=' font-grey-gallery' style='padding-left:10px;'>$end_date</p></h4>
                                                              <h4 style='margin-bottom:20px;' class= 'caption-subject font-red-thunderbird sbold '>Description:<p class=' font-grey-gallery' style='padding-left:10px;'>$description</p></h4>

                                                              ";

                                                            ?>







                                                          <!-- </div> -->
                                                          <!-- <div class='col-md-7'>
                                                            <div id='map' style= 'height:400px; width:100%;margin-bottom:20px;'></div>



                                                        </div> -->

                                                      <!-- </div> -->


                                                      <script>


                                                      function initMap(){
                                                        var center = {lat: 18.220833,lng:-66.590149};

                                                        var map = new google.maps.Map(document.getElementById("map"),{
                                                          zoom:9,
                                                           });

                                                          console.log('map',map);
                                                          var fullbounds= new google.maps.LatLngBounds();

                                                          function addMarker(coords,title,myinfowindow){
                                                            var marker = new google.maps.Marker({
                                                              position:coords,
                                                              map: map,
                                                              title: title,
                                                              infowindow: myinfowindow,

                                                              animation: google.maps.Animation.BOUNCE

                                                            });

                                                            fullbounds.extend( marker.getPosition());


                                                            google.maps.event.addListener(marker, 'click', function() {
                                                                    this.infowindow.open(map, this);



                                                            });
                                                            return marker ;

                                                          }



                                                          var locations = <?php echo $locations; ?>;
                                                          console.log("locations",locations);
                                                          for (i = 0; i < locations.length; i++){

                                                              var coords= {lat: Number(locations[i][1]),lng:Number(locations[i][2])};
                                                              var desc  = "<h5><b>" + locations[i][0] + ":</b></h5> <p> " + locations[i][3] + "</p>" ;
                                                              var myinfowindow = new google.maps.InfoWindow({
                                                                  content: desc
                                                              });

                                                              addMarker(coords,locations[i][0],myinfowindow);

                                                          }
                                                          // map.setCenter(fullbounds.getCenter());
                                                          map.fitBounds( fullbounds );

                                                          var listener = google.maps.event.addListener(map, "idle", function() {
                                                            if (locations.length ==1) map.setZoom(9);
                                                            google.maps.event.removeListener(listener);
                                                          });
                                                          // if (locations.length ==1){
                                                          //   console.log("only one marl");
                                                          //   map.
                                                          // }else {
                                                          //
                                                          // }
                                                          console.log(fullbounds);





                                                          // marker.addListener('click',function(){
                                                          //
                                                          //   infoWindow.open(map,marker);
                                                          // });





                                                      }





                                                      </script>



                                                      <!--
                                                      <div class='portlet-title'>
                                                          <div class='caption'>
                                                              <i class=' icon-layers font-blue'></i>
                                                              <span class='caption-subject font-blue bold '>Markers</span>
                                                          </div>
                                                          <div class='actions'>
                                                              <a class='btn btn-circle btn-icon-only btn-default' href='javascript:;'>
                                                                  <i class='icon-cloud-upload'></i>
                                                              </a>
                                                              <a class='btn btn-circle btn-icon-only btn-default' href='javascript:;'>
                                                                  <i class='icon-wrench'></i>
                                                              </a>
                                                              <a class='btn btn-circle btn-icon-only btn-default' href='javascript:;'>
                                                                  <i class='icon-trash'></i>
                                                              </a>
                                                          </div>
                                                      </div>
                                                      <div  class='portlet-body'>
                                                          <div id='gmap_marker' class='gmaps'> </div>
                                                      </div> -->






                                                      <!--END PORTLET BODY  -->

                                                    <!-- <div class="portlet light portlet-fit col-md-6 ">
                                                                                    <div class="portlet-title">
                                                                                        <div class="caption">
                                                                                            <i class="icon-fire font-red"></i>
                                                                                            <span class="caption-subject font-red sbold ">Project Information</span>
                                                                                        </div>

                                                                                    </div>

                                                                                    <div class="portlet-body">
                                                    <div id='map' style='height:500px;width:100%;margin:0;padding:0;'></div>
                                                    </div>
                                                  </div> -->
                                                </div> <!--END PORTLET -->



                                                  </div><!-- end row div  -->
                                                </div>
                                                  <!-- begin new prtolent -->
                                                  <div class='col-md-8'>

                                                    <div class="portlet light portlet-fit ">
                                                      <div class="portlet-title">
                                                        <div class="caption">

                                                            <span class="caption-subject font-red sbold ">Project Datasets</span>
                                                        </div>

                                                      </div>

                                                      <div class="portlet-body">
                                                            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="display:none">ID</th>
                                                                        <th style="text-align: center;"> Name </th>
                                                                        <th style="text-align: center;"> Project </th>
                                                                        <th style="text-align: center;"> Start Date </th>
                                                                        <th style="text-align: center;"> End Date </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php
                                                                    $query= "SELECT * FROM tbl_data_set WHERE deleted = 0 and project_id IN (SELECT distinct id FROM tbl_projects WHERE u_id='$user_id' and project_id = '$project_id') ";

                                                                    $result = $db_conn->query($query);

                                                                    // $row = $result->fetch_assoc();
                                                                    // echo $row['status'];

                                                                    while ($row = $result->fetch_assoc() ) {
                                                                      # code...
                                                                      $data_set_id = $row['id'];
                                                                      $name= $row['name'];
                                                                      $start_date= $row['start_date'];
                                                                      $end_date= $row['end_date'];
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
                                                                          <td class='clickable-row'  data-href='data_set_page.php?id=$data_set_id' style='text-align: center;'> $start_date </td>
                                                                          <td class='clickable-row'  data-href='data_set_page.php?id=$data_set_id' style='text-align: center;'> $end_date </td>



                                                                      </tr>";
                                                                    }



                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                          </div>
                                                        </div>
                                                  <div class="portlet light portlet-fit map_portlet ">
                                                                                  <div class="portlet-title">
                                                                                      <div class="caption">
                                                                                          <i class="fa fa-globe font-red"></i>
                                                                                          <span class="caption-subject font-red sbold ">Project Map</span>
                                                                                      </div>

                                                                                  </div>

                                                                                  <div class="portlet-body ">
                                                                                    <div id='map' style= 'height:400px; width:100%;margin-bottom:20px;'></div>
                                                                                    </div></div>

                                                                                <div class="portlet light portlet-fit ">
                                                                                                                <div class="portlet-title">
                                                                                                                    <div class="caption">
                                                                                                                        <i class="fa fa-map-marker font-red"></i>
                                                                                                                        <span class="caption-subject font-red sbold ">Map Locations</span>
                                                                                                                    </div>

                                                                                                                </div>

                                                                                                                <div class="portlet-body">
                                                                                                                  <div class="btn-group " style="margin-bottom:20px;">
                                                                                                                    <a href="add_location.php" >
                                                                                                                      <button id="sample_editable_1_2_new" class="btn sbold green "> Add New
                                                                                                                          <i class="fa fa-plus"></i>
                                                                                                                      </button>
                                                                                                                    </a>
                                                                                                              </div>
                                                                                          <table class="table table-striped table-bordered table-hover location_table" id="sample_2" >
                                                                                                <thead>
                                                                                                  <tr>
                                                                                                    <th style="text-align: center;"> Location </th>
                                                                                                    <th style="text-align: center;"> Latitude </th>
                                                                                                    <th style="text-align: center;"> Longitude </th>
                                                                                                    <th style="text-align: center;"> Actions </th>

                                                                                                  </tr>
                                                                                                </thead>
                                                                                                <tbody>

                                                                                                  <?php
                                                                                                    $query= "SELECT * FROM tbl_map where project_id='$project_id' ";

                                                                                                    $result = $db_conn->query($query);

                                                                                                      while ($r = $result->fetch_assoc() ) {
                                                                                                                                  # code...
                                                                                                        $marker_id = $r['id'];
                                                                                                        $location= $r['location'];
                                                                                                        $latitude= $r['latitude'];
                                                                                                        $longitude= $r['longitude'];
                                                                                                        $tbl_marker_description= $r['description'];


                                                                                                        echo "
                                                                                                            <tr class='clickable-row' data-href='../fc-projects/user_project.php?id=$marker_id'>
                                                                                                            <td> $location</td>
                                                                                                            <td style='text-align: center;'> $latitude </td>
                                                                                                            <td style='text-align: center;'> $longitude </td>
                                                                                                            <td style='text-align:center;vertical-align: text-top;'>" ;

                                                                                                            if($user_id != $owner_id)
                                                                                                            {
                                                                                                              if($perm['edit_project'] == 1)
                                                                                                              {
                                                                                                                echo "<a href='javascript:;' class='btn btn-icon-only green popovers' data-container='body' data-trigger='click' data-placement='top' data-content='$tbl_marker_description' data-original-title='Description: '>
                                                                                                                      <i style='font-size:16px;' class='fa fa-info-circle'></i></a>
                                                                                                                      <a href='edit_location.php?id=$marker_id;' class='btn btn-icon-only blue'><i style='font-size:16px;' class='fa fa-wrench'></i></a>
                                                                                                                      <button class='btn btn-icon-only red del_marker' value='$marker_id' ><i style='font-size:16px;' class='fa fa-trash'></i></button>
                                                                                                                      " ;
                                                                                                              }
                                                                                                            }

                                                                                                            else
                                                                                                            {
                                                                                                              echo "<a href='javascript:;' class='btn btn-icon-only green popovers' data-container='body' data-trigger='click' data-placement='top' data-content='$tbl_marker_description' data-original-title='Description: '>
                                                                                                                    <i style='font-size:16px;' class='fa fa-info-circle'></i></a>
                                                                                                                    <a href='edit_location.php?id=$marker_id;' class='btn btn-icon-only blue'><i style='font-size:16px;' class='fa fa-wrench'></i></a>
                                                                                                                    <button class='btn btn-icon-only red del_marker' value='$marker_id'><i style='font-size:16px;' class='fa fa-trash'></i></button>
                                                                                                                    " ;
                                                                                                            }

                                                                                                            echo" </td></tr> ";

                                                                                                        }


                                                                                                      ?>
                                                                                                    </tbody>
                                                                                                  </table>



                                                                                  </div>
                                                                                </div></div>



                                                  <!--end new prtlent  -->

                                                <!-- end content wrapper  --></div> </div>
                                              </div>
                                              <?php
                                                include 'includes/inviteCollaborators.php' ;

                                               ?>

                    <!-- END PORTLET -->
                    <!-- modal begin -->
                    <!-- <div class="modal fade" id="modal_img" tabindex="-1" role="basic" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">Add Image</h4>
                                                                </div>
                                                                <div class="modal-body"> -->

                                                                  <!--BEGIN FORMS  -->
                                                                  <!-- <div class="portlet-body form">
                                                                    <form role="form" method="POST" action="includes/upload_image.php" enctype="multipart/form-data">
                                                                      <div class="form-body">

                                                                        <div class="form-group form-md-line-input has-info form-md-floating-label  " >
                                                                          <div class="fileinput fileinput-new" data-provides="fileinput">
                                                      <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                                                      <div>
                                                          <span class="btn red btn-outline btn-file">
                                                              <span class="fileinput-new"> Select image </span>
                                                              <span class="fileinput-exists"> Change </span>
                                                              <input type="file" name="project_image"> </span>
                                                          <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                      </div>
                                                  </div>



                                                                        </div> -->






<!--
                                                                      </div>

                                                                      <div class="modal-footer">
                                                                          <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                          <button type="submit" class="btn " name="save_image" style="background-color:#FFA500; color:white;">Confirm Image</button>

                                                                      </div>
                                                                    </form>
                                                                  </div> -->
                                                                  <!--FORMS END  -->






                                                                    </div>


                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                    <!--modal end  -->

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
        include '../footer.php' ;
      ?>
      <!-- <script src="toggle.js" type="text/javascript"></script> -->
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9qbfEbiRczyw1stXbs0YMe2TVUCuMwTQ&callback=initMap" ></script>
<script>
$(document).on("click", '.del_marker', function(event) {
    console.log("marker id",this.value);
  $.ajax({
    url: 'includes/delete_location.php',
    method: 'POST',
    // dataType:"text",
    data: {marker_id:this.value,load:true},
    success: function(data){
      if (data != ''){
      $(".location_table ").load("user_project.php .location_table",
          function () {
            console.log("marker deleted!", data);
          });
      }
    }
  });
});

</script>
