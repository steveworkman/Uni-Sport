<?php
include('../inc/commitfunctions.inc.php');
include('../inc/connect.inc.php');
include('../inc/unsecure_page.inc.php');

$uid = $_POST['uid'];
$user = $_POST['user'];

$q = 'UPDATE users SET fb_id='.$uid.' WHERE user_id='.$user;
$res = mysql_query($q)
	or die(mysql_error());
submitlog('User associated facebook id: '.$uid.' with user '.$user);
header('location:../fbselect.php?succ=1');
?>