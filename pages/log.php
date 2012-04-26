<?php
if (SEC_LVL == 1)
{
	$query = "SELECT users.username, log.user_id, log.log_id, log.action, log.timestamp, log.ip FROM log, users " .
			"WHERE log.read = '0' AND users.user_id = log.user_id ORDER BY log.timestamp DESC";
	$res = mysql_query($query)
		or die(mysql_error());
	$id = '';
	$logs = array();
	while ($row = mysql_fetch_array($res))
	{
		$id .= $row['log_id'] . ",";
		$logs[] = array('id'=>$row['log_id'],
						'userlink'=>'viewprofile.php?action=view&uid='.$row['user_id'],
						'username'=>$row['username'],
						'ip'=>long2ip($row['ip']),
						'timestamp'=>$row['timestamp'],
						'action'=>$row['action']);
	}
	$id = substr($id,0,(strlen($id)-1));
	$smarty->assign('ids',$id);
	$smarty->assign('logs',$logs);
	$smarty->display('log.tpl');
}
else
{
	throw_error('AUTH');
}
?>