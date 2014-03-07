<box>
<h2>Upload a KML file</h2>
	<?
	session_start();
	
if (isset($_SESSION['myusername']))
	{
	// $waterbodyid = $_GET['waterbodyid'];

$username = $_SESSION['myusername'];
print "<!-- USERNAME = $username-->";

print "<!-- the waterbody id is: $waterbodyid<br> -->";
?>
<link rel="stylesheet" type="css/text/css" href="../css/style.css"/>

<form action="php/upload_file.php" method="post"
enctype="multipart/form-data" target="_blank">
<input class="fancybutton" type="file" name="file" id="file"><br>
<input type="hidden" name="waterbodyid" value="<?php echo $waterbodyid ?>">
<input type="hidden" name="uploadtype" value="waterbody"><br>
<input class="fancybutton" type="submit" name="submit" value="Submit">
</form>
</box>

<?
}
else {
	print "you gotta log in to do that!";
}