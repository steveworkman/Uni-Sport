<?php
include("../inc/connect.inc.php");

// This is the AJAX function for getting a person's mini profile
header("Content-Type: text/xml; charset=UTF-8");

$query = "SELECT value ".
		"FROM users ".
		"WHERE user_id = '".$_POST['id']."'";
$res = mysql_query($query)
	or die(mysql_error());

echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
echo "<root>";
while ($row = mysql_fetch_array($res))
{
	echo "<value>".$row['value']."</value>";
	echo "<posneg>".$_POST['neg']."</posneg>";
}
echo "</root>";

?>