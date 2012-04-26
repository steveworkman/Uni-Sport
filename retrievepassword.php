<?php
include "inc/unsecure_page.inc.php";
include "inc/header.inc.php";
include "inc/sidebar.inc.php";
require("classes/class.phpmailer.php");
?>
<div id="gallery">
<?php
$query = "SELECT username, Email, user_password FROM users WHERE Email = '" . $_POST['email'] . "'";
$result = mysql_query($query)
	or die(mysql_error());

if (mysql_num_rows($result) == 0)
{
	echo "<center>There are no user accounts with that email address. Please check the address is correct, go back and re-enter the address</center>";
}
else
{
	while ($row = mysql_fetch_array($result))
	{
	
		$mail = new phpmailer();
		
		$mail->From     = "webmaster@sheffieldhockey.com";
		$mail->FromName = "SUHC AutoMailer";
		$mail->Host     = "localhost";
		$mail->Mailer   = "smtp";
		$mail->Subject  = "Sheffield University Hockey Club user_password Retrieval";
		
		// HTML body
		
		$body  = "<h2>user_password Retrieval</h2>" .
				"<p>You have requested to be reminded of your username/user_password. So here they are:</p>" .
				"<p>Username: " . $row['username'] . "<br />" .
				"Passowrd: " . $row['user_password'] . "</p>" .
				"<p>Hockey love<br />Girder</p>";
	
		// Plain text body (for mail clients that cannot read HTML)
		$text_body  = "user_password Retrieval \n \n" .
				"You have requested to be reminded of your username/user_password. So here they are: \n" .
				"Username: " . $row['username'] . "\n" .
				"Passowrd: " . $row['user_password'] . "\n \n" .
				"Hockey love \n Girder";
		
		$mail->Body    = $body;
		$mail->AltBody = $text_body;
		$mail->AddAddress($row['Email'], $row['username']);
		
		if(!$mail->Send())
		{
			echo "<p>There has been a mail error sending to " . $row['Email'] . "<br />" .
				"Please try again later</p>";
		}
		else
		{
			echo "Message sent to " . $row['username'] . " with email address " . $row['Email'] . "<br />";
		}
	
		$mail->ClearAddresses();
	}
}
?>
</div>
	<?php
	include "inc/footer.inc.php";
?>