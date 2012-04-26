<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Photo Gallery');
$css = array();
$js = array();
if(!empty($_GET['album_id']) || !empty($_GET['uid']))
{
	// For carousel
	$css[] = 'css/jquery.jcarousel.css';
	$css[] = 'css/jcarousel.ie7.skin.css';
	$js[] = 'js/jquery.jcarousel.pack.js';
	// Controller
	$js[] = 'js/slideshow.js';
}
else
{
	$js[] = 'js/gallery.js';
}
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/picfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');
require('classes/class.Calendar_Events.php');

include ('./pages/gallery.php');
SmartyPaginate::disconnect();

include ('inc/sidebar2.inc.php');
include ('inc/footer.inc.php');
?>