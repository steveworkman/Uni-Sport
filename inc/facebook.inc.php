<?php
require_once('./facebook/facebook.php');
// Get these from http://developers.facebook.com
$api_key = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
$secret  = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'; 

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

/*
 * Looks for a user with a facebook id
 * Returns array('id','username','arc') if successful, -1/-2 otherwise
 */
function getUser($id)
{
	$data = array();
	$q = 'SELECT user_id, username, archived, user_active FROM users '.
			'WHERE fb_id='.$id;
	$res = mysql_query($q)
		or die(mysql_error());
	if(mysql_num_rows($res) == 0)
		return -1;
		
	$row = mysql_fetch_array($res);
	if($row['user_active'] == 0)
		return -2;
	$data = array('id'=>$row['user_id'],
					'username'=>$row['username'],
					'arc'=>$row['archived']);
	return $data;
}

// Create a new Facebook class
$facebook = new Facebook($api_key, $secret);
$facebook->set_user($facebook->user, $_SESSION['shef_hockey_session_key']);
if(!isset($_SESSION['shef_hockey_user_logged']) || $_SESSION['shef_hockey_user_logged'] == '')
{
	if(!empty($_GET['auth_token']))
	{ 	ob_start();
		// if there's an auth token, try and swap it for a session
		try{
			$session = $facebook->do_get_session($_GET['auth_token']);
		}
		catch(Exception $e){
			echo $e;
		}
		if(!is_array($session))
		{
			header('location: http://www.facebook.com/login.php?api_key='.$api_key.'&v=1.0&next=/index.php&hide_checkbox=1');
			//header('location:/index.php?loginerror=1');
		}
		else
		{	
			$user = getUser($session['uid']);
			if($user == -1)
			{
				header('location:fbselect.php?uid='.$session['uid']);
				ob_flush();
				exit();
			}
			else if($user == -2)
			{
				header('location:fbselect.php?pending=1');
				ob_flush();
				exit();
			}
			
			$facebook->set_user($session['uid'], $session['session_key'], $session['expires']);

			/* HEREIN LIES THE HOCKEY SESSION SETTING CODE */
			$_SESSION['shef_hockey_user_id'] = $user['id'];
			$_SESSION['shef_hockey_user_logged'] = $user['username'];
			$_SESSION['shef_hockey_user_securitylevel'] =  setsecuritylevel($user['id']);
			$_SESSION['shef_hockey_session_key'] = $session['session_key'];
			$_SESSION['shef_hockey_user_archived'] = $user['arc'];

			// header to the login page to do the rest
			header('location:/forum/login.php?fb=1&ref='.$_SERVER['PHP_SELF']);
			ob_flush();
			
		} // end session check
	}// end auth token check 
} // end session check
?>