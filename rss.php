<?php  
// RSS Feed Creator for CB's Fishing Log
// originally from
// http://www.supadupawebdesign.co.uk/tutorials/PHP-1/Easy-Dynamic-RSS-Feed-in-PHPMySQL-11
// heavily modified by CB
//////////////////////////////////////

////// ABOUT THIS FEED ///////////
// This feed is a feed for ALL USERS of the fishing log
// if we want to make a feed for just a single user, we should add that to the query somehow
//////////////////////////////////

error_reporting(0);

// connect to the DB
include 'config/config.php';
include 'config/connect.php';

// create the syntax of an RSS file
header('Content-Type: text/xml');  

echo '<?xml version="1.0" encoding="ISO-8859-1"?>  
<rss version="2.0">  
<channel>  
<title>CB\'s Fishing Log (all users)</title>  
<description>An RSS feed of the most recent fishing adventures on CB\'s Fishing Log </description>  
<link>http://cbfishes.com/log/index.php</link>';

// run a query
$get_articles = "SELECT *
				FROM trips 
				WHERE private = 0
				ORDER BY date 
				DESC 
				LIMIT 999";  
	  
// error?
$articles = mysql_query($get_articles) or die(mysql_error());  
  
// list out the results into an RSS feed
while ($article = mysql_fetch_array($articles)){  
	$watertype = ucfirst($article[watertype]);
	$fishcaught = ucfirst($article[fishcaught]);
	if ( $fishcaught == 0 )
		{
		$results = 'skunked';
		}
		else
		{
		$results = 'fish caught: ' . $fishcaught;
		}
		
        
    echo "  
       <item>  
          <title>$watertype $article[date] - $results</title>  
          <description><![CDATA[  
          $article[notes]  
          ]]></description>  
          <link>http://cbfishes.com/log/viewtrip.php?tripnumber=$article[tripnumber]</link>  
          <pubDate>$article[date]</pubDate>  
          <fishcaught>$article[fishcaught]</fishcaught>
          <lures>$article[lures]</lures>
      </item>";  
}  
echo '</channel>  
</rss>';  
?>  