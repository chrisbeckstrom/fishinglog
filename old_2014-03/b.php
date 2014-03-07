<?php

// $a=array("a"=>"Dog","b"=>"Cat","c"=>"Horse");

$cities=array(
"Itasca"=>"http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/IL/Itasca.json",
"Batavia"=>"http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/IL/Batavia.json",
"Kalamazoo"=>"http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/MI/Kalamazoo.json",
"RockfordMI"=>"http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/MI/Rockford.json"
	);
				
 foreach($cities as $val) 
 	{
    $json_url = $val;
    print "The URL we're using now is $val";
	} 
	
	
$json_url = "http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/IL/Itasca.json";


/*
kalamazoo, mi
http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/MI/Kalamazoo.json

rockford, mi
http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/MI/Rockford.json

batavia
http://api.wunderground.com/api/681a9b949662ace6/geolookup/conditions/q/IL/Batavia.json
