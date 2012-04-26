<?php
	$smarty->assign('error',urldecode($_GET['error']));
	if(empty($_GET['uid']) || !isset($_GET['uid']))
		throw_error('HACK');
	
	$q = 'SELECT user_avatar, username FROM users '.
			'WHERE user_id = '.$_GET['uid'];
	$res = mysql_query($q)
		or die(mysql_error());
	$row = mysql_fetch_array($res);
	$smarty->assign('avatar',$row['user_avatar']);
	$smarty->assign('name',$row['username']);
	$smarty->assign('id',$_GET['uid']);
	$smarty->display('avatar.tpl');
?>