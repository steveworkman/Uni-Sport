<?php
function calcScore($uid)
{
	global $oscore;
	global $scorervalues;
	global $ycards;
	global $rcards;
	global $motm;
	global $minus;
	
	$points = 0;
	
	$q = "SELECT position, points, gay FROM users WHERE user_id = '".$uid."'";
	$res = mysql_query($q)
		or die(mysql_error());
	$row = mysql_fetch_array($res);
	
	if ($row['gay'] == 0)
	{
		// Add everyone's appearence money
		$points += APPEARENCE;
		
		// Add goals (conceeded and scored)
		switch($row['position'])
		{
			case GKINDEX: // GK
				if ($oscore == 0)
					$points += GKCLEANSHEET;
				else
					$points += $oscore*GKCONCEEDED;
			break;
			
			case DFINDEX: //DF
				if ($oscore == 0)
					$points += DFCLEANSHEET;
				else
					$points += $oscore*DFCONCEEDED;
				if (in_array($uid, array_keys($scorervalues)))
					$points += $scorervalues[$uid]*DFGOAL;
			break;
			
			case MFINDEX: //MF
				if (in_array($uid, array_keys($scorervalues)))
					$points += $scorervalues[$uid]*MFGOAL;
			break;
			
			case FWINDEX: //FW
				if (in_array($uid, array_keys($scorervalues)))
						$points += $scorervalues[$uid]*FWGOAL;
			break;
			
			default:
				if (in_array($uid, array_keys($scorervalues)))
						$points += $scorervalues[$uid]*FWGOAL;
			break;
		}
		
		// Add Man of the Match Points
		if ($motm == $uid)
			$points += MOTM;
			
		// 'Add' Yellow Card Points - assumes you only get one yellow card
		if (in_array($uid, $ycards))
			$points += YCARD;
			
		// 'Add' Red Card Points - assumes you only get one red card
		if (in_array($uid, $rcards))
			$points += RCARD;
	}
	// Final points = current points + new points
	if ($minus == 0)
		$totalpoints = $points + $row['points'];
	else
		$totalpoints = $row['points'] - $points;
	
	$fq = "UPDATE users SET points='".$totalpoints."' WHERE user_id='".$uid."'";
	$fres = mysql_query($fq)
		or die("Error in Fantasy Hockey Query: ".mysql_error());
	
	return $points;
}

function CalcTeamPoints()
{
	global $uid;
	global $points;
	global $minus;

	// For each player in the squad, get the distinct teams they're associated with and update that team's points
	for ($i=0; $i<sizeof($uid); $i++)
	{	
		$q = "SELECT DISTINCT team_id FROM fteam_players WHERE user_id = '".$uid[$i]."'";
		$res = mysql_query($q)
			or die(mysql_error());
		while ($row = mysql_fetch_array($res))
		{
			//Add the points to the team
			// Get current points
			$q2 = "SELECT points FROM fteams WHERE team_id = '".$row['team_id']."'";
			$res2 = mysql_query($q2)
				or die(mysql_error());
			$row2 = mysql_fetch_array($res2);
			if ($minus == 0)
				$p = $row2['points'] + $points[$i];
			else
				$p = $row2['points'] - $points[$i];
			
			// Update the row
			$fq = "UPDATE fteams SET points='".$p."' WHERE team_id='".$row['team_id']."'";
			$fres = mysql_query($fq)
				or die(mysql_error());
		}
	}
}

/*
 * Finds the top points scorers
 * Returns a sidebarContent object.
 */
function getTopPoints()
{
	$points = new sidebarContent('Top Points');
	$points->id = 'points';
	$data = array();
	$tp_query = "SELECT user_id, username, points FROM users WHERE user_id > 0 ORDER BY points DESC LIMIT 5";
	$tp_result = mysql_query($tp_query)
		or die($mysql_error());
	if (mysql_num_rows($tp_result) == 0)
		$points->error = 'There have been no points awarded yet';
	else
	{
		while($tp_row = mysql_fetch_array($tp_result))
		{
			$data[] = array('link'=>'./viewprofile.php?action=view&uid='.$tp_row['user_id'],
							'text'=>$tp_row['username'].' - '.$tp_row['points'].' points');
		}
		$points->data = $data;
	}
	return $points;
}

/*
 * Gets the players for a certain position
 * Used in create.php
 * Returns an array(array('id','name','value')).
 */
function getPlayerList($pos)
{
	$data = array();
	$query = 'SELECT user_id, username, value FROM users '.
					'WHERE position = '.$pos.' AND archived = 0 '.
					'AND gay = 0 ORDER BY value DESC';
	$result = mysql_query($query)
		or die(mysql_error());
	while ($row = mysql_fetch_array($result))
	{
		$data[] = array('id'=>$row['user_id'],
						'name'=>$row['username'],
						'value'=>$row['value']);
	}
	return $data;	
}
?>