<?php
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
include('../inc/commitfunctions.inc.php');
// Get the post, trim it etc
$club = myAddSlashes(trim($_POST['club']));
$keys = myAddSlashes(trim($_POST['keys']));
$desc = myAddSlashes(trim($_POST['desc']));

$q = "UPDATE settings SET 	`clubname` = '".$club."', ".
							"`metakeywords` = '".$keys."', ".
							"`metadescription` = '".$desc."'";
$res = mysql_query($q)
	or die(mysql_error());
submitlog('User updated website settings');
header("location:../adminpages.php?Page=settings");
?>