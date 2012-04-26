<?php /* Smarty version 2.6.18, created on 2009-09-02 20:33:25
         compiled from newsStory.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'newsStory.tpl', 5, false),)), $this); ?>
<div class="story">
    <?php if ($this->_tpl_vars['in_story'] != '1'): ?>
	<h2><a href="<?php echo $this->_tpl_vars['story']['link']; ?>
"><?php echo $this->_tpl_vars['story']['headline']; ?>
</a></h2>
	<?php endif; ?>
    <em>By <a href="<?php echo $this->_tpl_vars['story']['userLink']; ?>
"><?php echo $this->_tpl_vars['story']['author']; ?>
</a> on <?php echo ((is_array($_tmp=$this->_tpl_vars['story']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 in <?php echo $this->_tpl_vars['story']['cat']; ?>
</em>
    <p><?php echo $this->_tpl_vars['story']['text']; ?>
</p>
</div>