<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','News');
$css = array();
$js = array();
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');
$story = getNewsArticle($_GET['article_id']);
$smarty->assign('story',$story);
$smarty->assign('in_story','1');
$smarty->display('newsdetails.tpl');
include ('inc/sidebar2.inc.php');
include ('inc/footer.inc.php');
?>