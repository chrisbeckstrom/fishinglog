<?

include('Mail.php');
include "Mail/mime.php";


$crlf = "\r\n";
$hdrs = array( 
        'From' => 'foo@bar.org', 
        'Subject' => 'Mail_mime test message' 
        ); 

$mime = new Mail_mime($crlf); 

$mime->addHTMLImage("http://www.chrisbeckstrom.com/piwigo/_data/i/upload/2013/01/30/20130130085826-1f8f4398-me.jpg", "image/jpg");

//here's the butt-ugly bit where we grab the content id
$cid=$mime->_html_images[count($mime->_html_images)-1]['cid'];

//now we can use the content id in our message
$html = '<html><body><img src="cid:'.$cid.'"></body></html>';
$text = 'Plain text version of email';

$mime->setTXTBody($text);
$mime->setHTMLBody($html); 

$body = $mime->get();
$hdrs = $mime->headers($hdrs);

$mail =& Mail::factory('mail');
$mail->send('chris@chartcapture.com', $hdrs, $body);