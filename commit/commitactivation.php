<?php
include('../inc/commitfunctions.inc.php');
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
require('../classes/class.phpmailer.php');
$pids = split(",",$_POST['Activates']);

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

for ($i=0; $i<sizeof($pids); $i++)
{
	// Approve the account
	if ($_POST['a'.$pids[$i]] == 'on')
	{
		// Set as active
		$query = "UPDATE `users` SET `user_active`='1' WHERE `user_id` = '". $pids[$i] ."'";
		$res = mysql_query($query)
			or die(mysql_error());
		
		$q2 = 'SELECT username, user_password, user_id, user_email FROM users WHERE user_id = '.$pids[$i];
		$res2 = mysql_query($q2)
			or die(mysql_error());
		$row = mysql_fetch_array($res2);
		
		$mail = new phpmailer();
		
		$mail->From     = $boardemail;
		$mail->FromName = $sitename." AutoMailer";
		$mail->Host     = "localhost";
		$mail->Mailer   = "smtp";
		$mail->Subject  = 'Welcome To '.$sitename.' Online';
		
		// HTML body
		
		$body  = '<h2>Welcome to the '.$sitename.' Website</h2>' .
					'<p>You have been successfully added to the online database with the username <br />' .
					'Username: '. $row['username'] .'</p>' .
					'<p>You can now log into the website using your Facebook account. Click the Facebook button to log in</p>'.
					'<p>If you have any questions, please email the webmaster at '.$boardemail.'</p>' .
					'<p>I hope you enjoy using the website</p>' .
					'<p>The Webmaster</p>';
		
			// Plain text body (for mail clients that cannot read HTML)
			$text_body  = 'Welcome to the '.$sitename.' Website ' .
					'You have been successfully added to the online database with user details ' .
					'Username: ' . $row['username'] . '  ' .
					'You can now log into the website using your Facebook account. Click the Facebook button to log in. '.
					'If you have any questions, please email the webmaster at '.$boardemail.' with Activation as the subject. ' .
					'I hope you enjoy using the new website ' .
					'The Webmaster';
		
		$mail->Body    = $body;
		$mail->AltBody = $text_body;
		$mail->AddAddress($row['user_email'], $row['username']);
		
		$mail->Send();
		$mail->ClearAddresses();
		
		// LOG SUBMISSION
		$logdata = 'User approved account id: '.$pids[$i].' and sent activation email to '.$row['user_email'];
		submitlog($logdata);
	}
	// Deny the account - deletes the person
	if ($_POST['d'.$pids[$i]] == 'on')
	{	
		// Send them an email
		$q3 = "SELECT username, user_password, user_id, user_email FROM users WHERE user_id = '". $pids[$i] ."'";
		$res3 = mysql_query($q3)
			or die(mysql_error());
		$row2 = mysql_fetch_array($res3);
		
		$mail2 = new phpmailer();
		
		$mail2->From     = $boardemail;
		$mail2->FromName = $sitename." AutoMailer";
		$mail2->Host     = "localhost";
		$mail2->Mailer   = "smtp";
		$mail2->Subject  = 'Your Registration request has been denied';
		
		$body  = '<p>Dear '.$row2['username'].'</p>'.
					'<p>Your registration request has been denied. This could be for any number of reasons (duplicate account, unknown address etc). You may contact the website administrator at '.$boardemail.' if you wish to query their decision</p>'.
					'<p>Regards<br />'.
					'The Administrator</p>';
		
		// Plain text body (for mail clients that cannot read HTML)
		$text_body  = 'Dear '.$row2['username'].' \n \n'.
					'Your registration request has been denied. This could be for any number of reasons (duplicate account, unknown address etc). You may contact the website administrator at '.$boardemail.' if you wish to query their decision \n \n'.
					'Regards \n'.
					'The Administrator';
		
		$mail2->Body    = $body;
		$mail2->AltBody = $text_body;
		$mail2->AddAddress($row['user_email'], $row['username']);
		
		$mail2->Send();
		$mail2->ClearAddresses();
		
		$query = "DELETE FROM `users` WHERE `user_id` = '". $pids[$i] ."' LIMIT 1";
		$res = mysql_query($query)
			or die(mysql_error());
		
		// LOG SUBMISSION
		$logdata = 'User denied user with user_id '.$pids[$i].'. This account has now been deleted';
		submitlog($logdata);
	}
}
header("location:../adminpages.php?Page=activationmenu");
?>