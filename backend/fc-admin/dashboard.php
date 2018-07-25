<?php

  include '../includes/topMenu.php';
  require '../includes/dbConnect.php' ;

  include '../includes/sideBar.php';

  $user_id = $_SESSION['user_id'];



  $count_projects = $db_conn->query("SELECT distinct COUNT(p.id) from tbl_user u join tbl_projects p on u.u_id = p.u_id where u.u_id = '$user_id' and p.deleted = 0") ;
  $count_projects = $count_projects->fetch_assoc();

  $count_datasets = $db_conn->query("SELECT distinct COUNT(d.id) from tbl_user u join tbl_projects p on u.u_id = p.u_id join tbl_data_set d on d.project_id = p.id where u.u_id = '$user_id' and p.deleted = 0") ;
  $count_datasets = $count_datasets->fetch_assoc();

  $count_data_files = $db_conn->query("SELECT COUNT(df.id) from tbl_user u join tbl_projects p on u.u_id = p.u_id join tbl_data_set d on d.project_id = p.id join tbl_data_files df on d.id = df.data_set_id where u.u_id = '$user_id' and p.deleted = 0") ;
  $count_data_files = $count_data_files->fetch_assoc() ;

  $count_collaborators = $db_conn->query("SELECT COUNT(distinct user_id) from tbl_collaborators where p_id in(SELECT id from tbl_projects where u_id = '$user_id')") ;
  $count_collaborators = $count_collaborators->fetch_assoc();

$locations=array();
  $res = $db_conn->query("SELECT * FROM tbl_projects where u_id ='$user_id'");
  // $rowp =$res->fetch_assoc();
$j=0;


while ($rowp = $res->fetch_assoc() ) {
  $markers = array();

  $p_title = $rowp['title'];
  $p_id = $rowp['id'];
  // retrieve markers from database
      $result = $db_conn->query("SELECT * FROM tbl_map where project_id ='$p_id'");

      $i=0;


      while ($row = $result->fetch_assoc() ) {
        $location= $row['location'];
        $latitude= $row['latitude'];
        $longitude=$row['longitude'];
        $marker_description= $row['description'];
        $location_id=$row['id'];

        $markers[$i]=array();
        array_push($markers[$i],$location,$latitude,$longitude,$marker_description,$location_id,$p_title);
        $i= $i + 1 ;


      }
      // $all_projects =  array();
      // $all_projects= array_push($markers)

      // $locations = json_encode($markers);
      // $locations[$j]=array();
      array_push($locations, $markers);
      $j= $j + 1 ;


}
$locations= json_encode($locations);
    //
    // $projects = array();
    //   $res = $db_conn->query("SELECT * FROM tbl_projects where u_id ='$user_id'");
    //   while ($rowp = $res->fetch_assoc() ) {
    //   $p_id = $rowp['id'];
    //
    //   array_push($projects,$p_id);
    // }
    //   $projects = json_encode($projects);


    //Get id from last opened projects,dataset,datafiles
    $res_last = $db_conn->query("SELECT * FROM tbl_user WHERE u_id='$user_id'");
    $row_last = $res_last->fetch_assoc() ;
    $last_pr_id = $row_last['last_project'];
    $last_ds_id = $row_last['last_dataset'];
    $last_df_id = $row_last['last_datafiles'];
    //last project
    $res_last_pr = $db_conn->query("SELECT * FROM tbl_projects WHERE id='$last_pr_id'");
    $row_last_pr = $res_last_pr->fetch_assoc() ;
    $last_pr = $row_last_pr['short_name'];
    //last dataset
    $res_last_ds = $db_conn->query("SELECT * FROM tbl_data_set WHERE id='$last_ds_id'");
    $row_last_ds = $res_last_ds->fetch_assoc() ;
    $last_ds = $row_last_ds['name'];
    //last dataset
    $res_last_df = $db_conn->query("SELECT * FROM tbl_data_set WHERE id='$last_df_id'");
    $row_last_df = $res_last_df->fetch_assoc() ;
    $last_df = $row_last_df['name'];
