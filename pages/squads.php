<?php
/*
 * Retrieves all the squads captained by $uid
 * A $uid of blank or 0 returns all the squads
 * Returns array(array('squad_id','squad_name','captain_link','captain_name'))
 */
function getSquads($uid=0)
{
	$data = array();
	$uidText = '';
	if($uid != 0)
		$uidText = 'AND s.captain = '.$uid.' ';
	$query = 'SELECT s.squad_id, s.name, u.username, u.user_id '.
				'FROM squads AS s, users AS u '.
				'WHERE u.user_id = s.captain '.
				$uidText.
				'ORDER BY s.name';
	$result = mysql_query($query)
		or die(mysql_error());
	while ($row = mysql_fetch_array($result))
	{
		$data[] = array('squad_id'=>$row['squad_id'],
						'squad_name'=>$row['name'],
						'captain_link'=>'./viewprofile.php?action=view&uid='.$row['user_id'],
						'captain_name'=>$row['username']);
	}
	return $data;
}

/*
 * Retrieves a specific squad, $uid needs to be supplied to verify the captain
 * A $uid of blank or 0 returns the squads no matter what
 * Returns array(array('squad_id','squad_name','captain_link','captain_name'),array('link','name'))
 */
function getSquad($id, $uid=0)
{
	$squad = array();
	$team = array();
	$data = array();
	$uidText = '';
	if($uid != 0)
		$uidText = 'AND s.captain = '.$uid.' ';
	$query = 'SELECT s.squad_id, s.name, u.username, u.user_id, s.description '.
				'FROM squads AS s, users AS u '.
				'WHERE u.user_id = s.captain '.
				'AND s.squad_id = '.$id.' '.
				$uidText.
				'ORDER BY s.name';
	$result = mysql_query($query)
		or die(mysql_error());
	$row = mysql_fetch_array($result);
	$squad = array('squad_id'=>$row['squad_id'],
					'squad_name'=>$row['name'],
					'squad_desc'=>$row['description'],
					'captain_id'=>$row['user_id'],
					'captain_link'=>'./viewprofile.php?action=view&uid='.$row['user_id'],
					'captain_name'=>$row['username']);
	if(!empty($squad))
	{
		// Get the squad members
		$q2 = 'SELECT us.user_id, u.username '.
				'FROM users AS u, user_squad AS us '.
				'WHERE us.squad_id = '.$id.' '.
				'AND us.user_id = u.user_id '.
				'ORDER BY u.username';
		$res2 = mysql_query($q2)
			or die(mysql_error());
		while($row2 = mysql_fetch_array($res2))
		{
			$team[] = array('link'=>'./viewprofile.php?action=view&uid='.$row2['user_id'],
							'name'=>$row2['username'],
							'id'=>$row2['user_id']);
		}
	}
	$data[0] = $squad;
	$data[1] = $team;
	return $data;
}

// Start of main code switch	
if (SEC_LVL == 1 || SEC_LVL == 3)
{
	$remain = 21; // This is the maximum number of boxes shown
	switch ($_GET['Action'])
	{
		case "add":
			$playernum = 12;
			$remstart = $playernum;
			$smarty->assign('error',urldecode($_GET['error']));
			$smarty->assign('USR_ID',USR_ID);
			$smarty->assign('pageTitle','Add Squad');
			$smarty->assign('formLink','./commit/commitsquad.php?Action=add');
			$smarty->assign('buttonText','Create Squad');
			$smarty->assign('playernum',$playernum);
			$smarty->assign('remain',$remain);
			$smarty->assign('remstart',$remstart);
			$smarty->display('addsquad.tpl');
		break;
		
		case "edit":
			if(SEC_LVL == 1)
				$uid = 0;
			else
				$uid = USR_ID;
			$data = getSquad($_GET['id'],$uid);
			
			$playernum = count($data[1])+1;
			$remstart = $playernum;
			$smarty->assign('error',urldecode($_GET['error']));
			$smarty->assign('squadData',$data[0]);
			array_unshift($data[1],''); // To counter the offset in the template
			$smarty->assign('squad',$data[1]);
			$smarty->assign('USR_ID',$data[0]['captain_id']);
			$smarty->assign('pageTitle','Edit Squad');
			$smarty->assign('formLink','./commit/commitsquad.php?Action=edit');
			$smarty->assign('buttonText','Submit Changes');
			$smarty->assign('playernum',$playernum);
			$smarty->assign('remain',$remain);
			$smarty->assign('remstart',$remstart);
			$smarty->display('addsquad.tpl');
		break;
				
		case "delete":
			if(SEC_LVL == 1)
				$uid = 0;
			else
				$uid = USR_ID;
			$data = getSquad($_GET['id'],$uid);
			$smarty->assign('squad',$data[0]);
			$smarty->assign('team',$data[1]);
			$smarty->display('deletesquad.tpl');
		break;
						
		default:
			if(SEC_LVL == 1)
				$id = 0;
			else
				$id = USR_ID;
			$squads = getSquads($id);
			$smarty->assign('squads',$squads);
			$smarty->display('listsquad.tpl');
		break;
	}
}
else
	throw_error('AUTH');
?>