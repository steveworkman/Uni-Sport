<?php
include("../inc/connect.inc.php");
// This is the AJAX function for searching people.
header("Content-Type: text/xml; charset=UTF-8");

$str = trim($_POST['str']);
$user = $_POST['uid'];

// Construct the dates
$fromdate = date("Y-m-d G:i:s",mktime(0,0,0,$_POST['fmon'], $_POST['fday'], $_POST['fyr']));
$todate = date("Y-m-d G:i:s",mktime(0,0,0,$_POST['tmon'], $_POST['tday'], $_POST['tyr']));

if (!empty($str))
{
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	
	switch($_POST['type'])
	{	
		case 'events':
			// Events
			$eq = "SELECT event_id, name, description FROM events WHERE eventdatetime BETWEEN '".$fromdate."' AND '".$todate."'";
			$eres = mysql_query($eq)
				or die(mysql_error());
			while($erow = mysql_fetch_array($eres))
			{
				if(stristr($erow['description'], $str) || stristr($erow['name'], $str))
				{
					echo "<event>";
					echo "<id>".$erow['event_id']."</id>";
					echo "<name>".$erow['name']."</name>";
					echo "<desc>".stripslashes(substr(str_replace('</em>', '',str_replace('<em>', '',str_replace('<br />', '',$erow['description']))),0, 35))."...</desc>";
					echo "</event>";
				}
			}
		break;
		
		case 'news':
			// News
			$nq = "SELECT article_id, heading, text FROM newsarticles WHERE submittedon BETWEEN '".$fromdate."' AND '".$todate."'";
			$nres = mysql_query($nq)
				or die(mysql_error());
			while($nrow = mysql_fetch_array($nres))
			{
				if(stristr($nrow['heading'], $str))
				{
					echo "<news>";
					echo "<id>".$nrow['article_id']."</id>";
					echo "<heading>".$nrow['heading']."</heading>";
					echo "<text>".stripslashes(substr(str_replace('</em>', '',str_replace('<em>', '',str_replace('<br />', '',$nrow['text']))),0, 35))."...</text>";
					echo "</news>";
				}
			}
		break;
		
		
		case 'nletter':
			// Newsletters
			$nq = "SELECT newsletter_id, title, path FROM newsletters WHERE submittedon BETWEEN '".$fromdate."' AND '".$todate."'";
			$nres = mysql_query($nq)
				or die(mysql_error());
			while($nrow = mysql_fetch_array($nres))
			{
				if(stristr($nrow['title'], $str))
				{
					echo "<nletter>";
					echo "<id>".$nrow['newsletter_id']."</id>";
					echo "<title>".$nrow['title']."</title>";
					echo "<path>".$nrow['path']."</path>";
					echo "</nletter>";
				}
			}
		break;
		
		case 'match':
			// Matches with current squads
			$mq = "SELECT report_id, opposition, name, home_score, opp_score FROM playedmatches, squads ".
					"WHERE date BETWEEN '".$fromdate."' AND '".$todate."' ".
					"AND playedmatches.squad_id = squads.squad_id";
			$mres = mysql_query($mq)
				or die(mysql_error());
			while($mrow = mysql_fetch_array($mres))
			{
				if(stristr($mrow['opposition'], $str) || stristr($mrow['name'], $str))
				{
					echo "<match>";
					echo "<id>".$mrow['report_id']."</id>";
					echo "<title>".stripslashes($mrow['name'])." ".$mrow['home_score']. " - ".$mrow['opp_score']." ".stripslashes($mrow['opposition'])."</title>";
					echo "</match>";
				}
			}
			// Matches with history squads
			$mhq = "SELECT report_id, opposition, name, home_score, opp_score FROM playedmatches, squadhistory ".
					"WHERE date '".$fromdate."' AND '".$todate."' ".
					"AND playedmatches.squad_id = squadhistory.squad_id";
			$mhres = mysql_query($mhq)
				or die(mysql_error());
			while($mhrow = mysql_fetch_array($mhres))
			{
				if(stristr($mhrow['opposition'], $str) || stristr($mhrow['name'], $str))
				{
					echo "<match>";
					echo "<id>".$mhrow['report_id']."</id>";
					echo "<title>".$mhrow['name']." ".$mhrow['home_score']. " - ".$mhrow['opp_score']." ".$mhrow['opposition']."</title>";
					echo "</match>";
				}
			}
		break;
		
		//Pictures
		case 'picbyu':
			echo "<type>picbyu</type>";
			echo "<uid>".$user."</uid>";
			$uq = "SELECT picture_id, comment, thumb FROM pictures ".
					"WHERE user_id = '".$user."' ".
					"AND date BETWEEN '".$fromdate."' AND '".$todate."' ".
					"LIMIT 9";
			$ures = mysql_query($uq)
				or die(mysql_error());
			while ($urow = mysql_fetch_array($ures))
			{
					echo "<pic>";
					echo "<id>".$urow['picture_id']."</id>";
					echo "<caption>".htmlspecialchars($urow['comment'])."</caption>";
					echo "<thumb>".$urow['thumb']."</thumb>";
					echo "</pic>";
			}
		break;
		
		case 'picofu':
			echo "<type>picofu</type>";
			echo "<uid>".$user."</uid>";
			$uq = "SELECT pictures.picture_id, comment, thumb FROM pictures, user_picture ".
					"WHERE user_picture.user_id = '".$user."' ".
					"AND pictures.picture_id = user_picture.picture_id ".
					"AND date BETWEEN '".$fromdate."' AND '".$todate."' ".
					"LIMIT 9";
			$ures = mysql_query($uq)
				or die(mysql_error());
			while ($urow = mysql_fetch_array($ures))
			{
					echo "<pic>";
					echo "<id>".$urow['picture_id']."</id>";
					echo "<caption>".htmlspecialchars($urow['comment'])."</caption>";
					echo "<thumb>".$urow['thumb']."</thumb>";
					echo "</pic>";
			}
		break;
			
		case 'caption':
			echo "<type>caption</type>";
			echo "<uid>".$user."</uid>";
			$pq3 = "SELECT picture_id, comment, thumb FROM pictures ".
					"WHERE date BETWEEN '".$fromdate."' AND '".$todate."' ";
			$pres3 = mysql_query($pq3)
				or die(mysql_error());
			$counter = 0;
			while ($prow3 = mysql_fetch_array($pres3))
			{
				if (stristr($prow3['comment'], $str))
				{
					if ($counter < 9)
					{
						echo "<pic>";
						echo "<id>".$prow3['picture_id']."</id>";
						echo "<caption>".htmlspecialchars($prow3['comment'])."</caption>";
						echo "<thumb>".$prow3['thumb']."</thumb>";
						echo "</pic>";
						$counter++;
					}
				}
			}
		break;
	}
	echo "</root>";
}
else
{
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>";
	echo "<root>";
	echo "</root>";
}
?>