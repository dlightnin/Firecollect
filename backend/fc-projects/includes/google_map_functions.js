var markers = [];
function initMap(){
  var location = {lat: 18.220833,lng:-66.590149};

  var map = new google.maps.Map(document.getElementById("map"),{
    zoom:9,
    center: location });

    console.log('map',map);
    //
    // google.maps.event.addListener(map,'click',
    //   function(event){
    //     var marked = addMarker(event.latLng);
    //     // markers.push(marked);
    //     // console.log("marked: ",marked.getPosition());
    //     var lat = document.getElementsByClassName("marker_latitude");
    //     var lng = document.getElementsByClassName("marker_longitude");
    //     // change input values
    //     lat[0].value = marked.getPosition().lat();
    //     lng[0].value = marked.getPosition().lng();
    //     console.log('markers ',markers);
    //
    //   })
    var marker = new google.maps.Marker({
      position:location,
      map: map,
      title: 'hello',
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
