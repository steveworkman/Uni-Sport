<?php
include('../inc/commitfunctions.inc.php');
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
if (SEC_LVL == 1)
{
	switch($_GET['action'])
	{
		case 'add':
			$ftmp = $_FILES['pic']['tmp_name'];
			$fname = './img/ads/'.$_FILES['pic']['name'];
			
			$alt = myAddSlashes(trim($_POST['title']));
			$seq = trim($_POST['seq']);
			$link = myAddSlashes(trim($_POST['link']));
			if(move_uploaded_file($ftmp, '.'.$fname))
			{	
				// Add to database
				$q2 = "INSERT INTO adverts (`alt`, `path`, `sequence`, `link`) VALUES ('".$alt."', '".$fname."', '".$seq."', '".$link."') ";
				$res2 = mysql_query($q2)
					or die(mysql_error());
				submitlog('User added a new advert with id '.mysql_insert_id());
			}
		break;
		
		case 'edit':
			$ids = split(",",$_POST['IDs']);
		
			for ($i=0; $i<sizeof($ids); $i++)
			{
				$alt = myAddSlashes(trim($_POST['alt_'.$ids[$i]]));
				$seq = trim($_POST['seq_'.$ids[$i]]);
				$link = myAddSlashes(trim($_POST['hyp_'.$ids[$i]]));
				
				// Update database
				$q2 = "UPDATE adverts SET `alt`='".$alt."', `sequence`='".$seq."', `link`='".$link."' WHERE ad_id = '".$ids[$i]."'";
				$res2 = mysql_query($q2)
					or die(mysql_error());
				submitlog('User edited adverts');
			}
		break;
		
		case 'delete':
			// get path to unlink picture
			$q1 = "SELECT path FROM adverts WHERE ad_id = '".$_GET['id']."'";
			$r1 = mysql_query($q1)
				or die(mysql_error());
			$row = mysql_fetch_array($r1);
			unlink('.'.$row['path']);
		
			$q = "DELETE FROM adverts WHERE ad_id = '".$_GET['id']."' LIMIT 1";
			$res = mysql_query($q)
				or die(mysql_error());
			submitlog('User deleted advert with id '.$_GET['id']);
		break;
	}
	
	header("location:../adminpages.php?Page=ads");
}
else
{
	header("location:../adminpages.php?Page=ads");
}
?>