<?php
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
include('../inc/commitfunctions.inc.php');
if (SEC_LVL == 1)
{
	switch($_GET['action'])
	{
		case 'add':
		
			$title = myAddSlashes(trim($_POST['title']));
			$seq = trim($_POST['seq']);
			$text = myAddSlashes(trim($_POST['text']));
	
			// add to database
			$q2 = "INSERT INTO infopages (`title`, `sequence`, `text`) VALUES ('".$title."', '".$seq."', '".$text."') ";
			$res2 = mysql_query($q2)
				or die(mysql_error());
			submitlog('User added information page with id '.mysql_insert_id());
		break;
			
		case 'edit':
			$ids = split(",",$_POST['IDs']);
		
			for ($i=0; $i<sizeof($ids); $i++)
			{
				$title = myAddSlashes(trim($_POST['tit_'.$ids[$i]]));
				$seq = trim($_POST['seq_'.$ids[$i]]);
				$text = myAddSlashes(trim($_POST['text_'.$ids[$i]]));
				
				// Update database
				$q2 = "UPDATE infopages SET `title`='".$title."', `sequence`='".$seq."', `text`='".$text."' WHERE page_id = '".$ids[$i]."'";
				$res2 = mysql_query($q2)
					or die(mysql_error());
			}
			submitlog('User edited the info pages');
		break;
		
		case 'delete':
			$q = "DELETE FROM infopages WHERE page_id = '".$_GET['id']."' LIMIT 1";
			$res = mysql_query($q)
				or die(mysql_error());
			submitlog('User deleted info page with id: '.$_GET['id']);
		break;
	}
	header("location:../adminpages.php?Page=infopages");
}
else
{
	header("location:../adminpages.php?Page=infopages");
}
?>