<?php
// Girder's security level function
function setsecuritylevel($uid)
{
	$level = 4;
	// Work out their level
	
	// Get groups they belong to
	$q = "SELECT group_id FROM user_group WHERE user_id = '".$uid."' AND user_pending = 0";
	$res = mysql_query($q)
		or die(mysql_error());
	if (mysql_num_rows($res) != 0)
	{
		while($row = mysql_fetch_array($res))
		{
			$group[] = $row['group_id'];
		}
		
		// Get securitylevel constants
		$q2 = "SELECT * FROM securitylevels";
		$res2 = mysql_query($q2)
			or die(mysql_error());
		while($row2 = mysql_fetch_array($res2))
		{
			if ($row2['name'] == "Admin")
				$admin = $row2['group_id'];
			else if($row2['name'] == "Committee")
				$committee = $row2['group_id'];
			else if($row2['name'] == "Team Captain")
				$tc = $row2['group_id'];
		}
		
		// work out their highest level
		for ($i = 0; $i<sizeof($group); $i++)
		{
			if ($group[$i] == $admin)
			{
				$level = 1;
				break;
			}
			else if($group[$i] == $committee && $level > 2)
				$level = 2;
			else if($group[$i] == $tc && $level > 3)
				$level = 3;
		}
	}
	return $level;
}

	$q = "SELECT * FROM config WHERE config_name IN ('cookie_name', 'cookie_path', 'cookie_domain', 'cookie_secure') ";
	$res = mysql_query($q)
		or die(mysql_error());
	while ($r = mysql_fetch_array($res))
	{
		switch($r['config_name'])
		{
			case 'cookie_name':
				$cookiename = $r['config_value'];
				break;
			case 'cookie_path':
				$cookiepath = $r['config_value'];
				break;
			case 'cookie_domain':
				$cookiedomain = $r['config_value'];
				break;
			case 'cookie_secure':
				$cookiesecure = $r['config_value'];
				break;
		}
	}
	if ( isset($HTTP_COOKIE_VARS[$cookiename . '_sid']) || isset($HTTP_COOKIE_VARS[$cookiename . '_data']) )
	{
		$session_id = isset($HTTP_COOKIE_VARS[$cookiename . '_sid']) ? $HTTP_COOKIE_VARS[$cookiename . '_sid'] : '';
		$sessiondata = isset($HTTP_COOKIE_VARS[$cookiename . '_data']) ? unserialize(stripslashes($HTTP_COOKIE_VARS[$cookiename . '_data'])) : array();
		//print_r($sessiondata);
		if ($sessiondata['userid'] != -1)
		{
			$q2 = "SELECT username, archived, stayloggedin FROM users where user_id = '".$sessiondata['userid']."'";
			$res2 = mysql_query($q2)
				or die(mysql_error());
			$r2 = mysql_fetch_array($res2);
			if ($r2['stayloggedin'] == 1)
			{
				$_SESSION['shef_hockey_user_id'] = $sessiondata['userid'];
				$_SESSION['shef_hockey_user_logged'] = $r2['username'];
				//$_SESSION['user_password'] = $row['user_password'];
				$_SESSION['shef_hockey_user_securitylevel'] =  setsecuritylevel($sessiondata['userid']);
				$_SESSION['shef_hockey_session_id'] = $session_id;
				$_SESSION['shef_hockey_user_archived'] = $r2['archived'];
			}
		}
	}
?>
	