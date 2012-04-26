<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Home');
$css = array();
$js = array();
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/picfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');
	include('inc/feature.inc.php');
	SmartyPaginate::setLimit(5);
	$smarty->assign('stories', getNews(0));
	$smarty->clear_cache('newsStory.tpl');
	$smarty->cache_lifetime = 0;
	// Paginate the news stories
	SmartyPaginate::assign($smarty); // For pagination
	$smarty->display('index.tpl');
	SmartyPaginate::disconnect();
	include ('inc/sidebar2.inc.php');
include('inc/footer.inc.php');
?>