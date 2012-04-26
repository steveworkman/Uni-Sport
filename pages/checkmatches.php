<?php
require('classes/class.Match.php');
/*
This is the old way. Get everything at once. Not only is it not good for my objects, it's less efficient SQL-wise

$matchesquery = "SELECT squads.name, matches.details, users.username, opposition, " .
				"date, meettime, pushback, match_squad.match_id, match_squad.available, match_squad.squad_id, matches.match_id " .
				"FROM (matches, users, squads) LEFT JOIN match_squad ON match_squad.match_id = matches.match_id " .
				"WHERE match_squad.user_id = '" . $_SESSION['shef_hockey_user_id'] . "' " .
				"AND squads.squad_id = match_squad.squad_id " .
				"AND users.user_id = squads.captain " .
				"AND matches.date >= NOW()";
*/
// Find all the match IDs, then use the Match class to get the details
$query = 'SELECT m.match_id FROM matches AS m, match_squad, squads '.
		'WHERE match_squad.user_id = '.USR_ID.' '.
		'AND squads.squad_id = match_squad.squad_id '.
		'AND m.match_id = match_squad.match_id '.
		'AND m.date >= NOW()';

$result = mysql_query($query)
	or die(mysql_error());
// if no matches not answered for, display how many matches you are playing in
if (mysql_num_rows($result) != 0)
{
	$matches = array();
	// Create a new Match for each of the match IDs
	while ($row = mysql_fetch_array($result))
	{
		$match = new Match($row['match_id']);
		$match->getAvailability(USR_ID);
		$matches[] = $match;
	}
	$smarty->assign('matches', $matches);
}		
else
	$smarty->assign('error','You have not been selected for any matches');

// For the select options
$availabilities = array('-1'=>'Unknown','0'=>'No','1'=>'Yes');
$smarty->assign('availabilities', $availabilities);
$smarty->assign('USR_ID',USR_ID);
$smarty->display('checkmatches.tpl');
?>