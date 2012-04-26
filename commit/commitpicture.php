<?php
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
include('../inc/commitfunctions.inc.php');

switch ($_GET['Action'])
{
	case "upload":
		//variables
		$uid = USR_ID;
		$username = USR_LOGGED;
		$today = date("Y-m-d");
		$album_id = $_POST['id'];
		$error = '';

		//upload image and check type
		if (empty($_FILES))
		{
			$error = "Please select some files to upload";
		}
		else
		{
			$ImageDir = "../img/";
			if (!is_dir($ImageDir . $uid))
			{
				mkdir($ImageDir . $uid,0777);
				chmod($ImageDir . $uid,0777);
			}
			foreach($_FILES as $file)
			{
				$tempname = $file['name'];
				if(!empty($tempname))
				{
					//print_r($file);
					$ImageName = $ImageDir . $uid . "/" . $tempname;
					
					if (move_uploaded_file($file['tmp_name'], $ImageName))
					{
						//get info about image being uploaded
						list ($width, $height, $type, $attr) = getimagesize($ImageName);
						
						if (($type > 3) || ($height == 0) || ($width == 0))
						{
							$error = "Sorry, but the file you uploaded was not a JPG/GIF/PNG file<br />Please hit your browser's back button and try again.";
						}
						else
						{
							//image is ok, proceed
							$insert = 	"INSERT INTO pictures " .
										"(album_id,path, date) " .
										"VALUES ('$album_id','$ImageName', '$today')";
							$insertresults = mysql_query($insert)
								or die(mysql_error());
							
							//rename image
							$lastpicid = mysql_insert_id();
							
							$newfilename = $ImageDir . $uid . "/" . $lastpicid . ".jpg";
							$finalpath = "./img/".$uid."/".$lastpicid.".jpg";
							// Allocate enough memory
							setMemoryForImage($ImageName);
							
							switch ($type)
							{
								case "2":
								$image_old = imagecreatefromjpeg($ImageName);
								break;
							
								case "1":
								$image_old = imagecreatefromgif($ImageName);
								break;
							
								case "3":
								$image_old = imagecreatefrompng($ImageName);
								break;
							}
			
							if (($width < 1024) && ($height < 1024))
							{
								$new_width = $width;
								$new_height = $height;
							}
							else
							{
								if ($width > $height)
								{
									$new_width = 1024;
									$new_height = 768;
								}
								if ($width < $height)
								{
									$new_width = 768;
									$new_height = 1024;
								}
								if ($width == $height)
								{
									$new_width = 1024;
									$new_height = 1024;
								}
							}
							$image_jpg = imagecreatetruecolor($new_width, $new_height);
							imagecopyresampled($image_jpg, $image_old, 0,0,0,0, $new_width, $new_height, $width, $height);
							imagejpeg($image_jpg, $newfilename);
			
							// create thumbnail image
							$thumbdir = $ImageDir . $uid . "/thumbs/";
							$thumbpath = $thumbdir . $lastpicid . ".jpg";
							$finalthumb = "./img/".$uid."/thumbs/".$lastpicid.".jpg";
							if (!is_dir($thumbdir))
							{
								mkdir($thumbdir,0777);
								chmod($thumbdir,0777);
							}
							
							if ($width > $height)
							{
								$thumb_width = 233;
								$thumb_height = 175;
							}
							if ($width < $height)
							{
								$thumb_width = 131;
								$thumb_height = 175;
							}
							if ($width == $height)
							{
								$thumb_width = 175;
								$thumb_height = 175;
							}
							$image_thumb = imagecreatetruecolor($thumb_width, $thumb_height);
							imagecopyresampled($image_thumb, $image_old, 0,0,0,0, $thumb_width, $thumb_height, $width, $height);
							imagejpeg($image_thumb, $thumbpath);
			
							// destroy resources
							imagedestroy($image_old);
							imagedestroy($image_jpg);
							imagedestroy($image_thumb);
							unlink($ImageName);
			
							$update = "UPDATE pictures SET path = '$finalpath', thumb = '$finalthumb' WHERE picture_id = '$lastpicid'";
							$res = mysql_query($update)
								or die(mysql_error());
			
						}
						// LOG SUBMISSION
						$logdata = 'User added picture with picture_id '.$lastpicid.' to album: '.$album_id;
						submitlog($logdata);
					}
					else
					{
						$error .= 'Failed+to+upload+'.$file['name'];
					}
				}
			}
		}
		if(empty($error))
			header('location:../memberpages.php?Page=picmenu&Action=edit&id='.$album_id);
		else
			header('location:../memberpages.php?Page=picmenu&Action=upload&id='.$album_id.'&error='.$error);
	break;
}
?>