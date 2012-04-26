<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html dir="{S_CONTENT_DIRECTION}">
<head>
<meta http-equiv="Content-Type" content="text/html; charset={S_CONTENT_ENCODING}">
<meta http-equiv="Content-Style-Type" content="text/css">
{META}
{NAV_LINKS}
<title>{SITENAME} :: {PAGE_TITLE}</title>
<link rel="stylesheet" href="templates/hockey/basics.css" type="text/css" >
<link rel="stylesheet" href="templates/hockey/borders.css" type="text/css" >
<link rel="stylesheet" href="templates/hockey/{T_HEAD_STYLESHEET}" type="text/css" >
<script language="javascript" type="text/javascript" src="../js/jquery.js"></script>
<!-- BEGIN switch_enable_pm_popup -->
<script language="Javascript" type="text/javascript">
<!--
	if ( {PRIVATE_MESSAGE_NEW_FLAG} )
	{
		window.open('{U_PRIVATEMSGS_POPUP}', '_phpbbprivmsg', 'HEIGHT=225,resizable=yes,WIDTH=400');;
	}
//-->
</script>
<!-- END switch_enable_pm_popup -->
<script language="javascript" type="text/javascript">
$(document).ready(function() {
	$("#logintoggle").click(function() {
		$("#oldlogin").toggle();
	});
	return false;
});
</script>
</head>
<body id="forum">
<div id="header">

<a name="top"></a>
<div id="header">
	<div class="cb2"><div class="i12"><div class="i22"><div class="i32">
		<h1 class="clubName"><a href="/">{SITENAME}</a></h1>
		<h1 class="nostyle"><a class="logo" href="http://www.uni-sport.org">Uni-Sport.org</a></h1>
		<div id="mainNav">
        	<ul>
                <li class="home"><a href="/" class="main" onClick="this.blur()">Home</a></li>
                <li class="forum"><a href="/forum/index.php" class="forum" onClick="this.blur()">Forums</a></li>
                <li class="fantasy"><a href="/fhockey.php" class="fantasy" onClick="this.blur()">Fantasy Hockey</a></li>
    		</ul>
  		</div>
  		<div id="subNav">
  			<ul>
                <li><a href="{U_FAQ}" class="faq" onClick="this.blur()">{L_FAQ}</a></li>
                <li><a href="{U_SEARCH}" class="search" onClick="this.blur()">{L_SEARCH}</a></li>
                <li><a href="{U_MEMBERLIST}" class="list" onClick="this.blur()">{L_MEMBERLIST}</a></li>
                <li><a href="{U_GROUP_CP}" class="groups" onClick="this.blur()">{L_USERGROUPS}</a></li>
                <li><a href="{U_PRIVATEMSGS}" class="msg" onClick="this.blur()">{PRIVATE_MESSAGE_INFO}</a></li>
    		</ul>
  		</div>
        <div class="clear"></div>
    </div></div></div><div class="bb2"><div></div></div></div>
</div>
<div id="googleadvert">
<script type="text/javascript"><!--
google_ad_client = "pub-7889480162103082";
google_ad_width = 728;
google_ad_height = 90;
google_ad_format = "728x90_as";
google_ad_type = "text_image";
//2007-07-03: SheffieldHockey
google_ad_channel = "3396740022";
google_color_border = "000000";
google_color_bg = "FFFFFF";
google_color_link = "CC0000";
google_color_text = "000000";
google_color_url = "3D81EE";
google_ui_features = "rc:10";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
<div id="global">
	<div class="cb"><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
	<div id="topBar">
        <!-- BEGIN switch_user_logged_out -->
        <a href="http://www.facebook.com/login.php?api_key={FB_API}&v=1.0&hide_checkbox=1" style="float:left"><img src="http://static.ak.facebook.com/images/devsite/facebook_login.gif" /></a>
        <a href="#" style="float:left;outline:none;padding:0 5px;color:#383838;font-size:86%;" id="logintoggle">Show/Hide Old Login</a>
        <div id="oldlogin" style="display:none;">
        <form method="post" action="{S_LOGIN_ACTION}">
            <label for="username" style="padding-left:10px;">{L_USERNAME}:</label>
            <input class="post" type="text" name="username" size="10" />
            <label for="password">{L_PASSWORD}:</label>
            <input class="post" type="password" name="password" size="10" maxlength="32" />
            <input type="submit" class="mainoption" name="login" value="{L_LOGIN}" />
        </form>
        </div>
        <!-- END switch_user_logged_out -->
        <!-- BEGIN switch_user_logged_in -->
        <div id="subnav"><ul><li><a href="{U_LOGIN_LOGOUT}" class="login" onClick="this.blur()">{L_LOGIN_LOGOUT}</a></li></ul></div>
        <!-- END switch_user_logged_in -->
    </div>