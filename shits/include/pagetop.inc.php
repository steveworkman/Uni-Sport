<?php
ob_start();
//error_reporting(E_ALL);
// page time code
$m_time = explode(" ",microtime());
$m_time = $m_time[0] + $m_time[1];
$starttime = $m_time;

include "connect.inc.php";

//Check for cookies
include "cookies.inc.php";
//print_r($_SESSION);
// Get Site name variables etc
$sitequery = "SELECT * FROM settings";
$siteres = mysql_query($sitequery)
	or die(mysql_error());
$sitedetails = mysql_fetch_array($siteres);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="<?php echo stripslashes($sitedetails['metakeywords']); ?>" />
<meta name="description" content="<?php echo stripslashes($sitedetails['metadescription']); ?>" />
<meta name="author" content="Steven Workman" />
<title><?php echo stripslashes($sitedetails['sitetitle']); ?></title>
<link rel="alternate" type="application/rdf+xml" title="SUHC RSS - Latest News" href="http://www.sheffieldhockey.com/rss/news.php" />
<link rel="stylesheet" href="css/3col_rightNav.css" type="text/css" />
</head>


<body>
<div id="pagetop">
<img src="img/tl_curve_white.gif" id="gnl" alt="" /><img src="img/tr_curve_white.gif" id="gnr" alt="" />
  <div id="pageName">
    <a href="http://www.sheffield.ac.uk"><img src="./img/shef_logo.png" border="0" /></a>
  </div>
  <div id="googleads"><center><script type="text/javascript"><!--
google_ad_client = "pub-7889480162103082";
google_ad_width = 468;
google_ad_height = 60;
google_ad_format = "468x60_as";
google_ad_type = "text";
google_ad_channel ="";
google_color_border = "CCCCCC";
google_color_bg = "FFFFFF";
google_color_link = "000000";
google_color_url = "666666";
google_color_text = "333333";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
  </center>
  </div>
  <div id="logoImage">
  <h1><?php echo stripslashes($sitedetails['clubname']); ?> </h1>
  </div>
</div>
<div id="tabs">
<table border="0" cellpadding="2">
<tr style="font-weight:bold ">
<td><img src="img/crest.gif" alt="Main" /> <a href="index.php">Home</a></td> <td><img src="img/comments.gif" alt="Forum" /><a href="http://www.sheffieldhockey.com/forum/index.php">Forums</a></td>
</tr>
</table>
</div>
</div>
  <div id="pagecell">

<?php
// Maintainence mode query
	$q = "SELECT * FROM config WHERE config_name = 'board_disable'";
	$re = mysql_query($q)
		or die(mysql_error());
	$r = mysql_fetch_array($re);
	if ($r['config_value'] == 1 && $_SESSION['shef_hockey_user_securitylevel'] != 1)
		include 'disabled.php';
?>