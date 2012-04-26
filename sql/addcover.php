<?php
include('../inc/connect.inc.php');
$sql = "ALTER TABLE `albums` ADD `cover_id` INT NOT NULL DEFAULT '0'";
mysql_query($sql)
	or die(mysql_error());

echo 'Successfully added cover to albums<br/>';

$q = 'SELECT album_id FROM albums';
$res = mysql_query($q)
	or die(mysql_error());
$i=1;
while($row = mysql_fetch_array($res))
{
	$q2 = 'SELECT picture_id FROM pictures WHERE album_id ='.$row['album_id'].' LIMIT 1';
	$res2 = mysql_query($q2)
		or die(mysql_error());
	$row2 = mysql_fetch_array($res2);
	$q3 = 'UPDATE albums SET cover_id='.$row2['picture_id'].' WHERE album_id='.$row['album_id'];
	mysql_query($q3)
		or die(mysql_error());
	$i++;
}
echo $i.' albums update';
?>