<?php
	include('inc/feature.inc.php');
	SmartyPaginate::setLimit(5);
	$smarty->assign('stories', getFNews(5));
	$smarty->clear_cache('newsStory.tpl');
	SmartyPaginate::assign($smarty); // For pagination
	$smarty->display('index.tpl');
	SmartyPaginate::disconnect();
?> 