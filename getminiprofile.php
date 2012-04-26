<?php
include('inc/indexfunctions.inc.php');
include_once('classes/class.MiniProfile.php');
include_once('classes/class.MiniFacebookProfile.php');
include('inc/connect.inc.php');
include('smarty_connect.php');
include('inc/facebook.inc.php');

if(!empty($_POST['id']))
	$id = $_POST['id'];
else
	$id = USR_ID;
$fb_id = getFacebookID($id);
if($fb_id != 0)
	$profile = new MiniFacebookProfile($facebook,$fb_id, $id);
else
	$profile = new MiniProfile($id);

$smarty->assign('profile', $profile);
$smarty->display('miniprofile.tpl');
?>