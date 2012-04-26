<?php
include('inc/connect.inc.php');
include('smarty_connect.php');
$s_query = "SELECT match_squad.available, users.username FROM match_squad, users " .
			"WHERE match_id = '" . $_GET['id'] . "' " .
			"AND match_squad.user_id = users.user_id";
$s_result = mysql_query($s_query)
	or die(mysql_error());
$data = array();
while ($s_row = mysql_fetch_array($s_result))
{
	$data[] = array('available'=>$s_row['available'],
					'name'=>$s_row['username']);
}
$smarty->assign('players',$data);
$smarty->display('checkstatus.tpl');
?>