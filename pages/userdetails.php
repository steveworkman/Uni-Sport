<?php
require('classes/class.UserProfile.php');
require('classes/class.FacebookProfile.php');
switch ($_GET['Action'])
{
	case "view":
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
		
	case "edit":
		if ((SEC_LVL != 1) || (empty($_GET['user_id'])))
			$id = USR_ID;
		else
			$id = $_GET['user_id'];
			
		$fb_id = getFacebookID($id);
		if($fb_id != 0)
			$profile = new FacebookProfile($facebook,$fb_id, $id);
		else
			$profile = new UserProfile($id);
		$smarty->assign('fhlock',$profile->getFHLocks());
		$smarty->assign('error',urldecode($_GET['error']));
		$sex = array(0=>'Female', 1=>'Male');
		$smarty->assign('sex',$sex);
		$smarty->assign('sides',$profile->getSides());
		$smarty->assign('positions',$profile->getPositions());
		if(SEC_LVL == 1)
			$smarty->assign('admin',1);
		if($profile->gay == 1)
			$smarty->assign('gay',' checked="checked"');
		if($profile->cookie == 1)
			$smarty->assign('cookie',' checked="checked"');
		if($profile->view_email == 0)
			$smarty->assign('hidden',' checked="checked"');
		if($profile->archived == 1)
			$smarty->assign('arc',' checked="checked"');
		
		$smarty->assign('profile',$profile);
		
		$smarty->display('editprofile.tpl');
}
?>