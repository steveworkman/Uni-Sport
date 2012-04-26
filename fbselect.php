<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Select User');
$css = array();
$css[] = 'css/forms.css';
require('inc/unsecure_page.inc.php');
require('inc/indexfunctions.inc.php');
require('inc/header.inc.php');
require('inc/sidebar.inc.php');
if($_GET['succ'] == 1)
{
	$smarty->assign('succ','You have successfully associated your Facebook account with that user. Please use the button on the left to log in');
}
else if($_GET['pending'] == 1)
{
	$smarty->assign('inactive',1);
}
else
{
	// This page is for people who don't have a their facebook account associated with the site
	// Get List of people without fb_id
	$q = 'SELECT user_id, username, firstname, lastname FROM users '.
			'WHERE fb_id=0 AND user_id > 0 '.
			'ORDER BY username';
	$res = mysql_query($q)
		or die(mysql_error());
	$data = array();
	while($row = mysql_fetch_array($res))
	{
		$data[$row['user_id']] = $row['username'].' ('.$row['firstname'].' '.$row['lastname'].')';
	}
	$smarty->assign('users',$data);
	$smarty->assign('uid',$_GET['uid']);
}
$smarty->display('fbselect.tpl');
require('inc/sidebar2.inc.php');
require('inc/footer.inc.php');
?>