?>


            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content ">
                    <!-- BEGIN PAGE HEADER-->


                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <span data-counter="counterup" data-value="20"><?php echo $count_projects['COUNT(p.id)'] ; ?></span>
                                            <!-- <small class="font-green-sharp"></small> -->
                                        </h3>
                                        <small>Total Projects</small>
                                        <br><br>
                                        <small>Last Opened:</small>
                                        <br>
                                      <div class="last_link popovers" data-container='body' data-trigger='hover' data-placement='bottom' data-content='<?php echo $last_pr; ?>' >
                                        <a  href="../fc-projects/user_project.php?id=<?php echo $last_pr_id; ?>">
                                          <small class="font-green-sharp"><?php echo $last_pr; ?></small></a>

                                      </div>



                                    </div>
                                    <div class="icon corner ">
                                        <i class="fa fa-tasks"></i>
                                    </div>

                                </div>
                                <!-- <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 76%;" class="progress-bar progress-bar-success green-sharp">
                                            <span class="sr-only">76% progress</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> progress </div>
                                        <div class="status-number"> 76% </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <span data-counter="counterup" data-value="36"><?php echo $count_datasets['COUNT(d.id)'];?></span>
                                        </h3>
                                        <small>Total Datasets</small>
                                        <br><br>
                                        <small>Last Opened:</small>
                                        <br>
                                        <div class="last_link popovers" data-container='body' data-trigger='hover' data-placement='bottom' data-content='<?php echo $last_ds; ?>'>

                                          <a href="../fc-projects/data_set_page.php?id=<?php echo $last_ds_id; ?>">
                                            <small class="font-red-haze"><?php echo $last_ds; ?></small></a>
                                      </div>
                                    </div>
                                    <div class="icon corner">
                                        <i class="fa fa-database"></i>
                                    </div>
                                </div>
                                <!-- <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 85%;" class="progress-bar progress-bar-success red-haze">
                                            <span class="sr-only">85% change</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> change </div>
                                        <div class="status-number"> 85% </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-blue-sharp">
                                            <span data-counter="counterup"><?php echo $count_data_files['COUNT(df.id)']; ?></span>
                                        </h3>
                                        <small>Total Datafiles</small>
                                        <br><br>
                                        <small>Last Opened:</small>

                                        <br>
                                        <div class="last_link popovers" data-container='body' data-trigger='hover' data-placement='bottom' data-content='<?php echo $last_df; ?>'>

                                        <a  href="../fc-projects/datafiles.php?id=<?php echo $last_df_id; ?>">
                                          <small class="font-blue-sharp"><?php echo $last_df; ?></small></a>
                                      </div>
                                    </div>
                                    <div class="icon corner">
                                        <i class="fa fa-file"></i>
                                    </div>
                                </div>
                                <!-- <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 45%;" class="progress-bar progress-bar-success blue-sharp">
                                            <span class="sr-only">45% grow</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> grow </div>
                                        <div class="status-number"> 45% </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 ">
                                <div class="display">
                                    <div class="number">
                                        <h3 class="font-purple-soft">
                                            <span data-counter="counterup" data-value="276"><?php echo $count_collaborators['COUNT(distinct user_id)']; ?></span>
                                        </h3>
                                        <small>Total Collaborators</small>
                                        <br><br>
                                        <br><br>


                                    </div>
                                    <div class="icon corner">
                                        <i class="fa fa-user"></i>
                                    </div>
                                </div>
                                <!-- <div class="progress-info">
                                    <div class="progress">
                                        <span style="width: 57%;" class="progress-bar progress-bar-success purple-soft">
                                            <span class="sr-only">56% change</span>
                                        </span>
                                    </div>
                                    <div class="status">
                                        <div class="status-title"> change </div>
                                        <div class="status-number"> 57% </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12">
                            <div class="portlet light ">
                                <div class="portlet-title" style="border-bottom:none; margin-bottom:0px;">
                                    <div class="caption">
                                        <span class="title firecollect">Project Summary</span>
                                        <!-- <span clas="caption-helper"></span> -->
                                    </div>
                                </div>
                                <div class="portlet-body">
                                  <div class="mt-element-list">

                                      <div class="list-default mt-list-container ">

                                          <ul>
                                              <li class="mt-list-item">
                                                  <div class="list-item-content" style="margin-top:15px;">
                                                      <h3>
                                                          <label class="subject firecollect">Total Projects:</label>
                                                            <div class="number pull-right" style="font-size:24px; padding-right:10px;"><span data-counter="counterup" data-value="276"><?php echo $count_projects['COUNT(p.id)'] ; ?></span></div>
                                                      </h3>

                                                  </div>
                                              </li>
                                              <li class="mt-list-item">
                                                <?php
                                                  $priv = $db_conn->query("SELECT COUNT(p.id) from tbl_projects p where u_id = '$user_id' and status = 0 and deleted = 0") ;
                                                    $priv = $priv->fetch_assoc();

                                                 ?>

                                                  <div class="list-item-content">
                                                      <h3 >
                                                          <label class="subject firecollect">Private Projects:</label>
                                                          <div class="number pull-right" style="font-size:24px; padding-right:10px;"><span data-counter="counterup" data-value="276"><?php echo $priv['COUNT(p.id)'] ; ?></span></div>
                                                      </h3>

                                                  </div>
                                              </li>
                                              <li class="mt-list-item">


                                                  <div class="list-item-content">
                                                      <h3 >
                                                          <label class="subject firecollect">Public Projects:</label>
                                                          <div class="number pull-right" style="font-size:24px; padding-right:10px;"><span data-counter="counterup" data-value="276"><?php echo $count_projects['COUNT(p.id)'] - $priv['COUNT(p.id)']; ?></span></div>
                                                      </h3>

                                                  </div>
                                              </li>

                                          </ul>
                                      </div>
                                  </div>
                              </div>
                            </div>

                            <div class="portlet light portlet-fit">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="title firecollect">Media</span>
                                    </div>

                                </div>
                                <div class="portlet-body" style="position:relative; height:375px ">
                                  <canvas id="myChart" style="display: block; width: 100%; height: 100%; "></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12 ">
                          <div class="portlet light ">
                              <div class="portlet-title" style="border-bottom:none; margin-bottom:0px;">
                                  <div class="caption">
                                      <i class="icon-bubbles font-dark hide"></i>
                                      <span class="title firecollect">Dataset Summary</span>
                                  </div>

                              </div>
                              <div class="portlet-body">
                                <div class="mt-element-list">

                                    <div class="mt-list-container list-default">

                                        <ul>
                                            <li class="mt-list-item">
                                                <div class="list-item-content" style="margin-top:15px;">
                                                    <h3>
                                                        <label class="subject firecollect">Total Datasets:</label>
                                                        <div class="number pull-right" style="font-size:24px; padding-right:10px;"><span data-counter="counterup" data-value="276"><?php echo $count_datasets['COUNT(d.id)'] ; ?></span></div>
                                                    </h3>

                                                </div>
                                            </li>
                                            <li class="mt-list-item">
                                              <?php
                                                $priv2 = $db_conn->query("SELECT COUNT(d.id) from tbl_data_set d join tbl_projects p on p.id = d.project_id where p.u_id = '$user_id' and p.status = 0") ;
                                                  $priv2 = $priv2->fetch_assoc();

                                               ?>

                                                <div class="list-item-content">
                                                    <h3>
                                                        <label class="subject firecollect">Private Datasets:</label>
                                                        <div class="number pull-right" style="font-size:24px; padding-right:10px;"><span data-counter="counterup" data-value="276"><?php echo $priv2['COUNT(d.id)'] ; ?></span></div>

                                                    </h3>

                                                </div>
                                            </li>
                                            <li class="mt-list-item">


                                                <div class="list-item-content">
                                                    <h3>
                                                        <label class="subject firecollect">Public Datasets:</label>
                                                        <div class="number pull-right" style="font-size:24px; padding-right:10px;"><span data-counter="counterup" data-value="276"><?php echo $count_datasets['COUNT(d.id)'] - $priv2['COUNT(d.id)'] ; ?></span></div>

                                                    </h3>

                                                </div>
                                            </li>



                                        </ul>
                                    </div>
                                </div>
                              </div>
                          </div>

                          <div class="portlet light portlet-fit ">
                              <div class="portlet-title">
                                  <div class="caption">
                                      <span class="title firecollect">Memory</span>
                                  </div>

                              </div>
                              <div class="portlet-body" style="position:relative; height:375px">
                                <canvas id="myPieChart" style="display: block; width: 100%; height: 100%; "></canvas>

                              </div>
                          </div>
                        </div>

                    </div>
                    <div class="portlet light portlet-fit ">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <span class="title firecollect">Project Map</span>
                                                        </div>

                                                    </div>

                                                    <div class="portlet-body">
                                                      <div id='map' style= 'height:400px; width:100%;margin-bottom:20px;'></div>
                                                      </div></div>
                    </div>
                </div>
            </div>
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->

      <?php
        include '../includes/footer.php' ;

        $count_data_files_text = $db_conn->query("SELECT COUNT(df.id), SUM(df.file_size) from tbl_data_files df where df.data_set_id in(select d.id from tbl_data_set d where d.project_id in(select p.id from tbl_projects p where p.u_id = '$user_id')) and (file_type like '%text%' or file_type like '%application%')") ;
        $count_data_files_text = $count_data_files_text->fetch_assoc() ;



        $count_data_files_img = $db_conn->query("SELECT COUNT(df.id), SUM(df.file_size) from tbl_data_files df where df.data_set_id in(select d.id from tbl_data_set d where d.project_id in(select p.id from tbl_projects p where p.u_id = '$user_id')) and file_type like '%image%' ") ;
        $count_data_files_img = $count_data_files_img->fetch_assoc() ;
        // //
        $count_data_files_vid = $db_conn->query("SELECT COUNT(df.id), SUM(df.file_size) from tbl_data_files df where df.data_set_id in(select d.id from tbl_data_set d where d.project_id in(select p.id from tbl_projects p where p.u_id = '$user_id')) and file_type like '%video%' ") ;
        $count_data_files_vid = $count_data_files_vid->fetch_assoc() ;
        //
        $count_data_files_audio = $db_conn->query("SELECT COUNT(df.id), SUM(df.file_size) from tbl_data_files df where df.data_set_id in(select d.id from tbl_data_set d where d.project_id in(select p.id from tbl_projects p where p.u_id = '$user_id')) and file_type like '%audio%' ") ;
        $count_data_files_audio = $count_data_files_audio->fetch_assoc() ;


        // echo "<p>
        // ".$textSize."
        // </p>";

      ?>



      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9qbfEbiRczyw1stXbs0YMe2TVUCuMwTQ&callback=initMap" ></script>

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





          function setLocation(locations,index,length){
            // console.log("locations",locations);

            for (i = 0; i < length; i++){
              var coords= {lat: Number(locations[index][i][1]),lng:Number(locations[index][i][2])};
                var desc  = "<h5><b>Project:</b></h5>"+ locations[index][i][5] + "<br><h5> <b>Location:</b></h5>" + locations[index][i][0] + "<br><h5> <b>Description:</b></h5> <p> " + locations[index][i][3] + "</p>" ;
                var myinfowindow = new google.maps.InfoWindow({
                    content: desc

                });

                var aMarker = addMarker(coords,locations[index][i][0],myinfowindow);
                var marker_id = locations[index][i][4];
                all_markers[i] = aMarker;
                marker_info=marker_id;
                all_markers_info[i] = marker_info;





            }
            console.log(all_markers);


            // map.setCenter(fullbounds.getCenter());
            map.fitBounds( fullbounds );

            // var listener = google.maps.event.addListener(map, "idle", function() {
            //   if (locations[index].length ==1) map.setZoom(5);
            //   google.maps.event.removeListener(listener);
            // });
            return all_markers;
          }
          var locations = <?php echo $locations; ?>;
          console.log("locations",locations);


          for (j = 0; j < locations.length; j++){
            if (locations[j].length>0){
              setLocation(locations,j,locations[j].length);
            }

      }
  }













  //     function humanFileSize(bytes, si) {
  //     var thresh = si ? 1000 : 1024;
  //     if(Math.abs(bytes) < thresh) {
  //         return bytes + ' B';
  //     }
  //     var units = si
  //         ? ['kB','MB','GB','TB','PB','EB','ZB','YB']
  //         : ['KiB','MiB','GiB','TiB','PiB','EiB','ZiB','YiB'];
  //     var u = -1;
  //     do {
  //         bytes /= thresh;
  //         ++u;
  //     } while(Math.abs(bytes) >= thresh && u < units.length - 1);
  //     return bytes.toFixed(1)+' '+units[u];
  // }
    var countText = <?php echo $count_data_files_text['COUNT(df.id)']  ?> ;
    var countImg = <?php echo $count_data_files_img['COUNT(df.id)'] ?> ;
    var countVid = <?php echo $count_data_files_vid['COUNT(df.id)']  ?> ;
    var countAudio = <?php echo $count_data_files_audio['COUNT(df.id)']  ?> ;

    // var text_Size = humanFileSize(<?php echo $count_data_files_text['SUM(df.file_size)'] ?>,false);
    // var img_Size = humanFileSize(<?php echo $count_data_files_img['SUM(df.file_size)'] ?>,false);
    // var vid_Size = humanFileSize(<?php echo $count_data_files_vid['SUM(df.file_size)'] ?>,false);
    // var audio_Size = humanFileSize(<?php echo $count_data_files_audio['SUM(df.file_size)'] ?>,false);
    //
    // var imgData = String(countImg) + ", (" + img_Size + ")" ;
    //
    // console.log(imgData);

    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Images", "Video", "Text", "Audio"],


        datasets: [{

            data: [ countImg, countVid ,countText, countAudio],
            backgroundColor: [
                'rgba(239, 194, 48, 1)',
                'rgba(231, 80, 90, 1)',
                'rgba(27, 188, 155, 1)',
                'rgba(92, 155, 209, 1)'
            ],
            borderColor: [
                'rgba(100, 100, 100, 1)',
                'rgba(100, 100, 100, 1)',
                'rgba(100, 100, 100, 1)',
                'rgba(100, 100, 100, 1)'
            ],
            borderWidth: 1
        }]
    }


});

var ctx = document.getElementById("myPieChart").getContext('2d');
// document.getElementById("algo").innerHtml;
var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: ["Used","Free"],


        datasets: [{
            label: '# of Votes',
            data: [90, 60],
            backgroundColor: [
                'rgba(27, 188, 155, 1)',
                'rgba(200, 200, 200, 1)'
            ],
            borderColor: [
                'rgba(100, 100, 100, 1)',
                'rgba(100, 100, 100, 1)'
            ],
            borderWidth: 1
        }]
    }


});





</script>
