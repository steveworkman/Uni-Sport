<?php
/*
This script is to set everyone's fantasy hockey team back to their correct amount of points according to the current people in their team.
*/
include './include/connect.inc.php';
$query = 'SELECT team_id FROM fteams';
$res = mysql_query($query)
	or die(mysql_error());
while ($row = mysql_fetch_array($res))
{
	$q2 = 'SELECT points FROM users, fteam_players '.
			'WHERE fteam_players.team_id = '.$row['team_id'].' '.
			'AND fteam_players.user_id = users.user_id';
	$res2 = mysql_query($q2)
		or die(mysql_error());
	$points = 0;
	while ($row2 = mysql_fetch_array($res2))
	{
		$points += $row2['points'];
	}
	$q3 = 'UPDATE fteams SET points = '.$points.' WHERE team_id = '.$row['team_id'];
	$res3 = mysql_query($q3)
		or die(mysql_error());
}