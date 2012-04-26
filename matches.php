<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Match Reports');
$css = array();
$js = array();
$js[] = 'js/matches.js';
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('classes/class.MatchReport.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');

	$matchValues = array();
	$matchOptions = array();
	$matchesSelect = $_GET['report_id'];
	$matchValues[] = '';
	$matchOptions[] = 'Select a match report';
	// Get played matches
	$data = getPlayedMatches(0,0);
	usort($data,"comparePlayedMatches");
	$matchValues = array();
	$matchOptions = array();
	// Stuff with blank values
	$matchValues[] = -1;
	$matchOptions[] = 'Select a Match Report';
	// Put into the right arrays
	foreach($data as $match)
	{
		$matchValues[] = $match['id'];
		$matchOptions[] = $match['text'].' on '.$match['date'];
	}
	$smarty->assign('matchValues',$matchValues);
	$smarty->assign('matchOptions',$matchOptions);
	$smarty->assign('matchesSelect', $matchesSelect);
	
	$report = '';
	if (!empty($_GET['report_id']))
	{
		$report = new matchReport($_GET['report_id']);
		$squad = $report->getSquad();
		$scorers = $report->getFormattedScorers();
		$ycards = $report->getYellowCards();
		$rcards = $report->getRedCards();
		
		$smarty->assign('squad',$squad);
		$smarty->assign('scorers',$scorers);
		$smarty->assign('ycards',$ycards);
		$smarty->assign('rcards',$rcards);
	}
	$smarty->assign('report', $report);
	$smarty->cache_lifetime = 0;
	$smarty->display('readreports.tpl');
include ('inc/sidebar2.inc.php');
include ('inc/footer.inc.php');
?>