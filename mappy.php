<?php

print "<HR> <h1>Add lat and long! </h1><br>";

include 'php-form-builder-class/class.form.php';
session_start();	// this needs to be here to prevent errors

///////////////////////// FORM STUFF ///////////////////////////////////
$form = new form("googlemaps_0", 500);
	
	// This sets the arrangement of boxes and whatnot
	// $form->setAttributes(array(
	//     "map" => array(3, 1, 1, 2, 3)));
	
	$form->setAttributes(array(
		"jsincludesPath" => 'php-form-builder-class/includes'));
	
	if(!empty($_GET["errormsg_0"]))
		$form->errorMsg = filter_var($_GET["errormsg_0"], FILTER_SANITIZE_SPECIAL_CHARS);
	 
	$form->addHidden("cmd", "submit_0");

////////////////////////// FORM ///////////////////////////////////////

	// MAP - lat and long - google map lat/lon chooser
	$form->addLatLng("", "lat_plus_long", array(41.983, -88.013), array( "style" => "width: 100%", "height" => 500, "width" => 999, "zoom" => 15));
	
	// TRIPID
	// $form->addTextbox("tripid", "tripid", "$tripid");
	
	?>
	<label>Water type:</label>
<select name="watertype">
  <option value="pond">pond</option>
  <option value="creek">creek</option>
  <option value="river">river</option>
  <option value="lake">lake</option>
  <option value="ocean">ocean</option>
  <option value="flats">flats</option>
</select> 
<br>
	
	<?php

///////////////////////// CLEANING /////////////////////////////////////
// CLEAN LATITUDE AND LONGITUDE
	$dirty = "$_POST[lat_plus_long]";
	$badwords = array("Latitude: ", "Longitude: "); 
	$clean = str_replace($badwords, "", $dirty );
	
	$data = $clean;
	list($lat, $lon) = explode(", ", $data);
	print "</div>";

///////////////////////// SUBMIT THE FORM ///////////////////////////////
	$form->addButton("submit");
	$form->render();
	
	




?>
