<?php
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
include('../inc/commitfunctions.inc.php');

switch($_GET['action'])
{
	case 'add':
		$error = '';
		$name = myAddSlashes(trim($_POST['name']));
		$today = date("Y-m-d");
		
		$type = $_POST['type'];
		if($type == 3)
			$uid = USR_ID;
		else
			$uid = 0;
		if (empty($name))
		{
			$error .= "Please+enter+a+name+for+the+album%21%0D%0A";
		}
		if(empty($error))
		{
			$q = "INSERT INTO albums (name,album_type,user_id,date) VALUES (".
					"'".$name."',".
					"'".$type."',".
					"'".$uid."',".
					"'".$today."')";
			$res = mysql_query($q)
				or die(mysql_error());
			$id = mysql_insert_id();
			
			$log = 'User created album with ID: '.$id;
			submitlog($log);
			header('location:../memberpages.php?Page=picmenu&Action=upload&id='.$id);
		}
		else
			header('location:../memberpages.php?Page=picmenu&Action=add&error='.urlencode($error));
	break;
	
	case 'edit':
		// First, update the album name if it's been changed.
		$error = '';
		$name = myAddSlashes(trim($_POST['name']));
		$album_id = $_POST['id'];
		$cover = $_POST['cover'];
		if($_POST['arc'] == 'on')
			$arc = 1;
		else
			$arc = 0;
		if (empty($name))
		{
			$error .= "Please+enter+a+name+for+the+album%21%0D%0A";
			header('location:../memberpages.php?Page=picmenu&Action=edit&id='.$album_id.'&error='.urlencode($error));
		}
		if(empty($error))
		{
			$q = "UPDATE albums SET name='".$name."', archived=".$arc.", cover_id=".$cover." WHERE album_id=".$album_id;
			$res = mysql_query($q)
				or die(mysql_error());
		}
		// Then update the comments, do the tags and delete pictures
		$pic_ids = explode(',',$_POST['pic_ids']);
		foreach($pic_ids as $id)
		{
			if($_POST['del'.$id] != 'on')
			{
				// Not deleting
				// Updaing comments and featured
				if($_POST['feat'.$id] == 'on')
					$feat = 1;
				else
					$feat = 0;
				$q2 = "UPDATE pictures SET comment='".myAddSlashes($_POST['cap'.$id])."', featured=".$feat." ".
						"WHERE picture_id=".$id;
				$res2 = mysql_query($q2)
					or die(mysql_error());
				
				// Change tags
				$tagstr = substr($_POST['hidden_tag'.$id],0,(strlen($_POST['hidden_tag'.$id])-1));
				$tags = array_unique(explode(',',$tagstr));
				
				//remove all current tags
				$q3 = 'DELETE FROM user_picture WHERE picture_id='.$id;
				mysql_query($q3)
					or die(mysql_error());
				// Create the inserts for the new one
				$vals = '';
				foreach($tags as $tag)
				{
					$vals .= '('.$id.','.$tag.'),';
				}
				$vals = substr($vals,0,(strlen($vals)-1));
				// do the query
				$q4 = 'INSERT INTO user_picture (picture_id,user_id) VALUES '.$vals;
				$res4 = mysql_query($q4)
					or die(mysql_error());
			}
			else
			{
				// Get their paths to delete the files
				$query = 'SELECT path, thumb FROM pictures WHERE picture_id = '.$id;
				$res = mysql_query($query)
					or die(mysql_error());
				while($row = mysql_fetch_array($res))
				{
					$oldpath = $row['path'];
					$oldthumb = $row['thumb'];
					unlink('.'.$oldpath);
					unlink('.'.$oldthumb);
				}
				// Deleting picture from DB
				$q2 = 'DELETE FROM pictures WHERE picture_id = '.$id.' LIMIT 1';
				$res2 = mysql_query($q2)
					or die(mysql_error());
			}
		}
		$log = 'User edited album '.$album_id;
		submitlog($log);
		$succ = 'Successfully updated album';
		header('location:../memberpages.php?Page=picmenu&succ='.urlencode($succ));
	break;
	
	case "delete":
		$error = '';
		$album_id = $_POST['id'];
		// get path so can remove from server
		$query = 'SELECT picture_id, path, thumb FROM pictures WHERE album_id = '.$album_id;
		$res = mysql_query($query)
			or die(mysql_error());
		while($row = mysql_fetch_array($res))
		{
			$oldpath = $row['path'];
			$oldthumb = $row['thumb'];
			
			$sql = 'DELETE FROM pictures '.
					'WHERE picture_id = '.$row['picture_id'].' '.
					'LIMIT 1';
			$result = mysql_query($sql)
				or die("Invalid query: " . mysql_error());
			unlink('.'.$oldpath);
			unlink('.'.$oldthumb);
		}
		$q2 = 'DELETE FROM albums WHERE album_id='.$album_id.' LIMIT 1';
		$res2 = mysql_query($q2)
			or die(mysql_error());
		
		// LOG SUBMISSION
		$logdata = 'User deleted album with album_id: '.$album_id;
		submitlog($logdata);
		$succ = urlencode('Album successfully deleted');
		header('location:../memberpages.php?Page=picmenu&succ='.$succ);
	break;
}
?>