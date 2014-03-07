<?php
// this script either hidesthings or showsthings based on privacy settings

////////////////////////////PRIVACY SETTINGS ////////////////////////////	
/////////////////////////// FIGURE OUT WHICH THINGS TO HIDE //////////////	
	// privacy of this current trip
	$privacy = $row['private'];
	
	//print "PRIVACY = $privacy <br>";
	//print "<b> 0 = public, 1 = users, 2 = friends, 3 = private <br></b>";
	
	// if privacy is TOTALLY private (4)
	if 	( $privacy == '3' )
		{
		//print "PRIVACY = 3, showing stuff ONLY to the tripusername $tripusername <br>";
		
			if ( $_SESSION['myusername'] == $tripusername )
				{
				//print "session name matches $tripusername 0 don't hide things! <br>";
				$hidethings = 0;
				$hidespots = 0;
				}
				else
				{
				$hidethings = 1;
				$hidespots = 1;
				}
		}
		
	// if privacy is none (0)
	if 	( $privacy == '0' )
		{
		//print "PRIVACY = 0, showing EVERYTHING to EVERYONE <br>";
		$hidethings = 0;
		$hidespots = 0;
		}
		
	// if privacy is set to JUST USERS (2)
	if 	( $privacy == '1' )
		{
		//print "PRIVACY = 1, if there is a user logged in, showing EVERYTHING <br>";
		// if there is no user logged in, redirect to login.php
			if(!isset($_SESSION['myusername']))
				{
				//print "NO USER CURRENTLY LOGGED IN <br>";
				$hidethings = 1;
				$hidespots = 1;
				}
			else
				{
				$hidethings = 0;
				$hidespots = 0;
				}
		}
		
		
	// if privacy is set to friends (3)
	if ( $privacy == '2' )
		{
		//print "PRIVACY = 2 - we want to show things just to friends of $tripusername <br>";
			// get a comma-delimited list of $currentusername's friends
			
			$friendsquery = "SELECT friends FROM users WHERE username = '" . $_SESSION['myusername'] . "'";
			//print "query is: <pre>$friendsquery</pre>";	
			$friendsresults = mysql_query($friendsquery);
			$friendsrow = mysql_fetch_array($friendsresults);
			
			//print "$tripusername's friends are: " . $friendsrow[0] . "<br>";
			
			// make that into an array
			$friendsarray = explode(',', $friendsrow[0]); //split string into array separated by ','

			
			// if $currentusername's list of friends ($friendsarray) includes $tripusername, show us everything
			//print "current user is: $currentuser<br>";
				if (in_array($tripusername, $friendsarray)) 
					{
    				//echo "$currentuser (YOU) are friends with $tripusername<br>";
    				$hidethings = 0;
    				$hidespots = 0;
					}
					else
					{
					//print "$currentuser is not one of $tripusername's friends<br>";
					$hidethings = 1;
					$hidespots = 1;
					}
		}
		
	// make sure that the user can see their own stuff, regardless of everything above
	if ($tripusername == $currentuser)
		{
		$hidethings = 0;
		$hidespots = 0;
		}
		
//////////////// END OF PRIVACY STUFF ///////////////////	




?>