<?php
	include "../inc/connect.inc.php";
	include "../inc/secure_page.inc.php";
	//print_r($_POST);
	
	$query = "UPDATE `securitylevels` SET `group_id` = '".$_POST['1']."' WHERE `securitylevel_id` = '1'";
	$res = mysql_query($query)
		or die(mysql_error());
	
	$query = "UPDATE `securitylevels` SET `group_id` = '".$_POST['2']."' WHERE `securitylevel_id` = '2'";
	$res = mysql_query($query)
		or die(mysql_error());
	
	$query = "UPDATE `securitylevels` SET `group_id` = '".$_POST['3']."' WHERE `securitylevel_id` = '3'";
	$res = mysql_query($query)
		or die(mysql_error());

	header("location:../adminpages.php?Page=securitylevels");
	
?>