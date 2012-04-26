<?php
$status = getHiddenStatus(USR_ID);
// Do Login
include('inc/login.inc.php');
$smarty->assign('login', $login);

// Here is the definition of the NEW_IMG path
define('NEW_IMG','./img/new.gif');
$smarty->assign('NEW_IMG',NEW_IMG);

$content = array();
// Do recent matches
$playedmatches = getPlayedMatchesSB(7);
$playedmatches->hidden = $status['matches'];
$content[] = $playedmatches;

// Do newsletters
$newsletters = getnewsletters(5);
$newsletters->hidden = $status['newsletters'];
$content[] = $newsletters;

// Do Topscorer
$topscorer = gettopscorer();
$topscorer->hidden = $status['topscorer'];
$content[] = $topscorer;
$smarty->assign('content', $content);

// Do Random Profile
$miniprofile = getrandomprofile($facebook); 
$miniprofile->hidden = $status['profile'];
$smarty->assign('profile', $miniprofile);
$smarty->assign('viewmemberslink', 'viewprofile.php');

// Display template
$smarty->clear_cache('sidebar.tpl');
$smarty->display('sidebar.tpl'); 
?>