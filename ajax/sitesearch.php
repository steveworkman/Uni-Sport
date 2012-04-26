<?php
include('../inc/unsecure_page.inc.php');
include('../inc/connect.inc.php');

// This script returns search results for the whole site based upon a query.
$str = $_GET['q'];

// Output variable
$out = '';

// Do people search
$profile = 'SELECT COUNT(user_id) AS profilecount FROM users '.
			'WHERE username LIKE "%'.$str.'%"';
$profileres = mysql_query($profile)
	or die(mysql_error());
$profilerow = mysql_fetch_array($profileres);

// If the count query only returns one, do it again but get the details
if($profilerow['profilecount'] == 1)
{
	$pq2 = 'SELECT user_id, username FROM users '.
			'WHERE username LIKE "%'.$str.'%" LIMIT 1';
	$pres2 = mysql_query($pq2)
		or die(mysql_error());
	$prow2 = mysql_fetch_array($pres2);
	$out .= "./viewprofile.php?action=view&uid=".$prow2['user_id']."|1 Profile: ".$prow2['username']."\n";
}
else if($profilerow['profilecount'] != 0)
{
	$out .= "./search.php?type=user&search=".$str."|".$profilerow['profilecount']." Profiles\n";
}

// Now do picture search
// get results from comments
$pics = 'SELECT COUNT(picture_id) AS piccount FROM pictures '.
		'WHERE comment LIKE "%'.$str.'%"';
$picres = mysql_query($pics)
	or die(mysql_error());
$picrow = mysql_fetch_array($picres);

// If the count query only returns one, do it again but get the details
if($picrow['piccount'] == 1)
{
	// Get the album details for that picture
	$pic2q = 'SELECT p.album_id, a.name '.
			'FROM albums AS a, pictures AS p '.
			'WHERE p.comment LIKE "%'.$str.'%" '.
			'AND p.album_id = a.album_id LIMIT 1';
	$pic2res = mysql_query($pic2q)
		or die(mysql_error());
	$pic2row = mysql_fetch_array($pic2res);
	$out .= "./gallery.php?album_id=".$pic2row['album_id']."|1 Picture in album: ".$pic2row['name']."\n";
}
else if($picrow['piccount'] != 0)
{
	$out .= "./search.php?type=album&search=".$str."|".$picrow['piccount']." Pictures\n";
}

// Now do events
// Only get from titles, not from the text
$events = 'SELECT COUNT(event_id) AS eventcount FROM events '.
			'WHERE name LIKE "%'.$str.'%"';
$eventres = mysql_query($events)
	or die(mysql_error());
$eventrow = mysql_fetch_array($eventres);

// If the count query only returns one, do it again but get the details
if($eventrow['eventcount'] == 1)
{
	$eq = 'SELECT event_id, name FROM events '.
			'WHERE name LIKE "%'.$str.'%" LIMIT 1';
	$eres = mysql_query($eq)
		or die(mysql_error());
	$erow = mysql_fetch_array($eres);
	
	$out .= "./viewevent.php?event_id=".$erow['event_id']."|1 Event: ".$erow['name']."\n";
}
else if($eventrow['eventcount'] != 0)
{
	$out .= "./search.php?type=event&search=".$str."|".$eventrow['eventcount']." Events\n";
}

// Now do match reports
// Search in squad name, opposition, scores
$match = 'SELECT COUNT(p.report_id) AS reportcount '.
			'FROM playedmatches AS p, squads AS s '.
			'WHERE s.squad_id = p.squad_id '.
			'AND (p.opposition LIKE "%'.$str.'%" '.
			'OR s.name LIKE "%'.$str.'%" '.
			'OR p.home_score LIKE "%'.$str.'%" '.
			'OR p.opp_score LIKE "%'.$str.'%")';
$matchres = mysql_query($match)
	or die(mysql_error());
$matchrow = mysql_fetch_array($matchres);

// do it again for history
$match_h = 'SELECT COUNT(p.report_id) AS reportcount '.
			'FROM playedmatches AS p, squadhistory AS s '.
			'WHERE s.squad_id = p.squad_id '.
			'AND (p.opposition LIKE "%'.$str.'%" '.
			'OR s.name LIKE "%'.$str.'%" '.
			'OR p.home_score LIKE "%'.$str.'%" '.
			'OR p.opp_score LIKE "%'.$str.'%")';
