<?php
  require '../includes/dbConnect.php' ;
  include '../includes/topMenu.php';
  include '../includes/sideBar.php';

  $project_id = $_SESSION['current_project_id'];
  $marker_id = $_GET['id'];
  $query= "SELECT * FROM tbl_map where id ='$marker_id'";

  $result = $db_conn->query($query);


  $row = $result->fetch_assoc();
  $location= $row['location'];
  $latitude = $row['latitude'];
  $longitude = $row['longitude'];
  $description = $row['description'];

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
                                                        <div class="caption">
                                                            <i class="fa fa-globe font-red"></i>
                                                            <span class="caption-subject font-red sbold uppercase">Project Map</span>
                                                        </div>

                                                    </div>
                                                    <div class="portlet-body">
                                                      <!--BEGIN PORTLET BODY  -->
                                                      <div class="alert alert-success display-show"><b>Drag</b> the marker to obtain coordinates.
                                                      <button class="close" data-close="alert"></button>  </div>

                                                      <!--BEGIN FORMS  -->
                                                      <div class="portlet-body form">
                                                        <form role="form" method="post" action="includes/update_map_info.php" id="form_sample_1">
                                                          <div class="form-body">
                                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>

                                                            <input type="hidden" name="marker_id" value="<?php echo $marker_id; ?>">

                                                            <div id='map' style='height:400px;width:100%;margin-bottom:40px;padding:0;' ></div>


                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                 <input required='true' type="text" class="form-control " id="form_control_1" name="location" value="<?php echo $location;?>">
                                                                 <label for="form_control_1">Location:</label>
                                                                 <span class="help-block">Location of the project...</span>
                                                             </div>


                                                            <!-- <div class="row" >
                                                              <div > -->

                                                                  <div class="form-group form-md-line-input form-md-floating-label ">
                                                                    <input number='true' required='true'  type="text" id="form_control_1" class="form-control  marker_latitude  " name="latitude"  value="<?php echo $latitude;?>">
                                                                    <label for="form_control_1" >Latitude:</label>
                                                                  </div>
                                                                  <div class="form-group form-md-line-input form-md-floating-label ">
                                                                    <input number='true' required='true'  type="text" id="form_control_1" class="form-control   marker_longitude " name="longitude"  value="<?php echo $longitude;?>">
                                                                    <label for="form_control_1" >Longitude:</label>
                                                                  </div>


                                                              <!-- </div>
                                                            </div> -->





                                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                                 <textarea required="true" class="form-control" name="description" rows="3"><?php echo $description;?></textarea>
                                                                 <label for="form_control_1">Description:</label>
                                                                 <!-- <span class="help-block">Type a description about location.</span> -->

                                                            </div>


                                                            <!-- <div class="form-actions"> -->
                                                              <a class="col-md-offset-8 " href="<?php echo $_SESSION['last_url'];?>"><button type="button"  class="btn btn-lg dark btn-outline " >Cancel</button></a>
                                                              <button type="submit" class="btn btn-lg  " style="background-color:#FFA500; color:white;" name="edit_marker" >Apply Changes</button>
                                                            <!-- </div> -->




                                                          <!-- </div> -->
                                                        </form>
                                                      </div>
                                                      <!-- END FORMS -->



                                                      <!--END PORTLET BODY  -->
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
      <script type="text/javascript">
      var markers = [];
      function initMap(){
        // var center = {lat: 18.220833,lng:-66.590149};
        var lat_db= Number(<?php echo $latitude; ?>);
        var lng_db = Number(<?php echo $longitude; ?>);
        var location = {lat: lat_db, lng: lng_db};

        var map = new google.maps.Map(document.getElementById("map"),{
          zoom:3,
          center: location
         });

          console.log('map',map);

          var marker = new google.maps.Marker({
            position:location,
            map: map,
            title: '<?php echo $location; ?>',
            draggable:true,
            animation: google.maps.Animation.BOUNCE

          });

            google.maps.event.addListener(marker,'dragend',
              function(event){

                var lat = document.getElementsByClassName("marker_latitude");
                var lng = document.getElementsByClassName("marker_longitude");
                // change input values

                lat[0].value = marker.getPosition().lat();
                lng[0].value = marker.getPosition().lng();
                lat[0].focus();
                lng[0].focus();

                console.log('marker ',marker);



              })


          function addMarker(coords){
            var marker = new google.maps.Marker({
              position:coords,
              map: map,
              title: 'hello',
              draggable:true,
              animation: google.maps.Animation.BOUNCE

            });
            return marker ;

          }

          // var marker = addMarker(location);
      }
</script>
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9qbfEbiRczyw1stXbs0YMe2TVUCuMwTQ&callback=initMap" ></script>
