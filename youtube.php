<?php
$yt_link = $_GET['link'];
?>
<object width="425" height="355">
	<param name="movie" value="http://www.youtube.com/v/<?php echo $yt_link;?>&rel=0&color1=0xd6d6d6&color2=0xf0f0f0&border=0"></param>
	<param name="wmode" value="transparent"></param>
	<embed src="http://www.youtube.com/v/<?php echo $yt_link;?>&rel=0&color1=0xd6d6d6&color2=0xf0f0f0&border=0" type="application/x-shockwave-flash" wmode="transparent" width="425" height="355"></embed>
</object>