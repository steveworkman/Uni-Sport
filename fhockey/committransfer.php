<?php
include('../inc/secure_page.inc.php');
include('../inc/connect.inc.php');
include('../inc/indexfunctions.inc.php');

$tid = $_POST['tid'];
$pid = $_POST['pid'];
$id = $_POST['id'];
$fb = $_POST['fb'];
if (isset($tid) && isset($pid) && isset($id))
{
	// Check if the team has transfers left. If not, exit. If so, remove one
	$tranq = 'SELECT transfers FROM fteams WHERE team_id = '.$tid;
	$tranres = mysql_query($tranq)
		or die(mysql_error());
	$tranrow = mysql_fetch_array($tranres);
	if ($tranrow['transfers'] == 0)
	{
		// Transfer not ok, fail
		header('location:../fhockey.php?Page=transfers&error='.urlencode('You have no transfers remaining'));
	}
	else
	{
		// Minus a transfer and update budget
		$new_tran = $tranrow['transfers'] - 1;
		$newtranq = 'UPDATE fteams SET transfers = '.$new_tran.', budget = '.$fb.' WHERE team_id = '.$tid;
		$newtranres = mysql_query($newtranq)
			or die(mysql_error());
		
		// Remove the old player from the team
		$delq = 'DELETE FROM fteam_players WHERE team_id = '.$tid.' AND user_id = '.$pid;
		$delres = mysql_query($delq)
			or die(mysql_error());
		
		// Add the new player in
		$addq = 'INSERT INTO fteam_players (`team_id`, `user_id`) VALUES ('.$tid.', '.$id.')';
		$addres = mysql_query($addq)
			or die(mysql_error());
		
		header('location:../fhockey.php?Page=transfers');
	}
}
else
{
	header('location:../fhockey.php');
}
?>