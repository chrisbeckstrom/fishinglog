<html>
  <head>
  	
  	
 <? 
 include 'config/config.php';
 include 'config/connect.php';
 
$username = $_GET['username'];

 
 // go to the DB and get the number of each waterbody type
 	// RIVERS
 	$watertype = 'river';
		$watertypequery = mysql_query("
		SELECT COUNT(*) FROM trips WHERE watertype = '$watertype' AND username = '$username';");
		$watertypearray = mysql_fetch_array($watertypequery);
		$rivercount= $watertypearray['COUNT(*)'];
		
 	$watertype = 'creek';
		$watertypequery = mysql_query("
		SELECT COUNT(*) FROM trips WHERE watertype = '$watertype' AND username = '$username';");
		$watertypearray = mysql_fetch_array($watertypequery);
		$creekcount= $watertypearray['COUNT(*)'];
		
 	$watertype = 'lake';
		$watertypequery = mysql_query("
		SELECT COUNT(*) FROM trips WHERE watertype = '$watertype' AND username = '$username';");
		$watertypearray = mysql_fetch_array($watertypequery);
		$lakecount= $watertypearray['COUNT(*)'];
		
 	$watertype = 'pond';
		$watertypequery = mysql_query("
		SELECT COUNT(*) FROM trips WHERE watertype = '$watertype' AND username = '$username';");
		$watertypearray = mysql_fetch_array($watertypequery);
		$pondcount= $watertypearray['COUNT(*)'];

 
 ?>	
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Water type', 'Number of trips'],
          ['River',     <? print $rivercount ?>],
          ['Creek',      <? print $creekcount ?>],
          ['Pond',  <? print $pondcount ?>],
          ['Lake', <? print $lakecount ?>]
        ]);

        var options = {
          title: 'Water types', backgroundColor: 'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  
  <body>
    <div id="chart_div" style="width: 500px; height: 500px; background: transparent;"></div>
  </body>
</html>