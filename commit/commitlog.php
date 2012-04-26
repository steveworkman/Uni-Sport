<?php
	include "../inc/connect.inc.php";
	include "../inc/secure_page.inc.php";
	
	$ids = split(",",$_POST['IDs']);
	
	for ($i=0; $i<sizeof($ids); $i++)
	{
		if ($_POST[$ids[$i]] == 'on')
		{
			$query = "UPDATE `log` SET `read` = '1' WHERE `log_id` = '". $ids[$i] ."'";
			$res = mysql_query($query)
				or die(mysql_error());
		}
	}
	header("location:../adminpages.php?Page=log");
?>