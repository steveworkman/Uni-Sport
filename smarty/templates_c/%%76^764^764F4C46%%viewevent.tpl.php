<?php /* Smarty version 2.6.18, created on 2007-12-07 09:03:19
         compiled from viewevent.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'viewevent.tpl', 6, false),)), $this); ?>
<div id="main">
	<div id="content">
		<?php if ($this->_tpl_vars['event']['name'] != ''): ?>
		<div class="center"><h1><?php echo $this->_tpl_vars['event']['name']; ?>
</h1></div>
		<br/>
        <em>This event is happening on <?php echo ((is_array($_tmp=$this->_tpl_vars['event']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</em>
		<p>
			<?php echo $this->_tpl_vars['event']['desc']; ?>

		</p>
        <p>
        	<em>Created By <a href="<?php echo $this->_tpl_vars['event']['author_link']; ?>
"><?php echo $this->_tpl_vars['event']['author']; ?>
</a></em>
        </p>
		<?php else: ?>
			<div align="center"><h1>No Event Found</h1></div>
			<p>
				Oops, we've not found an event for that ID! Tell the administrator what happened.
			</p>
		<?php endif; ?>
	</div>