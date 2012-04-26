<?php
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

/*
 * Throws the user to an error page when they try something naughty
 * accepted types are 'AUTH', 'HACK'
 */
function throw_error($type)
{
	switch($type)
	{
		case 'AUTH':
			header('location:./error.php?type=auth');
		break;
		case 'HACK':
			header('location:./error.php?type=hack');
		break;
		case 'USER':
			header('location:./error.php?type=user');
		break;
	}
}

/*
The following code is by e dot a dot schultz at gmail dot com taken from www.php.net
It tries to solve the error with imagecreatefromjpeg and memory allocation
It also allows for the memory_get_usage function not to be enabled
*/

function setMemoryForImage( $filename )
{
   $imageInfo = getimagesize($filename);
   $MB = 1048576;  // number of bytes in 1M
   $K64 = 65536;    // number of bytes in 64K
   $TWEAKFACTOR = 1.5;  // Or whatever works for you
   $memoryNeeded = round( ( $imageInfo[0] * $imageInfo[1]
										   * $imageInfo['bits']
										   * $imageInfo['channels'] / 8
							 + $K64
						   ) * $TWEAKFACTOR
						 );
   //ini_get('memory_limit') only works if compiled with "--enable-memory-limit" also
   //Default memory limit is 8MB so well stick with that.
   //To find out what yours is, view your php.ini file.
   $memoryLimitMB = 8;
   $memoryLimit = $memoryLimitMB * $MB;
   if (function_exists('memory_get_usage') &&
	   memory_get_usage() + $memoryNeeded > $memoryLimit)
   {
	   $newLimit = $memoryLimitMB + ceil( ( memory_get_usage()
										   + $memoryNeeded
										   - $memoryLimit
										   ) / $MB
									   );
		$newLimit = $newLimit+3000000;
	   ini_set( 'memory_limit', $newLimit . 'M' );
	   return true;
   }
   else
	   return false;
}

/*
 * myAddSlashes solves the problem of having magic quotes enabled on a server or not enabled
 * Code from http://www.webmasterstop.com/63.html
 */
function myAddSlashes($string)
{
	if (get_magic_quotes_gpc() == 1)
		return ($string);
	else
		return (addslashes($string));
}

/*
 * notifyAll sends a message to all users through facebook
 * Takes Facebook, and message and e-mail if you want to e-mail the person
 * Returns false on failure or a url to send the person to on success
 */
function notifyPeople(Facebook $facebook, $message,$email='',$users=array())
{
	$fbids = array();
	if(empty($users)) {
		// Get all IDs
		$fbids = getAllFbIds();
	}
	else {
		// Get the IDs given 
		$fbids = getFbIds($users);
	}
	// Send the notification
	try {
		$result = $facebook->api_client->notifications_send($fbids,$message,$email);
		return $result;
	}
	catch(Exception $e) {
		return false;
	}
}

// Function gets all the FBIDs that are currently in the database
function getAllFbIds()
{
	$data = array();
	$q = 'SELECT fb_id FROM users WHERE fb_id != 0';
	$res = mysql_query($q)
		or die(mylsq_error());
	while($row = mysql_fetch_array($res))
	{
		$data[] = $row['fb_id'];
	}
	return $data;
}

// Function gets all the FBIDs for players given in the array
function getFbIds($users)
{
	$data = array();
	$q = 'SELECT fb_id FROM users WHERE fb_id != 0 AND (';
	foreach($users as $u)
	{
		$q .= 'user_id='.$u.' OR ';
	}
	$q = substr($q,0,strlen($q)-4);
	$q .= ')';

	$res = mysql_query($q)
		or die(mysql_error());
	while($row = mysql_fetch_array($res))
	{
		$data[] = $row['fb_id'];
	}
	return $data;
}

// Gets a username for an ID
function getUsername($uid)
{
	$name = '';
	$q = 'SELECT username FROM users WHERE user_id='.$uid.' LIMIT 1';
	$res = mysql_query($q)
		or die(mysql_error());
	$row = mysql_fetch_array($res);
	$name = $row['username'];
	return $name;
}

// Gets the website URL
function getSiteUrl()
{
	$q = 'SELECT * FROM config WHERE config_name="server_name"';
	$res = mysql_query($q)
		or die(mysql_error());
	$row = mysql_fetch_array($res);
	$url = $row['config_value'];
	return $url;
}

// Get the name from squadID
function getSquadName($sid)
{
	$name = '';
	$q = 'SELECT name FROM squads WHERE squad_id='.$sid.' LIMIT 1';
	$res = mysql_query($q)
		or die(mysql_error());
	$row = mysql_fetch_array($res);
	$name = $row['name'];
	return $name;
}
?>