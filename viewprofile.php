<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Profile');
$css = array();
$css[] = 'css/forms.css';
$js = array();
$js[] = 'js/profileSearch.js';
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');
require('classes/class.UserProfile.php');
require('classes/class.FacebookProfile.php');
switch($_GET['action'])
{
	default:
		$smarty->display('profileSearch.tpl');
	break;
	
	case 'view':
		if(!empty($_GET['uid']))
			$id = $_GET['uid'];
		else
			$id = USR_ID;
		$fb_id = getFacebookID($id);
		if($fb_id != 0)
			$profile = new FacebookProfile($facebook,$fb_id, $id);
		else
			$profile = new UserProfile($id);
		$profile->getFantasyTeam();
		$smarty->assign('profile', $profile);
		$smarty->display('viewprofile.tpl');
	break;
}

include ('inc/sidebar2.inc.php');
include ('inc/footer.inc.php');
?>