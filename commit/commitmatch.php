<?php
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
include('../inc/commitfunctions.inc.php');
include('facebook.inc.php');

switch ($_GET['Action'])
{
	case "add":
		$error = '';
		//input validation
		$opposition = myAddSlashes(trim($_POST['opposition']));
		$squad = trim($_POST['squad']);
		$home = trim($_POST['home']);
		
		//sorts out the featured checkbox
		if ($_POST['friendly'] == "on")
			$friendly = "1";
		else
			$friendly = "0";
		
		// Do Dates
		$when = date ("Y-m-d",mktime(00,00,00,$_POST['dateMonth'], $_POST['dateDay'], $_POST['dateYear']));
		$meetHour = $_POST['meetHour'];
		if($_POST['meetMeridian'] == pm)
			$meetHour += 12;
		$meettime = date ("G:i:s",mktime($meetHour, $_POST['meetMinute'],00));
		$startHour = $_POST['startHour'];
		if($_POST['startMeridian'] == pm)
			$startHour += 12;
		$pushback = date ("G:i:s",mktime($startHour, $_POST['startMinute'],00));
		
		$details = myAddSlashes(nl2br(trim($_POST['details'])));
		if (empty($details))
		{
			$error .= "Please+enter+a+description%21%0D%0A";
		}
		if (empty($opposition))
		{
			$error .= "Please+enter+a+name+for+the+opposition%21%0D%0A";
		}
		
		if (empty($error))
		{
			$sql = "INSERT INTO `matches` (`opposition` , `squad_id` , `home` , `date` , `meettime` , `pushback` , `details`, `friendly` ) VALUES (" .
						"'" . $opposition . "', " .
						"'" . $squad . "', " .
						"'" . $home . "', " .
						"'" . $when . "', " .
						"'" . $meettime . "', " .
						"'" . $pushback . "', " .
						"'" . $details . "', " .
						"'" . $friendly . "')";	
		}
		else
		{
			header("location:../adminpages.php?Page=matches&Action=add&error=" . urlencode($error));
		}
		if (isset($sql) && (!empty($sql)))
		{
			$result = mysql_query($sql)
				or die("Invalid query1: " . mysql_error());
			$matchid = mysql_insert_id();
			
			$psql = "SELECT user_id FROM user_squad WHERE squad_id = '" . $squad . "'";
			$presult = mysql_query($psql)
				or die("Invalid query2: " . mysql_error());
			while ($p_row = mysql_fetch_array($presult))
			{
				$uid[] = $p_row['user_id'];
			}
			if (count($uid) !=0)
			{
				$sql1 = "INSERT INTO `match_squad` (`match_id` , `squad_id` , `user_id`) VALUES ";
				for($a =0;$a<count($uid);$a++)
				{
					$sql1 = $sql1 . "(" ."'" . $matchid . "', '" . $squad . "', " ."'" . $uid[$a] . "'),";
				}
				$sql1 = substr($sql1,0,(strlen($sql1)-1));
				if (isset($sql) && (empty($error)))
				{
					$result1 = mysql_query($sql1)
						or die("Invalid query: " . mysql_error());
				}
			}
			// LOG SUBMISSION
			$user = getUsername(USR_ID);
			$logdata = 	$user.' added fixture with match_id: '.$matchid;
			submitlog($logdata);
			
			// FACEBOOK NOTIFICATION
			$siteUrl = getSiteUrl();
			$msg = 'You have been selected to play for '.getSquadName($squad).' against '.$opposition.' on '.date("Y-m-d",$when).'. <a href="http://'.$siteUrl.'/memberpages.php?Page=checkmatches">Click here to confirm your availability</a>';
			$fbres = notifyPeople($facebook,$msg,'',$uid);
		}
		header("location:../adminpages.php?Page=matches".$fb_link);
	break;
	
	case "delete":
		$sql = 'DELETE FROM matches '.
				'WHERE match_id = '.$_POST['id'].' '.
				'LIMIT 1';
		$sql2 = 'DELETE FROM match_squad '.
				'WHERE match_id = '.$_POST['id'];
		
		// LOG SUBMISSION
		$logdata = 	'User deleted match with match_id '.$_POST['id'];
		submitlog($logdata);
		
		$result = mysql_query($sql)
					or die("Invalid query1: " . mysql_error());
		$result2 = mysql_query($sql2)
					or die("Invalid query2: " . mysql_error());
		
		header('location:../adminpages.php?Page=matches');
	break;

	case "edit":
		$error = '';
		//input validation
		$opposition = myAddSlashes(trim($_POST['opposition']));
		$squad = trim($_POST['squad']);
		$home = trim($_POST['home']);
		
		//sorts out the featured checkbox
		if ($_POST['friendly'] == "on")
			$friendly = "1";
		else
			$friendly = "0";
		
		// Do Dates
		$when = date ("Y-m-d",mktime(00,00,00,$_POST['dateMonth'], $_POST['dateDay'], $_POST['dateYear']));
		$meetHour = $_POST['meetHour'];
		if($_POST['meetMeridian'] == pm)
			$meetHour += 12;
		$meettime = date ("G:i:s",mktime($meetHour, $_POST['meetMinute'],00));
		$startHour = $_POST['startHour'];
		if($_POST['startMeridian'] == pm)
			$startHour += 12;
		$pushback = date ("G:i:s",mktime($startHour, $_POST['startMinute'],00));
		
		$details = myAddSlashes(nl2br(trim($_POST['details'])));
		if (empty($details))
		{
			$error .= "Please+enter+a+description%21%0D%0A";
		}
		if (empty($opposition))
		{
			$error .= "Please+enter+a+name+for+the+opposition%21%0D%0A";
		}
		
		if (empty($error))
		{
			$sql = "UPDATE `matches` SET Opposition = " . "'" . $opposition . 
						"', squad_id =  " . "'" . $squad . 
						"', home = " ."'" . $home .
						"', date = " . "'" . $when . 
						"', meettime = " ."'" . $meettime . 
						"', pushback = " . "'" . $pushback .
						"', friendly = " . "'" . $friendly . 
						"', details = " . "'" .  $details . "' " . 
						"WHERE match_id = '" . $_POST['id'] . "'";	
		}
		else
		{
			header("location:../adminpages.php?Page=matches&Action=edit&error=" . urlencode($error));
		}
		if (isset($sql) && (!empty($sql)))
		{
			$result = mysql_query($sql)
				or die("Invalid query1: " . mysql_error());
				
			// LOG SUBMISSION
			$logdata = 	"User edited match with match_id ". $_POST['id'];
			submitlog($logdata);
		}
		header("location:../adminpages.php?Page=matches");
}
?>