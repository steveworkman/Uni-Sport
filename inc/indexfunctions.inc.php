<?php
include_once('classes/class.SidebarContent.php');
include_once('classes/class.MiniProfile.php');
include_once('classes/class.MiniFacebookProfile.php');

/*
 * Retrieves a random picture from the database that has been marked as 'featured'
 * Returns an array with 'link', 'alt', 'imgw' and 'imgh'
 * If there are no featured pics, returns an empty array
 */
function getRandomPicture()
{
	$data = array();

	$picquery = ('SELECT * FROM pictures WHERE featured=1');
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
		$featurequery = ('SELECT thumb, path, comment FROM pictures WHERE picture_id='.$featureid);
		$featureresult = mysql_query($featurequery)
			or die(mysql_error());
		while ($featurerow = mysql_fetch_array($featureresult))
		{
			$featuredpicthumb = $featurerow['thumb'];
			$featuredpicpath = $featurerow['path'];
			$featuredpiccomment = $featurerow['comment'];
		}
		// get the picture's size, so that portrait pictures don't look gay
		list ($width, $height) = getimagesize($featuredpicpath);
		if ($width > $height)
		{
			$featuredpicwidth = 233;
			$featuredpicheight = 175;
			$boxw = 250;
		}
		if ($width < $height)
		{
			$featuredpicwidth = 131;
			$featuredpicheight = 175;
			$boxw = 150;
		}
		if ($width == $height)
		{
			$featuredpicwidth = 175;
			$featuredpicheight = 175;
			$boxw = 190;
		}
		$data = array('path'=>$featuredpicpath, 'thumb'=>$featuredpicthumb,
					'alt'=>$featuredpiccomment, 'boxw'=>$boxw,
					'imgw'=>$featuredpicwidth, 'imgh'=>$featuredpicheight,
					'tags'=>formatTags(getTags($featureid)));
	}
	return $data;
}

/*
 * Retrieves a random profile id for use with the miniprofile class, which gets the data.
 * Returns a miniprofile object
 */
function getrandomprofile(Facebook $facebook=null)
{
	$profquery = 'SELECT user_id, fb_id FROM users WHERE archived = 0 AND user_id > 0'; // Make sure it's current users and not SS
	$profresult = mysql_query($profquery)
		or die(mysql_error());
	if (mysql_num_rows($profresult) !=0)
	{
		while ($row = mysql_fetch_array($profresult))
		{
			$idarray[] = $row['user_id'];
			$fbarray[] = $row['fb_id'];
		}
		$featureidkey = array_rand($idarray);
		$featureid = $idarray[$featureidkey];
		if($fbarray[$featureidkey] != 0)
			$profile = new MiniFacebookProfile($facebook,$fbarray[$featureidkey],$featureid);
		else
			$profile = new MiniProfile($featureid);
	}
	else
	{
		$profile = new MiniProfile(0);
		$profile->error = 'There are currently no members';
	}
	return $profile;
}


/*
 * Deprecated function, use {$variable|date_format}
 */
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

/*
 * Retrieves the latest $limit news articles
 * If $uid is set then it gets the ones written by that person
 * Returns array( array('id','link','headline','userLink','author','author_id','date','cat','text'))
 */
function getNews($limit, $uid=0, $arc=1)
{
	$data = array();

	$limitText = '';
	if($limit != 0)
		$limitText = 'LIMIT '.$limit;
	$uidText = '';
	if($uid != 0)
		$uidText = 'AND n.user_id = '.$uid.' ';
	$arcText = '';
	if($arc == 0)
		$arcText = 'AND n.archived = 0 ';
	
	$newsquery = 'SELECT n.article_id, n.heading, n.text, n.submittedon, u.username, nc.name, u.user_id, n.archived '.
				'FROM newsarticles AS n, users AS u, newsarticlecategories AS nc '.
				'WHERE n.user_id = u.user_id '.
				'AND n.category = nc.category_id '.
				$uidText.$arcText.
				'ORDER BY n.submittedon DESC '.$limitText;
				
	$newsresult = mysql_query($newsquery)
		or die(mysql_error());
		
	while ($newsrow = mysql_fetch_array($newsresult))
	{
		$data[] = array('id'=>$newsrow['article_id'],
						'link'=>'./newsdetails.php?article_id='.$newsrow['article_id'],
						'headline'=>$newsrow['heading'],
						'userLink'=>'./viewprofile.php?action=view&amp;uid='.$newsrow['user_id'],
						'author'=>$newsrow['username'],
						'author_id'=>$newsrow['user_id'],
						'date'=>$newsrow['submittedon'],
						'cat'=>$newsrow['name'],
						'text'=>$newsrow['text'],
						'arc'=>$newsrow['archived']);
	}
	SmartyPaginate::setTotal(count($data));
	return array_slice($data, SmartyPaginate::getCurrentIndex(),SmartyPaginate::getLimit());
}

