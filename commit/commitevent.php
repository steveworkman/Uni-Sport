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
		$name = myAddSlashes(trim($_POST['head']));
		$desc = myAddSlashes(nl2br(trim($_POST['text'])));
		
		$timeHour = $_POST['Time_Hour'];
		if($_POST['Time_Meridian'] == pm)
			$timeHour += 12;
		$datetime = date ("Y-m-d G:i:s",mktime($timeHour, $_POST['Time_Minute'], 00,
												$_POST['Date_Month'], $_POST['Date_Day'], $_POST['Date_Year']));

		if (empty($desc))
		{
			$error .= "Please+enter+a+description%21%0D%0A";
		}
		if (empty($name))
		{
			$error .= "Please+enter+a+name+for+the+event%21%0D%0A";
		}
		
		if (empty($error))
		{
			$sql = "INSERT INTO `events` (`Name` , `Description` , `user_id` , `EventDateTime` ) VALUES (" .
						"'" . $name . "', " .
						"'" . $desc . "', " .
						"'" . USR_ID . "', " .
						"'" . $datetime . "')";
		}
		else
		{
			header('location:../adminpages.php?Page=events&Action=add&error='.urlencode($error));
			ob_end_flush();
		}
		if (isset($sql) && (!empty($sql)))
		{
			$result = mysql_query($sql)
				or die("Invalid query: " . mysql_error());
		}
		$lastid = mysql_insert_id();
		$user = getUsername(USR_ID);
		// LOG SUBMISSION
		$logdata = $user.' added event with event_id: '.$lastid;
		submitlog($logdata);
		
		// FACEBOOK NOTIFICATION
		$siteUrl = getSiteUrl();
		$msg = ': '.$user.' has added an event entitled '.$name.' on '.$siteUrl.'. <a href="http://'.$siteUrl.'/viewevent.php?event_id='.$lastid.'">Click here to read the article</a>';
		$fbres = notifyPeople($facebook,$msg);
		header("location:../adminpages.php?Page=events".$fb_link);
		ob_end_flush();
	break;
	
	case "delete":
		$error = '';
		$sql = "DELETE FROM events " .
				"WHERE event_id = '" . $_POST['id'] . "' " .
				"LIMIT 1";
		$result = mysql_query($sql)
			or die("Invalid query: " . mysql_error());
		
		// LOG SUBMISSION
		$logdata = 	"User deleted event with event_id ". $_POST['id'];
		submitlog($logdata);
		header('location:../adminpages.php?Page=events');
	break;

	case "edit":
		$error = '';
		//input validation
		$name = myAddSlashes(trim($_POST['head']));
		$desc = myAddSlashes(nl2br(trim($_POST['text'])));
		
		if($_POST['Time_Meridian'] == pm)
			$timeHour += 12;
		$datetime = date ("Y-m-d G:i:s",mktime($timeHour, $_POST['Time_Minute'], 00,
												$_POST['Date_Month'], $_POST['Date_Day'], $_POST['Date_Year']));
		if (empty($desc))
		{
			$error .= "Please+enter+a+description%21%0D%0A";
		}
		if (empty($name))
		{
			$error .= "Please+enter+a+name+for+the+event%21%0D%0A";
		}
		if (empty($error))
		{
			$sql = "UPDATE `events` SET `Name` = '". $name ."', ".
					"`Description` = '". $desc . "', ".
					"`EventDateTime` = '". $datetime . "' WHERE `event_id` = '" . $_POST['id'] . "'";
		}
		else
		{
			header('location:../adminpages.php?Page=events&Action=edit&error='.urlencode($error));
			ob_end_flush();
		}
		if (isset($sql) && (!empty($sql)))
		{
			$result = mysql_query($sql)
				or die("Invalid query: " . mysql_error());
		}
		// LOG SUBMISSION
		$logdata = 'User edited event with event_id: '.$_POST['id'];
		submitlog($logdata);
		header('location:../adminpages.php?Page=events');
		ob_end_flush();
	break;
	
	case 'arc':
		$ids = split(",",$_POST['IDs']);
		
		for ($i=0; $i<sizeof($ids); $i++)
		{
			if ($_POST[$ids[$i]] == 'on')
			{
				$query = "UPDATE events SET `archived` = 1 WHERE `event_id` = '". $ids[$i] ."'";
				$res = mysql_query($query)
					or die(mysql_error());
			}
			else
			{
				$query = "UPDATE events SET `archived` = 0 WHERE `event_id` = '". $ids[$i] ."'";
				$res = mysql_query($query)
					or die(mysql_error());
			}
		}
		header('location:../adminpages.php?Page=events');
	break;
}
?>