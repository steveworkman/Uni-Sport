<?php
include("../inc/connect.inc.php");
// This is the AJAX function for searching people.

$str = $_GET['q'];
$lim = $_GET['limit'];
$arc = $_GET['arc'];

if (!$str) return;
$arcText = '';
if($arc == 1)
	$arcText = 'AND u.archived = 0 ';
$query = 'SELECT u.user_id, u.username, u.male, p.name, s.name '.
		'FROM users AS u, positions AS p, sides AS s '.
		'WHERE u.user_id != -1 '.
		$arcText.
		'AND u.position = p.position_id '.
		'AND u.side = s.side_id '.
		'ORDER BY username ASC';
$res = mysql_query($query)
	or die(mysql_error());

while ($row = mysql_fetch_array($res))
{
	if(stristr($row['username'], $str))
	{
		$male = 'Female';
		if($row['male'] == 1)
			$male = 'Male';
		echo $row['username']."|".$row['user_id']."|".$male."|".$row[3]."|".$row[4]."\n";
	}
}
?>