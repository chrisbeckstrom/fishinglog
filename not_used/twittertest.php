<?php

print "test";
$pagetitle = 89;

?>
<body>
<a href="http://twitter.com/home?status= <?php $pagetitle; ?> " title="Tweet this!" target="_blank">Share on Twitter</a>

</body>

<a href="http://twitter.com/home?status=Currently reading <?php the_permalink(); ?>" title="Click to send this page to Twitter!" target="_blank">Share on Twitter</a>