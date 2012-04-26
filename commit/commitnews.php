<?php
ob_start();
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
include('../inc/commitfunctions.inc.php');
include('facebook.inc.php');
switch ($_GET['Action'])
{
	case "add":
		$error = '';
		//input validation
		$heading = myAddSlashes(trim($_POST['head']));
		$text = myAddSlashes(trim($_POST['text']));
		if (empty($text))
		{
			$error .= "Please+enter+a+story%21%0D%0A";
		}
		if (empty($heading))
		{
			$error .= "Please+enter+a+headline%21%0D%0A";
		}
		$text = nl2br($text);
		if (empty($error))
		{
			$sql = 	"INSERT newsarticles SET " .
					"heading = '" . $heading . "', " .
					"text = '" . $text . "', " .
					"user_id = '" . USR_ID . "', " .
					"submittedon = '" . date("Y-m-j G:i:s") . "', " .
					"category = '" . $_POST['category'] . "'";
		}
		else
		{
			header('location:../adminpages.php?Page=news&Action=add&error='.urlencode($error));
			ob_end_flush();
		}
		if (isset($sql) && (!empty($sql)))
		{
			$result = mysql_query($sql)
				or die("Invalid query: " . mysql_error());
		}
		$lastid = mysql_insert_id();
		// LOG SUBMISSION
		$logdata = 'User added news item with article_id '.$lastid;
		submitlog($logdata);
		
		// FACEBOOK NOTIFICATION
		$siteUrl = getSiteUrl();
		$msg = '('.getUsername(USR_ID).') has written some news on '.$siteUrl.'. <a href="http://'.$siteUrl.'/newsdetails.php?article_id='.$lastid.'">Click here to read the article</a>';
		$fbres = notifyPeople($facebook,$msg);
		header("location:../adminpages.php?Page=news");
		ob_end_flush();
	break;
	
	case "delete":
		$error = '';
		$sql = "DELETE FROM newsarticles " .
				"WHERE article_id = '" . $_POST['id'] . "' " .
				"LIMIT 1";
		$result = mysql_query($sql)
			or die("Invalid query: " . mysql_error());
		
		// LOG SUBMISSION
		$logdata = 'User deleted news item with article_id '.$_POST['id'];
		submitlog($logdata);
		header("location:../adminpages.php?Page=news");
		ob_end_flush();
	break;

	case "edit":
		$error = '';
		//input validation
		$heading = myAddSlashes(trim($_POST['head']));
		$text = myAddSlashes(trim($_POST['text']));
		if (empty($text))
		{
			$error .= "Please+enter+a+story%21%0D%0A";
		}
		if (empty($heading))
		{
			$error .= "Please+enter+a+headline%21%0D%0A";
		}
		$text = nl2br($text); // Afterwards so as to check for no text
		if (!empty($text))
		{
			$text .= '<br /><br />Edited by '.USR_LOGGED.' on '.date("j F Y").' at '.date("G:i");
		}
		if (empty($error))
		{
			$sql = 	"UPDATE newsarticles SET " .
					"`heading` = '" . $heading . "', " .
					"`text` = '" . $text . "', " .
					"`user_id` = '" . $_POST['author_id'] . "', " .
					"`submittedon` = '" . $_POST['date'] . "', " .
					"`category` = '" . $_POST['category'] . "' " .
					"WHERE article_id = '" . $_POST['id'] . "' ";
		}
		else
		{
			header('location:../adminpages.php?Page=news&Action=edit&error='.urlencode($error));
			ob_end_flush();
		}
		if (isset($sql) && (!empty($sql)))
		{
			$result = mysql_query($sql)
				or die("Invalid query: " . mysql_error());
		}
		
		// LOG SUBMISSION
		$logdata = 'User edited news item with article_id '.$_POST['id'];
		submitlog($logdata);
		header('location:../adminpages.php?Page=news');
		ob_end_flush();
	break;
		
	case 'arc':
		$ids = split(",",$_POST['IDs']);
		
		for ($i=0; $i<sizeof($ids); $i++)
		{
			if ($_POST[$ids[$i]] == 'on')
			{
				$query = "UPDATE newsarticles SET `archived` = 1 WHERE `article_id` = '". $ids[$i] ."'";
				$res = mysql_query($query)
					or die(mysql_error());
			}
			else
			{
				$query = "UPDATE newsarticles SET `archived` = 0 WHERE `article_id` = '". $ids[$i] ."'";
				$res = mysql_query($query)
					or die(mysql_error());
			}
		}
		header("location:../adminpages.php?Page=news");
	break;
}
?>