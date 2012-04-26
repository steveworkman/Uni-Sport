<?php /* Smarty version 2.6.18, created on 2009-09-02 20:33:24
         compiled from header.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['metakeywords']; ?>
" />
<meta name="description" content="<?php echo $this->_tpl_vars['metadescription']; ?>
" />
<meta name="author" content="Steel Software &copy; 2005-2007" />
<title><?php echo $this->_tpl_vars['title']; ?>
 - <?php echo $this->_tpl_vars['clubname']; ?>
</title>
<link rel="alternate" type="application/rdf+xml" title="SUHC RSS - Latest News" href="http://www.sheffieldhockey.com/rss/news.php" />
<link rel="stylesheet" href="css/unisport.css" type="text/css" />
<link rel="stylesheet" href="css/basics.css" type="text/css" />
<link rel="stylesheet" href="css/borders.css" type="text/css" />
<link rel="stylesheet" href="css/thickbox.css" type="text/css" />
<link rel="stylesheet" href="css/jquery.autocomplete.css" type="text/css"/>
<!--[if lte IE 7]>  
<style type="text/css" media="all">  
@import "css/fieldset-styling-ie.css";  
</style> 
<![endif]-->
<?php $_from = $this->_tpl_vars['add_css']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['css']):
?>
	<link rel="stylesheet" href="<?php echo $this->_tpl_vars['css']; ?>
" type="text/css" />
<?php endforeach; endif; unset($_from); ?>
<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/interface.js" type="text/javascript"></script>
<script src="js/sidebarSliding.js" type="text/javascript"></script>
<script src="js/jquery.overlabel.js" type="text/javascript"></script>
<script src="js/thickbox-compressed.js" type="text/javascript"></script>
<script src="js/jquery.autocomplete.js" type="text/javascript"></script>
<script src="js/jquery.dimensions.pack.js" type="text/javascript"></script>
<script src="js/jquery.bgiframe.min.js" type="text/javascript"></script>
<script src="js/search.js" type="text/javascript"></script>
<?php $_from = $this->_tpl_vars['add_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['js']):
?>
<script src="<?php echo $this->_tpl_vars['js']; ?>
" type="text/javascript"></script>
<?php endforeach; endif; unset($_from); ?>
<script type="text/javascript">
<?php echo '
$(document).ready(function() {
    $("label.overlabel").overlabel();
});
'; ?>

</script>
</head>
<body id="<?php echo $this->_tpl_vars['curr_page']; ?>
">
<div id="header">
	<div class="cb2"><div class="i12"><div class="i22"><div class="i32">
		<h1 class="clubName"><a href="/"><?php echo $this->_tpl_vars['clubname']; ?>
</a></h1>
		<h1 class="nostyle"><a class="logo" href="http://www.uni-sport.org">Uni-Sport.org</a></h1>
		<div id="mainNav">
        	<ul>
                <li class="home"><a href="/" class="main" onclick="this.blur();">Home</a></li>
                <li class="forum"><a href="forum/index.php" class="forum" onclick="this.blur();">Forums</a></li>
                <li class="fantasy"><a href="fhockey.php" class="fantasy" onclick="this.blur();">Fantasy Hockey</a></li>
    		</ul>
  		</div>
  		<div id="subNav">
        	
  			<ul><?php if ($this->_tpl_vars['curr_page'] == 'fantasy'): ?>
            	<li><a href="fhockey.php" class="news" onclick="this.blur();">News</a></li>
                <li><a href="fhockey.php?Page=table" class="info" onclick="this.blur();">League Table</a></li>
            	<?php else: ?>
                <li><a href="/" class="news" onclick="this.blur();">News</a></li>
                <li><a href="gallery.php?Page=gallery" class="pic" onclick="this.blur();">Pictures</a></li>
                <li><a href="matches.php" class="matches" onclick="this.blur();">Matches</a></li>
                <li><a href="calendar.php" class="calendar" onclick="this.blur();">Calendar</a></li>
                <li><a href="information.php" class="info" onclick="this.blur();">Info</a></li>
                <?php if ($this->_tpl_vars['USR_LOGGED'] == ''): ?>
                <li><a href="register.php" class="register" onclick="this.blur();">Register</a></li>
                <?php endif; ?>
                <?php endif; ?>
    		</ul>
			<ul class="right">
				<li><a href="help.php" class="info" onclick="this.blur();">Help</a></li>
			</ul>
  		</div>
        <div class="clear"></div>
    </div></div></div><div class="bb2"><div></div></div></div>
</div>
<div id="googleadvert">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'googleadvert.htm', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div id="global">
	<div class="cb"><div class="bt"><div></div></div><div class="i1"><div class="i2"><div class="i3">
	<div id="topBar">
    	<form method="get" action="search.php">
        	<div class="left">
            	<div class="label">
                    <label for="search" class="overlabel">Search...</label>
                    <input id="search" name="search" type="text" />
                    <input type="image" id="top-submit" src="img/search_book.gif" alt="Submit" />
                </div>
        	</div>
        </form>
    </div>
    <div class="clear"></div>