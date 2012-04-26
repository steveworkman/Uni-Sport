<?php
if (!empty($_GET['id']))
	$uid = $_GET['id'];
else
	$uid = USR_ID;

$query = 'SELECT * FROM fteams WHERE user_id = '.$uid;
$res = mysql_query($query)
	or die(mysql_error());
$row = mysql_fetch_array($res);
$tid = $row['team_id'];
$smarty->assign('tid',$tid);
$smarty->assign('teamname',$row['name']);
$smarty->assign('points',$row['points']);
$smarty->assign('budget',$row['budget']);

// Calculate rank
$q2 = "SELECT team_id FROM fteams ORDER BY points DESC";
$res2 = mysql_query($q2)
	or die(mysql_error());
$i=0;
$rank = '??';
while ($row2 = mysql_fetch_array($res2))
{
	$i++;
	if ($row2['team_id'] == $tid)
		$rank = $i;
}
$position = $rank."/".mysql_num_rows($res2);
$smarty->assign('position',$position);

// Get the individual players data
$players = array();
$q3 = 'SELECT * FROM fteam_players WHERE team_id = '.$tid;
$res3 = mysql_query($q3)
	or die(mysql_error());
while($row3 = mysql_fetch_array($res3))
{
	$q4 = 'SELECT user_id, username, user_avatar, p.name, points, value '.
			'FROM users, positions AS p '.
			'WHERE user_id = '.$row3['user_id'].' '.
			'AND position = p.position_id '.
			'ORDER BY users.position DESC';
	$res4 = mysql_query($q4)
		or die(mysql_error());
	$row4 = mysql_fetch_array($res4);
	$players[] = array('id'=>$row4['user_id'],
						'name'=>$row4['username'],
						'avatar'=>$row4['user_avatar'],
						'pos'=>$row4['name'],
						'points'=>$row4['points'],
						'value'=>$row4['value']);
}
$smarty->assign('players',$players);
$smarty->display('myteam.tpl');
?>