$matchres_h = mysql_query($match_h)
	or die(mysql_error());
$matchrow_h = mysql_fetch_array($matchres_h);

// Total results
$match_totals = $matchrow['reportcount']+$matchrow_h['reportcount'];

// If the count query only returns one, do it again but get the details
if($matchrow['reportcount'] == 1)
{
	$mq = 'SELECT p.report_id, s.name, p.opposition, p.home_score, p.opp_score '.
			'FROM playedmatches AS p, squads AS s '.
			'WHERE s.squad_id = p.squad_id '.
			'AND (p.opposition LIKE "%'.$str.'%" '.
			'OR s.name LIKE "%'.$str.'%" '.
			'OR p.home_score LIKE "%'.$str.'%" '.
			'OR p.opp_score LIKE "%'.$str.'%") LIMIT 1';
	$mres = mysql_query($mq)
		or die(mysql_error());
	$mrow = mysql_fetch_array($mres);
	
	$out .= "./matches.php?report_id=".$mrow['report_id']."|1 Match Report: ".$mrow['name']." ".$mrow['home_score']."-".$mrow['opp_score']." ".$mrow['opposition']."\n";
}
else if($matchrow_h['reportcount'] == 1)
{
	$mq = 'SELECT p.report_id, s.name, p.opposition, p.home_score, p.opp_score '.
			'FROM playedmatches AS p, squadhistory AS s '.
			'WHERE s.squad_id = p.squad_id '.
			'AND (p.opposition LIKE "%'.$str.'%" '.
			'OR s.name LIKE "%'.$str.'%" '.
			'OR p.home_score LIKE "%'.$str.'%" '.
			'OR p.opp_score LIKE "%'.$str.'%") LIMIT 1';
	$mres = mysql_query($mq)
		or die(mysql_error());
	$mrow = mysql_fetch_array($mres);
	
	$out .= "./matches.php?report_id=".$mrow['report_id']."|1 Match Report: ".$mrow['name']." ".$mrow['home_score']."-".$mrow['opp_score']." ".$mrow['opposition']."\n";
}
else if($match_totals != 0)
{
	$out .= "./search.php?type=match&search=".$str."|".$match_totals." Match Reports\n";
}

// Now get news, only check titles
$news = 'SELECT COUNT(article_id) AS newscount FROM newsarticles '.
		'WHERE heading LIKE "%'.$str.'%"';
$newsres = mysql_query($news)
	or die(mysql_error());
$newsrow = mysql_fetch_array($newsres);

// If the count query only returns one, do it again but get the details
if($newsrow['newscount'] == 1)
{
	$nq = 'SELECT article_id, heading FROM newsarticles '.
			'WHERE heading LIKE "%'.$str.'%" LIMIT 1';
	$nres = mysql_query($nq)
		or die(mysql_error());
	$nrow = mysql_fetch_array($nres);
	
	$out .= "./newsdetails.php?article_id=".$nrow['article_id']."|1 Article: ".$nrow['heading']."\n";
}
else if($newsrow['newscount'] != 0)
{
	$out .= "./search.php?type=news&search=".$str."|".$newsrow['newscount']." News Articles\n";
}

// Now get newsletters
// Only check titles
$newsl = 'SELECT COUNT(newsletter_id) AS newscount FROM newsletters '.
		'WHERE title LIKE "%'.$str.'%"';
$newsresl = mysql_query($newsl)
	or die(mysql_error());
$newsrowl = mysql_fetch_array($newsresl);

// If the count query only returns one, do it again but get the details
if($newsrowl['newscount'] == 1)
{
	$nlq = 'SELECT title, path FROM newsletters '.
			'WHERE title LIKE "%'.$str.'%" LIMIT 1';
	$nlres = mysql_query($nlq)
		or die(mysql_error());
	$nlrow = mysql_fetch_array($nlres);
	
	$out .= $nlrow['path']."|1 Newsletter: ".$nlrow['title']."\n";
}
else if($newsrowl['newscount'] != 0)
{
	$out .= "./search.php?type=newsletters&search=".$str."|".$newsrowl['newscount']." Newsletters\n";
}

echo $out;
?>