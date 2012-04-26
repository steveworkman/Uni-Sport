<?php
// Get Albums
include_once('inc/indexfunctions.inc.php');
include_once('inc/picfunctions.inc.php');
include_once('inc/connect.inc.php');
include_once('smarty_connect.php');
if(!IN_GALLERY)
	header('location:./error.php');

$limit = 6;
$smarty->assign('increment',$limit);
SmartyPaginate::setLimit($limit);
/*
 * Retrieves data about User albums
 * Returns paginatable array
 */
function getAlbums($type='LATEST')
{
	$data = array();
	$condition = '';
	switch($type)
	{
		case 'LATEST':
			$condition = '';
		break;
		
		case 'USER':
			$condition = 'AND a.album_type=3 ';
		break;
		
		case 'EVENTS':
			$condition = 'AND a.album_type=1 ';
		break;
		
		case 'MATCHES':
			$condition = 'AND a.album_type=2 ';
		break;
	}
	$q = 'SELECT a.album_id, a.name, at.name, u.username, a.user_id, a.date, p.thumb '.
			'FROM albums AS a, album_type AS at, users AS u, pictures AS p '.
			'WHERE a.user_id = u.user_id '.
			'AND a.album_type = at.type_id '.
			'AND a.cover_id = p.picture_id '.
			$condition.
			'ORDER BY a.date DESC';
	
	$res = mysql_query($q)
		or die(mysql_error());
	while($row = mysql_fetch_array($res))
	{
		$data[] = array('id'=>$row['album_id'],
						'album_name'=>$row[1],
						'type_name'=>$row[2],
						'username'=>$row['username'],
						'date'=>$row['date'],
						'user_id'=>$row['user_id'],
						'pic_count'=>countPictures($row['album_id']),
						'cover'=>$row['thumb']);
	}
	SmartyPaginate::setTotal(count($data));
	return array_slice($data, SmartyPaginate::getCurrentIndex(),SmartyPaginate::getLimit());
}
// Set select box for 'showing'
$showing = array('LATEST'=>'Latest Albums and Events',
					'USER'=>'Personal Albums',
					'EVENTS'=>'Event Albums',
					'MATCHES'=>'Match Albums');
$smarty->assign('showing',$showing);

$albums = getAlbums($_GET['type']);
if(empty($albums))
	$smarty->assign('error',"There's no more albums. Go back!");
$smarty->assign('albums',$albums);
if(empty($_GET['next']))
	$next = 1;
else
	$next = $_GET['next'];
$smarty->assign('type',$_GET['type']);
$smarty->assign('next',$next);
$smarty->assign('nextid',$next+$limit);
$smarty->assign('previd',$next-$limit);
SmartyPaginate::seturl('gallery.php?type='.$_GET['type']);
SmartyPaginate::assign($smarty); // For pagination
if($_GET['ajax'] == 1)
{
	$smarty->display('albums.tpl');
	SmartyPaginate::disconnect();
}

?>