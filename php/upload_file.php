<?php
// UPLOAD A FILE
// takes a file via POST form a form (originally upload.php) and uploads it
// also records the upload in the UPLOADS table of the database

session_start();
include '../config/config.php';
include '../config/connect.php';

$username = $_SESSION['myusername'];
$waterbodyid = $_POST['waterbodyid'];
$uploadtype = $_POST['uploadtype'];

if ($_POST['waterbodyid'] == '')
	{
		print "no waterbody id!";
		die;
	}
	
if ( $uploadtype == 'waterbody')
	{
		print "<!-- UPLOAD TYPE: WATERBODY -->";
		$prefix = "waterbody";
	}
	
print "the waterbodyid is: $waterbodyid<br>";

// the file extensions allowed
$allowedExts = array("kml", "KML", "kmz", "KMZ", "XML", "xml");

$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

// check the file to make sure it's ok to upload
if (($_FILES["file"]["size"] < 6144000)	// 20000 is 20kb.. 6144000 is 6mb..?
&& in_array($extension, $allowedExts))	// and the extension is allowed
  {
  // if it's ok...	
  if ($_FILES["file"]["error"] > 0)
    {
    // error!	
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    // show us information about what was just uploaded	
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      	// if the file exists, tell the user
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      	// if the original filename doesn't exist, whohoo! move it
      $newfilename = $prefix . "_" . $waterbodyid . "_" . $username . "." . $extension;
	  $uploadpath = "../uploads/";	// where we put the file when we're done
      move_uploaded_file($_FILES["file"]["tmp_name"], $uploadpath . $newfilename);
      echo "Stored in: " . $uploadpath . $newfilename;
      }
    }
	
	// document the upload in the UPLOADS table
	$original_filename = $_FILES["file"]["name"];
	$filename = $newfilename;
	$uploaded_to = $uploadpath;
	
	$insert_upload_query = "INSERT INTO uploads
							(username, original_filename, filename, uploaded_to, uploadtype, waterbody_id)
							VALUES
							('$username', '$original_filename', '$filename', '$uploaded_to', '$uploadtype', '$waterbodyid')";
							
	// show us the query
	print "<br> -------- THE SQL QUERY --------- <br><pre> $insert_upload_query </pre>";
	
	// Tell us the results
	if (!mysql_query($insert_upload_query,$con))
	  {
	  die('Error: ' . mysql_error());							// error message
	}

	mysql_close($con);
  }
else
  {
  // if it's NOT ok...	
  echo "Invalid file";
  }
?>