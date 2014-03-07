<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Info windows</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
// This example displays a marker at the center of Australia.
// When the user clicks the marker, an info window opens.

function initialize() {
  var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
  var mapOptions = {
    zoom: 4,
    center: myLatlng
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

	/////////// CREATE A MARKER ///////////////////
  var contentString = '<a href="http://google.com">testing testing</a> 1234';

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  	});

	var latLng = new google.maps.LatLng(-25.363882,131.044922);

  var marker = new google.maps.Marker({
      position: latLng,
      map: map,
      title: 'Uluru (Ayers Rock)'
  });
  
    google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });
  
  ////////////// end of create a marker ////////////////
  
  
  
  
  
  
  
  
}




google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>