<link rel='stylesheet' href='style.css' type="text/css" />

<?php
$pagetitle = "Form (simple)";

include 'config.php';
include 'connect.php';
include 'header.php';

print $header;
print "<div id='wrap'>";
print "<div id='form'>";

print "<h1> Log a trip! </h1>"; 

?>

<!-- ZIPCODE SEARCH -->
<head>
	<script type="text/javascript" src="jquery/js/jquery-1.4.2.min.js"></script> 
	<script type="text/javascript" src="jquery/js/jquery-ui-1.8.2.custom.min.js"></script> 
	<script type="text/javascript"> 
 
		jQuery(document).ready(function(){
			$('#zipsearch').autocomplete({source:'suggest_water.php', minLength:2});
		});
 
	</script> 
	<link rel="stylesheet" href="jquery/css/smoothness/jquery-ui-1.8.2.custom.css" /> 
	<style type="text/css"><!--
	
	        /* style the auto-complete response */
	        li.ui-menu-item { font-size:12px !important; }
	
	--></style> 
</head> 
 
<body> 
 
<form onsubmit="return false;"> 
	Enter a Zipcode:
	<input id="zipsearch" type="text" /> 
</form> 
