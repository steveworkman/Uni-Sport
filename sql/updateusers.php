<?php
include('../inc/connect.inc.php');
$sql = "ALTER TABLE `users` 
ADD `fb_id` INT NOT NULL AFTER `user_id`,
ADD `hide_comm` TINYINT( 1 ) NOT NULL DEFAULT '0',
ADD `hide_tc` TINYINT( 1 ) NOT NULL DEFAULT '0',
ADD `hide_admin` TINYINT( 1 ) NOT NULL DEFAULT '0',
ADD `hide_matches` TINYINT( 1 ) NOT NULL DEFAULT '0',
ADD `hide_nl` TINYINT( 1 ) NOT NULL DEFAULT '0',
ADD `hide_ts` TINYINT( 1 ) NOT NULL DEFAULT '0',
ADD `hide_profile` TINYINT( 1 ) NOT NULL DEFAULT '0',
ADD `hide_points` TINYINT( 1 ) NOT NULL DEFAULT '0'";
$res = mysql_query($sql)
	or die(mysql_error());
if($res)
	echo 'Table successfully altered';
else
	echo 'Failed to update users table';
?>