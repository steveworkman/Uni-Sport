<?php
define('CURR_PAGE', 'home');
$title = 'Member Pages';
$css = array();
$css[] = 'css/forms.css';
$js = array();
if($_GET['Page'] != 'picmenu')
{
	$js[] = 'js/tiny_mce/tiny_mce.js';
	$js[] = 'js/init_tiny_mce.js';
}

if($_GET['Page'] == 'matchreports')
{
	$title = 'Match Reports';
	$js[] = 'js/reports.js';
}
if($_GET['Page'] == 'picmenu' && $_GET['Action'] == 'upload')
	$js[] = 'js/jquery.MultiFile.pack.js';
if($_GET['Page'] == 'picmenu' && $_GET['Action'] == 'edit')
{
	$js[] = 'js/picturetags.js';
}
define('PAGE_TITLE',$title); // Defined here so that different pages can set it
include('inc/secure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/picfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');
switch($_GET['Page'])
{
	case 'picmenu':
		include('./pages/picmenu.php');
	break;
	
	case 'matchreports':
		include('./pages/matchreports.php');
	break;
	
	case 'userdetails':
		include('./pages/userdetails.php');
	break;
	
	case 'checkmatches':
		include('./pages/checkmatches.php');
	break;
	
	case 'avatar':
		include('./pages/avatar.php');
	break;
	
	default:
		include('./pages/index.php');
	break;
}
include ('inc/sidebar2.inc.php');
include ('inc/footer.inc.php');
?>