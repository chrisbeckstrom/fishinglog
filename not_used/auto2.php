<!doctype html>

<?

$lookingfor = '';

//$q = "SELECT blah1, blah2, blah3 WHERE blah4=$num";

include 'config/config.php';
include 'config/connect.php';


///////////////////////// GET STUFF FROM THE DB: fish name search
// get the results of the query
			$fishnameresults = mysql_query("select fishbase_name from fish where (fishbase_name like '%$lookingfor%' 
															or species like '%$lookingfor%'
															or name like '%$lookingfor%')")
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
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>jQuery UI Autocomplete - Default functionality</title>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  
  <script>
  // FIND FISH FUNCTION //
  $(function() {
    var availableTags = <?php print $fancy	// THIS IS OUR ARRAY // ?>;
    
    $( "#findfish" ).autocomplete({
      source: availableTags
    });
  });
  </script>
  

  <script>
  // FIND WATERBODIES FUNCTION //
  $(function() {
    var availableTags = <?php print $fancywater	// THIS IS OUR ARRAY // ?>;
    
    $( "#findwaterbodies" ).autocomplete({
      source: availableTags
    });
  });
  </script>
 
  
</head>

<body>
 
<div class="ui-widget">
  <label for="findfish">Find fish </label>
  <input id="findfish" />
</div>
<br>

<div class="ui-widget">
  <label for="findwaterbodies">Find waterbodies </label>
  <input id="findwaterbodies" />
</div>

 
</body>
</html>