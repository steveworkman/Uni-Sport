<?php
require_once('../facebook/facebook.php');
// Get these from http://developers.facebook.com
$api_key = '75d7d80466bf669f82b774398513d087';
$secret  = 'eef33ee2a4ccc7b8242936c8ad151cbd'; 

// Create a new Facebook class
$facebook = new Facebook($api_key, $secret);
$facebook->set_user($facebook->user, $_SESSION['shef_hockey_session_key']);
?>