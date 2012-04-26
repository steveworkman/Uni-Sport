<?php
/***************************************************************************
 *                                login.php
 *                            -------------------
 *   begin                : Saturday, Feb 13, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: login.php,v 1.47.2.23 2006/01/13 20:10:02 grahamje Exp $
 *
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

/*
 * Logging function.
 * Should be called every time a database commit is made (or an action is finished)
 */
function submitlog($action)
{
	if(USR_ID == '' || USR_ID == 0)
		$id = -1;
	else
		$id = USR_ID;
	$log = "INSERT INTO log (`user_id`, `action`, `timestamp`, `ip`) VALUES ".
			"('".$id."', '".$action."', '".date("Y-m-d G:i:s", time())."', '".ip2long($_SERVER['REMOTE_ADDR'])."')";

	if (isset($log))
	{
		$logresult = mysql_query($log)
			or die("Log entry failed: ". mysql_error());
	}
}

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

function sendToHost($host,$method,$path,$data,$useragent=0)
{
    // Supply a default method of GET if the one passed was empty
    if (empty($method)) {
        $method = 'GET';
    }
    $method = strtoupper($method);
    $fp = fsockopen($host, 80);
    if ($method == 'GET') {
        $path .= '?' . $data;
    }
    fputs($fp, "$method $path HTTP/1.1\r\n");
    fputs($fp, "Host: $host\r\n");
    fputs($fp,"Content-type: application/x-www-form- urlencoded\r\n");
    fputs($fp, "Content-length: " . strlen($data) . "\r\n");
    if ($useragent) {
        fputs($fp, "User-Agent: MSIE\r\n");
    }
    fputs($fp, "Connection: close\r\n\r\n");
    if ($method == 'POST') {
        fputs($fp, $data);
    }

    while (!feof($fp)) {
        $buf .= fgets($fp,128);
    }
    fclose($fp);
    return $buf;
}


//
// Allow people to reach login page if
// board is shut down
//
define("IN_LOGIN", true);

define('IN_PHPBB', true);
$phpbb_root_path = './';
include($phpbb_root_path . 'extension.inc');
include($phpbb_root_path . 'common.'.$phpEx);
session_start();
//
// Set page ID for session management
//
$userdata = session_pagestart($user_ip, PAGE_LOGIN);
init_userprefs($userdata);
//
// End session management
//

// session id check
if (!empty($HTTP_POST_VARS['sid']) || !empty($HTTP_GET_VARS['sid']))
{
	$sid = (!empty($HTTP_POST_VARS['sid'])) ? $HTTP_POST_VARS['sid'] : $HTTP_GET_VARS['sid'];
}
else
{
	$sid = '';
}
// You've not got sessions set, will try to log you in