/*
 * Retrieves a single news article
 * I've not created a newsarticle object because on the main index page that would actually increase the
 * amount of SQL queries (instead of one it would be 5, or $limit)
 */
function getNewsArticle($id)
{
	$data = array();
	if(empty($id))
		return $data;	
	$newsquery = 'SELECT n.article_id, n.heading, n.text, n.submittedon, u.username, nc.name, n.category, u.user_id '.
				'FROM newsarticles AS n, users AS u, newsarticlecategories AS nc '.
				'WHERE n.article_id = '.$id.' AND n.user_id = u.user_id AND '.
				'n.category = nc.category_id';
				
	$newsresult = mysql_query($newsquery)
		or die(mysql_error());
		
	while ($newsrow = mysql_fetch_array($newsresult))
	{
		$data = array('link'=>'./newsdetails.php?article_id='.$newsrow['article_id'],
						'id'=>$newsrow['article_id'],
						'headline'=>$newsrow['heading'],
						'userLink'=>'./viewprofile.php?action=view&amp;uid='.$newsrow['user_id'],
						'author'=>$newsrow['username'],
						'author_id'=>$newsrow['user_id'],
						'date'=>$newsrow['submittedon'],
						'cat'=>$newsrow['name'],
						'cat_id'=>$newsrow['category'],
						'text'=>$newsrow['text']);
	}
	return $data;
}

/*
 * Retrieves the latest $limit Fantasy League news articles
 * If $uid is set then it gets the ones written by that person
 * Returns array( array('id','link','headline','userLink','author','author_id','date','cat','text'))
 */
function getFNews($limit, $uid=0, $arc=1)
{
	$data = array();

	$limitText = '';
	if($limit != 0)
		$limitText = 'LIMIT '.$limit;
	$uidText = '';
	if($uid != 0)
		$uidText = 'AND n.user_id = '.$uid.' ';
	$arcText = '';
	if($arc == 0)
		$arcText = 'AND n.archived = 0 ';
	
	$newsquery = 'SELECT n.article_id, n.heading, n.text, n.submittedon, u.username, nc.name, u.user_id, n.archived '.
				'FROM fhockeynews AS n, users AS u, newsarticlecategories AS nc '.
				'WHERE n.user_id = u.user_id '.
				'AND n.category = nc.category_id '.
				$uidText.$arcText.
				'ORDER BY n.submittedon DESC '.$limitText;
				
	$newsresult = mysql_query($newsquery)
		or die(mysql_error());
		
	while ($newsrow = mysql_fetch_array($newsresult))
	{
		$data[] = array('id'=>$newsrow['article_id'],
						'link'=>'./newsdetails.php?article_id='.$newsrow['article_id'],
						'headline'=>$newsrow['heading'],
						'userLink'=>'./viewprofile.php?action=view&amp;uid='.$newsrow['user_id'],
						'author'=>$newsrow['username'],
						'author_id'=>$newsrow['user_id'],
						'date'=>$newsrow['submittedon'],
						'cat'=>$newsrow['name'],
						'text'=>$newsrow['text'],
						'arc'=>$newsrow['archived']);
	}
	SmartyPaginate::setTotal(count($data));
	return array_slice($data, SmartyPaginate::getCurrentIndex(),SmartyPaginate::getLimit());
}

/*
 * Retrieves a single Fantasy Leaguenews article
 * I've not created a newsarticle object because on the main index page that would actually increase the
 * amount of SQL queries (instead of one it would be 5, or $limit)
 */
function getFNewsArticle($id)
{
	$data = array();
	if(empty($id))
		return $data;	
	$newsquery = 'SELECT n.article_id, n.heading, n.text, n.submittedon, u.username, nc.name, n.category, u.user_id, n.archived '.
				'FROM fhockeynews AS n, users AS u, newsarticlecategories AS nc '.
				'WHERE n.article_id = '.$id.' AND n.user_id = u.user_id AND '.
				'n.category = nc.category_id';
				
	$newsresult = mysql_query($newsquery)
		or die(mysql_error());
		
	while ($newsrow = mysql_fetch_array($newsresult))
	{
		$data = array('link'=>'./newsdetails.php?article_id='.$newsrow['article_id'],
						'id'=>$newsrow['article_id'],
						'headline'=>$newsrow['heading'],
						'userLink'=>'./viewprofile.php?action=view&amp;uid='.$newsrow['user_id'],
						'author'=>$newsrow['username'],
						'author_id'=>$newsrow['user_id'],
						'date'=>$newsrow['submittedon'],
						'cat'=>$newsrow['name'],
						'cat_id'=>$newsrow['category'],
						'text'=>$newsrow['text'],
						'arc'=>$newsrow['archived']);
	}
	return $data;
}

