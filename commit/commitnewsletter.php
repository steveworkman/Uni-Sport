<?php
ob_start();
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
include('../inc/commitfunctions.inc.php');
include('facebook.inc.php');

//variables
$title = myAddSlashes(trim($_POST['title']));
$user_id = USR_ID;
$tempname = $_FILES['filename'] ['name'];
$today = date("Y-m-d");
$error = '';

switch ($_GET['Action'])
{
	case "upload":
		//upload file and check type
		if ($tempname == '')
			$error = "Please select a file to upload";
		if (empty($title))
			$error .= "Please+enter+a+title";
		else
		{
			$FileDir = "./newsletters/";
			$FileName = $FileDir . $tempname;
			if (!is_dir($FileDir))
			{
				mkdir($FileDir,0777);
				chmod($FileDir,0777);
			}
			if (move_uploaded_file($_FILES['filename'] ['tmp_name'], '.'.$FileName))
			{
				//get filetype - this is a hack, but it works
				$type = substr($FileName,(strlen($FileName)-3),strlen($FileName));
	
				if (($type != 'doc') && ($type != 'txt') && ($type != 'rtf') && ($type != 'xls') && ($type != 'pdf'))
				{
					$error .= "Sorry, but the file you uploaded was not a DOC/TXT/RTF/XLS/PDF file<br />Please hit your browser back button and try again.";
				}
				else
				{
					//file is ok, proceed
					//insert file info into table
					$insert = 	"INSERT INTO newsletters " .
								"(Title, path, SubmittedOn, user_id) " .
								"VALUES ('$title', '$FileName', '$today', '$user_id')";
					$insertresults = mysql_query($insert)
						or die(mysql_error());
						
					// LOG SUBMISSION
					$user = getUsername(USR_ID);
					$lastid = mysql_insert_id();
					$logdata = $user.' added newsletter with NewsletterID: '.$lastid;
					submitlog($logdata);
					
					// FACEBOOK NOTIFICATION
					$siteUrl = getSiteUrl();
					$msg = ': '.$user.' has added a newsletter entitled '.$title.' on '.$siteUrl.'. <a href="http://'.$siteUrl.'/'.$FileName.'">Click here to read the newsletter</a>';
					$fbres = notifyPeople($facebook,$msg,'');
				}
			}
		}
		if(empty($error))
			header('location:../adminpages.php?Page=newslettermenu'.$fb_lnk);
		else
			header('location:../adminpages.php?Page=newslettermenu&Action=upload&error='.urlencode($error).$fb_lnk);
		 
		ob_end_flush();
	break;
	
	case "edit":
	
		$error = '';
		//input validation
		if (empty($title))
			$error .= "Please+enter+a+title";
		if (empty($error))
		{
			$sql = 	"UPDATE newsletters SET " .
					"title = '" . $title . "' " .
					"WHERE newsletter_id = '" . $_POST['id'] . "' ";
		}
		else
		{
			header("location:../adminpages.php?Page=newslettermenu&Action=edit&error=" . urlencode($error));
			ob_end_flush();
		}
		if (isset($sql) && (!empty($sql)))
		{
			$result = mysql_query($sql)
				or die("Invalid query: " . mysql_error());
		}
		// LOG SUBMISSION
		$logdata = 'User edited newletter with NewsletterID: '.$_POST['id'];
		submitlog($logdata);
		header("location:../adminpages.php?Page=newslettermenu");
	break;
	
	case "delete":
		$error = '';
		// get path so can remove from server
		$query = "SELECT path FROM newsletters WHERE newsletter_id = '" . $_POST['id'] . "'";
		$res = mysql_query($query)
			or die(mysql_error());
		$row = mysql_fetch_array($res);
		$oldpath = $row['path'];
		
		$sql = "DELETE FROM newsletters " .
				"WHERE newsletter_id = '" . $_POST['id'] . "' " .
				"LIMIT 1";
		$result = mysql_query($sql)
			or die("Invalid query: " . mysql_error());
		unlink('.'.$oldpath);
		
		// LOG SUBMISSION
		$logdata = 'User deleted newsletter with NewsletterID '.$_POST['id'];
		submitlog($logdata);
		header("location:../adminpages.php?Page=newslettermenu");
	break;
	
	case 'arc':
		$ids = split(",",$_POST['IDs']);
		
		for ($i=0; $i<sizeof($ids); $i++)
		{
			if ($_POST[$ids[$i]] == 'on')
			{
				$query = "UPDATE newsletters SET `archived` = 1 WHERE `newsletter_id` = '". $ids[$i] ."'";
				$res = mysql_query($query)
					or die(mysql_error());
			}
			else
			{
				$query = "UPDATE newsletters SET `archived` = 0 WHERE `newsletter_id` = '". $ids[$i] ."'";
				$res = mysql_query($query)
					or die(mysql_error());
			}
		}
		header("location:../adminpages.php?Page=newslettermenu");
}
?>