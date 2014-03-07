<?

$waterbodyname = "Some lake";
$url = "water.php?name=" . $waterbodyname;
$spacesurl = "http://cbfishes.com/log/" . "$url";
$fullurl = "http://cbfishes.com/log/water.php?name=Some+lake";
print "The full url is $fullurl <br>
here's a link: <br>
<a href='$fullurl'>link</a>";

$fullurl = Str_replace(" ","+", $spacesurl); 

print "the str replaced uRL is <br>
$fullurl";

// call the ADD TO FEED FUNCTION
//addtofeed($username, 'waterbody_add', $url, $waterbodyname);

// create a tweet that makes sense
// cbfishes just added Some Lake to CB's Fishing log: FULLURL #cbsfishinglog
// "$username just added a new $waterbodyname to CB's Fishing log! $url #cbsfishinglog"

// send this to twitter!
$tweettext = "$username just added $waterbodyname to CB's Fishing log: $fullurl #cbsfishinglog";

print "<hr>
	the tweettext is: $tweettext";