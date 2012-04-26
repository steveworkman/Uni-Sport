<?php
if(SEC_LVL == 1)
{

	$q = "SELECT * FROM fhockeyconfig";
	$res = mysql_query($q)
		or die(mysql_error());
	$lockpos = 0;
	$locksignup = 0;
	while ($row = mysql_fetch_array($res))
	{
		if ($row['name'] == 'lockpositions')
			$lockpos = $row['value'];
		else if ($row['name'] == 'locksignup')
			$locksignup = $row['value'];
	}
	if ($lockpos == 0)
		$postext = 'Lock Positions';
	else
		$postext = 'Unlock Positions';
		
	if ($locksignup == 0)
		$signtext = 'Lock Sign-ups';
	else
		$signtext = 'Unlock Sign-ups';
	
	$smarty->assign('pos',$postext);
	$smarty->assign('lockpos',$lockpos);
	$smarty->assign('sign',$signtext);
	$smarty->assign('locksign',$locksignup);
	$smarty->display('fleaguesettings.tpl');
}
else
{
	throw_error('AUTH');
}
?>