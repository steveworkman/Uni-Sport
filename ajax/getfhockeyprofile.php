<?php
include("../inc/connect.inc.php");

function formatdate($date)
{
	$year = substr($date, 0, 4);
	$month = substr($date, 5, 2);
	$day = substr($date, 8, 2);
	
	if (($month == 0 || $year == 0 || $day == 0) || ($month < 0 || $year < 1970 || $day < 0))
		return "Date not entered";
	else
		return date("j F Y", mktime(0, 0, 0, $month, $day, $year));
}

// This is the AJAX function for getting a person's mini profile
header("Content-Type: text/xml; charset=UTF-8");

$query = "SELECT user_id, username, firstname, lastname, dob, value, points, user_avatar, p.name, s.name ".
		"FROM users, positions AS p, sides AS s ".
		"WHERE user_id = '".$_POST['id']."' ".
		"AND side = s.side_id ".
		"AND position = p.position_id";
$res = mysql_query($query)
	or die(mysql_error());

$q2 = "SELECT user_id FROM scorers WHERE user_id = '".$_POST['id']."'";
$r2 = mysql_query($q2)
	or die(mysql_error());
$goals = mysql_num_rows($r2);

echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
echo "<root>";
while ($row = mysql_fetch_array($res))
{
	echo "<id>".$row['user_id']."</id>";
	echo "<username>".$row['username']."</username>";
	echo "<firstname>".$row['firstname']."</firstname>";
	echo "<lastname>".$row['lastname']."</lastname>";
	echo "<dob>".formatdate($row['dob'])."</dob>";
	echo "<value>".$row['value']."</value>";
	echo "<points>".$row['points']."</points>";
	echo "<goals>".$goals."</goals>";
	echo "<avatar>".$row['user_avatar']."</avatar>";
	echo "<position>".$row[8]."</position>";
	echo "<side>".$row[9]."</side>";
}
echo "</root>";

?>