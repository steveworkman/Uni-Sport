<?php
define('IN_GALLERY',true);
if(!empty($_GET['album_id']) || !empty($_GET['uid']))
{	
	if(!empty($_GET['album_id']))
	{
		// Slideshow of album
		// Get the album details. More efficient to do this than to use the indexfunctions one
		$smarty->assign('album',1);
		$q = 'SELECT a.album_id, a.name, at.name, a.date, a.user_id, u.username '.
				'FROM albums AS a, album_type AS at, users AS u '.
				'WHERE a.album_type = at.type_id '.
				'AND a.user_id = u.user_id '.
				'AND a.album_id='.$_GET['album_id'];
		$res = mysql_query($q)
			or die(mysql_error());
		$row = mysql_fetch_array($res);
		$album = array('album_id'=>$row['album_id'],
						'album_name'=>$row[1],
						'type_name'=>$row[2],
						'date'=>$row['date'],
						'user_id'=>$row['user_id'],
						'username'=>$row['username']);
		
		$smarty->assign('album',$album);
		
		// get first picture
		$q2 = 'SELECT picture_id, path, comment FROM pictures '.
				'WHERE album_id='.$_GET['album_id'].' '.
				'LIMIT 1';
		$res2 = mysql_query($q2)
			or die(mysql_error());
		$row2 = mysql_fetch_array($res2);
		
		$currpic = $row2['path'];
		$currtags = formatTags(getTags($row2['picture_id']));
		
		$smarty->assign('currpath',$currpic);
		$smarty->assign('currpicid',$row2['picture_id']);
		$smarty->assign('curralt',htmlspecialchars($row2['comment']));
		$smarty->assign('currtags',$currtags);
	}
	else
	{
		// Slideshow of a person
		$uid = $_GET['uid'];
		
		// Create album details
		// Get the user's name!
		$q1 = 'SELECT username FROM users WHERE user_id='.$uid;
		$res1 = mysql_query($q1)
			or die(mysql_error());
		$row1 = mysql_fetch_array($res1);
		$album = array('album_name'=>'Pictures of '.$row1['username'],
					'type_name'=>'Pictures of...',
					'username'=>'Generated');
		$smarty->assign('album',$album);
		
		
		// Get first picture of that person
		$q = 'SELECT p.picture_id, p.path, p.comment, u.username '.
				'FROM pictures AS p, user_picture AS up, users AS u '.
				'WHERE up.user_id = '.$uid.' '.
				'AND up.picture_id = p.picture_id '.
				'AND u.user_id = up.user_id LIMIT 1';
		$res = mysql_query($q)
			or die(mysql_error());
		$row = mysql_fetch_array($res);
		if(mysql_num_rows($res) != 0)
		{
			// Picture Assignments
			$currpic = $row['path'];
			$currtags = formatTags(getTags($row['picture_id']));
			
			$smarty->assign('currpath',$currpic);
			$smarty->assign('currpicid',$row['picture_id']);
			$smarty->assign('curralt',htmlspecialchars($row['comment']));
			$smarty->assign('currtags',$currtags);
			$smarty->assign('user_id',$uid);
		}
		else
		{
			$smarty->assign('error','There are no pictures of this person');
		}
	}
	// Do dimension calcs
	list ($width, $height, $type, $attr) = getimagesize($currpic);
	if($width < 300)
		$imgwidth = $width;
	else
	{
		$imgwidth = '80%';
	}
	
	if($height < 300)
		$imgheight = $height;
	else
	{
		$imgheight = ''; // So that the img is only controlled by width
	}
	$smarty->assign('imgwidth',$imgwidth);
	$smarty->assign('imgheight',$imgheight);
	
	$smarty->display('slideshow.tpl');
}
else
{
	// The main gallery
	$smarty->assign('gallery',1);
	include('getalbums.php');
	$smarty->display('gallery.tpl');
}
?>