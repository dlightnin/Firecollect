<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';

  $_SESSION["last_url"]= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  $user_id = $_SESSION["user_id"];
  $project_id = $_GET['id'];
  $db_conn->query("UPDATE tbl_user set last_project = '$project_id' where u_id = '$user_id'") ;
  $_SESSION['current_project_id']= $project_id;
  $query= "SELECT * FROM tbl_projects where id ='$project_id'";

  $result = $db_conn->query($query);



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
    // $research_area = $row['research_area'];
    $period= $row['period'];

    $owner = $db_conn->query("SELECT * FROM tbl_user_info where u_id = '$owner_id'") ;
    $owner = $owner->fetch_assoc() ;



    include 'includes/permissionFunctions.php' ;



    $query2= "SELECT * FROM tbl_user_info WHERE u_id='$user_id'";
    $result = $db_conn->query($query2);
    $row = $result->fetch_assoc();
    $full_name= $row['f_name'].' '.$row['l_name'];

// retrieve markers from database
    $markers = array();
    $query= "SELECT * FROM tbl_map where project_id ='$project_id'";
    $result = $db_conn->query($query);

    $i=0;


    while ($row = $result->fetch_assoc() ) {
      $location= $row['location'];
      $latitude= $row['latitude'];
      $longitude=$row['longitude'];
      $marker_description= $row['description'];
      $location_id=$row['id'];


      $markers[$i]=array();
      array_push($markers[$i],$location,$latitude,$longitude,$marker_description,$location_id);
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

                    <a id='back' class='icon-btn' href='projects.php'>
                      <i class='fa fa-arrow-left'></i>
                      <div> Back </div>
                    </a>";

                    editProject($user_id,$owner_id,$project_id,$perm) ;
                    editMap($user_id,$owner_id,$perm) ;
                    addImages($user_id,$owner_id,$perm);
                    copyProject($user_id,$owner_id,$perm);
                    inviteUsers($user_id,$owner_id,$perm) ;
                    changePermissions($user_id,$owner_id,$project_id,$perm);
                    addDatasets($user_id,$owner_id,$project_id,$perm) ;
                    deleteProject($user_id,$owner_id,$project_id,$perm);

                    echo "
                          </div>
                          <div class='mobile_menu' style='margin-right:15px;'>
                          <div class='btn-group'>
                                                                <button class='btn dark btn-lg dropdown-toggle pull-right' type='button' data-toggle='dropdown'> Actions
                                                                    <i class='fa fa-angle-down'></i>
                                                                </button>
                                                                <ul class='dropdown-menu' role='menu'>";

                                                                editProjectMobile($user_id,$owner_id,$project_id,$perm) ;
                                                                editMapMobile($user_id,$owner_id,$perm) ;
                                                                addImagesMobile($user_id,$owner_id,$perm);
                                                                copyProjectMobile($user_id,$owner_id,$perm);
                                                                inviteUsersMobile($user_id,$owner_id,$perm) ;
                                                                changePermissionsMobile($user_id,$owner_id,$project_id,$perm);
                                                                addDatasetsMobile($user_id,$owner_id,$project_id,$perm) ;
                                                                deleteProjectMobile($user_id,$owner_id,$project_id,$perm);

                                                            echo "</ul>
                                                            </div>
                                                            </div>
                                                            </div>";


?>
<!-- <div class="row"> -->

                  <div class="col-md-12">
                    <div class="portlet light portlet-fit ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <span class="caption-subject sbold title firecollect">Project Information</span>

                                                        </div>

                                                        <div class="tools">
                                                          <a href="" class="collapse" data-original-title="" title=""> </a>
                                                        </div>
                                                        <?php
                                                        changeStatus($user_id,$owner_id,$perm,$status);
                                                    //   <div id ='0' class='btn-group status_toggle pull-right'>
                                                    //     <button  class='btn btn-success btn-sm dropdown-toggle ' type='button' data-toggle='dropdown' aria-expanded='false'> Public
                                                    //     </button>
                                                    //     <ul class='dropdown-menu' role='menu'>
                                                    //         <li>
                                                    //             <a data-toggle='modal' href='' > Private </a>
                                                    //         </li>
                                                    //
                                                    //     </ul>
                                                    // </div>
                                                      echo "<div class='modal fade modal-scroll modal_tag' id='modal_terms' tabindex='-1' role='dialog' aria-hidden='true' >
                                                                                        <div class='modal-dialog modal-lg' style='position:relative;' id='ea'>
                                                                                            <div class='modal-content'>
                                                                                                <div class='modal-header'>
                                                                                                    <button type='button' class='close close_modal' data-dismiss='modal' aria-hidden='true'></button>


                                                                                                    <h4 class='modal-title font-red'  > Terms and Conditions:</h4>
                                                                                                    <span style='display:none' class='id'>$project_id</span>



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
                                                                                    </div>";


                                                      ?>
                                                    </div>


                                                    <div class="portlet-body">
                                                      <!--BEGIN PORTLET BODY  -->



                                                          <!-- <div class='row'> -->
                                                            <!-- <div class='col-md-5'> -->


                                                              <?php
                                                                echo "
                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold '>Title:<p class='text firecollect' style='padding-left:10px;'>$project_title</p></h4>
                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold '>Principal Investigator:<p class='text firecollect' style='padding-left:10px;'>".$owner['f_name']." ".$owner['l_name']."</p></h4>
                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold '>Short Name:<p class='text firecollect' style='padding-left:10px;'>$short_name</p></h4>
                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold '>Contact Name:<p class='text firecollect' style='padding-left:10px;'>$contact_name</p></h4>
                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold '>Contact Email:<p class='text firecollect' style='padding-left:10px;'>$contact_email</p></h4>
                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold '>Sponsor:<p class='text firecollect' style='padding-left:10px;'>$sponsor</p></h4>";

                                                              echo "
                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold '>Period:<p class='text firecollect' style='padding-left:10px;'>$period</p></h4>
                                                              <h4 style='margin-bottom:20px;' class= 'subject firecollect sbold '>Description:<p class='text firecollect' style='padding-left:10px;'>$description</p></h4>
                                                              ";

                                                            ?>







                                                          <!-- </div> -->
                                                          <!-- <div class='col-md-7'>
                                                            <div id='map' style= 'height:400px; width:100%;margin-bottom:20px;'></div>



                                                        </div> -->

                                                      <!-- </div> -->






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
                                                  <div class='col-md-12'>

                                                    <div class="portlet light portlet-fit ">
                                                      <div class="portlet-title">
                                                        <div class="caption">

                                                            <span class="caption-subject sbold title firecollect">Project Datasets</span>
                                                        </div>
                                                        <div class="tools">
                                                          <a href="" class="collapse" data-original-title="" title=""> </a>
                                                        </div>

                                                      </div>

                                                      <div class="portlet-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="btn-group" style="margin-bottom:3%;">
                                                                  <?php
                                                                  if($user_id == $owner_id or $perm['add_dataset'] == 1)
                                                                  {
                                                                    echo "<a  class='btn firecollect' href='add_data_set.php?id=$id' >
                                                                      <!-- <button  class='btn '   style='background-color:#FFA500; color: white;'>  -->
                                                                        Add Data Set
                                                                          <i class='fa fa-plus'></i>
                                                                      <!-- </button> -->
                                                                    </a>" ;
                                                                  }

                                                                  ?>

                                                                </div>
                                                            </div>
                                                          </div>


                                                            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="display:none">ID</th>
                                                                        <th style="text-align: center;"> Name </th>

                                                                        <th style="text-align: center;"> Period </th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php
                                                                    $query= "SELECT * FROM tbl_data_set WHERE deleted = 0 and project_id IN (SELECT distinct id FROM tbl_projects WHERE  project_id = '$project_id') ";

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
                                                                          <td class='clickable-row'  data-href='data_set_page.php?id=$data_set_id' style='text-align: center;'> $period </td>




                                                                      </tr>";
                                                                    }



                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                          </div>
                                                        </div>
                                                  <div class="portlet light portlet-fit map_portlet">
                                                                                  <div class="portlet-title">
                                                                                      <div class="caption">
                                                                                          <span class="caption-subject sbold title firecollect">Project Map</span>
                                                                                      </div>
                                                                                      <div class="tools">
                                                                                        <a href="" class="collapse" data-original-title="" title=""> </a>
                                                                                      </div>
                                                                                  </div>

                                                                                  <div class="portlet-body ">

                                                                                    <script>

                                                                                    var all_markers = [];
                                                                                    var all_markers_info =[];
                                                                                    var marker_info=[];

                                                                                    function initMap(data){
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





                                                                                        function setLocation(locations){
                                                                                          // console.log("locations",locations);

                                                                                          for (i = 0; i < locations.length; i++){

                                                                                              var coords= {lat: Number(locations[i][1]),lng:Number(locations[i][2])};
                                                                                              var desc  = "<h5><b>" + locations[i][0] + ":</b></h5> <p> " + locations[i][3] + "</p>" ;
                                                                                              var myinfowindow = new google.maps.InfoWindow({
                                                                                                  content: desc

                                                                                              });

                                                                                              var aMarker = addMarker(coords,locations[i][0],myinfowindow);
                                                                                              var marker_id = locations[i][4];
                                                                                              all_markers[i] = aMarker;
                                                                                              marker_info=marker_id;
                                                                                              all_markers_info[i] = marker_info;


                                                                                              // var mark_selector = ".location_table:nth-child("+String(i+1)+")";
                                                                                              // console.log(mark_selector);



                                                                                          }
                                                                                          console.log(all_markers);


                                                                                          // map.setCenter(fullbounds.getCenter());
                                                                                          map.fitBounds( fullbounds );

                                                                                          var listener = google.maps.event.addListener(map, "idle", function() {
                                                                                            if (locations.length ==1) map.setZoom(5);
                                                                                            google.maps.event.removeListener(listener);
                                                                                          });
                                                                                          return all_markers;
                                                                                        }
                                                                                        var locations = <?php echo $locations; ?>;

                                                                                        the_marks = setLocation(locations);

                                                                                        // var dict = [];
                                                                                        // for (i = 0; i < locations.length; i++){
                                                                                        //   // dict.push({
                                                                                        //     var key="marker"+String(i);
                                                                                        //     var value= locations[i];
                                                                                        //   // });
                                                                                        //   // if (!dict[key]) {
                                                                                        //   //       dict[key] = [];
                                                                                        //   //   }
                                                                                        //   //
                                                                                        //   // dict[key]=value;
                                                                                        //   dict[i]=[key,value];
                                                                                        // }
                                                                                        // for (i = 0; i < dict.length; i++){
                                                                                        //
                                                                                        // console.log(dict);
                                                                                        //     }

                                                                                        // if (locations.length ==1){
                                                                                        //   console.log("only one marl");
                                                                                        //   map.
                                                                                        // }else {
                                                                                        //
                                                                                        // }
                                                                                        // console.log(fullbounds);





                                                                                        // marker.addListener('click',function(){
                                                                                        //
                                                                                        //   infoWindow.open(map,marker);
                                                                                        // });


                                                                                        console.log("made it",the_marks);



                                                                                    }





                                                                                    </script>

                                                                                    <div id='map' style= 'height:400px; width:100%;margin-bottom:20px;'></div>
                                                                                    </div></div>

                                                                                <div class="portlet light portlet-fit ">
                                                                                                                <div class="portlet-title">
                                                                                                                    <div class="caption">

                                                                                                                        <span class="caption-subject sbold title firecollect">Map Locations</span>
                                                                                                                    </div>
                                                                                                                    <div class="tools">
                                                                                                                      <a href="" class="collapse" data-original-title="" title=""> </a>
                                                                                                                    </div>

                                                                                                                </div>

                                                                                                                <div class="portlet-body ">
                                                                                                                  <div class="btn-group " style="margin-bottom:20px;">
                                                                                                                    <?php
                                                                                                                      if($user_id == $owner_id or $perm['edit_map'] == 1)
                                                                                                                      {
                                                                                                                        echo "<a href='add_location.php' >
                                                                                                                          <button id='sample_editable_1_2_new' class='btn firecollect '> Add New
                                                                                                                              <i class='fa fa-plus'></i>
                                                                                                                          </button>
                                                                                                                        </a>" ;
                                                                                                                      }
                                                                                                                     ?>
                                                                                                              </div>
                                                                                            <div class="contain_table">


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
                                                                                                  $j = 0;

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
                                                                                                            <tr class='clickable-row ' data-href='../fc-projects/user_project.php?id=$marker_id'>
                                                                                                            <td> $location</td>
                                                                                                            <td style='text-align: center;'> $latitude </td>
                                                                                                            <td style='text-align: center;'> $longitude </td>
                                                                                                            <td style='text-align:center;vertical-align: text-top;'>" ;



                                                                                                            if($user_id != $owner_id)
                                                                                                            {
                                                                                                              if($user_id == $owner_id or $perm['edit_map'] == 1)
                                                                                                              {
                                                                                                                echo "<a href='javascript:;' class='btn btn-icon-only green popovers' data-container='body' data-trigger='hover' data-placement='top' data-content='$tbl_marker_description' data-original-title='Description: '>
                                                                                                                      <i style='font-size:16px;' class='fa fa-info-circle'></i></a>
                                                                                                                      <a href='edit_location.php?id=$marker_id;' class='btn btn-icon-only blue'><i style='font-size:16px;' class='fa fa-wrench'></i></a>
                                                                                                                      <button class='btn btn-icon-only red del_marker ' value='$marker_id' ><i style='font-size:16px;' class='fa fa-trash '></i></button>
                                                                                                                      " ;
                                                                                                              }
                                                                                                            }

                                                                                                            else
                                                                                                            {
                                                                                                              echo "<a href='javascript:;' class='btn btn-icon-only green popovers' data-container='body' data-trigger='hover' data-placement='top' data-content='$tbl_marker_description' data-original-title='Description: '>
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
                  <div class="modal fade" id="modal_img" tabindex="-1" role="basic" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">Add Image</h4>
                                                                </div>
                                                                <div class="modal-body"> -->

                                                                  <!--BEGIN FORMS  -->
                                                                  <div class="portlet-body form">
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



                                                                        </div>







                                                                      </div>

                                                                      <div class="modal-footer">
                                                                          <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                          <button type="submit" class="btn " name="save_image" style="background-color:#FFA500; color:white;">Confirm Image</button>

                                                                      </div>
                                                                    </form>
                                                                  </div>
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
        include '../includes/footer.php' ;
      ?>
      <script src="includes/js/statusToggle.js" type="text/javascript"></script>

      <!-- <script src="toggle.js" type="text/javascript"></script> -->
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9qbfEbiRczyw1stXbs0YMe2TVUCuMwTQ&callback=initMap" ></script>
<script>
// change status button
// function change_status_btn(new_id,remove,add,btn_txt,drop_txt )
//       {$(".status_toggle")[0].id = new_id;
//       $(".status_toggle button").removeClass(remove);
//       $(".status_toggle button").addClass(add);
//       $(".status_toggle").find("button")[0].innerHTML=btn_txt;
//       $(".status_toggle").find("a")[0].innerHTML=drop_txt ;}



// activate popovers when clicking to other table entries
$(document).on( 'click','a',function(){
  console.log('clicked boi');
  $(".popovers").popover();


});
$(document).on( 'ready',function(){
  $('.select2-search__field')[0].placeholder="Select Collaborators";

           });
// activate popovers when ajax completes



$(document).on("click", '.del_marker', function(event) {
    console.log("marker id",this.value);
    var marker_id=this.value;

    // $(document).on("click", ".del_marker", function(event) {

      var res = confirm("u sure?");
      if (res == true){
        var num = String(this.id);
        num = num.substr(3);
        var k = "marker"+String(num);
          console.log(k);

          // all_markers[k].setMap(null);

          // console.log(,all_markers[key]);

      }

    // });
    var title= $(this).closest("tr")[0].children[0].innerHTML;
    var latitude= $(this).closest("tr")[0].children[1].innerHTML;
    var longitude= $(this).closest("tr")[0].children[2].innerHTML;
    var desc= $(this).closest("tr")[0].children[3].children[0].getAttribute("data-content");
    title=String(title).trim();
    latitude=String(latitude).trim();
    longitude=String(longitude).trim();
    desc=String(desc).trim();
    console.log("desc",desc);


  $.ajax({
    url: 'includes/delete_location.php',
    method: 'POST',
    // dataType:"text",
    data: {marker_id:this.value,load:true},
    success: function(data){
      if (data != ''){
        //retrieve updated table and replace it with the current one
      $.get(String(window.location.href), function (loaded_data) {
          loaded_data = $(loaded_data).find('.contain_table');
          $(".contain_table").replaceWith(loaded_data);
      // data contains your html
  // });
      // $(".contain_table ").load(String(window.location.href)+" .contain_table",
      // activate datatable functionality
          $('.location_table').dataTable( {
             aaSorting:[], 'searching': true,
            'lengthMenu': [[5,10, 15, 20, -1], [5,10, 15, 20, 'All']]
          });
            $(".popovers").popover();



            console.log("marker deleted!", data);
            console.log("all_markers",all_markers);
            for (var i = 0; i < all_markers_info.length; i++) {
              // var del_lat = String(all_markers_info[i][0].lat);
              // var del_lng = String(all_markers_info[i][0].lng);
              // var del_title = String(all_markers_info[i][2]);
              // var del_desc = String(all_markers_info[i][1]);
              // console.log("title",title,del_title);
              // console.log("latitude",latitude,del_lat);
              // console.log("longitude",longitude,del_lng);
              // console.log("longitude",desc,del_desc);
              // console.log(del_lat,del_lng,del_title,del_desc);
              var del_marker_id = all_markers_info[i];
              if (del_marker_id == marker_id){
                all_markers[i].setMap(null);
                console.log("true boi");
                break;
              }


              // console.log("all_markers_info",all_markers_info[i]);
            }
            // var dict = [];
            // // for (i = 0; i < data.length; i++){
            //   dict.push({
            //     key:"marker"+String(i),
            //     value: data[i]
            //   });
            // }
            // console.log(dict);

            // var map = new google.maps.Map(document.getElementById("map"),{
            //   zoom:9,
            //    });
            // var fullbounds= new google.maps.LatLngBounds();
            //
            // setLocation(data);
            // INSERT INTO `tbl_map`( `project_id`, `location`, `latitude`, `longitude`, `description`) VALUES (1,'RUSSIA','67.02136237890625','67.02136237890625','fd')


            // $(".map_portlet script").load("includes/load_ajax/user_project.php .map_portlet script");


          });
      }
    }
   //  complete: function() {
   //   // $.getScript("/scripts/mysearchscript.js", function() {
   //   //      alert('loaded script and content');
   //   // });
   //   $(".map_portlet").load(String(window.location.href)+" .map_portlet");
   //
   // }
  });
});
var tr_num = $(".location_table tr").length;
console.log("table rows:",$(".location_table tr").length -1);
for (i = 1; i < tr_num; i++){
  var tr = $(".location_table").children().children()[i];
  tr.children[3].children[2].id = "del"+String(i-1);
  // console.log(tr.children[3].children[2]);
}

// console.log("table rows:",$(".location_table").children().children()[0]);

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


  $(document).on("click", '.del_project', function(event) {
    event.preventDefault();
    event.stopPropagation();
    // var project_id =$(this).closest('tr ').find(".id")[0].innerHTML;
    // console.log(project_id);
    var res = confirm("u sure?");
    if (res) {
      $.ajax({
        url: 'includes/deleteProject.php',
        method: 'POST',
        // dataType:"text",
        data: {del : <?php echo $project_id;  ?>},
        success: function(data){
          if (data != ''){
            console.log(data);
            window.location.replace('projects.php');

          }
        }
      });
    }
  });


$('#proceed_dataset').click(function(){
  var project_id = $('#dropdown_dataset :selected').val();
  $("#hidden_input").attr("value", project_id);

});
setStatusToggle("page","includes/updateStatus.php");

</script>
<?php
  unset($_SESSION['invited']) ;
 ?>
