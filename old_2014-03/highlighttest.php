<?php

include 'disguise.php';

$searchterm = 'Rogue';

$text = 'went fishing on the Rogue';

$text = highlight($searchterm,$text);

print "text: $text";


