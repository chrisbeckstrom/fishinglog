<?php
// set include path (the root level of the Twitter-PHP folder)
set_include_path('/home/chrisbeckstrom/cbfishes.com/log/');
require_once 'twitter.class.php';
include 'creds.php';

// comment this out if you want to send $tweettext to this page
//$tweettext = "testing";

// ENTER HERE YOUR CREDENTIALS (see readme.txt)
$twitter = new Twitter($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
$status = $twitter->send($tweettext);

echo $status ? 'OK' : 'ERROR';
