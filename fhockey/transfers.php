<?php
switch($_GET['pg'])
{
	case '2':
		// Define the gets in smarty
		$smarty->assign('tid',$_GET['tid']);
		$smarty->assign('pid',$_GET['pid']);
		$smarty->assign('pos',$_GET['pos']);
		
		// Check that the user is in that team
		$uq = 'SELECT user_id FROM fteam_players WHERE team_id = '.$_GET['tid'].' AND user_id = '.$_GET['pid'];
		$ures = mysql_query($uq)
			or die(mysql_error());
		if (mysql_num_rows($ures) == 0)
		{
			throw_error('HACK');
		}
		else
		{	
			// Check that the position is correct
			$q2 = "SELECT username, value, position FROM users WHERE user_id = '".$_GET['pid']."'";
			$res2 = mysql_query($q2)
				or die(mysql_error());
			$row2 = mysql_fetch_array($res2);
			if ($row2['position'] != $_GET['pos'])
			{
				throw_error('HACK');
			}
			else
			{
				$smarty->assign('pname',$row2['username']);
				$pvalue = $row2['value'];
				
				$query = 'SELECT budget FROM fteams WHERE user_id = '.USR_ID;
				$res = mysql_query($query)
					or die(mysql_error());
				$row = mysql_fetch_array($res);
				$budget = $row['budget'];
				$remaining_cash = $budget + $pvalue;
				$smarty->assign('remaining_cash',$remaining_cash);

				// Get all the current players. A person can't have the same player twice!
				$twoq = 'SELECT user_id FROM fteam_players WHERE team_id = '.$_GET['tid'];
				$twores = mysql_query($twoq)
					or die(mysql_error());
				$not_current_players = '';
				while ($tworow = mysql_fetch_array($twores))
				{
					$not_current_players .= 'AND user_id != '.$tworow['user_id'].' ';
				}
				
				// Find all the players that match the given position
				$pq = 'SELECT username, user_id, value FROM users '.
						'WHERE position = '.$_GET['pos'].' '.
						'AND archived = 0 AND gay = 0 '.
						'AND value <= '.$remaining_cash.' '.
						$not_current_players;
				$pres = mysql_query($pq)
					or die(mysql_error());
				if (mysql_num_rows($pres) == 0)
				{
					$error = 'There are no players available in that position for your budget';
					$smarty->assign('error',$error);
				}
				else
				{
					$players = array();
					while ($prow = mysql_fetch_array($pres))
					{
						$players[] = array('id'=>$prow['user_id'],
											'name'=>$prow['username'],
											'value'=>$prow['value']);
					}
					$smarty->assign('players',$players);
				}
				$smarty->display('transfers2.tpl');
			}
		}
	break;

	case '3':
		// Define the gets in smarty
		$smarty->assign('tid',$_GET['tid']);
		$smarty->assign('pid',$_GET['pid']);
		$smarty->assign('pos',$_GET['pos']);
		// Check that the user is in that team
		$uq = 'SELECT user_id FROM fteam_players WHERE team_id = '.$_GET['tid'].' AND user_id = '.$_GET['pid'];
		$ures = mysql_query($uq)
			or die(mysql_error());
		if (mysql_num_rows($ures) == 0)
		{
			throw_error('HACK');
		}
		else
		{
			// check that the position is correct
			$q2 = 'SELECT username, value, position FROM users WHERE user_id = '.$_GET['pid'];
			$res2 = mysql_query($q2)
				or die(mysql_error());
			$row2 = mysql_fetch_array($res2);
			if ($row2['position'] != $_GET['pos'])
			{
				throw_error('HACK');;
			}
			else
			{
				$pname = $row2['username'];
				$pvalue = $row2['value'];
				$query = 'SELECT budget FROM fteams WHERE user_id = '.USR_ID;
				$res = mysql_query($query)
					or die(mysql_error());
				$row = mysql_fetch_array($res);
				$budget = $row['budget'];
				
				$remaining_cash = $budget + $pvalue;
				// Check that the selected person is of the right value and position
				$q3 = 'SELECT value, position, username FROM users WHERE user_id = '.$_GET['id'];
				$res3 = mysql_query($q3)
					or die(mysql_error());
				$row3 = mysql_fetch_array($res3);
				if (($row3['position'] != $_GET['pos']) || ($row3['value'] > $remaining_cash))
				{
					throw_error('HACK');
				}
				else
				{
					$sname = $row3['username'];
					$final_budget = $remaining_cash - $row3['value'];
					$smarty->assign('pname',$pname);
					$smarty->assign('sname',$sname);
					$smarty->assign('final_budget',$final_budget);
					$smarty->display('transfers3.tpl');
				}
			}
		}
	break;

	default:
		$smarty->assign('error',urldecode($_GET['error']));
		// Find the person's team
		$query = 'SELECT team_id, budget, transfers FROM fteams WHERE user_id = '.USR_ID;
		$res = mysql_query($query)
			or die(mysql_error());
		$row = mysql_fetch_array($res);
		$tid = $row['team_id'];
		$smarty->assign('budget',$row['budget']);
		$smarty->assign('transfers',$row['transfers']);
		
		// Get the players in the team
		$players = array();
		$q3 = 'SELECT * FROM fteam_players WHERE team_id = '.$tid;
		$res3 = mysql_query($q3)
			or die(mysql_error());
		while($row3 = mysql_fetch_array($res3))
		{
			$q4 = "SELECT user_id, username, user_avatar, p.name, position, points, value ".
					"FROM users, positions AS p ".
					"WHERE user_id = '".$row3['user_id']."' ".
					"AND position = p.position_id ";
			$res4 = mysql_query($q4)
				or die(mysql_error());
			$row4 = mysql_fetch_array($res4);
			$players[] = array('tid'=>$tid,
								'uid'=>$row4['user_id'],
								'user_link'=>'./viewprofile.php?action=view&uid='.$row4['user_id'],
								'user_avatar'=>$row4['user_avatar'],
								'user_name'=>$row4['username'],
								'pos'=>$row4['name'],
								'posid'=>$row4['position'],
								'value'=>$row4['value'],
								'points'=>$row4['points']);
		}
		$smarty->assign('data',$players);
		$smarty->display('transfers.tpl');
	break;
}
?>