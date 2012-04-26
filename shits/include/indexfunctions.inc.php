<?php
function getrandompicture()
{
	global $featuredpicpath;
	global $featuredpiccomment;
	global $featuredpicwidth;
	global $featuredpicheight;
	
	$picquery = ("SELECT * FROM pictures WHERE Featured=1");
	$picresult = mysql_query($picquery)
		or die(mysql_error());
	if (mysql_num_rows($picresult) != 0)
	{
		while ($row = mysql_fetch_array($picresult))
		{
			$idarray[] = $row['picture_id'];
		}
		$featureidkey = array_rand($idarray);
		$featureid = $idarray[$featureidkey];
		$featurequery = ("SELECT thumb, comment FROM pictures WHERE picture_id='" . $featureid . "'");
		$featureresult = mysql_query($featurequery)
			or die(mysql_error());
		while ($featurerow = mysql_fetch_array($featureresult))
		{
			$featuredpicpath = $featurerow['thumb'];
			$featuredpiccomment = $featurerow['comment'];
		}
		// get the picture's size, so that portrait pictures don't look gay
		list ($width, $height) = getimagesize($featuredpicpath);
		if ($width > $height)
		{
			$featuredpicwidth = 233;
			$featuredpicheight = 175;
		}
		if ($width < $height)
		{
			$featuredpicwidth = 131;
			$featuredpicheight = 175;
		}
		if ($width == $height)
		{
			$featuredpicwidth = 175;
			$featuredpicheight = 175;
		}
		echo "<img src=\"$featuredpicpath\" alt=\"$featuredpiccomment\" width=\"$featuredpicwidth\" height=\"$featuredpicheight\" />";
	}
	else
		echo "There are currently no featured pictures";
}

function getrandomprofile()
{
	$profquery = "SELECT user_id FROM users WHERE archived = 0 AND user_id > 0";
	$profresult = mysql_query($profquery)
		or die(mysql_error());
	if (mysql_num_rows($profresult) !=0)
	{
		while ($row = mysql_fetch_array($profresult))
		{
			$idarray[] = $row['user_id'];
		}
		$featureidkey = array_rand($idarray);
		$featureid = $idarray[$featureidkey];
		$featurequery = "SELECT username, user_avatar, p.name, s.name, quote, points ".
						"FROM users, sides AS s, positions AS p ".
						"WHERE user_id='" . $featureid . "' ".
						"AND user_id != -1 ".
						"AND side = s.side_id ".
						"AND position = p.position_id";;
		$featureresult = mysql_query($featurequery)
			or die(mysql_error());
		while ($featurerow = mysql_fetch_array($featureresult))
		{
			$avatar = $featurerow['user_avatar'];
			$uname = $featurerow['username'];
			$position = $featurerow[2];
			$side = $featurerow[3];
			$quote = stripslashes($featurerow['quote']);
			$points = $featurerow['points'];
		}
		// get the picture's size, so that portrait pictures don't look gay
		list ($width, $height) = getimagesize($avatar);
		if ($width > $height)
		{
			$featuredpicwidth = 80;
			$featuredpicheight = 60;
		}
		if ($width < $height)
		{
			$featuredpicwidth = 60;
			$featuredpicheight = 80;
		}
		if ($width == $height)
		{
			$featuredpicwidth = 80;
			$featuredpicheight = 80;
		}
		echo "<h3>Member Profile</h3>";
		echo "<div class=\"right\"><a href=\"viewprofile.php?action=view&amp;uid=".$featureid."\"><img src=\"".$avatar."\" border=\"0\" alt=\"".$uname."\" /></a></div>";
		echo "<p><strong>Nickname:</strong> ".$uname."<br />";
		echo "<strong>Favoured Position:</strong> ".$side." ".$position."<br />";
		echo "<strong>Fantasy League Points:</strong> ".$points."<br />";
		echo "<strong>Quote:</strong> ".$quote."</p>";
	}
	else
	{
		$featuredpiccomment = "There are currently no featured pictures";
	}
}

