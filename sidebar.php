<?php

// SIDEBAR
// this goes on the side of the page.. on every page!
?>
<box>
		<h3>Search</h3>
		<form action="trips.php" method="get">
		<input class='longinput' type="text" name="q">
		<input type="submit" value="search trips" name="submit">
		<input type="checkbox" name="show_query">
		<small>show query</small>
		</form>
	</box>
	
	<?php
	
///// IF THERE IS A USER LOGGED IN ////
if(isset($_SESSION['myusername']))
	{			// logged in
		print "<box>
		<a href='user.php?username=$username'><img class='circular' src='$useravatarurl'  height='50' width='50'></a>
		<h3>Your score</h3>
    	8928837 points
    	</box>";
	
		print "<box>";
		print "current user is " . $_SESSION['myusername'] . "<br>";
		include 'recenttrips.php';
		print "</box>";
	}
	else		// IF NO USER LOGGED IN
	{
	?>
	<box>
		<h3>Login</h3>
		<tr>
		<form class="loginform" name="loginform" method="post" action="php/checklogin.php">
		<td>
		<tr>
		<b></b>
		<td width="294"><input name="myusername" type="text" id="myusername" placeholder="username" required></td>
		</tr>
		<tr>
		<td></td>
		<br>
		<td><input name="mypassword" type="password" id="mypassword" placeholder="password" required></td>
		</tr>
		<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><br><input class="fancybutton" type="submit" name="Submit" value="login!"></td>
		</tr>
		</table>
		</td>
		</form>
		</tr>
		</table>
	</box>
<?
	}
?>
