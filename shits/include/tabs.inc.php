<?php
$pagenamearray =  explode('/', $_SERVER['PHP_SELF']);
for ($i=0; $i<sizeof($pagenamearray); $i++)
{
	$strlen = strlen($pagenamearray[$i]);
	if (substr($pagenamearray[$i],($strlen-4),$strlen) == '.php')
	{
		$pgname = substr($pagenamearray[$i],0,($strlen-4));
	}
}
if ($pgname == 'fhockey')
{
?>
<table border="0" cellpadding="2">
<tr>
<td><img src="img/table.gif" alt="League Table" /><a href="fhockey.php?Page=table">League Table </a></td>
<?php
// check if user already has a team
	$fq = "SELECT team_id FROM fteams WHERE user_id = '".$_SESSION['shef_hockey_user_id']."'";
	$fres = mysql_query($fq)
		or die(mysql_error());
	if (!empty($_SESSION['shef_hockey_user_logged']) && mysql_num_rows($fres) > 0)
	{
?>
<td><img src="img/vcard.gif" alt="My Team" /><a href="fhockey.php?Page=myteam">My Team </a></td>
<td><img src="img/user_go.gif" alt="fhockey.php?Page=Transfers" /><a href="fhockey.php?Page=transfers">Transfers </a></td>
<?php
	}
?>
</tr>
</table>
<?php
}
else
{
?>
<table border="0" cellpadding="2">
<tr>
<td><img src="img/newspaper.gif" alt="news" /><a href="index.php">News </a></td> <td><img src="img/camera.gif" alt="Gallery" /><a href="gallery.php">Gallery </a></td> <td><img src="img/report.gif" alt="Matches" /><a href="matches.php">Matches </a></td> <td><img src="img/date.gif" alt="Calendar" /><a href="calendar.php">Calendar </a></td><td><img src="img/information.gif" alt="Information" /><a href="information.php">Info </a></td>
<?php if(!empty($_SESSION['shef_hockey_user_logged']))
{ ?>
<td><img src="img/user.gif" alt="Profile" /><a href="memberpages.php?Page=userdetails&Action=view">Profile </a></td>
<?php
}
else
{ ?>
<td><img src="img/register.gif" alt="Profile" /><a href="register.php">Register </a></td>
<?php
}
?>
</tr>
</table>
<?php
}
?>