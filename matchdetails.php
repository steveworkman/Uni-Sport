<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Match Reports');
$css = array();
$js = array();
$js[] = 'js/matches.js';
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');
include('classes/class.Match.php');
$match = new Match($_GET['match_id']);
$smarty->assign('squad',$match->getSquad());
$smarty->assign('match', $match);
$smarty->display('matchdetails.tpl');
include ('inc/sidebar2.inc.php');
include ('inc/footer.inc.php');
?>