function formatdate($date)
{
	$year = substr($date, 0, 4);
	$month = substr($date, 5, 2);
	$day = substr($date, 8, 2);
	
	if (($month == 0 || $year == 0 || $day == 0) || ($month < 0 || $year < 1970 || $day < 0))
		return "Date not entered";
	else
		return date("j F Y", mktime(0, 0, 0, $month, $day, $year));
}

function getnews()
{
	global $NEWS;
	
	$query = "SELECT * FROM newsarticles";
	$result = mysql_query($query)
		or die(mysql_error());
	$articlecount = mysql_num_rows($result);
	
	$newsquery = "SELECT newsarticles.article_id, newsarticles.Heading, newsarticles.Text, newsarticles.SubmittedOn, users.username, newsarticlecategories.Name, users.user_id " .
				"FROM newsarticles, users, newsarticlecategories " .
				"WHERE newsarticles.article_id > '" . ($articlecount -5) . "' AND newsarticles.user_id = users.user_id AND " .
				"newsarticles.Category = newsarticlecategories.category_id " .
				"ORDER BY newsarticles.SubmittedOn DESC " .
				"LIMIT 5";
	$newsresult = mysql_query($newsquery)
		or die(mysql_error());
		
	while ($newsrow = mysql_fetch_array($newsresult))
	{
		$uid[] = $newsrow['user_id'];
		$id[] = $newsrow['article_id'];
		$headline[] = $newsrow['Heading'];
		$text[] = $newsrow['Text'];
		$date[] = formatdate($newsrow['SubmittedOn']);
		$submittedby[] = $newsrow['username'];
		$category[] = $newsrow['Name'];
	}
	
	$i = 0;
	$NEWS = '';
	while ($i<sizeof($text))
	{
		$NEWS .=<<<EOD
		<h2><a href="./newsdetails.php?article_id=$id[$i]">$headline[$i]</a></h2>
		<i>By <a href="./viewprofile.php?action=view&amp;uid=$uid[$i]">$submittedby[$i]</a> on $date[$i] in $category[$i]</i>
		<p>$text[$i]</p>
EOD;
	$i++;
	}
}

function getupcomingmatches()
{
	global $matches;
	
	$matchquery = 	"SELECT squads.name, matches.opposition, matches.date, matches.match_id " .
					"FROM matches, squads " .
					"WHERE  matches.date >= NOW() AND matches.date <= DATE_ADD(NOW() , INTERVAL 7 DAY)" .
					"AND matches.squad_id = squads.squad_id ORDER BY matches.Date";
					
	$matchresult = mysql_query($matchquery)
		or die(mysql_error());
	$opposition = array();
	while ($matchrow = mysql_fetch_array($matchresult))
	{
		$matchid[] = $matchrow['match_id'];
		$squad[] = $matchrow['name'];
		$opposition[] = $matchrow['opposition'];
		$matchdate[] = $matchrow['date'];
	}
	
	$j = 0;
	$matches = '';
	$sizeop = sizeof($opposition);
	
	if ($sizeop == 0)
	{
		$matches = "There are no upcoming fixtures<br />";
	}
	else
	{
		while ($j<$sizeop)
		{
			$matches .=<<<EOD
			<a href="./matchdetails.php?match_id=$matchid[$j]">$squad[$j] v $opposition[$j] on $matchdate[$j]</a><br />
EOD;
		$j++;
		}
	}
}

