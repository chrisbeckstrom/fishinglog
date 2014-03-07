<?php
function disguise($string)
{
	$regex = "/\[(.*?)\]/";
	preg_match_all($regex, $string, $matches);
	
	for($i = 0; $i < count($matches[1]); $i++)
	{
	    $match = $matches[1][$i];
	    $array = explode('~', $match);
	// $newValue = $array[0] . " - " . $array[1] . " - " . $array[2] . " - " . $array[3];
	$newValue = '*****';
	$string = str_replace($matches[0][$i], $newValue, $string);
	return $string;
	}
}

// USAGE:
// $notes = disguise($notes);

$notes = 'here are some notes about the [rogue river]';

print "<br> notes: $notes <br>";

$notes = disguise($notes);

print "notes: $notes";

// $inputtext = "I like to fish the [Rogue River]";
// print "input: $inputtext";
// $inputtext = disguiseWaters($inputtext);
// print "<br>output: $inputtext<br>";


