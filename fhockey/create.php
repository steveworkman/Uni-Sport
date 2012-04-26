<?php
// Check to see if the player has already got a team
$sq = 'SELECT user_id FROM fteams WHERE user_id = '.USR_ID;
$sres = mysql_query($sq)
	or die(mysql_error());
if (mysql_num_rows($sres) > 0)
{
	//TODO forward to error page
	$error =  'You already have a fantasy hockey team. The limit is one team per player.';
}
else
{
	// Retrieve lock 
	$lq = "SELECT * FROM fhockeyconfig WHERE name = 'locksignup'";
	$lres = mysql_query($lq)
		or die(mysql_error());
	$lrow = mysql_fetch_array($lres);

	if ($lrow['value'] == 1)
	{
		$smarty->assign('locked','<p class="blue">Sign-ups for Fantasy League are currently suspended. Please check back again soon</p>');
	}
	else
	{
		$smarty->assign('GKs',getPlayerList(GKINDEX));
		$smarty->assign('DFs',getPlayerList(DFINDEX));
		$smarty->assign('MFs',getPlayerList(MFINDEX));
		$smarty->assign('FWs',getPlayerList(FWINDEX));
	}
	$smarty->display('createteam.tpl');
}
?>