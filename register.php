<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Registration');
$css = array();
$css[] = 'css/forms.css';
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');
	
if (empty($_GET['succ']))
{
	if (!empty($_GET['error']))
	{
		$smarty->assign('error',urldecode($_GET['error']));
	}
	$smarty->assign('fbid',$_GET['uid']);
}
else
{
	$smarty->assign('succ', '1');
	$smarty->assign('boardemail', getBoardEmail());	
}
$smarty->display('register.tpl');
include('inc/sidebar2.inc.php');
include('inc/footer.inc.php');
?>