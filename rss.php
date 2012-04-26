<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','RSS');
$css = array();
$js = array();
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');

// This is temporary until I figure out a better way of doing feeds, or need to do anything with them
$feeds = array();
$feeds[] = array('link'=>'http://www.sheffieldhockey.com/RSS/news.php',
					'title'=>'News Feed');
$smarty->assign('feeds',$feeds);
$smarty->display('rss.tpl');
include('inc/sidebar2.inc.php');
include('inc/footer.inc.php');
?>