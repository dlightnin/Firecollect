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





    function setLocation(locations){
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
        if (locations.length ==1) map.setZoom(5);
        google.maps.event.removeListener(listener);
      });
      return fullbounds;
    }
