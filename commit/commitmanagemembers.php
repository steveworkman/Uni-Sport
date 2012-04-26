<?php
include('../inc/secure_page.inc.php');
include('../inc/connect.inc.php');
include('../inc/commitfunctions.inc.php');
require('../classes/class.phpmailer.php');
	
switch($_GET['action'])
{
	case 'add':
		$error = '';
		//input validation
		$firstname = myAddSlashes(trim($_POST['firstname']));
		$lastname = myAddSlashes(trim($_POST['lastname']));
		$username = myAddSlashes(trim($_POST['nickname']));
		$email = trim($_POST['email']);
		if (empty($username))
		{
			$error .= "Please+enter+a+username%21%0D%0A";
		}
		if (empty($error))
		{
			$sql = 	"INSERT INTO users ( `username`, `firstname`, `lastname`, `male`, `user_email`, `user_active`, `user_regdate`) VALUES (" .
					"'" . $username . "', " .
					"'" . $firstname . "', " .
					"'" . $lastname . "', " .
					"'" . $_POST['sex'] . "', " .
					"'" . $email . "', " .
					"'0', ".
					"'" . time() . "')";
		}
		else
		{
			header("location:../adminpages.php?Page=managemembers&action=add&error=" . urlencode($error));
			ob_end_flush();
		}
	
		if (isset($sql) && (!empty($sql)))
		{
			$result = mysql_query($sql)
				or die("Invalid query: " . mysql_error());
			
			$uid = mysql_insert_id();
			
			// Get board config
			$sitenamequery = 'SELECT * FROM config WHERE config_name = "sitename"';
			$sitenameresult = mysql_query($sitenamequery)
				or die(mysql_error());
			$sitenamerow = mysql_fetch_array($sitenameresult);
			$sitename = $sitenamerow['config_value'];
			
			$boardemailquery = 'SELECT * FROM config WHERE config_name = "board_email"';
			$boardemailresult = mysql_query($boardemailquery)
				or die(mysql_error());
			$boardemailrow = mysql_fetch_array($boardemailresult);
			$boardemail = $boardemailrow['config_value'];
						
			$mail = new phpmailer();

			$mail->From     = $boardemail;
			$mail->FromName = "SUHC AutoMailer";
			$mail->Host     = "localhost";
			$mail->Mailer   = "smtp";
			$mail->Subject  = "Welcome To ".$sitename." Online";
			
			// HTML body
			$hashuser = base64_encode(stripslashes($username));
			$hashuid = base64_encode($uid);
			
			$body  = '<h2>Welcome to the '.$sitename.' Website</h2>' .
					'<p>You have been successfully added to the online database with the username <br />' .
					'Username: '. stripslashes($username) .'</p>' .
					'<p>Please follow the link below to activate your account<br />' .
					'http://www.sheffieldhockey.com/activate.php?hash='. $hashuser .'&amp;stamp='. $hashuid.'</p>' .
					'<p>If you have forgotten your password, please go to http://www.sheffieldhockey.com/forum/profile.php?mode=sendpassword to set a new password.</p>' .
					'<p>Once you have activated your account, please change your password as soon as possible. Do this by going into your profile and setting a new password.</p>' .
					'<p>If you have any questions, please email the webmaster at '.$boardemail.'</p>' .
					'<p>I hope you enjoy using the new website</p>' .
					'<p>The Webmaster</p>';
		
			// Plain text body (for mail clients that cannot read HTML)
			$text_body  = 'Welcome to the '.$sitename.' Website ' .
					'You have been successfully added to the online database with user details ' .
					'Username: ' . stripslashes($username) . '  ' .
					'Please follow the link below to activate your account ' .
					'http://www.sheffieldhockey.com/activate.php?hash=' . $hashuser .'&stamp='. $hashuid .' ' .
					'If you have forgotten your password, please go to http://www.sheffieldhockey.com/forum/profile.php?mode=sendpassword to set a new password. '.
					'Once you have activated your account, please change your password as soon as possible. Do this by going into into your profile and setting a new password ' .
					'If you have any questions, please email the webmaster at '.$boardemail.' with Activation as the subject. ' .
					'I hope you enjoy using the new website ' .
					'The Webmaster';
			
			$mail->Body    = $body;
			$mail->AltBody = $text_body;
			$mail->AddAddress($email, $username);
			
			$mail->Send();
			$mail->ClearAddresses();
				
			// LOG SUBMISSION
			$logdata = 'New member signed up; new user_id: '.$uid;
			submitlog($logdata);
			header('location:../adminpages.php?Page=managemembers&action=add&succ=1');
		}
	break;
	
	default:
		$ids = split(",",$_POST['ids']);
		
		if ($_POST['submit'] == "Delete")
		{
			for ($i=0; $i<sizeof($ids); $i++)
			{
				if ($_POST['del_'.$ids[$i]] == 'on')
				{
					$query = "DELETE FROM users WHERE `user_id` = '". $ids[$i] ."' LIMIT 1";
					$res = mysql_query($query)
						or die(mysql_error());
					
					// LOG SUBMISSION
					$logdata = 'User deleted user with user_id '.$ids[$i];
					submitlog($logdata);
				}
			}
		}
		else // assume archive button pushed
		{
			for ($i=0; $i<sizeof($ids); $i++)
			{
				if ($_POST['arc_'.$ids[$i]] == 'on')
				{
					$query = "UPDATE users SET `archived` = 1 WHERE `user_id` = '". $ids[$i] ."'";
					$res = mysql_query($query)
						or die(mysql_error());
					
					// Find all pictures by that user and archive them too
					$q2 = "UPDATE pictures SET `archived` = 1 WHERE `user_id` = '". $ids[$i] ."'";
					$res2 = mysql_query($q2)
						or die(mysql_error());
						
					// LOG SUBMISSION
					$logdata = 'User archived user with user_id '.$ids[$i];
					submitlog($logdata);
				}
				else
				{
					$query = "UPDATE users SET `archived` = 0 WHERE `user_id` = '". $ids[$i] ."'";
					$res = mysql_query($query)
						or die(mysql_error());
				}
			}
		}
		header("location:../adminpages.php?Page=managemembers&next=".$_POST['next']);
	break;
}
?>