/*
 * Retrieves the next 7 upcoming matches. Needs to be updated to be more flexible (calendar use)
 * Returns an array (array ('link', 'name', 'date'))
 * Returns empty array on error
 */
function getUpcomingMatches($mnth, $yr)
{
	$data = array();
	$where = 'WHERE  m.date >= NOW() AND m.date <= DATE_ADD(NOW() , INTERVAL 7 DAY)';
	if($mnth != 0 && $yr != 0)
		$where = 'WHERE MONTH(m.date)='.$mnth.' AND YEAR(m.date)='.$yr;
	$matchquery = 	'SELECT s.name, m.opposition, m.date, m.match_id '.
					'FROM matches AS m, squads AS s '.
					$where.
					' AND m.squad_id = s.squad_id ORDER BY m.date';
					
	$matchresult = mysql_query($matchquery)
		or die(mysql_error());
	if (mysql_num_rows($matchresult) != 0)
	{
		while ($matchrow = mysql_fetch_array($matchresult))
		{
			$data[] = array('link'=>'./matchdetails.php?match_id='.$matchrow['match_id'],
							'name'=>$matchrow['name'].' v '.$matchrow['opposition'],
							'date'=>$matchrow['date']);

		}
	}
	return $data;
}

/*
 * Retrieves result details for matches played in a $mnth and $yr.
 * If $mnth and $yr are 0, all matches are returned
 * Returns an array(array('link', 'name', 'date'))
 */
function getPlayedMatches($mnth, $yr)
{
	$data = array();
	$and = '';
	if($mnth != 0 && $yr != 0)
		$and = 'AND MONTH(p.date) = '.$mnth.' AND YEAR(p.date) = '.$yr.' ';
	
	$playedmatchquery = 'SELECT s.name, p.opposition, p.home_score, p.opp_score, p.report_id, p.date '.
						'FROM playedmatches AS p, squads AS s '.
						'WHERE p.squad_id = s.squad_id '.
						$and.
						'ORDER BY p.date';
					
	$playedmatchresult = mysql_query($playedmatchquery)
		or die(mysql_error());
	
	while ($playedmatchrow = mysql_fetch_array($playedmatchresult))
	{
		$pmatch[] = array($playedmatchrow['report_id'], $playedmatchrow['name'], $playedmatchrow['opposition'], 
							$playedmatchrow['home_score'], $playedmatchrow['opp_score'], $playedmatchrow['date']);
	}
	
	// this next query is to get any recent matches where the squad has been moved to the squadhistory table
	$squadhistoryquery = 'SELECT sh.name, p.opposition, p.home_score, p.opp_score, p.report_id, p.date '.
						'FROM playedmatches AS p, squadhistory AS sh '.
						'WHERE p.squad_id = sh.squad_id '.
						$and.
						'ORDER BY p.date';
	$squadhistoryresult = mysql_query($squadhistoryquery)
		or die(mysql_error());
	
	while ($squadhistoryrow = mysql_fetch_array($squadhistoryresult))
	{
		$pmatch[] = array($squadhistoryrow['report_id'], $squadhistoryrow['name'], $squadhistoryrow['opposition'], 
							$squadhistoryrow['home_score'], $squadhistoryrow['opp_score'], $squadhistoryrow['date']);
	}
	
	if (!empty($pmatch))
	{
		// order the array by date
		$j = 0;
		while ($j<sizeof($pmatch))
		{
			$matchtemp = ''; // Reset matchtemp
			$matchtemp = $pmatch[$j];
			$preportid = $matchtemp['0'];
			$psquad = $matchtemp['1'];
			$popposition = $matchtemp['2'];
			$pscore = $matchtemp['3'].' - '.$matchtemp['4'];
			$pdate = $matchtemp['5'];
			
			$data[] = array('link'=>'./matches.php?report_id='.$preportid,
							'text'=>$psquad.' '.$pscore.' '.$popposition,
							'date'=>$pdate,
							'id'=>$preportid);
			$j++;
		}
	}
	usort($data, "comparePlayedMatches");
	return $data;
}

/*
 * Sorts the array of playedmatches by date
 * Returns the sorted array
 */
function comparePlayedMatches($a,$b)
{
	if($a['date'] == $b['date']) {
		return 0;
	}
	return ($a['date'] > $b['date']) ? -1 : 1;
}

