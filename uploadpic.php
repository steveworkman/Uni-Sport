<?php
include("inc/connect.inc.php");
$ftmp = $_FILES['image']['tmp_name'];
$oname = $_FILES['image']['name'];
$fname = './img/ads/'.$_FILES['image']['name'];
if(move_uploaded_file($ftmp, $fname))
{
	//Remove the picture
	$q = "SELECT path FROM adverts WHERE ad_id = '".$_GET['id']."'";
	$res = mysql_query($q)
		or die(mysql_error());
	$srow = mysql_fetch_array($res);
	unlink($srow['path']);
	
	// Update database
	$q2 = "UPDATE adverts SET path = '".$fname."' WHERE ad_id = '".$_GET['id']."'";
	$res2 = mysql_query($q2)
		or die(mysql_error());
	
	?>
	<html><head><script language="javascript" type="text/javascript">
	var par = window.parent.document;
	// Refresh the image
	par.images['ad<?=$_GET['id']?>'].src = '<?=$fname?>';
	</script></head>
	</html>
	<?php
	exit();
}



?>
<html><head>
<script language="javascript">
function upload(){
	// hide old iframe
	var par = window.parent.document;
	var iframe = par.getElementById('iframe_<?=$_GET['id']?>');
	iframe.className = 'hidden';
	
	// add image progress
	var images = par.getElementById('pic_<?=$_GET['id']?>');
	par.images['ad<?=$_GET['id']?>'].src = './img/indicator.gif';
	
	// send
	var imgnum = images.getElementsByTagName('div').length - 1;
	document.iform.imgnum.value = imgnum;
	document.iform.submit();
}
</script>
<style>
#file {
	width: 350px;
}

body
{
	background-color:#eee;
}
</style>
</head><body><center>
<form name="iform" action="" method="post" enctype="multipart/form-data">
<input id="file" type="file" name="image" onChange="upload()" size="15" />
<input type="hidden" name="imgnum" />
</form>
</center></html>