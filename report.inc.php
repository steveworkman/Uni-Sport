<?php
include('inc/connect.inc.php');
include('smarty_connect.php');
include('classes/class.MatchReport.php');
if($_GET['report_id'] != '')
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
	$smarty->assign('report',$report);
	$smarty->display('report.tpl');
}
else
{
	$smarty->assign('error', 'Try selecting another match report');
	$smarty->display('ajaxerror.tpl');
}
?>