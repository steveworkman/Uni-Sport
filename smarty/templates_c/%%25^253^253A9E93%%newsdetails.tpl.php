<?php /* Smarty version 2.6.18, created on 2009-09-02 21:08:55
         compiled from newsdetails.tpl */ ?>
<div id="main">
	<div id="content">
		<?php if ($this->_tpl_vars['story']['headline'] != ''): ?>
		<div class="center"><h1><?php echo $this->_tpl_vars['story']['headline']; ?>
</h1></div>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "newsStory.tpl", 'smarty_include_vars' => array('story' => $this->_tpl_vars['story'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php else: ?>
		<div class="center"><h1>No Story selected</h1></div>
		<p>
			Oops, there's no story for that ID! Tell the administrator
		</p>
		<?php endif; ?>
	</div>