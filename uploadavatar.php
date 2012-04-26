<?php
include('inc/connect.inc.php');
include('inc/secure_page.inc.php');

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

//Get the basic details of the user as an admin could be uploading for someone else therefore session values can't be used
$uid = $_GET['id'];

// Upload details
$ftmp = $_FILES['image']['tmp_name'];
$oname = $_FILES['image']['name'];
$fname = './img/'.$uid.'/avatar/'.$_FILES['image']['name'];

// create directory if there isn't one
$ImageDir = "./img/";
if (!is_dir($ImageDir . $uid))
{
	mkdir($ImageDir . $uid,0777);
	chmod($ImageDir . $uid,0777);
}

if (!is_dir($ImageDir . $uid . "/avatar/"))
{
	$suc = mkdir($ImageDir . $uid."/avatar/",0777);
	$suc2 = chmod($ImageDir . $uid."/avatar/",0777);
}

if(move_uploaded_file($ftmp, $fname))
{
	//get info about image being uploaded
	list ($width, $height, $type, $attr) = getimagesize($fname);
	
	if (!(($type > 3) || ($height == 0) || ($width == 0)))
	{
		chmod($fname, 0777);
		$default = "./img/avatar.jpg";
		
		//Remove the old avatar
		$q = "SELECT user_avatar FROM users WHERE user_id = '".$uid."'";
		$res = mysql_query($q)
			or die(mysql_error());
		$srow = mysql_fetch_array($res);
		
		if ($srow['user_avatar'] != $default)
			unlink($srow['user_avatar']);
		
		// PROCESS THE IMAGE
		//get info about image being uploaded
		list ($width, $height, $type, $attr) = getimagesize($fname);
		
		if (($type > 3) || ($height == 0) || ($width == 0))
		{
			$error = "Sorry, but the file you uploaded was not a JPG/GIF/PNG file<br />Please try again.";
		}
		else
		{
			// Allocate enough memory
			setMemoryForImage($fname);
			
			//image is ok, proceed
			switch ($type)
			{
				case "2":
				$image_old = imagecreatefromjpeg($fname);
				break;
			
				case "1":
				$image_old = imagecreatefromgif($fname);
				break;
			
				case "3":
				$image_old = imagecreatefrompng($fname);
				break;
			}
			if (($width < 120) && ($height < 120))
			{
				$new_width = $width;
				$new_height = $height;
			}
			else
			{
				if ($width > $height)
				{
					$new_width = 120;
					$new_height = 90;
				}
				if ($width < $height)
				{
					$new_width = 90;
					$new_height = 120;
				}
				if ($width == $height)
				{
					$new_width = 120;
					$new_height = 120;
				}
			}
			$image_jpg = imagecreatetruecolor($new_width, $new_height);
			imagecopyresampled($image_jpg, $image_old, 0,0,0,0, $new_width, $new_height, $width, $height);
			imagejpeg($image_jpg, $fname);
			
			// destroy resources
			imagedestroy($image_old);
			imagedestroy($image_jpg);
		
			// Update database
			$q2 = "UPDATE users SET user_avatar = '".$fname."' WHERE user_id = '".$uid."'";
			$res2 = mysql_query($q2)
				or die(mysql_error());
				
			// LOG SUBMISSION
			$logdata = 	"User uploaded avatar";
			$log = "INSERT INTO log (`user_id`, `action`, `timestamp`, `ip`) VALUES ".
			"('". $_SESSION['shef_hockey_user_id'] ."', '". $logdata ."', '". date("Y-m-d G:i:s", time()) ."', '". $_SERVER['REMOTE_ADDR'] ."')";
	
			if (isset($log))
			{
				$logresult = mysql_query($log)
					or die("Log entry failed: ". mysql_error());
			}
		}
	}
	?>
	<html><head>
	<style>
	#file {width: 250px;}
	body{background-color:#eee;}
	</style>
<script language="javascript" type="text/javascript">
	var par = window.parent.document;
	// Refresh the image
	par.images['avatar'].src = '<?=$fname?>';
	</script>
	</head>
	<body></body>
	</html>
	<?php
	exit();
}



?>
<html><head>
<script language="javascript">
function upload(){
	// hide old iframe
	var par = window.parent.document;
	var iframe = par.getElementById('iframe');
	iframe.className = 'hidden';
	
	// add image progress
	var images = par.getElementById('avatar');
	par.images['avatar'].src = './img/indicator.gif';
	
	// send
	var imgnum = images.getElementsByTagName('div').length - 1;
	document.iform.imgnum.value = imgnum;
	document.iform.submit();
}
</script>
<style>
#file {
	width: 250px;
}

body
{
	background-color:#eee;
}
</style>
</head><body><center>
<form name="iform" action="" method="post" enctype="multipart/form-data">
<input id="file" size="15" type="file" name="image" onChange="upload()" />
<input type="hidden" name="imgnum" />
</form>
</center></html>