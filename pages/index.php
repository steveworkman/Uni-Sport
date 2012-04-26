<?php
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
?> 