function getplayedmatches()
{
	global $playedmatches;
	
	$playedmatchquery = "SELECT squads.name, playedmatches.opposition, playedmatches.home_score, playedmatches.opp_score, playedmatches.report_id, playedmatches.date " .
						"FROM playedmatches, squads " .
						"WHERE playedmatches.squad_id = squads.squad_id " .
						"ORDER BY playedmatches.date DESC LIMIT 7";
					
	$playedmatchresult = mysql_query($playedmatchquery)
		or die(mysql_error());
	
	while ($playedmatchrow = mysql_fetch_array($playedmatchresult))
	{
		$pmatch[] = array($playedmatchrow['report_id'], $playedmatchrow['name'], $playedmatchrow['opposition'], $playedmatchrow['home_score'], $playedmatchrow['opp_score'], $playedmatchrow['date']);
	}
	
	// this next query is to get any recent matches where the squad has been moved to the squadhistory table
	$squadhistoryquery = "SELECT squadhistory.name, playedmatches.opposition, playedmatches.home_score, playedmatches.opp_score, playedmatches.report_id, playedmatches.date " .
						"FROM playedmatches, squadhistory " .
						"WHERE playedmatches.squad_id = squadhistory.squad_id " .
						"ORDER BY playedmatches.date DESC LIMIT 7";
	$squadhistoryresult = mysql_query($squadhistoryquery)
		or die(mysql_error());
	
	while ($squadhistoryrow = mysql_fetch_array($squadhistoryresult))
	{
		$pmatch[] = array($squadhistoryrow['report_id'], $squadhistoryrow['name'], $squadhistoryrow['opposition'], $squadhistoryrow['home_score'], $squadhistoryrow['opp_score'], $squadhistoryrow['date']);
	}
	
	if (empty($pmatch))
	{
		$playedmatches = "There are no recent fixtures";
	}
	else
	{
		// order the array by date
		// don't understand the ksort function
		
		$j = 0;
		$playedmatches = '';
		$psizeop = 7;
		if ($psizeop == 0)
		{
			$playedmatches = "<li>There are no recent fixtures</li>";
		}
		else
		{
			while ($j<$psizeop)
			{
				$matchtemp = '';
				$matchtemp = $pmatch[$j];
				$preportid = $matchtemp['0'];
				$psquad = $matchtemp['1'];
				$popposition = $matchtemp['2'];
				$pscore = $matchtemp['3'] . ' - '. $matchtemp['4'];
				$playedmatches .=<<<EOD
				<li><a href="./matches.php?Page=readreports.php&amp;report_id=$preportid">$psquad $pscore $popposition</a></li>
EOD;
			$j++;
			}
		}
	}
}

function getnextevent()
{
	global $event;

	$eventquery = 'SELECT event_id, Name FROM `events` WHERE `eventdatetime` >= NOW() ORDER BY `eventdatetime` LIMIT 3';
	
	
	$eventresults = mysql_query($eventquery)
		or die(mysql_error());
	
	$eventname = array();
	while ($eventrow = mysql_fetch_array($eventresults))
	{
		$eventid[] = $eventrow['event_id'];
		$eventname[] = $eventrow['Name'];
	}

	$k = 0;
	$event = '';
	$sizeevent = count($eventname);
	if ($sizeevent == 0)
	{
		$event = "There are no upcoming socials<br />";
	}
	else
	{
		while ($k<$sizeevent)
		{
			$event .=<<<EOD
			<a href="./viewevent.php?event_id=$eventid[$k]">$eventname[$k]</a><br />
EOD;
	$k++;
		}
	}
}

function getbirthdays()
{
	global $birthdays;
	$mnth = date('m');
	$day = date('j');
	$birthdayquery = "SELECT user_id, username, dob FROM users WHERE MONTH(dob) = '" . $mnth . "'";
	$birthdayresults = mysql_query($birthdayquery)
		or die(mysql_error());
		
	$birthdayname = array();	
	while ($birthdayrow = mysql_fetch_array($birthdayresults))
	{
		$bday = substr($birthdayrow['dob'], 8, 2);
		if ($bday == $day)
		{
			$birthdayid[] = $birthdayrow['user_id'];
			$birthdayname[] = $birthdayrow['username'];
		}
	}

	$l = 0;
	$birthdays = '';
	if (sizeof($birthdayid) == 0)
		$birthdays = "There are no birthdays today<br />";
	else
	{
		while ($l<sizeof($birthdayid))
		{
			$birthdays .=<<<EOD
			<a href="./viewprofile.php?action=view&amp;uid=$birthdayid[$l]">$birthdayname[$l]</a>,
EOD;
	$l++;
		}
		$birthdays = substr($birthdays,0,(strlen($birthdays)-1));
	}

}

