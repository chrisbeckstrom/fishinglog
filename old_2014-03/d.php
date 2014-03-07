<?php

$string = file_get_contents("http://waterservices.usgs.gov/nwis/iv/?format=json&sites=01646500&parameterCd=00060,00065");
$json_parsed=json_decode($string,true);

print_r($json_parsed);


?>