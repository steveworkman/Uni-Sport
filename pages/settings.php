<?php
if(SEC_LVL == 1)
{
	$q = "SELECT * FROM settings";
	$res = mysql_query($q)
		or die(mysql_error());
	$row = mysql_fetch_array($res);
	$smarty->assign('clubname',$row['clubname']);
	$smarty->assign('keywords',$row['metakeywords']);
	$smarty->assign('desc',$row['metadescription']);
	$smarty->display('settings.tpl');
}
else
{
	throw_error('AUTH');
}
?>