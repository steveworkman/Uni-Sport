<?php
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
include('../inc/commitfunctions.inc.php');

$logdata = '';
if (isset($_POST['pos']))
{
	if ($_POST['position'] == 0)
	{
		$val = 1;
		$logdata = 'User locked fantasy league positions';
	}
	else
	{
		$val = 0;
		$logdata = 'User unlocked fantasy league positions';
	}
	$q = "UPDATE fhockeyconfig SET `value` = '".$val."' WHERE `name` = 'lockpositions'";
}
else if (isset($_POST['sign']))
{
	if ($_POST['signup'] == 0)
	{
		$val = 1;
		$logdata = 'User locked fantasy league signups';
	}
	else
	{
		$val = 0;
		$logdata = 'User unlocked fantasy league signups';
	}
	$q = "UPDATE fhockeyconfig SET `value` = '".$val."' WHERE `name` = 'locksignup'";
}
if (isset($q) && !empty($q))
{
	$res = mysql_query($q)
		or die(mysql_error());
	submitlog($logdata);
}
header("location:../adminpages.php?Page=fhockey");
?>