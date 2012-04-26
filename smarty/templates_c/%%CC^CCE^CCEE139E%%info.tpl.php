<?php /* Smarty version 2.6.18, created on 2009-09-02 20:51:24
         compiled from info.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'info.tpl', 3, false),)), $this); ?>
<div id="main">
	<div id="content">
		<div class="center"><h1><?php echo ((is_array($_tmp=@$this->_tpl_vars['title'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Information') : smarty_modifier_default($_tmp, 'Information')); ?>
</h1></div>
        <?php if ($this->_tpl_vars['text'] != ''): ?>
        	<?php echo $this->_tpl_vars['text']; ?>

        <?php else: ?>
        	<ul style="list-style:none;" class="center">
            	<?php $_from = $this->_tpl_vars['links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['link']):
?>
                <li><a href="<?php echo $this->_tpl_vars['link']['link']; ?>
"><?php echo $this->_tpl_vars['link']['text']; ?>
</a></li>
            	<?php endforeach; endif; unset($_from); ?>
            </ul>
        <?php endif; ?>
    </div>