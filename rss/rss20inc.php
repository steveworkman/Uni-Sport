<?php
/*****************************************************

RSS20.php - RSS generator by Ovi Crisan @ www.2RSS.com

All rights reserved - V1.0 -   Also, available for ASP
This script is distributed as freeware. You can change
it upon your needs but have to keep its copyright info

More scripts [PHP & ASP] and RSS directory on our site

******************************************************/


function add_channel($channel_title, $channel_link, $channel_desc, $sql_cmd, $rss_id ) {
 global $channels;
 $channels[]=array( $channel_title, $channel_link, $channel_desc, $sql_cmd, $rss_id);
}

function rss() {
global $channels,$encoding;
global $rss_server,$rss_db,$rss_user,$rss_pass;
global $item_link,$channel_copyright,$channel_editor,$channel_webmaster;
global $image_title,$image_url,$image_link,$image_width,$image_height;

print "<?xml version=\"1.0\" encoding=\"{$encoding}\"?>\n<rss version=\"2.0\">\n <channel>";
if(count($channels)>0) {
 $id=0;
 if(isset($_GET['rss']))
    for($i=0;$i<count($channels);$i++)
      if($_GET['rss']==$channels[$i][4])
	{$id=$i; break;}

 print "  <title>{$channels[$id][0]}</title> 
  <link>{$channels[$id][1]}</link> 
  <description>{$channels[$id][2]}</description>
  <pubDate>".date("r")."</pubDate> ";
 print "\n  <generator>rss20.php by www.2RSS.com</generator>";
 if($channel_copyright!="")
	print "\n  <copyright>{$channel_copyright}</copyright> ";
 if($channel_editor!="")
	print "\n  <managingEditor>{$channel_editor}</managingEditor> ";
 if($channel_webmaster!="")
	print "\n  <webMaster>{$channel_webmaster}</webMaster> ";
 if($image_url!="")
	print "\n <image>
  <title>{$image_title}</title> 
  <url>{$image_url}</url> 
  <link>{$image_link}</link> 
  </image>";
 $link = mysql_connect($rss_server,$rss_user,$rss_pass) or die("Could not connect");
 mysql_select_db($rss_db) or die("Could not select database");
 $result=mysql_query($channels[$id][3]) or die("Query failed");

 while($line = mysql_fetch_array($result)) {
  print "\n <item>
  <title>".htmlspecialchars($line[0])."</title> 
  <link>{$item_link}{$line[1]}</link> 
  <description>".htmlspecialchars($line[2])."</description> ";
  if($line[3]!="")
	print "\n  <pubDate>".date("r",strtotime($line[3]))."</pubDate>";
  $p=strpos($line[4],"@");
  if($p>0)
	print "\n  <author>".$line[4]."</author>";
  print "\n <guid>{$item_link}{$line[1]}</guid>"; 
	//print "\n  <author>".substr_replace($line[4],"not.available.site",$p+1,strlen($line[4])-$p-1)."</author>";
  print "\n  </item>";
 }

 mysql_free_result($result);
 mysql_close($link);

}
print "\n  </channel>\n  </rss>";
} //end rss()

?>