<?php /* Smarty version 2.6.18, created on 2009-09-02 20:33:24
         compiled from miniprofile.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'miniprofile.tpl', 14, false),)), $this); ?>
<?php if ($this->_tpl_vars['profile']->error == ''): ?>
<div class="right">
	<?php if (isset ( $this->_tpl_vars['profile']->fb_id )): ?>
    <a href="<?php echo $this->_tpl_vars['profile']->link; ?>
"><img src="<?php echo $this->_tpl_vars['profile']->avatar; ?>
" alt="<?php echo $this->_tpl_vars['profile']->username; ?>
"/></a>
    <?php else: ?>
    <a href="<?php echo $this->_tpl_vars['profile']->link; ?>
"><img src="<?php echo $this->_tpl_vars['profile']->avatar; ?>
" alt="<?php echo $this->_tpl_vars['profile']->username; ?>
" width="<?php echo $this->_tpl_vars['profile']->imgwidth; ?>
" height="<?php echo $this->_tpl_vars['profile']->imgheight; ?>
"/></a>
    <?php endif; ?>
</div>
<p>
    <strong>Nickname:</strong> <?php echo $this->_tpl_vars['profile']->username; ?>
<br />
    <strong>Favoured Position:</strong> <?php echo $this->_tpl_vars['profile']->side; ?>
 <?php echo $this->_tpl_vars['profile']->position; ?>
<br />
    <strong>Fantasy League Points:</strong> <?php echo $this->_tpl_vars['profile']->points; ?>
<br />
    <strong>Goals:</strong> <?php echo $this->_tpl_vars['profile']->goals; ?>
<br />
    <strong>Quote:</strong> <?php echo ((is_array($_tmp=$this->_tpl_vars['profile']->quote)) ? $this->_run_mod_handler('truncate', true, $_tmp, 70, "...") : smarty_modifier_truncate($_tmp, 70, "...")); ?>
<br />
    <a href="<?php echo $this->_tpl_vars['profile']->link; ?>
">View full profile</a>
</p>
<?php else: ?>
<p>
	<?php echo $this->_tpl_vars['profile']->error; ?>

</p>
<?php endif; ?>