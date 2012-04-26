<?php
/*
 * Retrieves data about User albums
 * Returns paginatable array
 */
function getUserAlbums($uid=0, $arc=0)
{
	$data = array();
	$uidText = '';
	if($uid != 0)
		$uidText = 'AND u.user_id = '.$uid.' ';
	$arcText = '';
	if($arc == 0)
		$arcText = 'AND a.archived = 0 ';
	
	$q = 'SELECT a.album_id, a.name, at.name, u.username, a.user_id, a.archived, a.date '.
			'FROM albums AS a, album_type AS at, users AS u '.
			'WHERE a.user_id = u.user_id '.
			'AND a.album_type = at.type_id '.
			'AND a.album_type = 3 '.
			$uidText.$arcText.
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
						'arc'=>$row['arc'],
						'pic_count'=>countPictures($row['album_id']));
	}
	SmartyPaginate::setTotal(count($data));
	return array_slice($data, SmartyPaginate::getCurrentIndex(),SmartyPaginate::getLimit());
}

/*
 * Retrieves data about Event albums
 * Returns paginatable array
 */
function getEventAlbums($arc=0)
{
	$data = array();
	$arcText = '';
	if($arc == 0)
		$arcText = 'AND a.archived = 0 ';
	
	$q = 'SELECT a.album_id, a.name, at.name, a.archived, a.date '.
			'FROM albums AS a, album_type AS at '.
			'WHERE a.album_type = at.type_id '.
			'AND a.album_type = 1 '.
			$arcText.
			'ORDER BY a.date';
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
						'arc'=>$row['arc'],
						'pic_count'=>countPictures($row['album_id']));
	}
	SmartyPaginate::setTotal(count($data));
	return array_slice($data, SmartyPaginate::getCurrentIndex(),SmartyPaginate::getLimit());
}

/*
 * Retrieves data about Match albums
 * Returns paginatable array
 */
function getMatchAlbums($arc=0)
{
	$data = array();
	$arcText = '';
	if($arc == 0)
		$arcText = 'AND a.archived = 0 ';
	
	$q = 'SELECT a.album_id, a.name, at.name, a.archived, a.date '.
			'FROM albums AS a, album_type AS at '.
			'WHERE a.album_type = at.type_id '.
			'AND a.album_type = 2 '.
			$arcText.
			'ORDER BY a.date';
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
						'arc'=>$row['arc'],
						'pic_count'=>countPictures($row['album_id']));
	}
	SmartyPaginate::setTotal(count($data));
	return array_slice($data, SmartyPaginate::getCurrentIndex(),SmartyPaginate::getLimit());
}

// Returns the number of pictures in an album
function countPictures($album_id)
{
	$q = 'SELECT COUNT(picture_id) AS count FROM pictures WHERE album_id='.$album_id;
	$res = mysql_query($q)
		or die(mysql_error());
	$row = mysql_fetch_array($res);
	return $row['count'];
}

/*
 * Retrieves an array of data for pictures in an album
 * Returns array
 */
function getPictures($album_id, $uid=0)
{
	$data = array();
	$album = array();
	$pictures = array();
	$uidText = '';
	if($uid != 0)
		$uidText = 'AND u.user_id = '.$uid.' ';
	// Get the album data first, then get the pictures
	$q1 = 'SELECT a.name,at.name, u.user_id, u.username, a.album_type, a.date, a.archived, a.cover_id '.
			'FROM albums AS a, album_type AS at, users AS u '.
			'WHERE a.album_id = '.$album_id.' '.
			'AND a.album_type = at.type_id '.
			'AND u.user_id = a.user_id '.
			$uidText;
	$res1 = mysql_query($q1)
		or die(mysql_error());
	while($row1 = mysql_fetch_array($res1))
	{
		$album = array('album_id'=>$album_id,
						'album_name'=>$row1[0],
						'type_name'=>$row1[1],
						'user_id'=>$row1['user_id'],
						'username'=>$row1['username'],
						'album_type'=>$row1['album_type'],
						'date'=>$row1['date'],
						'arc'=>$row1['archived'],
						'cover'=>$row1['cover_id']);
	}
	
	$q = 'SELECT p.picture_id, p.featured, p.date, p.thumb, p.comment, p.path '.
			'FROM pictures AS p '.
			'WHERE p.album_id = '.$album_id.' '.
			'ORDER BY p.date';
	$res = mysql_query($q)
		or die(mysql_error());
	$id = '';
	while($row = mysql_fetch_array($res))
	{
		$pictures[] = array('id'=>$row['picture_id'],
						'featured'=>$row['featured'],
						'date'=>$row['date'],
						'thumb'=>$row['thumb'],
						'comment'=>$row['comment'],
						'path'=>$row['path'],
						'tags'=>getTags($row['picture_id']));
		$id .= $row['picture_id'].',';
	}
	$id = substr($id,0,(strlen($id)-1));
	$data[] = $album;
	$data[] = $pictures;
	$data[] = $id;
	return $data;
}

/*
 * Retrieves the tags for that photo
 * returns array(array('id','name'))
 * Should be the same as in commitfunctions
 */
function getTags($picid)
{
	$data = array();
	$q = 'SELECT u.user_id, u.username '.
			'FROM users AS u, user_picture AS up '.
			'WHERE up.user_id = u.user_id '.
			'AND up.picture_id='.$picid;
	$res = mysql_query($q)
		or die(mysql_error());
	while($row = mysql_fetch_array($res))
	{
		$data[] = array('id'=>$row['user_id'],
						'name'=>$row['username']);
	}
	return $data;
}

// Formats tags to be put straight into HTML
// This should be identical to the one in commmitfunctions
function formatTags($tags,$pretext=1)
{
	$out = '';
	if(!empty($tags))
	{
		if($pretext == 1)
			$out = 'In this photo:';
		foreach($tags as $tag)
		{
			$out .= ' <a href="./viewprofile.php?action=view&uid='.$tag['id'].'">'.$tag['name'].'</a> (<a href="gallery.php?uid='.$tag['id'].'">photos</a>),';
		}
		$out = substr($out,0,(strlen($out)-1)); // Get rid of the comma
	}
	return $out;
}
?>