<?php
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
include('../inc/commitfunctions.inc.php');

//Get the basic details of the user as an admin could be uploading for someone else therefore session values can't be used
$uid = $_POST['uid'];

// Upload details
$ftmp = $_FILES['image']['tmp_name'];
$oname = $_FILES['image']['name'];
$fname = './img/'.$uid.'/avatar/'.$_FILES['image']['name'];

// create directory if there isn't one
$ImageDir = "../img/";
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

if(move_uploaded_file($ftmp, '.'.$fname))
{
	//get info about image being uploaded
	list ($width, $height, $type, $attr) = getimagesize('.'.$fname);
	
	if (!(($type > 3) || ($height == 0) || ($width == 0)))
	{
		chmod('.'.$fname, 0777);
		$default = "./img/avatar.jpg";
		
		//Remove the old avatar
		$q = "SELECT user_avatar FROM users WHERE user_id = '".$uid."'";
		$res = mysql_query($q)
			or die(mysql_error());
		$srow = mysql_fetch_array($res);
		
		if ($srow['user_avatar'] != $default)
		{
			unlink('.'.$srow['user_avatar']);
		}
		
		// PROCESS THE IMAGE
		//get info about image being uploaded
		list ($width, $height, $type, $attr) = getimagesize('.'.$fname);
		
		if (($type > 3) || ($height == 0) || ($width == 0))
		{
			$error = "Sorry, but the file you uploaded was not a JPG/GIF/PNG file<br />Please try again.";
		}
		else
		{
			// Allocate enough memory
			setMemoryForImage('.'.$fname);
			
			//image is ok, proceed
			switch ($type)
			{
				case "2":
				$image_old = imagecreatefromjpeg('.'.$fname);
				break;
			
				case "1":
				$image_old = imagecreatefromgif('.'.$fname);
				break;
			
				case "3":
				$image_old = imagecreatefrompng('.'.$fname);
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
			imagejpeg($image_jpg, '.'.$fname);
			
			// destroy resources
			imagedestroy($image_old);
			imagedestroy($image_jpg);
		
			// Update database
			$q2 = "UPDATE users SET user_avatar = '".$fname."' WHERE user_id = '".$uid."'";
			$res2 = mysql_query($q2)
				or die(mysql_error());
				
			// LOG SUBMISSION
			$logdata = 	"User uploaded avatar using standalone avatar page";
			submitlog($logdata);
		}
	}
	header('location:../memberpages.php?Page=userdetails&Action=edit&user_id='.$uid);
}
else
{
	$error = 'There+was+an+error+uploading+your+picture.+Please+contact+the+administrator';
	header('location:../memberpages.php?Page=avatar&uid='.$uid.'&error='.urlencode($error));
}