/*
 * Retrieves result details for the last $limit match reports submitted. Takes from squadhistory if neccessary
 * Returns a sidebarContent object
 */
function getPlayedMatchesSB($limit)
{
	$playedmatches = new sidebarContent('Recent Matches');
	$playedmatches->id = 'matches';
	
	$playedmatchquery = 'SELECT s.name, p.opposition, p.home_score, p.opp_score, p.report_id, p.date, m.created_on '.
						'FROM playedmatches AS p, squads AS s, matchreports AS m '.
						'WHERE p.squad_id = s.squad_id '.
						'AND m.report_id = p.report_id '.
						'ORDER BY p.date DESC LIMIT '.$limit;
					
	$playedmatchresult = mysql_query($playedmatchquery)
		or die(mysql_error());
	
	while ($playedmatchrow = mysql_fetch_array($playedmatchresult))
	{
		$pmatch[] = array($playedmatchrow['report_id'], $playedmatchrow['name'], $playedmatchrow['opposition'], 
							$playedmatchrow['home_score'], $playedmatchrow['opp_score'], $playedmatchrow['date'], $playedmatchrow['created_on']);
	}
	
	// this next query is to get any recent matches where the squad has been moved to the squadhistory table
	$squadhistoryquery = 'SELECT sh.name, p.opposition, p.home_score, p.opp_score, p.report_id, p.date, m.created_on '.
						'FROM playedmatches AS p, squadhistory AS sh, matchreports AS m '.
						'WHERE p.squad_id = sh.squad_id '.
						'AND m.report_id = p.report_id '.
						'ORDER BY p.date DESC LIMIT '.$limit;
	$squadhistoryresult = mysql_query($squadhistoryquery)
		or die(mysql_error());
	
	while ($squadhistoryrow = mysql_fetch_array($squadhistoryresult))
	{
		$pmatch[] = array($squadhistoryrow['report_id'], $squadhistoryrow['name'], $squadhistoryrow['opposition'], 
							$squadhistoryrow['home_score'], $squadhistoryrow['opp_score'], $squadhistoryrow['date'], $squadhistoryrow['created_on']);
	}
	
	if (!empty($pmatch) && $limit != 0)
	{
		// order the array by date
		$j = 0;
		$data = array();
		while ($j<sizeof($pmatch))
		{
			$matchtemp = ''; // Reset matchtemp
			$matchtemp = $pmatch[$j];
			$preportid = $matchtemp['0'];
			$psquad = $matchtemp['1'];
			$popposition = $matchtemp['2'];
			$pscore = $matchtemp['3'].' - '.$matchtemp['4'];
			$pdate = $matchtemp['5'];
			$pcreated = $matchtemp['6'];
			if(date_dif($pcreated, date('Y-m-d')) < 7)
			{$pnew = 1;}
			else
			{$pnew = 0;}
			
			$data[] = array('link'=>'./matches.php?report_id='.$preportid,
							'text'=>$psquad.' '.$pscore.' '.$popposition,
							'date'=>$pdate,
							'new'=>$pnew);
			$j++;
		}
		usort($data, "comparePlayedMatches");
		if($limit != 0) {
			$data = array_slice($data,0,$limit);
		}
		// Set the generated data to the object
		$playedmatches->data = $data;
	}
	else
		$playedmatches->error = 'There are no recent matches';
		
	return $playedmatches;
}

/*
 * Retrieves the upcoming events. Needs to be extended to take a date range (so it can be used in the calendar)
 * Returns an array (array ('link', 'name'))
 * Returns empty array on error
 */
function getUpcomingEvents($limit)
{
	$data = array();
	$limitText = '';
	if($limit != 0)
		$limitText = 'LIMIT '.$limit;
	
	$eventquery = 'SELECT event_id, name FROM `events` WHERE `eventdatetime` >= NOW() ORDER BY `eventdatetime` '.$limitText;
	$eventresults = mysql_query($eventquery)
		or die(mysql_error());
	
	if (mysql_num_rows($eventresults) != 0)
	{
		while ($eventrow = mysql_fetch_array($eventresults))
		{
			$data[] = array('link'=>'./viewevent.php?event_id='.$eventrow['event_id'],
							'name'=>$eventrow['name']);
		}
	}
	return $data;
}
/*
 * Retrieves the latest $limit events
 * If $uid is set then it gets the ones written by that person
 * Returns array( array('id','link','headline','userLink','author','author_id','date','cat','text'))
 */
