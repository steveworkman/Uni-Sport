<?php
	$query = 'SELECT name, fteams.user_id, username, fteams.points '.
			 'FROM fteams, users '.
			 'WHERE fteams.user_id = users.user_id '.
			 'ORDER BY fteams.points DESC';
	$res = mysql_query($query)
		or die(mysql_error());
	
	if (mysql_num_rows($res) == 0)
		$smarty->assign('error','No teams found in the database');
	else
	{
		$j=0;
		$data = array();
		while ($row = mysql_fetch_array($res))
		{
			$j++;
			$data[] = array('rank'=>$j,
							'team_link'=>'./fhockey.php?Page=myteam&amp;id='.$row['user_id'],
							'team_name'=>$row['name'],
							'user_link'=>'./viewprofile.php?action=view&uid='.$row['user_id'],
							'user_name'=>$row['username'],
							'points'=>$row['points']);

		}
		SmartyPaginate::setTotal(count($data));
		$data = array_slice($data, SmartyPaginate::getCurrentIndex(),SmartyPaginate::getLimit());
		$smarty->assign('data',$data);
		SmartyPaginate::setUrl('fhockey.php?Page=table');
		SmartyPaginate::assign($smarty); // For pagination
		$smarty->display('leaguetable.tpl');
		SmartyPaginate::disconnect();
	}
?>