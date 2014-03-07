<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Google Maps JavaScript API v3 Example: Ground Overlays</title>
    <link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKgYN-19kduAW-dvjZADLJ48VEOV2PxP4&sensor=true"></script>
    <script>
      function initialize() {

        var newark = new google.maps.LatLng(40.740, -74.18);
        var imageBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(40.712216,-74.22655),
            new google.maps.LatLng(40.773941,-74.12544));

        var mapOptions = {
          zoom: 13,
          center: newark,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

        var oldmap = new google.maps.GroundOverlay(
            'https://www.lib.utexas.edu/maps/historical/newark_nj_1922.jpg',
            imageBounds);
        oldmap.setMap(map);
      }
    </script>
  </head>
  <body onload="initialize()">
    <div id="map_canvas" style="width: 100%; height: 700px;"></div>
  </body>
</html>
