<?php

include 'config.php';
include 'connect.php';

?>
<head>
<script type="text/javascript" >
  
  var map;
  function initialize() {
  var myLatlng = new google.maps.LatLng(40.713956,-74.006653);

  var myOptions = {
     zoom: 8,
     center: myLatlng,
     mapTypeId: google.maps.MapTypeId.ROADMAP
     }
  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); 

  var marker = new google.maps.Marker({
  draggable: true,
  position: myLatlng, 
  map: map,
  title: "Your location"
  });

  google.maps.event.addListener(marker,'click',function(overlay,point){
     document.getElementById("latbox").value = lat();
     document.getElementById("lngbox").value = lng();
     });

}
</script> 

</head>
<html>
<body onload="initialize()">

  <div id="map_canvas" style="width:50%; height:50%"></div>

  <div id="latlong">
    <p>Latitude: <input size="20" type="text" id="latbox" name="lat" ></p>
    <p>Longitude: <input size="20" type="text" id="lngbox" name="lng" ></p>
  </div>

</body>
</html>