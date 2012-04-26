<?php
include('../inc/connect.inc.php');
include('../inc/unsecure_page.inc.php');
// This is the AJAX function for getting pictures.
// This kinda repeats the query in indexfunctions getPictures
// but this function is a little bloated for AJAX purposes
$aid = $_POST['album_id'];
$uid = $_POST['user_id'];
if(!empty($aid) && $aid != 'null')
	$q = 'SELECT picture_id, path, thumb, comment FROM pictures WHERE album_id='.$aid;
else
{
	$q = 'SELECT p.picture_id, p.path, p.thumb, p.comment '.
			'FROM pictures AS p, user_picture AS up '.
			'WHERE p.picture_id = up.picture_id '.
			'AND up.user_id='.$uid;
}
$res = mysql_query($q)
	or die(mysql_error());
$out = '';
while($pic = mysql_fetch_array($res))
{
	// Do dimension calcs
	list ($width, $height, $type, $attr) = getimagesize('.'.$pic['path']);
	if($width < 300)
		$imgwidth = $width;
	else
	{
		$imgwidth = '80%';
	}
	if($height < 300)
		$imgheight = $height;
	else
	{
		$imgheight = ''; // So that the img is only controlled by width
	}
	$out .= $pic['picture_id'].'|'.$pic['thumb'].'|'.ereg_replace("'", "\'", htmlspecialchars($pic['comment'])).'|'.$imgwidth.'|'.$imgheight.'|';
}
$out = substr($out,0,(strlen($out)-1));
echo $out;
?>