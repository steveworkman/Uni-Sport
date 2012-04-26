<?php
/*****************************************************

RSS20.php - RSS generator by Ovi Crisan @ www.2RSS.com

All rights reserved - V1.0 -   Also, available for ASP
This script is distributed as freeware. You can change
it upon your needs but have to keep its copyright info

More scripts [PHP & ASP] and RSS directory on our site

******************************************************/

$rss_server="mysql.shef.uni-sport.org";	// MySQL server
$rss_db="shef_hockey";			// MySQL database
$rss_user="shef_hockey";			// MySQL user
$rss_pass="misterjuicey";			// MySQL password

// prefix for links, concatenated with their id
$item_link="http://www.sheffieldhockey.com/newsdetails.php?article_id=";

$channel_copyright="Sheffield University Hockey Club";
$channel_editor="webmaster@sheffieldhockey.com";	 	//Format: email_address OR email_address (name)
$channel_webmaster="webmaster@sheffieldhockey.com";	//Format: email_address OR email_address (name)

$image_title="";	// channel image or site logo
$image_url="";		// image URL [jpg, gif]
$image_link="";
$image_width=88;
$image_height=31;

$encoding="iso-8859-1";

include_once("rss20inc.php");


/**************************************************
Purpose: add all channels available with RSS script

Format for add_channel():

add_channel( Channel_Title, Channel_Link, Channel_Description, SQL_Command, RSS_ID )

Parameters:
 - Channel_Title  
 - Channel_Link - URL of the site
 - Channel_Description
 - SQL_Command - SQL command used to get info
		 SQL SELECT fields: Title,Link,Description,Date,Author
 - RSS_ID - unique ID of the RSS feed - leave empty for a single feed

***************************************************/


add_channel(
	"SUHC Latest News",
	"http://www.sheffieldhockey.com/",
	"Latest News from SUHC",
	"SELECT heading, article_id, text, submittedon FROM newsarticles ORDER BY submittedon DESC LIMIT 0,6",
	"");


header ("Content-type: text/xml");
rss(); // create RSS content

?>