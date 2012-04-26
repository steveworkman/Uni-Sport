<?php
include('inc/connect.inc.php');
include('inc/indexfunctions.inc.php');
include_once('classes/class.phpmailer.php');
include_once('classes/class.UserProfile.php');
include_once('classes/class.Match.php');

$sitename = getSiteName();
$mail = new phpmailer();
$mail->From     = getBoardEmail();;
$mail->FromName = $sitename." AutoMailer";
$mail->Host     = "localhost";
$mail->Mailer   = "smtp";

// Start of the loop
// Find all matches happening within 24 hours
$q = 'SELECT match_id FROM matches '.
		'WHERE date >= NOW() AND date <= DATE_ADD(NOW() , INTERVAL 1 DAY)';
$res = mysql_query($q)
	or die(mysql_error());

while($row = mysql_fetch_array($res))
{	
	// Get the match
	$match = new Match($row['match_id']);
	$mail->Subject  = $sitename." Squad Status - ".$match->squadName." v ".$match->opposition;

	// Write the body
	$body = "Afternoon ".$match->captain['name'].",<br/><p>Here's your squad for the game against <strong>".$match->opposition."</strong> on <strong>".$match->date."</strong></p>";
	$body .= "<table border=\"0\" cellpadding=\"2\" cellspacing=\"2\"><tr><th>Name</th><th>Available</th></tr>";
	$squad = $match->getSquad();
	for($i=0; $i<sizeof($squad);$i++)
	{
		$body .= "<tr><td>".$squad[$i]['name']."</td>";
		switch($match->getAvailability($squad[$i]['id']))
		{
			case '-1':
				$body .= "<td><span style=\"color:#06c;\">Unknown</span></td>";
			break;
			
			case '0':
				$body .= "<td><span style=\"color:#D96868;\">No</span></td>";
			break;
			
			case '1':
				$body .= "<td><span style=\"color:#565;\">Yes</span></td>";
			break;
		}
		$body .= "</tr>";
	}

	$body .= "</table><p>Don't forget that your meet time is <strong>".$match->meettime."</strong> and the push back is at <strong>".$match->pushback."</strong></p>";
	$body .= "<p>Good Luck!<br/>The ".$sitename." team";

	$mail->Body    = $body; // Add the body to the object
	// Get the captain's e-mail
	$captain = new UserProfile($match->captain['id']);
	$mail->AddAddress($captain->email, $captain->username);

	//$mail->Send();
	$mail->ClearAddresses();
		
	// LOG SUBMISSION
	echo $logdata = 'Squad status for '.$match->squadName.' v '.$match->opposition.'('.$match->match_id.') sent to '.$captain->email;
	//submitlog(addslashes($logdata));
}
?>