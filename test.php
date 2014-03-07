<?php
print "<hr> removing characters<br>";

$_POST[$bowfin] = "10 bowfins <br>";
print "<br>$bowfin<br>";

function removeletters($input)
{
$output = ereg_replace("[^0-9]", "", $input );
print $output;
$_POST[$input] = $output;
}

print "<hr>";

$_POST[$crappie] = "16 crappies";
print "The \$crappie variable is $_POST[$crappie]<br>";


function justnumbers($input)
{
$output = ereg_replace("[^0-9]", "", $input );
print "<br> the result is $output <br>";
}

$fishy = "67 largemouth bass";
justnumbers($fishy);



print "<hr>";
// simulating a list of fish caught
//$string = "10 bluegills, 2 largemouth bass, 1 rock bass, 1 redeye bass, 3 carp";


print "Here's what we grabbed from the input:<br>";
// Will take up to 10 types of fish caught
print $array[0];
print $array[1];
print $array[2];
print $array[3];
print $array[4];
print $array[5];
print $array[6];
print $array[7];
print $array[8];
print $array[9];

print "<br> THE ARRAY:";
print $array[4];

print "<hr>";
////////////////////////////////

// to access $GLOBAL variables, create them first here:
$bluegill = "undefined";	// just testing
$largemouth = "undefined";
$carp = "also undefined";

// CREATE THE 'MENTIONSFISH' FUNCTION
//	takes user input: a list of #'s of fish caught and the species
// i.e. 89 bluegills
//	identifies which of those variables[?] is the "bluegill" one or the "carp" one
// 		syntax:
//		mentions(string,word_youre_looking_for)

/*
switch (n)
{
case label1:
  code to be executed if n=label1;
  break;
case label2:
  code to be executed if n=label2;
  break;
default:
  code to be executed if n is different from both label1 and label2;
} 
*/

function mentionsfish($words)
{
	$inputfish="bluegill";
		if (strpos($words,$inputfish))
		{
				$GLOBALS[$inputfish] = $words;
		}

}

// ARRAY
print "<HR><BR> THIS IS THE ARRAY LOOP";




//print $x;

function findfish($x)
{foreach ($x as $value)
  {
  //echo $value . "<br>";
  		
  		$inputfish = "bluegill";
		if (strpos($value,$inputfish))
		{
				print "Hey I found a $inputfish in $value: <br>"; 
				$GLOBALS[$inputfish] = $value;
				print $GLOBALS[$inputfish];
		}
		else
		{
				print "didn't find any $inputfish in $value <br>";
		}
		  		
  		$inputfish = "carp";
		if (strpos($value,$inputfish))
		{
				print "Hey I found a $inputfish: in $value <br>";
				$GLOBALS[$inputfish] = $value;
				print $GLOBALS[$inputfish];
		}
		else
		{
				print "didn't find any $inputfish in $value <br>";
		}
		
		$inputfish = "largemouth";
		if (strpos($value,$inputfish))
		{
				print "Hey I found a $inputfish: in $value <br>";
				$GLOBALS[$inputfish] = $value;
				print $GLOBALS[$inputfish];
		}
		else
		{
				print "didn't find any $inputfish in $value <br>";
		}
		
		$inputfish = "greenie";
		if (strpos($value,$inputfish))
		{
				print "Hey I found a $inputfish: in $value <br>";
				$GLOBALS[$inputfish] = $value;
				print $GLOBALS[$inputfish];
		}
		else
		{
				print "didn't find any $inputfish in $value <br>";
		}
		
		$inputfish = "smallmouth";
		if (strpos($value,$inputfish))
		{
				print "Hey I found a $inputfish: in $value <br>";
				$GLOBALS[$inputfish] = $value;
				print $GLOBALS[$inputfish];
		}
		else
		{
				print "didn't find any $inputfish in $value <br>";
		}
  
  }
}

///////////////////////////////////////////////////////////////////////

$user_input = "11 carp, 8 largemouth bass, 4 bluegills";
$exploded = explode(", ", $user_input);

findfish($exploded);

//mentionsfish($array[0],"bluegill");


				print "<br>PRINTING STUFF AT THE END ";
		print "<br>\$bluegill = ";
		print $bluegill;
		print "<br>\$carp = ";
		print $carp;
		print "<br>\$largemouth = ";
		print $largemouth;
		print "<br>\$greenies = ";
		print $greenie;
		print "<br>\$greenies = ";
		print $greenie;

/*

function mentionsfish($words, $inputfish)
{
	if (strpos($words,$inputfish))		// if $words contains the string $fish
	{
		print "the phrase <i>$words</i> does in fact mention <i>$inputfish</i>!";	// print that it does
		$GLOBALS[$inputfish] = $words;
	}
	else
	{
		print "sorry, didn't find any mention of <i>$inputfish</i> in <i>$words</i>...";
	}
}
		
	*/

?>