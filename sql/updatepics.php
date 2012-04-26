<?php
require_once('../inc/connect.inc.php');

$album = "CREATE TABLE `albums` (
`album_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`album_type` TINYINT( 1 ) NOT NULL DEFAULT '0',
`user_id` INT NOT NULL DEFAULT '-1',
`archived` TINYINT( 1 ) NOT NULL DEFAULT '0'
) ENGINE = MYISAM COMMENT = 'Picture Albums'";

$album2 = "ALTER TABLE `albums` ADD `name` VARCHAR( 255 ) NULL AFTER `album_id`";

$albumtype = "CREATE TABLE `album_type` (
`type_id` TINYINT( 1 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 128 ) NULL 
) ENGINE = MYISAM";

echo 'Creating Album table<br/>';
$ar = mysql_query($album)
	or die(mysql_error());
echo 'Adjusting Album table<br/>';
$ar2 = mysql_query($album2)
	or die(mysql_error());
echo 'Creating Album_types table<br/>';
$at = mysql_query($albumtype)
	or die(mysql_error());

echo 'Adding album types<br/>';
$ins1 = "INSERT INTO `album_type` (`type_id` ,`name` )VALUES (1 , 'Event')";
$ins2 = "INSERT INTO `album_type` (`type_id` ,`name` )VALUES (2 , 'Match')";
$ins3 = "INSERT INTO `album_type` (`type_id` ,`name` )VALUES (3 , 'Personal')";
$in1 = mysql_query($ins1)
	or die(mysql_error());
$in2 = mysql_query($ins2)
	or die(mysql_error());
$in3 = mysql_query($ins3)
	or die(mysql_error());

$queries = array();
echo 'Getting user albums<br/>';
$names = array();
$data = array();
$q = 'SELECT u.username, u.user_id, p.picture_id FROM users AS u, pictures AS p WHERE u.user_id = p.user_id';
$res = mysql_query($q)
	or die(mysql_error());
while($row = mysql_fetch_array($res))
{
	$names[] = $row['username'];
	$data[$row['username']][] = $row['picture_id'];
}
$names = array_unique($names);
foreach($names as $name)
{
	$uid = "SELECT user_id FROM users WHERE username='".$name."'";
	$res5 = mysql_query($uid)
		or die(mysql_error());
	$row5 = mysql_fetch_array($res5);
	$q2 = "INSERT INTO albums (name,album_type,user_id) VALUES ('".$name."','3','".$row5['user_id']."')";
	$res2 = mysql_query($q2)
		or die(mysql_error());
	$insert = mysql_insert_id();
	for($i=0; $i<sizeof($data[$name]);$i++)
	{
		$q3 = 'SELECT * FROM pictures WHERE picture_id='.$data[$name][$i];
		$res3 = mysql_query($q3)
			or die(mysql_error());
		$row3 = mysql_fetch_array($res3);
		$queries[] = "INSERT INTO pictures (album_id,path,comment,featured,date,thumb) ".
					"VALUES ('".$insert."','".$row3['path']."','".addslashes($row3['comment'])."','".$row3['featured']."','".$row3['date']."','".$row3['thumb']."')";
	}
}

echo 'Getting event_pictures albums<br/>';
$names = array();
$data = array();
$q = 'SELECT e.name, ep.picture_id FROM event_pictures AS ep, events AS e WHERE ep.event_id = e.event_id';
$res = mysql_query($q)
	or die(mysql_error());
while($row = mysql_fetch_array($res))
{
	$names[] = $row['name'];
	$data[$row['name']][] = $row['picture_id'];
}
$names = array_unique($names);
foreach($names as $name)
{
	$q2 = "INSERT INTO albums (name,album_type) VALUES ('".$name."','1')";
	$res2 = mysql_query($q2)
		or die(mysql_error());
	$insert = mysql_insert_id();
	for($i=0; $i<sizeof($data[$name]);$i++)
	{
		$q3 = 'SELECT * FROM pictures WHERE picture_id='.$data[$name][$i];
		$res3 = mysql_query($q3)
			or die(mysql_error());
		$row3 = mysql_fetch_array($res3);
		$queries[] = "INSERT INTO pictures (album_id,path,comment,featured,date,thumb) ".
					"VALUES ('".$insert."','".$row3['path']."','".addslashes($row3['comment'])."','".$row3['featured']."','".$row3['date']."','".$row3['thumb']."')";
	}
}

echo 'Getting playedmatches_pictures albums<br/>';
$names = array();
$data = array();
$q = 'SELECT e.opposition, ep.picture_id FROM playedmatch_pictures AS ep, playedmatches AS e WHERE ep.report_id = e.report_id';
$res = mysql_query($q)
	or die(mysql_error());
while($row = mysql_fetch_array($res))
{
	$names[] = $row['opposition'];
	$data[$row['opposition']][] = $row['picture_id'];
}
$names = array_unique($names);
foreach($names as $name)
{
	$q2 = "INSERT INTO albums (name,album_type) VALUES ('".$name."','2')";
	$res2 = mysql_query($q2)
		or die(mysql_error());
	$insert = mysql_insert_id();
	for($i=0; $i<sizeof($data[$name]);$i++)
	{
		$q3 = 'SELECT * FROM pictures WHERE picture_id='.$data[$name][$i];
		$res3 = mysql_query($q3)
			or die(mysql_error());
		$row3 = mysql_fetch_array($res3);
		$queries[] = "INSERT INTO pictures (album_id,path,comment,featured,date,thumb) ".
					"VALUES ('".$insert."','".$row3['path']."','".addslashes($row3['comment'])."','".$row3['featured']."','".$row3['date']."','".$row3['thumb']."')";
	}
}

// Drop Pictures
echo 'dropping pictures<br/>';
$drop = 'DROP TABLE `pictures`';
$dropres = mysql_query($drop)
	or die(mysql_error());

echo 'dropping event_pictures<br/>';
//Drop event_pictures
$drop2 = 'DROP TABLE `event_pictures`';
$dropres2 = mysql_query($drop2)
	or die(mysql_error());

echo 'dropping playedmatches_pictures<br/>';
//Drop playedmatches_pictures
$drop3 = 'DROP TABLE `playedmatch_pictures`';
$dropres3 = mysql_query($drop3)
	or die(mysql_error());

echo 'Creating new pictures table<br/>';
// Create it with new bits
$pics = "CREATE TABLE `pictures` (
`picture_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`album_id` INT NOT NULL DEFAULT '0',
`path` VARCHAR( 255 ) NULL ,
`comment` VARCHAR( 255 ) NULL,
`featured` TINYINT( 1 ) NOT NULL DEFAULT '0',
`date` DATE NOT NULL ,
`thumb` VARCHAR( 255 ) NULL 
) ENGINE = MYISAM";
$picres = mysql_query($pics)
	or die(mysql_error());

echo 'Inserting new queries<br/>';
// Insert new queries
foreach($queries as $query)
{
	$res6 = mysql_query($query)
		or die(mysql_error());
}
echo count($queries).' queries executed<br/>';
echo 'Adding Date field to albums';
$alter = "ALTER TABLE `albums` ADD `date` DATE NOT NULL AFTER `user_id`";
$res7 = mysql_query($alter)
	or die(mysql_error());

?>