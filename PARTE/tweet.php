<?php
$consumerKey    = 'lsoLe938eXKFucJ3N4vMsw'; 
$consumerSecret = '0lskeUQcz0bdGBqFPb9C3Lw6w1xLSy5SY0JUVb6qBjM';
$oAuthToken     = '784594819-3OOhq8GXhu4Qppgzx2mBgBqOGOyJUpeWOBEs04go';
$oAuthSecret    = 'A1OSHVNBzuI14DWBvgMbPiOluzoF8Z8JEmXgwNPUhQ';
require_once('twitteroauth.php');
// twitteroauth.php points to OAuth.php
// all files are in the same dir
// create a new instance
$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
?>
