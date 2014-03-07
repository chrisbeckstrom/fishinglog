<?php
session_start();
?>

<!-- Start iPhone -->
<!-- 
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<link rel="apple-touch-icon" href="iphone.png" />
<link media="only screen and (max-device-width: 800px)" href="mobile.css" type= "text/css" rel="stylesheet" />
 -->

<!-- End iPhone -->

<link rel='stylesheet' href='css/style.css' type='text/css' />

<?php

////// SETUP THE PAGE ////////////
include 'header.php';
// include 'footer.php';
include 'config/connect.php';

$username = $_SESSION['myusername'];

	// if you're adding another spot to a trip
	$newtripnumber = $_GET['tripnumber'];


// if there is no user logged in, redirect to login.php
if(!isset($_SESSION['myusername']))
	{
	print "You gotta log in to do that!";
	header( 'Location: login.php' );
	}


////// ABOUT THE TRIPNUMBER
//		If you're just logging one trip, i.e. going to log.php with no arguments, this script will
//		connect to the DB and figure out the number of this new trip
//		If you're adding another spot to AN EXISTING TRIP (i.e. form.php?tripnumber=9023) then the script
//		will use THAT as the tripnumber.
//		Each tripid is unique, but a any number of trips can have the same tripnumber
//		(you can fish more than one spot in a given trip)
////////////////////////////