// First, try with facebook
if($HTTP_GET_VARS['fb'] == 1)
{
	require_once('facebook.inc.php');
	if(isset($facebook->user))
	{
		$admin = (isset($HTTP_POST_VARS['admin'])) ? 1 : 0;
		$session_id = session_begin($_SESSION['shef_hockey_user_id'], $user_ip, PAGE_INDEX, FALSE, $autologin, $admin);
		$_SESSION['shef_hockey_session_id'] = $session_id['session_id'];
		// Reset login tries
		$db->sql_query('UPDATE '.USERS_TABLE.' SET user_login_tries = 0, user_last_login_try = 0 WHERE user_id = ' .$_SESSION['shef_hockey_user_id']);
		if( $session_id )
		{
			if (empty($HTTP_GET_VARS['ref']))
			{
				$url = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : "index.$phpEx";
				redirect(append_sid($url, true));
			}
			else
			{
				//$url = substr($HTTP_GET_VARS['ref'],1,strlen($HTTP_GET_VARS['ref'])-1);
				$url = $HTTP_GET_VARS['ref'];
				header('Location:'.append_sid($url, true));
			}
		}
		else
		{
			message_die(CRITICAL_ERROR, "Couldn't start session : login", "", __LINE__, __FILE__);
		}
	}
}
else
{
	if( isset($HTTP_POST_VARS['login']) || isset($HTTP_GET_VARS['login']) || isset($HTTP_POST_VARS['logout']) || isset($HTTP_GET_VARS['logout']) )
	{
		if((isset($HTTP_POST_VARS['login']) || isset($HTTP_GET_VARS['login']) ) && (!$userdata['session_logged_in'] || isset($HTTP_POST_VARS['admin'])) )
		{
			$username = isset($HTTP_POST_VARS['username']) ? phpbb_clean_username($HTTP_POST_VARS['username']) : '';
			$password = isset($HTTP_POST_VARS['password']) ? $HTTP_POST_VARS['password'] : '';
	
			$sql = "SELECT user_id, username, user_password, user_active, user_level, user_login_tries, user_last_login_try, stayloggedin
				FROM " . USERS_TABLE . "
				WHERE username = '" . str_replace("\\'", "''", $username) . "'";
			if ( !($result = $db->sql_query($sql)) )
			{
				message_die(GENERAL_ERROR, 'Error in obtaining userdata', '', __LINE__, __FILE__, $sql);
			}
			if (mysql_num_rows($result) > 1)
			{
				// More than 1 person has that name, set that person straight
				message_die(GENERAL_ERROR, 'More than one user exists with that name. Please try again with your email address', '', '', '', '');
			}
			
			// Perhaps they tried to log in with their email address, try that before failing:
			$sql2 = "SELECT user_id, username, user_password, user_active, user_level, user_login_tries, user_last_login_try, stayloggedin
				FROM " . USERS_TABLE . "
				WHERE user_email = '" . str_replace("\\'", "''", $username) . "'";
			if ( !($result2 = $db->sql_query($sql2)) )
			{
				message_die(GENERAL_ERROR, 'Error in obtaining userdata', '', __LINE__, __FILE__, $sql2);
			}
			
			if( $row = $db->sql_fetchrow($result) )
			{
				if( $row['user_level'] != ADMIN && $board_config['board_disable'] )
				{
					redirect(append_sid("index.$phpEx", true));
				}
				else
				{
					// If the last login is more than x minutes ago, then reset the login tries/time
					if ($row['user_last_login_try'] && $board_config['login_reset_time'] && $row['user_last_login_try'] < (time() - ($board_config['login_reset_time'] * 60)))
					{
						$db->sql_query('UPDATE ' . USERS_TABLE . ' SET user_login_tries = 0, user_last_login_try = 0 WHERE user_id = ' . $row['user_id']);
						$row['user_last_login_try'] = $row['user_login_tries'] = 0;
					}
					
					// Check to see if user is allowed to login again... if his tries are exceeded
					if ($row['user_last_login_try'] && $board_config['login_reset_time'] && $board_config['max_login_attempts'] && 
						$row['user_last_login_try'] >= (time() - ($board_config['login_reset_time'] * 60)) && $row['user_login_tries'] >= $board_config['max_login_attempts'] && $userdata['user_level'] != ADMIN)
					{
						message_die(GENERAL_MESSAGE, sprintf($lang['Login_attempts_exceeded'], $board_config['max_login_attempts'], $board_config['login_reset_time']));
					}
	
					if( md5($password) == $row['user_password'] && $row['user_active'] )
					{	
						if ($row['stayloggedin'] == 1)
						{
							$autologin = TRUE;
						}
						else
						{
							$autologin = 0;
						}
	
						$admin = (isset($HTTP_POST_VARS['admin'])) ? 1 : 0;
						$session_id = session_begin($row['user_id'], $user_ip, PAGE_INDEX, FALSE, $autologin, $admin);
						
						// Reset login tries
						$db->sql_query('UPDATE ' . USERS_TABLE . ' SET user_login_tries = 0, user_last_login_try = 0 WHERE user_id = ' . $row['user_id']);
						
						/* HEREIN LIES THE HOCKEY SESSION SETTING CODE */
						$_SESSION['shef_hockey_user_id'] = $row['user_id'];
						$_SESSION['shef_hockey_user_logged'] = $row['username'];
						$_SESSION['shef_hockey_user_securitylevel'] =  setsecuritylevel($row['user_id']);
						$_SESSION['shef_hockey_user_archived'] = $row['user_archived'];
						$_SESSION['shef_hockey_session_id'] = $session_id['session_id'];
						/* HERE ENDETH THE HOCKEY SESSION SETTING CODE */
						
						if( $session_id )
						{
							if (empty($HTTP_POST_VARS['referrer']))
							{
								$url = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : "index.$phpEx";
								redirect(append_sid($url, true));
							}
							else
							{
								$url = $HTTP_POST_VARS['referrer'];
								header('Location:'.append_sid($url, true));
							}
							
						}
						else
						{
							message_die(CRITICAL_ERROR, "Couldn't start session : login", "", __LINE__, __FILE__);
						}
					}
					// Only store a failed login attempt for an active user - inactive users can't login even with a correct password
					else if( $row['user_active'] )
					{
						// Save login tries and last login
						if ($row['user_id'] != ANONYMOUS)
						{
							$sql = 'UPDATE ' . USERS_TABLE . '
								SET user_login_tries = user_login_tries + 1, user_last_login_try = ' . time() . '
								WHERE user_id = ' . $row['user_id'];
							$db->sql_query($sql);
						}
						
					}
	
					$redirect = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : '';
					$redirect = str_replace('?', '&', $redirect);
	
					if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))
					{
						message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
					}
	
					$template->assign_vars(array(
						'META' => "<meta http-equiv=\"refresh\" content=\"3;url=login.$phpEx?redirect=$redirect\">")
					);
	
					$message = $lang['Error_login'] . '<br /><br />' . sprintf($lang['Click_return_login'], "<a href=\"login.$phpEx?redirect=$redirect\">", '</a>') . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
	
					message_die(GENERAL_MESSAGE, $message);
				}
			}
			else if ($row = $db->sql_fetchrow($result2))
			{
				
				if( $row['user_level'] != ADMIN && $board_config['board_disable'] )
				{
					redirect(append_sid("index.$phpEx", true));
				}
				else
				{
					// If the last login is more than x minutes ago, then reset the login tries/time
					if ($row['user_last_login_try'] && $board_config['login_reset_time'] && $row['user_last_login_try'] < (time() - ($board_config['login_reset_time'] * 60)))
					{
						$db->sql_query('UPDATE ' . USERS_TABLE . ' SET user_login_tries = 0, user_last_login_try = 0 WHERE user_id = ' . $row['user_id']);
						$row['user_last_login_try'] = $row['user_login_tries'] = 0;
					}
					
					// Check to see if user is allowed to login again... if his tries are exceeded
					if ($row['user_last_login_try'] && $board_config['login_reset_time'] && $board_config['max_login_attempts'] && 
						$row['user_last_login_try'] >= (time() - ($board_config['login_reset_time'] * 60)) && $row['user_login_tries'] >= $board_config['max_login_attempts'] && $userdata['user_level'] != ADMIN)
					{
						message_die(GENERAL_MESSAGE, sprintf($lang['Login_attempts_exceeded'], $board_config['max_login_attempts'], $board_config['login_reset_time']));
					}
	
					if( md5($password) == $row['user_password'] && $row['user_active'] )
					{
						if ($row['stayloggedin'] == 1)
						{
							$autologin = TRUE;
						}
						else
						{
							$autologin = 0;
						}
	
						$admin = (isset($HTTP_POST_VARS['admin'])) ? 1 : 0;
						$session_id = session_begin($row['user_id'], $user_ip, PAGE_INDEX, FALSE, $autologin, $admin);
	
						// Reset login tries
						$db->sql_query('UPDATE ' . USERS_TABLE . ' SET user_login_tries = 0, user_last_login_try = 0 WHERE user_id = ' . $row['user_id']);
	
						/* HEREIN LIES THE HOCKEY SESSION SETTING CODE */
						$_SESSION['shef_hockey_user_id'] = $row['user_id'];
						$_SESSION['shef_hockey_user_logged'] = $row['username'];
						$_SESSION['shef_hockey_user_securitylevel'] =  setsecuritylevel($row['user_id']);
						$_SESSION['shef_hockey_user_archived'] = $row['user_archived'];
						$_SESSION['shef_hockey_session_id'] = $session_id['session_id'];
						/* HERE ENDETH THE HOCKEY SESSION SETTING CODE */
						
						if( $session_id )
						{
							if (empty($HTTP_POST_VARS['referrer']))
							{
								$url = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : "index.$phpEx";
								redirect(append_sid($url, true));
							}
							else
							{
								$url = $HTTP_POST_VARS['referrer'];
								header('Location:'.append_sid($url, true));
							}
							
						}
						else
						{
							message_die(CRITICAL_ERROR, "Couldn't start session : login", "", __LINE__, __FILE__);
						}
					}
					// Only store a failed login attempt for an active user - inactive users can't login even with a correct password
					else if( $row['user_active'] )
					{
						// Save login tries and last login
						if ($row['user_id'] != ANONYMOUS)
						{
							$sql = 'UPDATE ' . USERS_TABLE . '
								SET user_login_tries = user_login_tries + 1, user_last_login_try = ' . time() . '
								WHERE user_id = ' . $row['user_id'];
							$db->sql_query($sql);
						}
						
					}
	
					$redirect = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : '';
					$redirect = str_replace('?', '&', $redirect);
	
					if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r") || strstr(urldecode($redirect), ';url'))
					{
						message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
					}
	
					$template->assign_vars(array(
						'META' => "<meta http-equiv=\"refresh\" content=\"3;url=login.$phpEx?redirect=$redirect\">")
					);
	
					$message = $lang['Error_login'] . '<br /><br />' . sprintf($lang['Click_return_login'], "<a href=\"login.$phpEx?redirect=$redirect\">", '</a>') . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
	
					message_die(GENERAL_MESSAGE, $message);
				}
			
			}
			else
			{
				$redirect = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : "";
				$redirect = str_replace("?", "&", $redirect);
	
				if (strstr(urldecode($redirect), "\n") || strstr(urldecode($redirect), "\r"))
				{
					message_die(GENERAL_ERROR, 'Tried to redirect to potentially insecure url.');
				}
	
				$template->assign_vars(array(
					'META' => "<meta http-equiv=\"refresh\" content=\"3;url=login.$phpEx?redirect=$redirect\">")
				);
	
				$message = $lang['Error_login'] . '<br /><br />' . sprintf($lang['Click_return_login'], "<a href=\"login.$phpEx?redirect=$redirect\">", '</a>') . '<br /><br />' .  sprintf($lang['Click_return_index'], '<a href="' . append_sid("index.$phpEx") . '">', '</a>');
	
				message_die(GENERAL_MESSAGE, $message);
			}
		}
		else if( ( isset($HTTP_GET_VARS['logout']) || isset($HTTP_POST_VARS['logout']) ) && $userdata['session_logged_in'] )
		{
			// session id check
			if ($sid == '' || $sid != $userdata['session_id'])
			{
				message_die(GENERAL_ERROR, 'Invalid_session');
			}
	
			if( $userdata['session_logged_in'] )
			{
				session_end($userdata['session_id'], $userdata['user_id']);
				//submitlog("User logged out");
				/* HEREIN LIES THE HOCKEY SESSION REMOVAL CODE */
				$_SESSION['shef_hockey_user_id'] = '';
				$_SESSION['shef_hockey_user_logged'] = '';
				$_SESSION['shef_hockey_user_securitylevel'] =  '';
				$_SESSION['shef_hockey_session_id'] = '';
				$_SESSION['shef_hockey_user_archived'] = '';
				/* HERE ENDETH THE HOCKEY SESSION REMOVAL CODE */
				// Send a post to facebook to log out from there
				sendToHost('www.facebook.com','post','/logout.php','confirm=1');
			}
	
			if (!empty($HTTP_POST_VARS['redirect']) || !empty($HTTP_GET_VARS['redirect']))
			{
				if (empty($HTTP_GET_VARS['referrer']))
				{
					$url = (!empty($HTTP_POST_VARS['redirect'])) ? htmlspecialchars($HTTP_POST_VARS['redirect']) : htmlspecialchars($HTTP_GET_VARS['redirect']);
					$url = str_replace('&amp;', '&', $url);
					redirect(append_sid($url, true));
				}
				else
				{
					$url = $HTTP_GET_VARS['referrer'];
					if(substr("/beta/forum/", 0, 11) == substr($url, 0, 11))
						header('Location:'.append_sid("./beta/forum/index.php", true));
					else
						header('Location:'.append_sid("../index.php", true));
				}
				
			}
			else
			{
				if (empty($HTTP_GET_VARS['referrer']))
				{
					redirect(append_sid("index.$phpEx", true));
				}
				else
				{
					$url = $HTTP_GET_VARS['referrer'];
					if(substr("/beta/forum/", 0, 11) == substr($url, 0, 11))
						header('Location:'.append_sid("./beta/forum/index.php", true));
					else
						header('Location:'.append_sid("../index.php", true));
				}
			}
		}
		else
		{
			$url = ( !empty($HTTP_POST_VARS['redirect']) ) ? str_replace('&amp;', '&', htmlspecialchars($HTTP_POST_VARS['redirect'])) : "index.$phpEx";
			redirect(append_sid($url, true));
		}
	}
	else
	{
		//
		// Do a full login page dohickey if
		// user not already logged in
		//
		if( !$userdata['session_logged_in'] || (isset($HTTP_GET_VARS['admin']) && $userdata['session_logged_in'] && $userdata['user_level'] == ADMIN))
		{
			$page_title = $lang['Login'];
			include($phpbb_root_path . 'includes/page_header.'.$phpEx);
	
			$template->set_filenames(array(
				'body' => 'login_body.tpl')
			);
	
			$forward_page = '';
	
			if( isset($HTTP_POST_VARS['redirect']) || isset($HTTP_GET_VARS['redirect']) )
			{
				$forward_to = $HTTP_SERVER_VARS['QUERY_STRING'];
	
				if( preg_match("/^redirect=([a-z0-9\.#\/\?&=\+\-_]+)/si", $forward_to, $forward_matches) )
				{
					$forward_to = ( !empty($forward_matches[3]) ) ? $forward_matches[3] : $forward_matches[1];
					$forward_match = explode('&', $forward_to);
	
					if(count($forward_match) > 1)
					{
						for($i = 1; $i < count($forward_match); $i++)
						{
							if( !ereg("sid=", $forward_match[$i]) )
							{
								if( $forward_page != '' )
								{
									$forward_page .= '&';
								}
								$forward_page .= $forward_match[$i];
							}
						}
						$forward_page = $forward_match[0] . '?' . $forward_page;
					}
					else
					{
						$forward_page = $forward_match[0];
					}
				}
			}
	
			$username = ( $userdata['user_id'] != ANONYMOUS ) ? $userdata['username'] : '';
	
			$s_hidden_fields = '<input type="hidden" name="redirect" value="' . $forward_page . '" />';
			$s_hidden_fields .= (isset($HTTP_GET_VARS['admin'])) ? '<input type="hidden" name="admin" value="1" />' : '';
	
			make_jumpbox('viewforum.'.$phpEx);
			$template->assign_vars(array(
				'USERNAME' => $username,
	
				'L_ENTER_PASSWORD' => (isset($HTTP_GET_VARS['admin'])) ? $lang['Admin_reauthenticate'] : $lang['Enter_password'],
				'L_SEND_PASSWORD' => $lang['Forgotten_password'],
	
				'U_SEND_PASSWORD' => append_sid("profile.$phpEx?mode=sendpassword"),
	
				'S_HIDDEN_FIELDS' => $s_hidden_fields)
			);
	
			$template->pparse('body');
	
			include($phpbb_root_path . 'includes/page_tail.'.$phpEx);
		}
		else
		{
			redirect(append_sid("index.$phpEx", true));
		}
	
	}
}

?>