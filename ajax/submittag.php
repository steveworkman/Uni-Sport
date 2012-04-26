<?php
include('../inc/commitfunctions.inc.php');
include('../inc/picfunctions.inc.php');
include('../inc/connect.inc.php');
include('../inc/unsecure_page.inc.php');
// This is the AJAX function for submitting picture tags.
$pid = $_POST['pic_id'];
$uid = $_POST['user_id'];
$uname = $_POST['username'];
$out = '';

// First, check there's not already a duplicate
$q = 'SELECT user_id FROM user_picture '.
		'WHERE picture_id='.$pid.' AND user_id='.$uid;
$res = mysql_query($q)
	or die(mysql_error());
if(mysql_num_rows($res) == 0)
{
	// then not a duplicate
	$q2 = 'INSERT INTO user_picture (user_id, picture_id) '.
			'VALUES ('.$uid.','.$pid.')';
	$res = mysql_query($q2)
		or die(mysql_error());
	
	// Set the output
	$tags[] = array('id'=>$uid,'name'=>$uname);
	// Use this function to maintain order!
	$out = formatTags($tags,0);
	submitlog($uname.'('.$uid.') was tagged in pic '.$pid.' by User');
}

echo $out;
?>