function getEvents($limit, $uid=0, $arc=1)
{
	$data = array();
	$limitText = '';
	if($limit != 0)
		$limitText = 'LIMIT '.$limit;
	$uidText = '';
	if($uid != 0)
		$uidText = 'AND e.user_id = '.$uid.' ';
	$arcText = '';
	if($arc == 0)
		$arcText = 'AND e.archived = 0 ';
	
	$eventquery = 'SELECT e.event_id, e.name, e.description, e.eventdatetime, e.user_id, e.archived, u.username '.
					'FROM events AS e, users AS u '.
					'WHERE u.user_id = e.user_id '.
					$uidText.$arcText.
					'ORDER BY `eventdatetime` DESC '.$limitText;
	$eventresults = mysql_query($eventquery)
		or die(mysql_error());
	
	if (mysql_num_rows($eventresults) != 0)
	{
		while ($eventrow = mysql_fetch_array($eventresults))
		{
			$data[] = array('id'=>$eventrow['event_id'],
							'name'=>$eventrow['name'],
							'desc'=>$eventrow['description'],
							'date'=>$eventrow['eventdatetime'],
							'author_id'=>$eventrow['user_id'],
							'author'=>$eventrow['username'],
							'arc'=>$eventrow['archived']);
		}
	}
	SmartyPaginate::setTotal(count($data));
	return array_slice($data, SmartyPaginate::getCurrentIndex(),SmartyPaginate::getLimit());
}

/*
 * Retrieves the events for the given $month and $year
 * Returns an array(array('link', 'name', 'day'))
 * Returns an empty array on error
 */
function getMonthlyEvents($month, $year)
{
	$data = array();
	$eq = 	'SELECT event_id, name, eventdatetime '.
			'FROM events WHERE MONTH(eventdatetime) = '.$month.' AND YEAR(eventdatetime) = '.$year;
	$eres = mysql_query($eq)
		or die(mysql_error());
	while ($erow = mysql_fetch_array($eres))
	{
		$ed = explode('-', $erow['eventdatetime']);
		$data[] = array('link'=>'./viewevent.php?event_id='.$erow['event_id'],
						'name'=>$erow['name'],
						'day'=>$ed);
	}
	return $data;
}

/*
 * Retrieves a single event with id: $id
 * Returns array('name','desc','author','author_id','date')
 */
function getEvent($id)
{
	$data = array();
	if(empty($id))
	{
		return $data;
	}
	$query = 	'SELECT e.event_id, e.name, e.description, e.eventdatetime, u.username, e.user_id '.
				'FROM events AS e, users AS u '.
				'WHERE event_id = '.$id.' '.
				'AND e.user_id = u.user_id ';
				
	$result = mysql_query($query)
		or die(mysql_error());
	$row = mysql_fetch_array($result);
	$data = array('id'=>$row['event_id'],
					'name'=>$row['name'],
					'desc'=>$row['description'],
					'author'=>$row['username'],
					'author_id'=>$row['user_id'],
					'author_link'=>'./viewprofile.php?action=view&amp;uid='.$row['user_id'],
					'date'=>$row['eventdatetime']);
	return $data;
}

/*
 * Retrieves today's birthdays
 * Returns in format: array(array('link', 'name'))
 * When $month is specified, it returns all birthdays for that month
 * Returns in format: array(aray('link, 'name', 'dob'))
 * Returns an empty array on error
 */
function getBirthdays($month)
{
	$data = array();
	$mnth = $month;
	$day = date('j');
	
	if(empty($month))
		$mnth = date('m');
		
	$birthdayquery = 'SELECT user_id, username, dob, archived FROM users WHERE MONTH(dob) ='.$mnth;
	$birthdayresults = mysql_query($birthdayquery)
		or die(mysql_error());
		
	while ($birthdayrow = mysql_fetch_array($birthdayresults))
	{
		$bday = substr($birthdayrow['dob'], 8, 2);
		if(empty($month))
		{
			if ($bday == $day)
			{
				$data[] = array('link'=>'./viewprofile.php?action=view&amp;uid='.$birthdayrow['user_id'],
								'name'=>$birthdayrow['username']);
			}
		}
		else
		{
			$data[] = array('link'=>'./viewprofile.php?action=view&amp;uid='.$birthdayrow['user_id'],
								'name'=>$birthdayrow['username'],
								'dob'=>$birthdayrow['dob'],
								'arc'=>$birthdayrow['archived']);
		}
	}
	return $data;
}

// This function is from php.net by carloseduardopauluk at gmail dot com
// Takes two SQL dates and returns the difference in days
function date_dif($iniDate, $endDate) {
   $iniDate = explode("-",$iniDate);
   $endDate = explode("-",$endDate);
   $start_date    =    gregoriantojd($iniDate[1], $iniDate[2], $iniDate[0]);
   $end_date    =    gregoriantojd($endDate[1], $endDate[2], $endDate[0]);
   $dif = $end_date - $start_date;
   return $dif;
}

