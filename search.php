<?php
define('CURR_PAGE', 'home');
define('PAGE_TITLE','Search');
include('inc/unsecure_page.inc.php');
include('inc/indexfunctions.inc.php');
include('inc/header.inc.php');
include('inc/sidebar.inc.php');

// All the searches are functions so they can be used anywhere i.e. in the default one where all searches are done

function searchUsers($str)
{
	$data = array();
	$q = 'SELECT user_id, username FROM users '.
			'WHERE username LIKE "%'.$str.'%"';
	$res = mysql_query($q)
		or die(mysql_error());
	while($row = mysql_fetch_array($res))
	{
		$data[] = array('link'=>'./viewprofile.php?action=view&uid='.$row['user_id'],
						'name'=>$row['username']);
	}
	return $data;
}

function searchAlbums($str)
{
	$data = array();
	// Get the album details for that picture
	$q = 'SELECT DISTINCT(p.album_id), a.name '.
			'FROM albums AS a, pictures AS p '.
			'WHERE p.comment LIKE "%'.$str.'%" '.
			'AND p.album_id = a.album_id';
	$res = mysql_query($q)
		or die(mysql_error());
	while($row = mysql_fetch_array($res))
	{
		$data[] = array('link'=>'./gallery.php?album_id='.$row['album_id'],
								'name'=>$row['name']);
	}
	return $data;
}

function searchEvents($str)
{
	$data = array();
	$q = 'SELECT event_id, name FROM events '.
			'WHERE name LIKE "%'.$str.'%"';
	$res = mysql_query($q)
		or die(mysql_error());
	while($row = mysql_fetch_array($res))
	{
		$data[] = array('link'=>'./viewevent.php?event_id='.$row['event_id'],
						'name'=>$row['name']);
	}
	return $data;
}

function searchMatches($str)
{
	$data = array();
	$mq = 'SELECT p.report_id, s.name, p.opposition, p.home_score, p.opp_score '.
			'FROM playedmatches AS p, squads AS s '.
			'WHERE s.squad_id = p.squad_id '.
			'AND (p.opposition LIKE "%'.$str.'%" '.
			'OR s.name LIKE "%'.$str.'%" '.
			'OR p.home_score LIKE "%'.$str.'%" '.
			'OR p.opp_score LIKE "%'.$str.'%")';
	$mres = mysql_query($mq)
		or die(mysql_error());
	while($mrow = mysql_fetch_array($mres))
	{
		$data[] = array('link'=>'./matches.php?report_id='.$mrow['report_id'],
						'name'=>$mrow['name'].' '.$mrow['home_score'].'-'.$mrow['opp_score'].' '.$mrow['opposition']);
	}
	$mq2 = 'SELECT p.report_id, s.name, p.opposition, p.home_score, p.opp_score '.
			'FROM playedmatches AS p, squadhistory AS s '.
			'WHERE s.squad_id = p.squad_id '.
			'AND (p.opposition LIKE "%'.$str.'%" '.
			'OR s.name LIKE "%'.$str.'%" '.
			'OR p.home_score LIKE "%'.$str.'%" '.
			'OR p.opp_score LIKE "%'.$str.'%")';
	$mres2 = mysql_query($mq2)
		or die(mysql_error());
	while($mrow2 = mysql_fetch_array($mres2))
	{
		$data[] = array('link'=>'./matches.php?report_id='.$mrow2['report_id'],
						'name'=>$mrow2['name'].' '.$mrow2['home_score'].'-'.$mrow2['opp_score'].' '.$mrow2['opposition']);
	}
	return $data;
}

function searchNews($str)
{
	$data = array();
	$q = 'SELECT article_id, heading FROM newsarticles '.
			'WHERE heading LIKE "%'.$str.'%"';
	$res = mysql_query($q)
		or die(mysql_error());
	while($row = mysql_fetch_array($res))
	{
		$data[] = array('link'=>'./newsdetails.php?article_id='.$row['article_id'],
						'name'=>$row['heading']);
	}
	return $data;
}

function searchNewsletters($str)
{
	$data = array();
	$q = 'SELECT path, title FROM newsletters '.
			'WHERE title LIKE "%'.$str.'%"';
	$res = mysql_query($q)
		or die(mysql_error());
	while($row = mysql_fetch_array($res))
	{
		$data[] = array('link'=>$row['path'],
						'name'=>$row['title']);
	}
	return $data;
}


if(!empty($_GET['search']))
{
	$str = $_GET['search'];
	switch ($_GET['type'])
	{
		// This case is for profiles
		case 'user':
			$data = array();
			$data[] = array('Profile Search',searchUsers($str));
			$smarty->assign('data',$data);
		break;
		
		case 'album':
			$data = array();
			$data[] = array('Albums Containing Search',searchAlbums($str));
			$smarty->assign('data',$data);
		break;
		
		case 'event':
			$data = array();
			$data[] = array('Event Search',searchEvents($str));
			$smarty->assign('data',$data);
		break;
		
		case 'match':
			$data = array();
			$data[] = array('Match Search',searchMatches($str));
			$smarty->assign('data',$data);
		break;
		
		case 'news':
			$data = array();
			$data[] = array('News Search',searchNews($str));
			$smarty->assign('data',$data);
		break;
		
		case 'newsletters':
			$data = array();
			$data[] = array('Newsletter Search',searchNewsletters($str));
			$smarty->assign('data',$data);
		break;
		
		default:
			$data = array();
			$data[] = array('Profiles',searchUsers($str));
			$data[] = array('Albums',searchAlbums($str));
			$data[] = array('Events',searchEvents($str));
			$data[] = array('Matches',searchMatches($str));
			$data[] = array('News',searchNews($str));
			$data[] = array('Newsletter',searchNewsletters($str));
			$smarty->assign('data',$data);
		break;
	}
}
else
{
	$smarty->assign('nostr',1);
}
$smarty->display('search.tpl');
include ('inc/sidebar2.inc.php');
include ('inc/footer.inc.php');
?>