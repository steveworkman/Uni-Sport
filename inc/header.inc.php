<?php
// Require smarty templating engine
require('./smarty_connect.php');

ob_start();
// page time code
$m_time = explode(" ",microtime());
$m_time = $m_time[0] + $m_time[1];
$starttime = $m_time;

include('connect.inc.php'); // Connect to database
include('facebook.inc.php'); // Set up Facebook

// Get Site name variables etc
$sitequery = "SELECT * FROM settings";
$siteres = mysql_query($sitequery)
	or die(mysql_error());
$sitedetails = mysql_fetch_array($siteres);

$smarty->assign('metakeywords',$sitedetails['metakeywords']);
$smarty->assign('metadescription',$sitedetails['metadescription']);
$smarty->assign('clubname', $sitedetails['clubname']);
$smarty->assign('curr_page', CURR_PAGE);
$smarty->assign('add_css', $css);
$smarty->assign('add_js', $js);
$smarty->assign('USR_LOGGED',USR_LOGGED);
$smarty->assign('SID',SID);
$smarty->assign('fb_api',$api_key);
$smarty->assign('title',PAGE_TITLE);

$smarty->cache_lifetime=0;
$smarty->display('header.tpl');

// Maintainence mode query
$q = "SELECT * FROM config WHERE config_name = 'board_disable'";
$re = mysql_query($q)
	or die(mysql_error());
$r = mysql_fetch_array($re);
if ($r['config_value'] == 1 && SEC_LVL != 1)
	include 'disabled.php';
?>