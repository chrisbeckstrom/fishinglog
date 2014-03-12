<?php
session_start();
/*
This is the TRIPS page-
which gives a list of all the trips

*/
include 'config/config.php';
include 'config/connect.php';
include 'header.php';
include 'php/disguise.php';

?>
<link rel='stylesheet' href='css/style.css' type="text/css" />


<?php
//////// SET UP THE PAGE ////////////
$pagetitle = "Activity";
$url = 'trips.php';
$username = $_SESSION['myusername'];



/////// GET INFORMATION FROM _GET[$variable] ////
// get the trip_id from GET.. otherwise...
$tripnumberid = $_GET["tripnumber"];

// get a search item
$search_query = $_GET["q"];

// get the "show_query" value
$show_query = $_GET["show_query"];

// get a limit as an argument...
$limit = $_GET['limit'];

// find out what user to show
$user_to_show = $_GET['user'];



///// HEADER /////////
print $header;
	
	

// FOR DEBUGGING: print the whole array we got from MYSQL
//print_r($row);
?>

<div id='main'>
	<nav>nav
	</nav>
    
    <aside>
    
    <?php include 'sidebar.php'; ?>
	</aside>
		
	<article>
	
	
<script type="text/javascript">
	// SHOW AND HIDE 'more boxes'
	// toggles the visibility of a id named 'id' 
    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'none';
    }
</script>

		
		<div id="message">
		<messagebox>
		<?php print "Welcome!"; ?><br>
		<a onclick="toggle_visibility('message');"><small>close</small></a>
		</messagebox>
		</div>
	
<?
print "<box><h1>$pagetitle</h1>";

/////////////////// SEARCH FOR TRIPS FORM ///////////
?>
<!-- 
<form action="trips.php" method="get">

<input class='longinput' type="text" name="q">
<input type="submit" value="search trips" name="submit">
<input type="checkbox" name="show_query">
<small>show query</small>
</form>
 -->

<?
/////////// END FORM ////////////////////////////////


////////// SMALL INFO about the query etc ////////////
print "<small>";
// if there is no limit as an argument, make it 10 by default
if(isset($_GET['limit']))
	{
$limit = $_GET['limit'];
print "<i>limit set! showing $limit most recent</i><br><br>";
	}
else
	{
		$limit = 25;	
		//print "<i>no limit set: showing $limit most recent</i><br><br>";
	}


	//// select how many trips to view /////
print " show <a href='trips.php?limit=10'>10 most recent</a> - 
		<a href='trips.php?limit=20'>20 most recent</a> - 
		<a href='trips.php?limit=100'>100 most recent -</a>
		<a href='trips.php?limit=10000'>all</a>
</small>
		";
		
////////////////////////////////////////////////////////////////
//////////// SEARCH QUERY ///////////////////		
// If a search query, add that to the DB query
if(isset($_GET['q']))
	{
	print "<small><br>searching for '$search_query'</i>";
	$search = "WHERE (notes LIKE '%$search_query%' 
			OR waterbody LIKE '%$search_query%'
			OR lures LIKE '%$search_query%'
			OR username LIKE '%$search_query%'
			OR state LIKE '%$search_query%'
			OR conds LIKE '%$search_query%')
			";
	}
	else
	{
	$search = "";
	}

	$query = "
	SELECT * FROM trips $search ORDER BY date DESC
	LIMIT $limit";	


	// show the actual sql query?
	if ( $show_query == 'on' )
		{
	print "<pre>$query</pre>";
		}
	
	// track how long the search takes...
	$starttime = microtime(true);
	
	//Do your query and stuff here
	$result = mysql_query($query);
	
	$endtime = microtime(true);
	$duration = $endtime - $starttime; //calculates total time taken
	$rest = substr($duration, 0, -12);  // returns "abcde"
	
	
	$number_of_results = mysql_num_rows($result);
	
	
	print "<br><small>found $number_of_results results in $rest seconds:</small></small><br><br>";
	print "</span></box>";
			
	// take the data and put it into an array
	//$row = mysql_fetch_array($result);


	//print "<box>"; // the box that has all the trips in it

// get all the variables
while($row = mysql_fetch_array($result))
	{
	print "<box>";
	// get fish caught information
				//print "FISH CAUGHT INFO!<br>";
				$tripnumber = $row['tripnumber'];	
				$catchquery = "SELECT * FROM fishcaught WHERE tripnumber = '$tripnumber'";
		
				//print "catchquery is <pre>$catchquery</pre><br>";					
				$catchresults = mysql_query($catchquery);
				//print "catchresults is $catchresults";
				$number_of_fish_rows = mysql_num_rows($catchresults);
				//print "total fish caught: $number_of_fish_rows<br>";
				$fishcaught = $number_of_fish_rows;
				while($catchresultsarray = mysql_fetch_array($catchresults))
					{
					$fishID = $catchresultsarray['fishID'];
					//print "caught 1 fish: fishID = $fishID<br>";
					}	

	include 'php/tripinfo-short.php';
	print "</box>";
	}
	
if (!mysql_query($sql,$con))
  {
  //die('Error: ' . mysql_error());							// error message
	}


	//print "</box>"; // the end of the box that has all the trips in it
print "</article>";
print "<br><br>";
print "</div>";

// FOOTER
print "<footer>here's the footer</footer>";

?>
<head>
	<title>
	<?php print "Trips | $sitename"; ?>
</title>
<?
