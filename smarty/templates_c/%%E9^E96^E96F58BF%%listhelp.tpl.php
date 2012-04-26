<?php /* Smarty version 2.6.18, created on 2007-12-27 14:45:17
         compiled from listhelp.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'listhelp.tpl', 6, false),array('function', 'paginate_middle', 'listhelp.tpl', 20, false),array('modifier', 'truncate', 'listhelp.tpl', 8, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div class="center"><h1>Help Menu</h1></div>
		<table width="100%" border="0" cellpadding="2" cellspacing="2">
			<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['help']):
?>
			<tr class="<?php echo smarty_function_cycle(array('values' => "bg1,bg2"), $this);?>
">
				<td><strong><?php echo $this->_tpl_vars['help']['name']; ?>
</strong><br/>
				<em><?php echo ((is_array($_tmp=$this->_tpl_vars['help']['text'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30) : smarty_modifier_truncate($_tmp, 30)); ?>
</em>
				</td>
				<td><a href="adminpages.php?Page=help&amp;action=edit&amp;id=<?php echo $this->_tpl_vars['help']['id']; ?>
"><img src="./img/b_edit.png" alt="Edit Help Page"/></a> <a href="adminpages.php?Page=help&amp;action=delete&amp;id=<?php echo $this->_tpl_vars['help']['id']; ?>
"><img src="./img/b_drop.png" alt="Delete Help Page"/></a></td>
			</tr>
			<?php endforeach; else: ?>
			<tr>
				<td colspan="2"><?php echo $this->_tpl_vars['error']; ?>
</td>
			</tr>
			<?php endif; unset($_from); ?>
			<tr>
				<td colspan="2">
								<?php echo smarty_function_paginate_middle(array(), $this);?>

				</td>
			</tr>
		</table>
    </div>