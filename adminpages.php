<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Admin Pages');
$css = array();
$css[] = 'css/forms.css';
$js = array();
if($_GET['Action'] == 'add' || $_GET['Action'] == 'edit')
{
	$js[] = 'js/tiny_mce/tiny_mce.js';
	$js[] = 'js/init_tiny_mce.js';
}
if($_GET['Page'] == 'squads')
{
	$js[] = 'js/squadSearch.js';
}
else if($_GET['Page'] == 'activationmenu')
{
	$js[] = 'js/activation.js';
}
if($_GET['Page'] == 'managemembers')
{
	require_once('classes/class.ManualProfile.php');
	require_once('classes/class.UserProfile.php');
}
require('inc/secure_page.inc.php');
require('inc/indexfunctions.inc.php');
require('inc/header.inc.php');
require('inc/sidebar.inc.php');
switch($_GET['Page'])
{
	case 'newslettermenu':
		require('./pages/newsletters.php');
	break;
	
	case 'news':
		require('./pages/news.php');
	break;
	
	case 'fnews':
		require('./pages/fnews.php');
	break;
	
	case 'squads':
		require('./pages/squads.php');
	break;
	
	case 'matches':
		require('./pages/matches.php');
	break;
	
	case 'events':
		require('./pages/events.php');
	break;
	
	case 'admin':
		require('./pages/admin.php');
	break;
		
	case 'managemembers':
		require('./pages/managemembers.php');
	break;
	
	case 'log':
		require('./pages/log.php');
	break;
	
	case 'activationmenu':
		require('./pages/activation.php');
	break;
	
	case 'settings':
		require('./pages/settings.php');
	break;
	
	case 'securitylevels':
		require('./pages/securitylevels.php');
	break;
	
	case 'ads':
		require('./pages/ads.php');
	break;
	
	case 'infopages':
		require('./pages/infopages.php');
	break;
		
	case 'fhockey':
		require('./pages/fhockey.php');
	break;
	
	case 'help':
		require('./pages/help.php');
	break;
	
	default:
		require('./pages/index.php');
}
require('inc/sidebar2.inc.php');
require('inc/footer.inc.php');
?>