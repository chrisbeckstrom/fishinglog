<?php

// here we want to send the article to twitter  
require_once('twitteroauth-master/twitteroauth/twitteroauth.php');  

// Twitter Connection Data  
$tConsumerKey       = 'gepkPfUyyBpg1FNTwZXEA';  
$tConsumerSecret    = 'viDEHSHrKADIL0AikQpWjpDWEsG91vUQQgrhoPhw0';  
$tAccessToken       = '365039001-txwwFxi56h9N69mbqdvciP4zH0MQEESmdc2p54VB';  
$tAccessTokenSecret = 'zSQ655MtiVSSLj2lZBwtZ2GrXP5FJWVdfbKT4MiI0dQ';  
  
// start connection  
$tweet = new TwitterOAuth($tConsumerKey, $tConsumerSecret, $tAccessToken, $tAccessTokenSecret);  
  
// the message  
$message = "This is a test tweet via a PHP script.. nothing to see here";  
  
// send to twitter  
$msg = $tweet->post('statuses/update', array('status' => $message));  
    
    
?>