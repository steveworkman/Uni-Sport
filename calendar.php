<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Calendar');
$css = array();
$css[] = 'css/calendar.css';
$js = array();
$js[] = 'js/calendar.js';
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');
require('classes/class.Calendar_Events.php');

if(empty($_GET['month']))
	$curr_mnth = date('m');
else
	$curr_mnth = $_GET['month'];
if(empty($_GET['year']))
	$curr_yr = date('Y');
else
	$curr_yr = $_GET['year'];
if(empty($_GET['arc']))
	$arc = 0;
else
	$arc = $_GET['arc'];
	
$cal = new Calendar_Events ($curr_yr,$curr_mnth);
// Birthdays
$bdaydata = getBirthdays($curr_mnth);
for ($i=0; $i<sizeof($bdaydata); $i++)
{
	$bd = explode('-', $bdaydata[$i]['dob']);
	if($arc == 1 && $bdaydata[$i]['arc'] == 1)
		$bdaydata[$i]['arc'] = '2';
	$cal->addEvent($bd[2], $bdaydata[$i]['name'], $bdaydata[$i]['link'], $bdaydata[$i]['arc'], BDAY);
}
	
// query for all events
$eventdata = getMonthlyEvents($curr_mnth, $curr_yr);
for ($i=0; $i<sizeof($eventdata); $i++)
{
	$cal->addEvent($eventdata[$i]['day'], $eventdata[$i]['name'], $eventdata[$i]['link'], 0, EVENT);
}
	
// query for all upcoming matches
$upmatch = getUpcomingMatches($curr_mnth, $curr_yr);

for ($i=0; $i<sizeof($upmatch); $i++)
{
	$d = explode('-', $upmatch[$i]['date']);
	$cal->addEvent($d[2], $upmatch[$i]['name'], $upmatch[$i]['link'], 0, MATCH);
}
	
// query for all played matches
$pmatches = getPlayedMatches($curr_mnth, $curr_yr);
		
for ($i=0; $i<sizeof($pmatches); $i++)
{
	$d2 = explode('-', $pmatches[$i]['date']);
	$cal->addEvent($d2[2], $pmatches[$i]['name'], $pmatches[$i]['link'], 0, MATCH);
}
	
$cal->setDayNameFormat('%A');
if ($curr_mnth == 1)
	$bm = 'calendar.php?month=12&amp;year='.($curr_yr-1).'&amp;arc='.$arc;
else
	$bm = 'calendar.php?month='.($curr_mnth-1).'&amp;year='.$curr_yr.'&amp;arc='.$arc;
if ($curr_mnth == 12)
	$fm = 'calendar.php?month=1&amp;year='.($curr_yr+1).'&amp;arc='.$arc;
else
	$fm = 'calendar.php?month='.($curr_mnth + 1).'&amp;year='.$curr_yr.'&amp;arc='.$arc;

$smarty->assign('backMonth', $bm);
$smarty->assign('fwdMonth', $fm);
$smarty->assign('month', $cal->getFullMonthName());
$smarty->assign('year', $cal->getYear());
$smarty->assign('cal', $cal->display());
$smarty->cache_lifetime = 0;
$smarty->display('calendar.tpl');
include ('inc/sidebar2.inc.php');
include ('inc/footer.inc.php');
?>