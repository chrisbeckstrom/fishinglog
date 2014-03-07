<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        margin: 0;
        padding: 0;
        height: 100%;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
var map;
function initialize() {
  var chicago = new google.maps.LatLng(41.875,-87.624)
  var mapOptions = {
    zoom: 8,
    center: chicago,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
      
  var myLatlng = new google.maps.LatLng(-25.363882,131.044922)
   var myLatlng2 = new google.maps.LatLng(-26.363882,130.044922)
  
   var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hello World!'
   });
   
  var marker = new google.maps.Marker({
  position: myLatlng2,
  map: map,
  title: 'Hello World2!'
   });
   
  // CTA LAYER variable 
  var ctaLayer = new google.maps.KmlLayer({
    url: 'http://cb.hopto.org/log/cta.kml'	// apparently this has to be a full URL, not a filepath
  });
  
  ctaLayer.setMap(map);
  
    // FOX LAYER variable 
  var foxLayer = new google.maps.KmlLayer({
    url: 'http://cb.hopto.org/log/kml/fox.kml'	// apparently this has to be a full URL, not a filepath
  });
  
  foxLayer.setMap(map);
  
   // BUCK CREEK layer variable 
  var buckLayer = new google.maps.KmlLayer({
    url: 'http://cb.hopto.org/log/buckcreek.kml'	// apparently this has to be a full URL, not a filepath
  });
  
  buckLayer.setMap(map);
  
  
      
  
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>