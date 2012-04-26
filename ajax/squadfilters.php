<?php
include("../inc/secure_page.inc.php");
include("../inc/connect.inc.php");
// This is the AJAX function for the squad filters.
// Taking the post it generates a query and outputs the <option> fields
header("Content-Type: text/xml; charset=UTF-8");
if ($_POST['side'] == 1)
	$sidequery = '';
else
	$sidequery = "AND side = '".$_POST['side']."' ";

if ($_POST['pos'] == 1)
	$posquery = '';
else
	$posquery = "AND position = '".$_POST['pos']."' ";

if ($_POST['sex'] == 2)
	$sexquery = '';
else
	$sexquery = "AND male = '".$_POST['sex']."' ";

if ($_POST['arc'] == 2)
	$arcquery = '';
else
	$arcquery = "AND archived = '".$_POST['arc']."' ";

$query = "SELECT user_id, username FROM users ".
		"WHERE user_id > 0 ".
		$sexquery . $sidequery . $posquery . $arcquery .
		"ORDER BY username ASC";
$res = mysql_query($query)
	or die(mysql_error());

echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
echo "<root>";
while ($row = mysql_fetch_array($res))
{
	echo "<link>";
	echo "<value>".$row['user_id']."</value>";
	echo "<name>".$row['username']."</name>";
	echo "</link>";
}
echo "</root>";
?>