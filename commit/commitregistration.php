<?php
ob_start();
include('../inc/commitfunctions.inc.php');
include('../inc/connect.inc.php');
include('../inc/unsecure_page.inc.php');

$error = '';
//input validation
$username = myAddSlashes(trim($_POST['username']));
$fbid = trim($_POST['fbid']);
$email = trim($_POST['email']);
if (empty($username))
{
	$error .= "Please+enter+your+username%21%0D%0A";
}
if ($_POST['agree'] != '1')
{
	$error .= "You+must+agree+to+the+terms+of+service%21%0D%0A";
}
if(empty($fbid))
{
	$error .= "You+must+enter+a+Facebook+ID%21%0D%0A";
}
if (empty($error))
{
	$sql = 	"INSERT INTO users ( `username`, `fb_id`, `user_email`, `archived`, user_regdate) VALUES (" .
			"'" . $username . "', " .
			"'" . $fbid . "', " .
			"'" . $email . "', " .
			"'" . $_POST['usrgrp'] ."', ".
			"'" . time() . "')";
}
else
{
	header("location:../register.php?error=" . urlencode($error));
	ob_end_flush();
}

if (isset($sql) && (!empty($sql)))
{
	$result = mysql_query($sql)
		or die("Invalid query: " . mysql_error());
		
	// LOG SUBMISSION
	$logdata = 	"New member signed up; new user_id: ". mysql_insert_id().' Facebook ID: '.$fbid;
	submitlog($logdata);
	header("location:../register.php?succ=1");
}
?>