<?php

// Works as of PHP 4.3.0
//set_include_path('/home/chrisbeckstrom/cbfishes.com/log');	// unnecessary

/* $form->setAttributes(array(
    "jsincludesPath" => 'php-form-builder-class/includes' 
*/

$var = "Christopher";
$var2 = str_replace("i", "ooooo", $var );
print $var2;

// testing that the include path works
// include 'a.php';
// include 'more/b.php';

include 'php-form-builder-class/class.form.php';
	session_start();									// this needs to be here to prevent errors

$form = new form("googlemaps_0", 500);

$form->setAttributes(array(
    "jsincludesPath" => 'php-form-builder-class/includes'
));

if(!empty($_GET["errormsg_0"]))
    $form->errorMsg = filter_var($_GET["errormsg_0"], FILTER_SANITIZE_SPECIAL_CHARS);

$form->addHidden("cmd", "submit_0");
$form->addLatLng("Latitude/Longitude:", "lat_plus_long");
$form->addButton();
$form->render();


// CLEAN UP LAT / LONG
$dirty = "$_POST[lat_plus_long]";
$badwords = array("Latitude: ", "Longitude: ");
$clean = str_replace($badwords, "", $dirty );
print $clean;

$data = $clean;
list($lat, $long) = explode(", ", $data);
print "<br>$lat <br>";
print "$long <br>";

?>
