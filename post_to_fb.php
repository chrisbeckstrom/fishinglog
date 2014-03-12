<?php
  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
  require_once('facebook_sdk/src/facebook.php');

  $config = array(
    'appId' => '476877392396581',
    'secret' => '234e3ae2cf165b7d3dbde85c41630162',
    'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
  );

  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
?>
<html>
  <head></head>
  <body>

  <?php
  		
  		$logthis = "\n---- starting post_to_fb.php -----";
		fwrite($fh, $logthis);
		
  	// FACEBOOK POSTING
  		
  		// LINK: where should the link lead?
  		// http://cb.hopto.org/log/viewtrip.php?tripnumber=455
  		$fblink = 'cb.hopto.org/log/viewtrip.php?tripnumber=' . $tripnumber;
  		
  		//message: what is the content of the message?
  		//$fbmessage = "this is a test message via php";
  		$fbmessage = $_SESSION[myusername] . " logged a fishing trip";
  	

  
    if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {
        $ret_obj = $facebook->api('/me/feed', 'POST',
                                    array(
                                      'link' => $fblink,
                                      'message' => $fbmessage
                                 ));
        echo '<pre>Post ID: ' . $ret_obj['id'] . '</pre>';
        print "fblink: $fblink, message: $fbmessage<br>";
        		
        		$logthis = "\n post to facebook:
        					\n link: $fblink
        					\n message: $fbmessage";
				fwrite($fh, $logthis);

        // Give the user a logout link 
        echo '<br /><a href="' . $facebook->getLogoutUrl() . '">logout</a>';
      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
        $login_url = $facebook->getLoginUrl( array(
                       'scope' => 'publish_stream'
                       )); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      // No user, so print a link for the user to login
      // To post to a user's wall, we need publish_stream permission
      // We'll use the current URL as the redirect_uri, so we don't
      // need to specify it here.
      $login_url = $facebook->getLoginUrl( array( 'scope' => 'publish_stream' ) );
      echo 'Please <a href="' . $login_url . '">login.</a>';

    } 

  ?>      

  </body> 
</html>  