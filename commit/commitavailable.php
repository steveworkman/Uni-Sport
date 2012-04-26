<?php
include('../inc/secure_page.inc.php');
include('../inc/connect.inc.php');
include('../inc/commitfunctions.inc.php');
$logdata = 'User set their availability to '.$_POST['available'].' for matchID '.$_POST['match'];

$sql = "UPDATE match_squad SET Available = '" . $_POST['available'] . 
		"' WHERE match_id = '" .$_POST['match'] . 
		"' AND user_id = '" . $_POST['user'] .
		"' AND squad_id = '" . $_POST['squad'] . "'";
$res = mysql_query($sql)
	or die(mysql_error());			
submitlog($logdata);
header('location:../memberpages.php?Page=checkmatches');
?>