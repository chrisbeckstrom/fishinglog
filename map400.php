
<html>

	<head>

	<script type='text/javascript' src='jquery-1.6.2.min.js'></script>

	<script type='text/javascript' src='jquery-ui-1.8.14.custom.min.js'></script>

	<style>



		BODY {font-family : Verdana,Arial,Helvetica,sans-serif; color: #000000; font-size : 13px ; }

		

		#map_canvas { width:100%; height: 100%; z-index: 0; }

	</style>

	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false" /></script>

	<script type='text/javascript'>

	

	jQuery(document).ready( function($){

	

		//Get data, and replace it on the form

		var geocoder;

		var map;

		var markersArray = [];

		var infos = [];



		geocoder = new google.maps.Geocoder();

		var myOptions = {

			  zoom: 9,

			  mapTypeId: google.maps.MapTypeId.ROADMAP

			}

		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

		

		var bounds = new google.maps.LatLngBounds();

		var encodedString;

		var stringArray = [];

		encodedString = document.getElementById("encodedString").value;

		stringArray = encodedString.split("****");

		

		var x;

		for (x = 0; x < stringArray.length; x = x + 1)

		{

			var addressDetails = [];

			var marker;

			addressDetails = stringArray[x].split("&&&");

			

			var lat = new google.maps.LatLng(addressDetails[1], addressDetails[2]);

			//alert(image + " " + addressDetails[1] );

			marker = new google.maps.Marker({ 

				map: map, 

				position: lat,

				content: addressDetails[0]

			});

			markersArray.push(marker);

			google.maps.event.addListener( marker, 'click', function () {

				closeInfos();

				var info = new google.maps.InfoWindow({content: this.content});

				// where I have added .html to the marker object.

				//infowindow.setContent( marker.html);

				info.open(map,this);

				infos[0]=info;

			});

			bounds.extend(lat);

		}



		map.fitBounds(bounds);

				

		

		function closeInfos(){

	   if(infos.length > 0){

		  infos[0].set("marker",null);

		  infos[0].close();

		  infos.length = 0;

	   }

}



	});

	</script>





	</head>

	<body>

	<div id='input'>

	

				

		<input type="hidden" id="encodedString" name="encodedString" value="<p class='content'><b>Lat:</b> 40.0126385<br><b>Long:</b> -83.0307670<br><b>Name: </b>Ohio State University - Columbus Campus<br><b>Address: </b>The Ohio State University, 1739 N High St, Columbus, OH 43210, USA<br><b>Division: </b>Leaders</p>&&&40.0126385&&&-83.0307670****<p class='content'><b>Lat:</b> 40.0985023<br><b>Long:</b> -88.2290783<br><b>Name: </b>University of Illinois at Urbana–Champaign<br><b>Address: </b>University of Illinois - Financial Assistance, 601 E John St, Champaign, IL 61820-5711, USA<br><b>Division: </b>Leaders</p>&&&40.0985023&&&-88.2290783****<p class='content'><b>Lat:</b> 39.1700149<br><b>Long:</b> -86.5148133<br><b>Name: </b>Indiana University<br><b>Address: </b>Indiana University, 107 S Indiana Ave, Bloomington, IN 47405, USA<br><b>Division: </b>Leaders</p>&&&39.1700149&&&-86.5148133****<p class='content'><b>Lat:</b> 41.6629213<br><b>Long:</b> -91.5620347<br><b>Name: </b>University of Iowa<br><b>Address: </b>The University of Iowa, 107 Calvin Hall, Iowa City, IA 52242-1315, USA<br><b>Division: </b>Legends</p>&&&41.6629213&&&-91.5620347****<p class='content'><b>Lat:</b> 42.2993573<br><b>Long:</b> -83.7029564<br><b>Name: </b>University of Michigan<br><b>Address: </b>University of Michigan, North Campus Research Complex, 1600 Huron Pkwy, Ann Arbor, MI 48105-2590, USA<br><b>Division: </b>Legends</p>&&&42.2993573&&&-83.7029564****<p class='content'><b>Lat:</b> 42.7033214<br><b>Long:</b> -84.4843604<br><b>Name: </b>Michigan State University<br><b>Address: </b>Michigan State University, 1407 S Harrison Rd, East Lansing, MI 48823, USA<br><b>Division: </b>Legends</p>&&&42.7033214&&&-84.4843604****<p class='content'><b>Lat:</b> 44.9757740<br><b>Long:</b> -93.2326840<br><b>Name: </b>University of Minnesota, Twin Cities<br><b>Address: </b>University of Minnesota, University of Minnesota - Minneapolis, 80 Church St SE, Minneapolis, MN 55455, USA<br><b>Division: </b>legends</p>&&&44.9757740&&&-93.2326840****<p class='content'><b>Lat:</b> 40.8224674<br><b>Long:</b> -96.6985681<br><b>Name: </b>University of University of Nebraska–Lincoln<br><b>Address: </b>University of Nebraska, 1100 Seaton Hall, Lincoln, NE 68588, USA<br><b>Division: </b>legends</p>&&&40.8224674&&&-96.6985681****<p class='content'><b>Lat:</b> 42.0571909<br><b>Long:</b> -87.6753726<br><b>Name: </b>Northwestern University<br><b>Address: </b>Northwestern University, 600 Emerson St, Evanston, IL 60201-3810, USA<br><b>Division: </b>Legends</p>&&&42.0571909&&&-87.6753726****<p class='content'><b>Lat:</b> 40.7933949<br><b>Long:</b> -77.8600012<br><b>Name: </b>Pennsylvania State University<br><b>Address: </b>State College, PA, USA<br><b>Division: </b>Leaders</p>&&&40.7933949&&&-77.8600012****<p class='content'><b>Lat:</b> 40.4143581<br><b>Long:</b> -86.9352333<br><b>Name: </b>Purdue University<br><b>Address: </b>Hangar 6 (LAF), Lafayette, IN 47906, USA<br><b>Division: </b>Leaders</p>&&&40.4143581&&&-86.9352333****<p class='content'><b>Lat:</b> 43.0836160<br><b>Long:</b> -89.4292945<br><b>Name: </b>University of Wisconsin–Madison<br><b>Address: </b>University of Wisconsin, 1300 University Ave, Madison, WI 53706, USA<br><b>Division: </b>Leaders</p>&&&43.0836160&&&-89.4292945" />

	</div>

	<div id="map_canvas"></div>

	</body>

</html>