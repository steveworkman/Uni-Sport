<div id="leftPanel">
	<span style="font-size:small;">
<?php
	checkmatches($_SESSION['shef_hockey_user_id']);
	checklogs();
?>
</span>
<div id="headlines">
<?php
	$pagenamearray =  explode('/', $_SERVER['SCRIPT_NAME']);
	for ($i=0; $i<sizeof($pagenamearray); $i++)
	{
		$strlen = strlen($pagenamearray[$i]);
		if (substr($pagenamearray[$i],($strlen-4),$strlen) == '.php')
		{
			$pagename = substr($pagenamearray[$i],0,($strlen-4));
		}
	}
	?>
  	<a href="./shits.doc">Registration Form </a>
  	<a href="http://www.sheffieldhockey.com">sheffieldhockey.com </a>
  <div class="story" id="advert"> 
  <center>
 Our Sponsors
  <?php
  $aq = "SELECT * FROM adverts ORDER BY sequence";
  $ares = mysql_query($aq)
  	or die(mysql_error());
	while($arow = mysql_fetch_array($ares))
	{
		echo '<a href="'.$arow['link'].'"> <img src="'.$arow['path'].'" border="0" width="135" /></a>';
	}
	?>
	<script type="text/javascript"><!--
google_ad_client = "pub-7889480162103082";
google_ad_width = 125;
google_ad_height = 125;
google_ad_format = "125x125_as_rimg";
google_cpa_choice = "CAAQzdmTlwIaCJ1t49XVavhiKJe193M";
google_ad_channel = "";
//--></script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
	  </center>
  </div> 
</div>
</div>