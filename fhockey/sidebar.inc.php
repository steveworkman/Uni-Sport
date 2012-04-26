<?php
$status = getHiddenStatus(USR_ID);
// Do Login
include('inc/login.inc.php');
$smarty->assign('login', $login);

$content = array();
// Do recent matches
$playedmatches = getPlayedMatchesSB(7);
$playedmatches->hidden = $status['matches'];
$content[] = $playedmatches;

// Do Topscorer
$topscorer = gettopscorer();
$topscorer->hidden = $status['topscorer'];
$content[] = $topscorer;

// Do Top Points
$points = getTopPoints();
$points->hidden = $status['points'];
$content[] = $points;
$smarty->assign('content', $content);

// Do Random Profile
$miniprofile = getrandomprofile(); 
$miniprofile->hidden = $status['profile'];
$smarty->assign('profile', $miniprofile);
$smarty->assign('viewmemberslink', 'viewprofile.php');

// Display template
$smarty->clear_cache('sidebar.tpl');
$smarty->display('sidebar.tpl'); 
?>