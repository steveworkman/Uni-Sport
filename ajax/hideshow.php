<?php
include('../inc/connect.inc.php');
include('../inc/secure_page.inc.php');
// This is the AJAX function for searching people.

$id = $_POST['id'];
$hide = $_POST['hide'];
$field = '';
if (!$id) return;
switch($id)
{
	case 'committee':
		$field = 'hide_comm';
	break;
	case 'captain':
		$field = 'hide_tc';
	break;
	case 'admin':
		$field = 'hide_admin';
	break;
	case 'matches':
		$field = 'hide_matches';
	break;
	case 'newsletters':
		$field = 'hide_nl';
	break;
	case 'topscorer':
		$field = 'hide_ts';
	break;
	case 'profile':
		$field = 'hide_profile';
	break;
	case 'points':
		$field = 'hide_points';
	break;
	// Incorrect ID - return
	default:
		return;
}
$query = 'UPDATE users SET '.$field.'='.$hide.' WHERE user_id = '.USR_ID;
$res = mysql_query($query)
	or die(mysql_error());
?>