/*
 * Retrieves $limit most recent newsletters
 * Checks to see if they are new, adds a "new" tag to the link and sets to highlight the nlink bg
 * Returns a sidebarContent object.
 */
function getNewsletters($limit)
{
	$newsletters = new sidebarContent('Newsletters');
	$newsletters->id = 'newsletters';
	
	$nl_query = 'SELECT title, path, submittedon FROM newsletters WHERE archived = 0 ORDER BY submittedon DESC LIMIT '.$limit;
	$nl_result = mysql_query($nl_query)
		or die(mysql_error());
		
	while ($nl_row = mysql_fetch_array($nl_result))
	{
		$nltitle[] = $nl_row['title'];
		$nlpath[] = $nl_row['path'];
		if(date_dif($nl_row['submittedon'], date('Y-m-d')) < 7)
		{
			$nlnew[] = 1;
		}
		else
		{
			$nlnew[] = 0;
		}	
	}
	
	if (mysql_num_rows($nl_result) == 0)
	{
		$newsletters->error = 'There are currently no newsletters online';
	}
	else
	{
		$data = array();
		for ($m=0; $m<sizeof($nltitle); $m++)
		{
			$data[] = array('link'=>$nlpath[$m],'text'=>$nltitle[$m], 'new'=>$nlnew[$m]);
		}
		$newsletters->data = $data;
	}
	return $newsletters;
}

/*
 * Retrieves all newsletters where $uid uploaded it.
 * a $uid of 0 retrieves all newsletters
 */
function getNewsletterList($uid=0,$arc=1)
{
	$data = array();
	$uidText = '';
	if($uid != 0)
		$uidText = 'AND n.user_id = '.$uid.' ';
	$arcText = '';
	if($arc == 0)
		$arcText = 'AND n.archived = 0 ';
	
	$nl_query = 'SELECT n.newsletter_id, n.title, n.path, n.submittedon, n.user_id, n.archived, u.username '.
				'FROM newsletters AS n, users AS u '.
				'WHERE u.user_id = n.user_id '.
				$uidText.$arcText.
				'ORDER BY n.submittedon DESC';
	$nl_result = mysql_query($nl_query)
		or die(mysql_error());
		
	while ($nl_row = mysql_fetch_array($nl_result))
	{
		$data[] = array('id'=>$nl_row['newsletter_id'],
						'title'=>$nl_row['title'],
						'path'=>$nl_row['path'],
						'date'=>$nl_row['submittedon'],
						'author'=>$nl_row['username'],
						'author_id'=>$nl_row['user_id'],
						'arc'=>$nl_row['archived']);
	}
	SmartyPaginate::setTotal(count($data));
	return array_slice($data, SmartyPaginate::getCurrentIndex(),SmartyPaginate::getLimit());
}

/*
 * Retrieves a newsletter with specific $id
 * Returns an array.
 */
function getNewsletter($id)
{
	$data = array();
	$query = 'SELECT n.newsletter_id, n.title, n.path, n.submittedon, n.user_id, n.archived, u.username '.
				'FROM newsletters AS n, users AS u '.
				'WHERE u.user_id = n.user_id '.
				'AND n.newsletter_id = '.$id;
	$res = mysql_query($query)
		or die(mysql_error());
	$row = mysql_fetch_array($res);
	$data = array('id'=>$row['newsletter_id'],
					'title'=>$row['title'],
					'path'=>$row['path'],
					'date'=>$row['submittedon'],
					'author'=>$row['username'],
					'author_id'=>$row['user_id'],
					'arc'=>$row['archived']);
	return $data;
}

/*
 * Retrieves the site's top scorer for matches that have not been archived
 * Returns a sidebarContent object.
 */
