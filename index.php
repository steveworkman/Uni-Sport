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
	$query = "SELECT * FROM infopages WHERE page_id = '3'";
	$result = mysql_query($query)
		or die(mysql_error());
	$row = mysql_fetch_array($result);
	
	$smarty->assign('title',$row['title']);
	$smarty->assign('text',$row['text']);

$smarty->display('index.tpl');
include ('inc/sidebar2.inc.php');
include('inc/footer.inc.php');
?>