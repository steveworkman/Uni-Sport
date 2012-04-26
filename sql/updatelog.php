<?php
include('../inc/connect.inc.php');
$sql = 'ALTER TABLE `log` CHANGE `ip` `ip` INT NOT NULL';
$q = 'SELECT log_id, ip FROM log';
$res = mysql_query($q)
	or die(mysql_error());
$logs = array();
while($row = mysql_fetch_array($res))
{
	$logs[] = array('id'=>$row['log_id'],
					'ip'=>$row['ip']);
}
$res2 = mysql_query($sql)
	or die(mysql_error());
foreach($logs as $log)
{
	$q2 = 'UPDATE log SET ip='.ip2long($log['ip']).' WHERE log_id='.$log['id'];
	mysql_query($q2)
		or die(mysql_error());
}
echo 'Updated '.sizeof($logs).' log entries';
?>