<?php
// Do Random Profile
$miniprofile = getrandomprofile($facebook); 
$miniprofile->hidden = $status['profile'];
$smarty->assign('profile', $miniprofile);
$smarty->assign('viewmemberslink', 'viewprofile.php');
include('inc/menu.inc.php');
include('inc/adverts.inc.php');
$smarty->display('sidebar2.tpl');
?>