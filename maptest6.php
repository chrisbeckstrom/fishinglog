<!DOCTYPE html>
<html>
  <head>
    <title>Google Maps JavaScript API v3 Example: Styled MapTypes</title>
    <link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKgYN-19kduAW-dvjZADLJ48VEOV2PxP4&sensor=true"></script>
    <script>

      var map;
      //Latitude: 41.983, Longitude: -88.013
      var itasca = new google.maps.LatLng(41.983, -88.013);

      var MY_MAPTYPE_ID = 'waterez';

      function initialize() {

        var stylez = [
          {
            featureType: 'water',
            elementType: 'geometry.fill',
            stylers: [
              { hue: '#3333CC' },
              { saturation: 700 },
              { lightness: 0}
            ]
          },
          {
            featureType: 'water',
            elementType: 'labels',
            stylers: [
              { hue: '#FF0000' },
              { saturation: 700 },
              { lightness: 0}
            ]
          },
          {
            featureType: 'road',
            elementType: 'geometry',
            stylers: [
              { hue: 'white' },
              { saturation: 0 },
              { lightness: 0}
            ]
          }
        ];

        var mapOptions = {
          zoom: 12,
          center: itasca,
          mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
          },
          mapTypeId: MY_MAPTYPE_ID
        };

        map = new google.maps.Map(document.getElementById('map_canvas'),
            mapOptions);

        var styledMapOptions = {
          name: 'Waterz'
        };

        var jayzMapType = new google.maps.StyledMapType(stylez, styledMapOptions);

        map.mapTypes.set(MY_MAPTYPE_ID, jayzMapType);
      }
    </script>
  </head>
  <body onload="initialize()">
    <div id="map_canvas" style="width: 100%; height: 700px;"></div>
  </body>
</html>
