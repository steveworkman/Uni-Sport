<?php
ob_start();
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
include('../inc/commitfunctions.inc.php');
switch ($_GET['Action'])
{
	case "add":
		$error = '';
		//input validation
		$name = myAddSlashes(trim($_POST['name']));
		$text = myAddSlashes(trim($_POST['text']));
		$yt_link = myAddSlashes(trim($_POST['youtube']));
		if (empty($text))
		{
			$error .= "Please+enter+a+description%21%0D%0A";
		}
		if (empty($name))
		{
			$error .= "Please+enter+a+title%21%0D%0A";
		}
		$text = nl2br($text); // Afterwards so as to check for no text
		if (empty($error))
		{
			$sql = 	"INSERT help SET " .
					"name = '" . $name . "', " .
					"text = '" . $text . "', " .
					"youtube_link = '" . $yt_link . "'";
		}
		else
		{
			header('location:../adminpages.php?Page=help&action=add&error='.urlencode($error));
			ob_end_flush();
		}
		if (isset($sql) && (!empty($sql)))
		{
			$result = mysql_query($sql)
				or die("Invalid query: " . mysql_error());
		}
		$lastid = mysql_insert_id();
		// LOG SUBMISSION
		$logdata = 'User added help article with id '.$lastid;
		submitlog($logdata);
		
		header("location:../adminpages.php?Page=help");
		ob_end_flush();
	break;
	
	case "delete":
		$error = '';
		$sql = "DELETE FROM help " .
				"WHERE help_id = '" . $_POST['id'] . "' " .
				"LIMIT 1";
		$result = mysql_query($sql)
			or die("Invalid query: " . mysql_error());
		
		// LOG SUBMISSION
		$logdata = 'User deleted help article with id '.$_POST['id'];
		submitlog($logdata);
		header("location:../adminpages.php?Page=help");
		ob_end_flush();
	break;

	case "edit":
		$error = '';
		//input validation
		$name = myAddSlashes(trim($_POST['name']));
		$text = myAddSlashes(trim($_POST['text']));
		$yt_link = myAddSlashes(trim($_POST['youtube']));
		if (empty($text))
		{
			$error .= "Please+enter+a+description%21%0D%0A";
		}
		if (empty($name))
		{
			$error .= "Please+enter+a+title%21%0D%0A";
		}
		$text = nl2br($text); // Afterwards so as to check for no text
		if (empty($error))
		{
			$sql = 	"UPDATE help SET " .
					"`name` = '" . $name . "', " .
					"`text` = '" . $text . "', " .
					"`youtube_link` = '" . $yt_link . "' " .
					"WHERE help_id = '" . $_POST['id'] . "' ";
		}
		else
		{
			header('location:../adminpages.php?Page=help&action=edit&id='.$_POST['id'].'&error='.urlencode($error));
			ob_end_flush();
		}
		if (isset($sql) && (!empty($sql)))
		{
			$result = mysql_query($sql)
				or die("Invalid query: " . mysql_error());
		}
		
		// LOG SUBMISSION
		$logdata = 'User edited help article with id '.$_POST['id'];
		submitlog($logdata);
		header('location:../adminpages.php?Page=help');
		ob_end_flush();
	break;
}
?>