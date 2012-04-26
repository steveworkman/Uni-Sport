<?php
	ob_start();
	include('../inc/commitfunctions.inc.php');
	include('../inc/connect.inc.php');
	include('../inc/secure_page.inc.php');

	$error = '';
	//input validation
	$nick = myAddSlashes(trim($_POST['username']));
	$firstname = myAddSlashes(trim($_POST['fname']));
	$lastname = myAddSlashes(trim($_POST['lname']));
	$email = myAddSlashes(trim($_POST['email']));
	$pass = myAddSlashes(trim($_POST['pass']));
	$repass = myAddSlashes(trim($_POST['repeatpass']));
	$quote = myAddSlashes(nl2br(trim($_POST['quote'])));
	$degree = myAddSlashes(trim($_POST['degree']));
	$value = trim($_POST['value']);
	$points = trim($_POST['points']);
	$msn = myAddSlashes(trim($_POST['msn']));
	$website = myAddSlashes(trim($_POST['website']));
	$aol = myAddSlashes(trim($_POST['aol']));
	$yim = myAddSlashes(trim($_POST['yim']));
	$icq = myAddSlashes(trim($_POST['icq']));
	$occ = myAddSlashes(trim($_POST['occupation']));
	$location = myAddSlashes(trim($_POST['location']));
	$interests = myAddSlashes(trim($_POST['interests']));
	$phone = trim($_POST['phone']);
	$sig = trim($_POST['sig']);
	
	if ($_POST['archived'] == 'on')
		$archived = 1;
	else
		$archived = 0;
	
	if ($_POST['gay'] == 'on')
		$gay = 1;
	else
		$gay = 0;
	
	if ($_POST['cookie'] == 'on')
		$cookie = 1;
	else
		$cookie = 0;
	
	if ($_POST['hidden'] == 'on')
		$hideemail = 0;
	else
		$hideemail = 1;
	
	$daynum = $_POST['dobDay'];
	$month = $_POST['dobMonth'];
	$year = $_POST['dobYear'];
	if (($month == 0 || $year == 0 || $daynum == 0) || ($month < 0 || $year < 1970 || $daynum < 0))
		$when = "0000-00-00";
	else
		$when = date ("Y-m-d",mktime(00,00,00,$month, $daynum, $year));
	if (!empty($pass))
	{
		if (empty($repass))
		{
			$error .= "Please+enter+your+user_password+in+both+boxes%21%0D%0A";
		}
		if ($pass != $repass)
		{
			$error .= "Your+user_passwords+do+not+match.+Please+re-enter+them%21%0D%0A";
		}
	}
	if (empty($error))
	{
		if(isset($_POST['fbid']))
		{
			$sql = 	"UPDATE users SET " .
					"degree = '" . $degree . "', " .
					"user_email = '" . $email . "', " .
					"stayloggedin = '" . $cookie . "', ".
					"value = '" . $value . "', ".
					"points = '" . $points . "', ".
					"phone = '" . $phone . "', ".
					"user_msnm = '" . $msn . "', ".
					"user_website = '" . $website . "', ".
					"user_aim = '" . $aol . "', ".
					"user_yim = '" . $yim . "', ".
					"user_icq = '" . $icq . "', ".
					"user_from = '" . $location . "', ".
					"user_occ = '" . $occ. "', ".
					"user_viewemail = '" . $hideemail . "', ".
					"user_sig = '" . $sig . "', ".
					"archived = '" . $archived . "', ".
					"position = '" . $_POST['pos'] . "', ".
					$sql .= "side = '" . $_POST['side'] . "' ".
					"WHERE user_id = '" . USR_ID. "'";
		}
		else if (SEC_LVL != 1)
		{
			$sql = 	"UPDATE users SET " .
					"firstname = '" . $firstname . "', " .
					"lastname = '" . $lastname . "', " .
					"dob = '" . $when . "', " .
					"quote = '" . $quote . "', " .
					"degree = '" . $degree . "', " .
					"male = '" . $_POST['sex'] . "', " .
					"user_email = '" . $email . "', " .
					"stayloggedin = '" . $cookie . "', ".
					"value = '" . $value . "', ".
					"points = '" . $points . "', ".
					"phone = '" . $phone . "', ".
					"user_msnm = '" . $msn . "', ".
					"user_website = '" . $website . "', ".
					"user_aim = '" . $aol . "', ".
					"user_yim = '" . $yim . "', ".
					"user_icq = '" . $icq . "', ".
					"user_from = '" . $location . "', ".
					"user_occ = '" . $occ. "', ".
					"user_interests = '" . $interests . "', ".
					"user_viewemail = '" . $hideemail . "', ".
					"user_sig = '" . $sig . "', ".
					"archived = '" . $archived . "', ".
					"position = '" . $_POST['pos'] . "', ";
					if (!empty($repass))
						$sql .= "user_password = '" . md5($repass) . "', ";
					$sql .= "side = '" . $_POST['side'] . "' ".
					"WHERE user_id = '" . USR_ID. "'";
		}
		else
		{
			$sql = 	"UPDATE users SET " .
					"username = '" . $nick . "', " .
					"firstname = '" . $firstname . "', " .
					"lastname = '" . $lastname . "', " .
					"dob = '" . $when . "', " .
					"quote = '" . $quote . "', " .
					"degree = '" . $degree . "', " .
					"male = '" . $_POST['sex'] . "', " .
					"user_email = '" . $email . "', " .
					"stayloggedin = '" . $cookie . "', ".
					"value = '" . $value . "', ".
					"points = '" . $points . "', ".
					"gay = '" . $gay . "', ".
					"phone = '" . $phone . "', ".
					"user_msnm = '" . $msn . "', ".
					"user_website = '" . $website . "', ".
					"user_aim = '" . $aol . "', ".
					"user_yim = '" . $yim . "', ".
					"user_icq = '" . $icq . "', ".
					"user_from = '" . $location . "', ".
					"user_occ = '" . $occ. "', ".
					"user_interests = '" . $interests . "', ".
					"user_viewemail = '" . $hideemail . "', ".
					"user_sig = '" . $sig . "', ".
					"position = '" . $_POST['pos'] . "', ";
					if (!empty($repass))
						$sql .= "user_password = '" . md5($repass) . "', ";
					$sql .= "side = '" . $_POST['side'] . "' ".
					"WHERE user_id = '" . $_POST['id'] . "'";
		}
	}
	else
	{
		header("location:../memberpages.php?Page=userdetails&Action=edit&error=" . urlencode($error));
		ob_end_flush();
	}
	if (isset($sql) && (!empty($sql)))
	{
		$result = mysql_query($sql)
			or die("Invalid query: " . mysql_error());
	}
	// LOG SUBMISSION
	$logdata = 	'User edited User with user_id '.$_POST['id'];
	submitlog($logdata);
	header('location:../viewprofile.php?action=view&uid='.$_POST['id']);
?>