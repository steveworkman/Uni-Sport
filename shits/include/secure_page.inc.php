<?php
session_start();

if ((isset($_SESSION['shef_hockey_user_logged'])) && ($_SESSION['shef_hockey_user_logged'] != "")
	|| (isset($_SESSION['user_user_password'])) && ($_SESSION['user_user_password'] != ""))
	{ 
		// Do Nothing
	}
	else
	{
		$redirect = $_SERVER['PHP_SELF'];
		header("Refresh: 5; URL=index.php?redirect=$redirect");
		echo "This page is for members only and you are currently not logged in, we are redirecting you, please wait<br />";
		echo "(If your browser does not support this, " .
			"<a href=\"index.php?redirect=$redirect\">click here</a>)";
		die();
	}
?>