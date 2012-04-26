<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Information');
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');

if (!empty($_GET['PageID']))
{
	$query = "SELECT * FROM infopages WHERE page_id = '". $_GET['PageID'] ."'";
	$result = mysql_query($query)
		or die(mysql_error());
	$row = mysql_fetch_array($result);
	
	$smarty->assign('title',$row['title']);
	$smarty->assign('text',$row['text']);
}
else
{
	$smarty->assign('links',getInformation());
}
$smarty->display('info.tpl');
include ('inc/sidebar2.inc.php');
include ('inc/footer.inc.php');
?>