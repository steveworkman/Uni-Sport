<?php /* Smarty version 2.6.18, created on 2007-12-26 21:07:01
         compiled from help.tpl */ ?>
<div id="main">
	<div id="content">
		<div class="center"><h1>Help!</h1></div>
        <p>
			Want to know more about the site? Do you need to know how to add a match report, add some news or post in the forums?<br/>
			This page will show you how to do all this and more. Have a look at the tutorial videos, and if you have any questions, ask the webmaster.
		</p>
		<?php $_from = $this->_tpl_vars['help']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['hel']):
?>
		<h3><?php echo $this->_tpl_vars['hel']['name']; ?>
</h3>
		<p>
			<?php echo $this->_tpl_vars['hel']['text']; ?>

		</p>
		<p class="center">
			<a href="youtube.php?link=<?php echo $this->_tpl_vars['hel']['youtube_link']; ?>
&amp;height=365&amp;width=425" class="thickbox" title="<?php echo $this->_tpl_vars['hel']['name']; ?>
 video"><img src="http://img.youtube.com/vi/<?php echo $this->_tpl_vars['hel']['youtube_link']; ?>
/3.jpg" alt="<?php echo $this->_tpl_vars['hel']['name']; ?>
" title="<?php echo $this->_tpl_vars['hel']['name']; ?>
 video" /></a>
		</p>
		<?php endforeach; endif; unset($_from); ?>
    </div>