function getnewsletters()
{
	global $newsletters;
	
	$nl_query = "SELECT Title, path FROM newsletters WHERE archived = 0 ORDER BY SubmittedOn DESC LIMIT 5 ";
	$nl_result = mysql_query($nl_query)
		or die(mysql_error());
		
	while ($nl_row = mysql_fetch_array($nl_result))
	{
		$nltitle[] = $nl_row['Title'];
		$nlpath[] = $nl_row['path'];
	}
	
	if (mysql_num_rows($nl_result) == 0)
	{
		$newsletters = "<em>There are currently no newsletters online</em>";
	}
	else
	{
		$newsletters = '';
		for ($m=0; $m<sizeof($nltitle); $m++)
		{
			$newsletters .=<<<EOD
			<li><a href="$nlpath[$m]">$nltitle[$m]</a></li>
EOD;
		}
	}
}

function gettopscorer()
{
	global $topscorer;
	
	$ts_query = "SELECT user_id FROM scorers";
	$ts_result = mysql_query($ts_query)
		or die($mysql_error());
	if (mysql_num_rows($ts_result) == 0)
	{
		$topscorer = "There have been no goals scored yet";
	}
	else
	{
		while ($ts_row = mysql_fetch_array($ts_result))
		{
			$scorerid[] = $ts_row['user_id'];
		}
		$scorers = array_count_values($scorerid);
		$scorers_keys = array_keys($scorers);
		$topscore = current($scorers);
		$topscorerid[] = $scorers_keys[0];
		while (next($scorers))
		{
			if ($topscore < current($scorers))
			{
				$topscore = current($scorers);
				$topscorerid = '';
				$topscorerid[] = key($scorers);
			}
			elseif ($topscore == current($scorers))
			{
				$topscorerid[] = key($scorers);
			}
		}
		$topscorername = '';
		for ($s = 0; $s<sizeof($topscorerid); $s++)
		{
			$tsq2 = "SELECT username FROM users WHERE user_id = '" . $topscorerid[$s] . "'";
			$tsres2 = mysql_query($tsq2)
				or die(mysql_error());
			$tsrow = mysql_fetch_array($tsres2);
			$topscorername .= "<li><a href=\"./viewprofile.php?action=view&amp;uid=".$topscorerid[$s]."\">".$tsrow['username'] . " </a>, ";
		}
		$topscorername = substr($topscorername,0,(strlen($topscorername)-2));
		$topscorer = $topscorername . " - " . $topscore."</li>";
	}
}

function submitlog($action)
{
	// LOG SUBMISSION
	$log = "INSERT INTO log (`user_id`, `action`, `timestamp`, `ip`) VALUES ".
	"('". $_SESSION['shef_hockey_user_id'] ."', '". $action ."', '". date("Y-m-d G:i:s", time()) ."', '". $_SERVER['REMOTE_ADDR'] ."')";

	if (isset($log))
	{
		$logresult = mysql_query($log)
			or die("Log entry failed: ". mysql_error());
	}
}

function checkmatches($uid)
{
	$query = "SELECT available, date FROM match_squad LEFT JOIN matches ON matches.match_id = match_squad.match_id " .
				"WHERE match_squad.user_id = '" . $_SESSION['shef_hockey_user_id'] . "' " .
				"AND Available = '-1' " .
				"AND Date >= NOW()";
	$res = mysql_query($query)
		or die(mysql_error());
	$mcount = mysql_num_rows($res);
	if ($mcount != 0)
	{
		if ($mcount == 1)
			$plural = '';
		else
			$plural = 'es';
		echo "<h6>You have been selected for " . $mcount . " match".$plural."</h6>";
		echo "<strong><a href=\"./memberpages.php?Page=checkmatches\">Click here</a> to confirm your availability</strong>";
	}
}

function checklogs()
{
	if ($_SESSION['shef_hockey_user_securitylevel'] == 1)
	{
		$query = "SELECT log_id FROM log WHERE log.read=0";
		$res = mysql_query($query)
			or die(mysql_error());
		$lcount = mysql_num_rows($res);
		if ($lcount != 0)
		{
			if ($lcount == 1)
			{
				$plural = '';
				$prefix = 'is ';
			}
			else
			{
				$plural = 's';
				$prefix = ' are ';
			}
			echo "<h6>There ".$prefix . $lcount . " unread log".$plural." that require your attention</h6>";
			echo "<strong><a href=\"./adminpages.php?Page=log\">Click here</a> to read them</strong>";
		}
	}
}

?>