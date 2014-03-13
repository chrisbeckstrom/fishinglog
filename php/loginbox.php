top
<box class='login'>
<h1>Login</h1>
<tr>
<form class="loginform" name="loginform" method="post" action="php/checklogin.php">
<td>
<tr>
<h2><? print $message ?> </h2>
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