function gettopscorer()
{
	$topscorer = new sidebarContent('Top Scorer');
	$topscorer->id = 'topscorer';
	
	$ts_query = 'SELECT COUNT(s.user_id) AS goals, s.user_id '.
				'FROM scorers AS s, playedmatches AS p '.
				'WHERE p.report_id = s.report_id '.
				'AND p.archived = 0 '.
				'GROUP BY user_id '.
				'ORDER BY goals DESC';
	$ts_result = mysql_query($ts_query)
		or die($mysql_error());
	if (mysql_num_rows($ts_result) == 0)
	{
		$topscorer->error = 'There have been no goals scored yet';
	}
	else
	{
		// while there are rows, test to see if the current row
		$scorers = array();
		$numberequal = 1;
		$firstrow = mysql_fetch_array($ts_result);
		$numgoals = $firstrow['goals'];
		$scorers[] = $firstrow['user_id'];
		while ($ts_row = mysql_fetch_array($ts_result))
		{
			if ($ts_row['goals'] != $numgoals)
				break;
			else
			{
				$numberequal++;
				$scorers[] = $ts_row['user_id'];
			}
		}
		
		$data = array();
		for ($s = 0; $s<sizeof($scorers); $s++)
		{
			$tsq2 = 'SELECT username FROM users WHERE user_id = '. $scorers[$s];
			$tsres2 = mysql_query($tsq2)
				or die(mysql_error());
			$tsrow = mysql_fetch_array($tsres2);
			$data[] = array('link'=>'./viewprofile.php?action=view&amp;uid='.$scorers[$s],
							'text'=>$tsrow['username'].' - '.$numgoals);
		}
		$topscorer->data = $data;
	}
	return $topscorer;
}

/*
 * Gets the number of goals scored by a user
 * Returns the number of goals they have scored
 */

function getGoals($uid)
{
	$goalquery = 'SELECT COUNT(user_id) AS goals
				FROM scorers 
				WHERE user_id = '.$uid.'
				GROUP BY user_id';
	$goalresult = mysql_query($goalquery)
		or die(mysql_error());
	if (mysql_num_rows($goalresult) == 0)
		return 0;
	else
	{
		$goals = mysql_fetch_array($goalresult);
		return $goals['goals'];
	}
}

/*
 * Get Information. Returns the pages defined in the information table
 * Returns an array(array 'link', 'title'))
 * Returns an empty array on error
 */
function getInformation()
{
	$data = array();
	
	$q = "SELECT * FROM infopages ORDER BY sequence ASC";
	$r = mysql_query($q)
		or die(mysql_error());
	while ($inforow = mysql_fetch_array($r))
	{
		$data[] =  array('link'=>'information.php?PageID='.$inforow['page_id'],
						 'text'=>$inforow['title']);
	}
	return $data;
}

function getNewsLinks()
{
	$data = array();
	
	$newsquery = 'SELECT n.article_id, n.heading, n.text, n.submittedon, u.username, nc.name, u.user_id, n.archived '.
				'FROM newsarticles AS n, users AS u, newsarticlecategories AS nc '.
				'WHERE n.user_id = u.user_id '.
				'AND n.category = nc.category_id '.
				'ORDER BY n.submittedon DESC LIMIT 5';
				
	$newsresult = mysql_query($newsquery)
		or die(mysql_error());
		
	while ($newsrow = mysql_fetch_array($newsresult))
	{
		$data[] = array('link'=>'./newsdetails.php?article_id='.$newsrow['article_id'],
						'text'=>$newsrow['heading']);
	}
	return $data;
}


/*
 * Logging function.
 * Should be called every time a database commit is made (or an action is finished)
 */
function submitlog($action)
{
	if(USR_ID == '' || USR_ID == 0)
		$id = -1;
	else
		$id = USR_ID;
	$log = "INSERT INTO log (`user_id`, `action`, `timestamp`, `ip`) VALUES ".
			"('".$id."', '".$action."', '".date("Y-m-d G:i:s", time())."', '".ip2long($_SERVER['REMOTE_ADDR'])."')";
	echo $log;
	if (isset($log))
	{
		$logresult = mysql_query($log)
			or die("Log entry failed: ". mysql_error());
	}
}

/*
 * Checks to see if you have been selected for any matches.
 * Returns array('link', 'text', 'pretext')
 */
function checkmatches($uid)
{
	$data = array();
	$query = 'SELECT available, date FROM match_squad LEFT JOIN matches ON matches.match_id = match_squad.match_id '.
				'WHERE match_squad.user_id = '.$uid.' '.
				'AND Available = -1 '.
				'AND Date >= NOW()';
	$res = mysql_query($query)
		or die(mysql_error());
	$mcount = mysql_num_rows($res);
	if ($mcount != 0)
	{
		if ($mcount == 1)
			$plural = '';
		else
			$plural = 'es';
		$data = array('link'=>'./memberpages.php?Page=checkmatches',
						'text'=>'Confirm your availability',
						'pretext'=>'You have been selected for '.$mcount.' match'.$plural);
	}
	return $data;
}

/*
 * Checks to see if there are any logs unread by admins
 * Returns array('link','text','pretext')
 */
function checklogs()
{
	$data = array();
	if (SEC_LVL == 1)
	{
		$query = 'SELECT log_id FROM log WHERE log.read = 0';
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
			$data = array('link'=>'./adminpages.php?Page=log',
							'text'=>'Read the logs',
							'pretext'=>'There '.$prefix.$lcount.' unread log'.$plural.':');
		}
	}
	return $data;
}


