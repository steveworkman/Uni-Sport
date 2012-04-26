<?php
	include "../inc/connect.inc.php";
	include "../inc/secure_page.inc.php";

switch ($_GET['Action'])
	{
		case "add":
			$error = '';
			//input validation
			$name = trim($_POST['name']);
			$desc = trim($_POST['desc']);
			$elist = trim($_POST['emaillist']);
			$emaillist = substr($elist,1);
			$emaillist = split(",",$emaillist);
			
			if (empty($name))
			{
				$error .= "Please+enter+a+description%21%0D%0A";
			}
			if (empty($desc))
			{
				$error .= "Please+enter+a+name+for+the+event%21%0D%0A";
			}
			
			if (empty($error))
			{
				$sql = "INSERT INTO `emaillists` (`Name` , `Description`, `user_id` ) VALUES (" .
							"'" . $name . "', " .
							"'" . $desc . "', " .
							"'" . $_SESSION['shef_hockey_user_id'] . "')";
				$result = mysql_query($sql)
					or die("Invalid query: " . mysql_error());
				$listid = mysql_insert_id();
				
				$sql1 = "INSERT INTO `uelists` (`ListID` , `user_id`) VALUES ";
				for($a =0;$a<count($emaillist);$a++)
				{
					$sql1 = $sql1 . "(" ."'" . $listid . "', " ."'" . $emaillist[$a] . "'),";
				}
				$sql1 = substr($sql1,0,(strlen($sql1)-1));
											
				if (isset($sql) && (empty($error)))
				{
				$result1 = mysql_query($sql1)
					or die("Invalid query1: " . mysql_error());
				}
				
				// LOG SUBMISSION
				$logdata = 	"User added email list with ListID ". mysql_insert_id();
				
				$log = "INSERT INTO log (`user_id`, `Action`, `TimeStamp`, `IP`) VALUES ".
				"('". $_SESSION['shef_hockey_user_id'] ."', '". $logdata ."', '". date("Y-m-d G:i:s", time()) ."', '". $_SERVER['REMOTE_ADDR'] ."')";

				if (isset($log))
				{
				$logresult = mysql_query($log)
					or die("Log entry failed: ". mysql_error());
				}
			}
			else
			{
				header("location:../memberpages.php?Page=distributionlists&Action=add&error=" . urlencode($error));
			}
			header("location:../memberpages.php?Page=distributionlists");
	break;
		
		case "delete":
			$error = '';
			$sql = "DELETE FROM emaillists " .
					"WHERE ListID = '" . $_POST['id'] . "' " .
					"LIMIT 1";
			$sql2 = "DELETE FROM uelists " .
					"WHERE ListID = '" . $_POST['id'] . "'";
			
			// LOG SUBMISSION
			$logdata = 	"User deleted email list with ListID ". $_POST['id'];
			
			$log = "INSERT INTO log (`user_id`, `Action`, `TimeStamp`, `IP`) VALUES ".
				"('". $_SESSION['shef_hockey_user_id'] ."', '". $logdata ."', '". date("Y-m-d G:i:s", time()) ."', '". $_SERVER['REMOTE_ADDR'] ."')";
			if (isset($log))
			{
			$logresult = mysql_query($log)
				or die("Log entry failed: ". mysql_error());
			}
			
		header("location:../memberpages.php?Page=distributionlists");
	break;
	
		case "edit":
			//input validation
			$name = trim($_POST['name']);
			$desc = trim($_POST['desc']);
			$elist = trim($_POST['emaillist']);
			$emaillist = substr($elist,1);
			$emaillist = split(",",$emaillist);
			if (empty($name))
			{
				$error .= "Please+enter+a+name+for+the+list%21%0D%0A";
			}
			if (empty($desc))
			{
				$error .= "Please+enter+a+description+for+the+list%21%0D%0A";
			}
			if (empty($error))
			{
				$sql = "UPDATE `emaillists` SET Name = " . "'" . $name . 
							"', Description =  " . "'" . $desc . "' " . 
							"WHERE ListID = '" . $_POST['id'] . "'";
							
				$deleteuelists = "DELETE FROM uelists " .
								"WHERE ListID = '" . $_POST['id'] . "'";
				
				$addusers = "INSERT INTO `uelists` (`ListID` , `user_id`) VALUES ";
				for($a =1;$a<count($emaillist);$a++)
				{
					$addusers = $addusers . "(" ."'" . $_POST['id'] . "', " ."'" . $emaillist[$a] . "'),";
				}
				$addusers = substr($addusers,0,(strlen($addusers)-1));
				
				// LOG SUBMISSION
				$logdata = 	"User edited email list with ListID ". $_POST['id'];
				
				$log = "INSERT INTO log (`user_id`, `Action`, `TimeStamp`, `IP`) VALUES ".
				"('". $_SESSION['shef_hockey_user_id'] ."', '". $logdata ."', '". date("Y-m-d G:i:s", time()) ."', '". $_SERVER['REMOTE_ADDR'] ."')";
	
				if (isset($log))
				{
				echo $log;
				$logresult = mysql_query($log)
					or die("Log entry failed: ". mysql_error());
				}
								
			}
			else
			{
				header("location:../memberpages.php?Page=distributionlists&Action=edit&id=" . $_POST['id'] . "&error=" . urlencode($error));
			}
		header("location:../memberpages.php?Page=distributionlists");
	}
?>