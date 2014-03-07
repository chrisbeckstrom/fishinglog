<?php
// DISGUISE FUNCTION
// this function takes 1 input (a string) and replaces anything in brackets [ ] with ****
// the idea is to obscure waterbody names or other stuff users want to keep secret

// disguiseBrackets
// USAGE:
// $notes = disguiseBrackets($notes);

function disguiseBrackets($string)
{
	$regex = "/\[(.*?)\]/";
	preg_match_all($regex, $string, $matches);
	
	for($i = 0; $i < count($matches[1]); $i++)
	{
	    $match = $matches[1][$i];
	    $array = explode('~', $match);
	// $newValue = $array[0] . " - " . $array[1] . " - " . $array[2] . " - " . $array[3];
	$newValue = "<span class='blurry-text'>top secret</span>";
	$string = str_replace($matches[0][$i], $newValue, $string);
	}
		return $string;
}


// disguise
// USAGE:
// $notes = disguise($anything);

function disguise($input)
{
	$input = "<span class='blurry-text'>top secret</span>";
	return $input;
}

// disguiseWaterbody
// USAGE:
// $notes = disguise($nameofbodyofwater)

// function disguiseWaterbody($waterbodyinput)
// {
// 	$waterbodyinput = "<span class='blurry-text'>$watertype</span>";
// 	return $waterbodyinput;
// }

// highlight
function highlight($target,$sometext)
{
	$regex = "$something";
	preg_match_all($regex, $target, $matches);
	
	for($i = 0; $i < count($matches[1]); $i++)
	{
	    $match = $matches[1][$i];
	    $array = explode('~', $match);
	// $newValue = $array[0] . " - " . $array[1] . " - " . $array[2] . " - " . $array[3];
	$newValue = "<span class='highlight'>$target</span>";
	$sometext = str_replace($matches[0][$i], $newValue, $target);
	}
		return $sometext;
}