/*
 * Retrieves the e-mail address of the admin, set in the forums
 * Returns a String
 */
function getBoardEmail()
{
	$boardemailquery = 'SELECT * FROM config WHERE config_name = "board_email"';
	$boardemailresult = mysql_query($boardemailquery)
		or die(mysql_error());
	$boardemailrow = mysql_fetch_array($boardemailresult);
	return $boardemailrow['config_value'];
}

function getSiteName()
{
	// Get board config
	$sitenamequery = 'SELECT * FROM config WHERE config_name = "sitename"';
	$sitenameresult = mysql_query($sitenamequery)
		or die(mysql_error());
	$sitenamerow = mysql_fetch_array($sitenameresult);
	return $sitenamerow['config_value'];
}

// Changes <BR> tags to \n
function br2nl($str) {
   $str = preg_replace("/(\r\n|\n|\r)/", "", $str);
   return preg_replace("=<br */?>=i", "\n", $str);
}

/*
 * myAddSlashes solves the problem of having magic quotes enabled on a server or not enabled
 * Code from http://www.webmasterstop.com/63.html
 */
function myAddSlashes($string)
{
	if (get_magic_quotes_gpc() == 1)
		return ($string);
	else
		return (addslashes($string));
}

/*
 * Throws the user to an error page when they try something naughty
 * accepted types are 'AUTH', 'HACK'
 */
function throw_error($type)
{
	switch($type)
	{
		case 'AUTH':
			header('location:./error.php?type=auth');
		break;
		case 'HACK':
			header('location:./error.php?type=hack');
		break;
		case 'USER':
			header('location:./error.php?type=user');
		break;
	}
}

/*
 * Retrieves the statuses of all hideable content
 * return array('id'=>'val');
 */
function getHiddenStatus($uid)
{
	$data = array();
	if($uid != '')
	{
		$q = 'SELECT hide_comm, hide_tc, hide_admin, hide_matches, hide_nl, hide_ts, hide_profile, hide_points '.
				'FROM users WHERE user_id = '.$uid;
		$res = mysql_query($q)
			or die(mysql_error());
		$row = mysql_fetch_array($res);
		$data = array('committee'=>$row['hide_comm'],
						'captain'=>$row['hide_tc'],
						'admin'=>$row['hide_admin'],
						'matches'=>$row['hide_matches'],
						'newsletters'=>$row['hide_nl'],
						'topscorer'=>$row['hide_ts'],
						'profile'=>$row['hide_profile'],
						'points'=>$row['hide_points']);
	}
	return $data;
}

/*
 * Checks if the user has a facebook profile associated with their account
 * Returns their facebook_id for true, 0 for false
 */
function getFacebookID($uid)
{
	$q = 'SELECT fb_id FROM users WHERE user_id='.$uid;
	$res = mysql_query($q)
		or die(mysql_error());
	$row = mysql_fetch_array($res);
	return $row['fb_id'];
}

/*
 * Returns all help pages with a $limit (default ALL)
 * Returns array(array(id,name,text,youtube_link))
 */
function getHelpPages($limit=0)
{
	$data = array();
	$limitText = '';
	if($limit != 0)
		$limitText = 'LIMIT '.$limit;
	
	$helpquery = 'SELECT * FROM help '.$limitText;
	$helpresults = mysql_query($helpquery)
		or die(mysql_error());
	
	if (mysql_num_rows($helpresults) != 0)
	{
		while ($helprow = mysql_fetch_array($helpresults))
		{
			$data[] = array('id'=>$helprow['help_id'],
							'name'=>$helprow['name'],
							'text'=>$helprow['text'],
							'youtube_link'=>$helprow['youtube_link']);
		}
	}
	SmartyPaginate::setTotal(count($data));
	return array_slice($data, SmartyPaginate::getCurrentIndex(),SmartyPaginate::getLimit());
}

/*
 * Returns a single help row
 * Returns array(array(id,name,text,youtube_link))
 */
function getHelpPage($id)
{
	$data = array();
	
	$helpquery = 'SELECT * FROM help '.
					'WHERE help_id='.$id;
	$helpresults = mysql_query($helpquery)
		or die(mysql_error());
	
	if (mysql_num_rows($helpresults) != 0)
	{
		while ($helprow = mysql_fetch_array($helpresults))
		{
			$data = array('id'=>$helprow['help_id'],
							'name'=>$helprow['name'],
							'text'=>$helprow['text'],
							'youtube_link'=>$helprow['youtube_link']);
		}
	}
	return $data;
}
?>