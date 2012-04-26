<?php
session_start();

if ((isset($_SESSION['shef_hockey_user_logged'])) && ($_SESSION['shef_hockey_user_logged'] != "")
	|| (isset($_SESSION['user_user_password'])) && ($_SESSION['user_user_password'] != ""))
	{ 
		// Do Nothing
	}
	else
	{
		$guest = 1;
	}
?>