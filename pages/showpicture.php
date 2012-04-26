<?php
	// get picture details
	$query = "SELECT pictures.path, pictures.comment, " .
			" pictures.date, users.username FROM pictures, users " .
			"WHERE picture_id = '" . $_GET['id'] . "' " .
			"AND pictures.user_id = users.user_id";
	$result = mysql_query($query)
				or die(mysql_error());
	$id = $_GET['id'];
	$row = mysql_fetch_array($result);
	$comment = $row['comment'];
	$path = $row['path'];
	$path = ereg_replace(" ", "%20", $path);
	$nick = $row['username'];
	$date = formatdate($row['date']);
	
	
	// Construct the dates
	if ($_GET['type'] == 'arc')
	{
		$fromdate = date("Y-m-d G:i:s",mktime(0,0,0,$_GET['fmon'], $_GET['fday'], $_GET['fyr']));
		$todate = date("Y-m-d G:i:s",mktime(0,0,0,$_GET['tmon'], $_GET['tday'], $_GET['tyr']));
	}
	//Get details for previous and next picture
	$type = '';
	switch($_GET['type'])
	{
		case 'uid':
			$q = "SELECT picture_id FROM pictures WHERE user_id = '".$_GET['val']."' AND archived = 0";
			$type = 'uid='.$_GET['val'];
		break;
		
		case 'eid':
			$q = "SELECT picture_id FROM event_pictures WHERE event_id = '".$_GET['val']."'";
			$type = 'eid='.$_GET['val'];
		break;
		
		case 'mid':
			$q = "SELECT picture_id FROM playedmatch_pictures WHERE report_id = '".$_GET['val']."'";
			$type = 'mid='.$_GET['val'];
		break;
		
		case 'arc':
			switch($_GET['val'])
			{
				case 'picbyu':
					$q = "SELECT picture_id FROM pictures WHERE user_id = '".$_GET['uid']."' ".
							"AND date BETWEEN '".$fromdate."' AND '".$todate."'";
				break;
				
				case 'picofu':
					$q = "SELECT pictures.picture_id FROM pictures, user_picture ".
							"WHERE user_picture.user_id = '".$_GET['uid']."' ".
							"AND pictures.picture_id = user_picture.picture_id ".
							"AND date BETWEEN '".$fromdate."' AND '".$todate."'";
				break;
				
				case 'caption':
					$q = "SELECT picture_id, comment FROM pictures ".
						"WHERE date BETWEEN '".$fromdate."' AND '".$todate."'";
				break;
			}
		break;
		
		default:
			$q = "SELECT picture_id FROM pictures";
		break;
	}

	$res = mysql_query($q)
		or die(mysql_error());
	if (empty($_GET['cap']))
	{	
		while ($r = mysql_fetch_array($res))
		{
			$ids[] = $r['picture_id'];
		}
	}
	else
	{
		while ($r = mysql_fetch_array($res))
		{
			if (stristr($r['comment'], $_GET['cap']))
			{
				$ids[] = $r['picture_id'];
			}
		}
	}
	// Loop through until found id
	$next = '';
	$prev = '';
	for ($i = 0; $i<sizeof($ids); $i++)
	{
		if ($ids[$i] == $id)
		{
			if ($i == 0)
			{
				$prev = '';
				$next = $ids[$i+1];
			}
			else if ($i == sizeof($ids)-1)
			{
				$prev = $ids[$i-1];
				$next = '';
			}
			else
			{
				$prev = $ids[$i-1];
				$next = $ids[$i+1];
			}
		}
	}
	
	$back_gallery = "<a href=\"gallery.php?Page=gallery&amp;".$type."\">Back to Gallery</a><br />";
	
	// Check user_picture for who is in this picture
	$up_q = "SELECT username, users.user_id FROM users, user_picture ".
			"WHERE picture_id = '".$_GET['id']."' ".
			"AND users.user_id = user_picture.user_id";
	$up_res = mysql_query($up_q)
		or die(mysql_error());
	$in_picture = '';
	if (mysql_num_rows($up_res) != 0)
	{
		$in_picture .= 'In this picture:';
		while ($up_row = mysql_fetch_array($up_res))
		{
			$in_picture .= ' <a href="viewprofile.php?action=view&amp;uid='.$up_row['user_id'].'">'.$up_row['username'].'</a>,';
		}
		$in_picture = substr($in_picture,0,(strlen($in_picture)-1));
	}
	
	$picture =<<<EOD
		<div style="float:right;">$back_gallery</div><br />
		<center><h2>$comment</h2>
<p><a href="fullpic.php?id=$id"><img src="$path" alt="$comment" border="0" width="90%" /></a></p>
				<p>Submitted By $nick on $date </p></center>
<p>$in_picture</p>
EOD;
	echo $picture;
	echo "<div id=\"back\" style=\"float: left;\">";
	if (!empty($prev))
		echo "<a href=\"gallery.php?Page=showpicture&amp;type=".$_GET['type']."&amp;uid=".$_GET['uid']."&amp;val=".$_GET['val']."&amp;cap=".$_GET['cap']."&amp;id=".$prev."&amp;fday=".$_GET['fday']."&amp;fmon=".$_GET['fmon']."&amp;fyr=".$_GET['fyr']."&amp;tday=".$_GET['tday']."&amp;tmon=".$_GET['tmon']."&amp;tyr=".$_GET['tyr']."\"><img src=\"./img/control_rewind_blue.png\" border=\"0\" alt=\"Previous\" title=\"Previous\" /></a>";
	echo "</div>";
	
	echo "<div id=\"next\" style=\"float: right;\">";
	if (!empty($next))
		echo "<a href=\"gallery.php?Page=showpicture&amp;type=".$_GET['type']."&amp;uid=".$_GET['uid']."&amp;val=".$_GET['val']."&amp;cap=".$_GET['cap']."&amp;id=".$next."&amp;fday=".$_GET['fday']."&amp;fmon=".$_GET['fmon']."&amp;fyr=".$_GET['fyr']."&amp;tday=".$_GET['tday']."&amp;tmon=".$_GET['tmon']."&amp;tyr=".$_GET['tyr']."\"><img src=\"./img/control_fastforward_blue.png\" border=\"0\" alt=\"Next\" title=\"Next\" /></a>";
	echo "</div>";
?>