// check if the TRIPNUMBER is set
	if(isset($_GET['tripnumber']))
		{
		// if the tripnumber is set via a URL argument...
		// get info to populate the fields
			$result = mysql_query("
			SELECT *
			FROM trips
			WHERE tripnumber = $tripnumber
			");
			
			// take the data and put it into an array
			$row = mysql_fetch_array($result);
			$tripdate = $row['date'];
				// convert tripdate into MM/DD/YYYY and auto-populate the date form
				$time = strtotime($tripdate);
				$newformat = date('m/d/Y',$time);
				$tripdate = $newformat;
				$date = $row['date'];

			$newtripnumber = $row['tripnumber'];
			$tripid = $row['tripid'];
		}
		else
		{
		// if the tripnumber is NOT set already.. figure out what it should be
		$result = mysql_query("				
		SELECT MAX(tripnumber) AS tripnumber FROM trips;
				");
		$row = mysql_fetch_array($result);
		$highesttripnumber = $row['tripnumber'];
		$newtripnumber = $highesttripnumber + 1;
		}
		
// SET THE STARTING MAP LOCATION BASED ON THE USER'S GPS
	$userhomequery = mysql_query("
	SELECT gps FROM users WHERE USERNAME = '$username';
		");
	// put into an array	
	$userhomearray = mysql_fetch_array($userhomequery);
	
	// save that into a variable
	$userhome = $userhomearray['gps'];
	
	//print "user home is $userhome";
	$userlatlon = explode(",", $userhome);

?>

<!DOCTYPE html>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>

	<!-- Google map stuff -->
	<!-- Dependencies: JQuery and GMaps API should be loaded first -->
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCKgYN-19kduAW-dvjZADLJ48VEOV2PxP4&sensor=false">
	</script>

	<!-- CSS and JS for our code -->
	<link rel="stylesheet" type="text/css" href="css/jquery-gmaps-latlon-picker.css"/>
	<script src="js/jquery-gmaps-latlon-picker.js"></script>
	
	<!-- Show and hide things - function - CB -->
	<script type="text/javascript">
	function toggle(element) {
		document.getElementById(element).style.display = (document.getElementById(element).style.display == "none") ? "" : "none";
	}
	</script>
	
<!-- AUTOCOMPLETE 7-25-2013 -->
	<?
	// FISH NAME SEARCH //
	$lookingfor = '';	// this might not need to be here...
	// query the database
	$fishnameresults = mysql_query("select fishbase_name from fish where fishbase_name like '%$lookingfor'")
													or die(mysql_error());
	$fancy = "[ ";
	while($row = mysql_fetch_array( $fishnameresults ))
		{
			// BUILD AN ARRAY FROM SCRATCH!
			// go through each result and append that result to what will be the array
			// what we want is [ "Result", "Result2", "Result3", ] and so on
			$fancy = $fancy . '"' . $row['fishbase_name'].'"'.',';
		}
		// finish up the array
		$fancy = $fancy . "]";
		// $fancy array is what populates the "fish name search"	
	?>
	
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css" />

	  
<script>
  // AUTOCOMPLETE FISH NAME function
  $(function() {
    var availableTags = <?php print $fancy	// THIS IS OUR ARRAY // ?>;
    
    // the .findfish lets any div with class='findfish' use this function
    $( ".findfish" ).autocomplete({
      source: availableTags
    });
  });
</script>
		
		<?  
						
		///////////////////////// GET STUFF FROM THE DB: waterbody search
		// get the results of the query
					$waterbodyresults = mysql_query("select name from waterbodies where name like '%$lookingfor%'")
																	or die(mysql_error());  
						
					$fancywater = "[ ";
					while($row = mysql_fetch_array( $waterbodyresults ))
						{
							// BUILD AN ARRAY FROM SCRATCH!
							// go through each result and append that result to what will be the array
							// what we want is [ "Result", "Result2", "Result3", ] and so on
							$fancywater = $fancywater . '"' . $row['name'].'"'.',';
						}
						// finish up the array
						$fancywater = $fancywater . "]";
						
		?>

					 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
					  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
					  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
					  <link rel="stylesheet" href="/resources/demos/style.css" />

					  
					
					  <script>
					  // FIND WATERBODIES FUNCTION //
					  $(function() {
					    var availableTags = <?php print $fancywater	// THIS IS OUR ARRAY // ?>;
					    
					    $( "#findwaterbodies" ).autocomplete({
					      source: availableTags
					    });
					  });
					  </script>
 
<!-- end AUTOCOMPLETE -->


<!-- building the form -->

</head>

<body>
<? print $header ?>
<div id='main'>
   
    <nav>nav</nav>
    

<article>
    	
<!-- this decides what happens when you submit the form -->
<form action="submit.php" method="get" target="_blank">


<!-- DATE -->
<box>
	<h1>Log a trip</h1>
</box>
<formbox>
	<h2>Basic info</h2>
			<!-- from http://jqueryui.com/datepicker/ -->
		  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
		  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
		  <link rel="stylesheet" href="/resources/demos/style.css" />
		  
		  <script>
		  // jQuery datepicker
		  $(function() {
		    $( "#datepicker" ).datepicker();
		  });
		  </script>
		 
		
		<formitem>
			
			date <input class='input' type="text" id="datepicker" name="date" required/><br>
		</formitem>

<br>
		<!-- time of day -->
		<formitem>Time of day
		<select class='input' name="timeofday">
		<option value="morning" selected>morning</option>
		<option value="noon">noon</option>
		<option value="afternoon" >afternoon</option>
		<option value="evening" >evening</option>
		<option value="night" >night</option>
		</select>
		<br>
		
		<!-- time fished (hours) -->
		<formitem>Time fished
		<input class='shortinput' type="text" class='input' name="time">
		<span class='smallinfo'>hours</span>
		</formitem>
		
		<!-- Tripnumber -->
		<formitem>
		<input class='seethrough' type="hidden" class='input' name="tripnumber" value="<? echo $newtripnumber ?>" readonly>
		</formitem>
		<br>
		
		<!-- 
		///////////////////////////////////////////////////////////////////////
		//	WATERBODY AUTOCOMPLETE
		///////////////////////////////////////////////////////////////////////
		 -->			
		<formitem>
		  <label for="findwaterbodies">Waterbody </label>
		  <input class='input' id="findwaterbodies" name="waterbody"/>
		</formitem>
	</formbox>
<!--
///////////////////////////////////////////////////////////////////////
//	GOOGLE MAP LAT/LON PICKER
///////////////////////////////////////////////////////////////////////
 MAP -->
 <formbox>
	<fieldset class="gllpLatlonPicker">
		<!-- 
		<input type="text" class="gllpSearchField">
		<input type="button" class="gllpSearchButton" value="search for a place"> -->
		
		<div class="gllpMap" style="width: auto; height: 500px">Google Maps</div>
		<br/>
		lat/lon:
			<input type="text" class="gllpLatitude" value="<?php print $userlatlon[0] ?>" name="lat"/>
			<input type="text" class="gllpLongitude" value="<?php print $userlatlon[1] ?>" name="lon"/>
		<!-- zoom: <input type="text" class="gllpZoom" value="3"/> -->
		<!-- <input type="button" class="gllpUpdateButton" value="update map"> -->
		<br/>
	</fieldset>
</formbox>
	
<!--
///////////////////////////////////////////////////////////////////////
//	THE REST OF THE FORM
///////////////////////////////////////////////////////////////////////
 -->
<formbox>
<h2>Gear</h2>
		<!-- Gear (fly/spin/both) radio buttons -->
		<formitem>
		<input class='checkbox' type="radio" name="gear" value="fly">Fly
		<input class='checkbox' type="radio" name="gear" value="spin">Spin
		<input class='checkbox' type="radio" name="gear" value="both">Both
		<input class='checkbox' type="radio" name="gear" value="baitcasting">Baitcasting
		<input class='checkbox' type="radio" name="gear" value="trolling">Trolling
		</formitem>
		
		<!-- Method (dropdown) -->
		<formitem>Method
		<select class='input' name="method">
		<option value="shore" selected>shore</option>
		<option value="wading">wading</option>
		<option value="boat" >boat</option>
		<option value="kayak" >kayak</option>
		<option value="canoe" >canoe</option>
		<option value="float_tube" >float tube</option>
		</select>
		</formitem>
		<br>

<h2>Water</h2>
		<!-- Water trype (dropdown) -->
		<formitem>Water type
		<select class='input' name="watertype">
		<option value="river" selected>river</option>
		<option value="creek">creek</option>
		<option value="pond" >pond</option>
		<option value="lake">lake</option>
		<option value="ocean">ocean</option>
		<option value="flats">saltwater flats</option>
		</select>
		</formitem>
		
		<!-- Water clarity (dropdown) -->
		<formitem>Water clarity
		<select class='input' name="watercolor">
		<option value="clear" selected>clear</option>
		<option value="stained">lightly stained</option>
		<option value="stained">stained</option>
		<option value="muddy" >muddy</option>
		</select>
		</formitem>
		<br>
		

<h2>Extra</h2>
		<!-- Adventure -->
		<formitem>Adventure score
		<select class='shortinput' name="adventure">
		<option value="0" selected>0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		</select>
		</formitem>
		
		<!-- Scenic -->
		<formitem>Scenic score
		<select class='shortinput' name="scenic">
		<option value="0" selected>0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		</select>
		</formitem>
		
		<!-- Ninja -->
		<formitem>Ninja score
		<select class='shortinput' name="ninja">
		<option value="0" selected>0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		</select>
		</formitem>
		<br>
		
<!--
///////////////////////////////////////////////////////////////////////
//	NOTES
///////////////////////////////////////////////////////////////////////
-->
<h2>Notes</h2>
	<!-- 
	<textarea style="width: 85%; height: 80px" name="notes" value="notes">
	</textarea>
	<p>
	 -->

<script type="text/javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
// TINY MCE editor
tinymce.init({
    selector: "textarea"
 });
</script>

<span class='smallinfo'>put your secret stuff in brackets</span>
<textarea style="width: 55%; height: 100px" name="notes" value="notes"></textarea>

<h2>Bait</h2>
		<!-- Best lures -->
		<formitem>Best lures
		<input class='input' type="text" name="lures" size="90">
		</formitem>
		<br>
		
		<!-- Lure image link-->
		<formitem>best lure image (URL)
		<input class='input' type="text" name="lureimage" size="90">
		<br>
		</formitem>
		<br>



<!--///////////////////////////////////////////////////////////////////////
//	THE CREEL - fish boxes
///////////////////////////////////////////////////////////////////////-->
<script type="text/javascript">
	// SHOW AND HIDE 'more boxes'
	// toggles the visibility of a id named 'id' 
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }
</script>

<h2>Creel</h2>
<!-- Right now we only have the option to choose a species and how many were caught...
	maybe it would be cool if we had the option to record each specific fish!
	that way we could record individual fish sizes and weights -->
<!-- <form action="submitfish.php" method="get" target="_blank"> -->
<span class='smallinfo'>kind of fish / number</span>
<table>
		<div id="newlink">
			  	<input class="findfish" id ="findfish" type="text" name="fishbox[]" value=""  size="50">
	 			<input class="input" type="number" name="fishcount[]" value=""  size="20">
		</div>
		
		<div id="newlink">
			<input class="findfish" id ="findfish" type="text" name="fishbox[]" value=""  size="50">
			<input class="input" type="number" name="fishcount[]" value=""  size="20">
		</div>
		
		<div id="newlink">
			<input class="findfish" id ="findfish" type="text" name="fishbox[]" value=""  size="50">
			<input class="input" type="number" name="fishcount[]" value=""  size="20">
		</div>
		
		<a onclick="toggle_visibility('more');">more boxes...</a>
		
		<div id="more" style="display:none">
		<div id="newlink">
			<input class="findfish" id ="findfish" type="text" name="fishbox[]" value=""  size="50">
			<input class="input" type="number" name="fishcount[]" value=""  size="20">
		</div>
		
		<div id="newlink">
			<input class="findfish" id ="findfish" type="text" name="fishbox[]" value=""  size="50">
			<input class="input" type="number" name="fishcount[]" value=""  size="20">
		</div>
		
		<div id="newlink">
			<input class="findfish" id ="findfish" type="text" name="fishbox[]" value=""  size="50">
			<input class="input" type="number" name="fishcount[]" value=""  size="20">
		</div>
		
		<div id="newlink">
			<input class="findfish" id ="findfish" type="text" name="fishbox[]" value=""  size="50">
			<input class="input" type="number" name="fishcount[]" value=""  size="20">
		</div>
		
		<div id="newlink">
			<input class="findfish" id ="findfish" type="text" name="fishbox[]" value=""  size="50">
			<input class="input" type="number" name="fishcount[]" value=""  size="20">
		</div>
		
		<div id="newlink">
			<input class="findfish" id ="findfish" type="text" name="fishbox[]" value=""  size="50">
			<input class="input" type="number" name="fishcount[]" value=""  size="20">
		</div>
		
		<div id="newlink">
			<input class="findfish" id ="findfish" type="text" name="fishbox[]" value=""  size="50">
			<input class="input" type="number" name="fishcount[]" value=""  size="20">
		</div>
		
		<div id="newlink">
			<input class="findfish" id ="findfish" type="text" name="fishbox[]" value=""  size="50">
			<input class="input" type="number" name="fishcount[]" value=""  size="20">
		</div>
		
		</div>
		

	</td>
</tr>
</table>

	
<!-- PRIVACY -->
<h2>Privacy</h2>
		<span class='smallinfo'>who can see this trip?</span><br>
		<!-- Privacy -->
		<select class='input' name="privacy">
		<option value="0" selected>0 - Public</option>
		<option value="1">1 - Users only</option>
		<option value="2" >2 - Friends only</option>
		<option value="3">3 - Private</option>
		</select>
		</formitem>

<!-- SUBMIT BUTTON -->
<center>

<input class="fancybutton" type="submit" value="log a trip!" name="submit">
</formbox>
</center>
</form>

<?

?>
	
</body>
</html>
