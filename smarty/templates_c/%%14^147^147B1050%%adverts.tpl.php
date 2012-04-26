<?php /* Smarty version 2.6.18, created on 2009-09-02 20:33:25
         compiled from adverts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'adverts.tpl', 5, false),)), $this); ?>
<div id="adverts">
	<h3 class="header">Our Sponsors</h3>
    <ul>
    	<?php unset($this->_sections['ads']);
$this->_sections['ads']['name'] = 'ads';
$this->_sections['ads']['loop'] = is_array($_loop=$this->_tpl_vars['adverts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ads']['show'] = true;
$this->_sections['ads']['max'] = $this->_sections['ads']['loop'];
$this->_sections['ads']['step'] = 1;
$this->_sections['ads']['start'] = $this->_sections['ads']['step'] > 0 ? 0 : $this->_sections['ads']['loop']-1;
if ($this->_sections['ads']['show']) {
    $this->_sections['ads']['total'] = $this->_sections['ads']['loop'];
    if ($this->_sections['ads']['total'] == 0)
        $this->_sections['ads']['show'] = false;
} else
    $this->_sections['ads']['total'] = 0;
if ($this->_sections['ads']['show']):

            for ($this->_sections['ads']['index'] = $this->_sections['ads']['start'], $this->_sections['ads']['iteration'] = 1;
                 $this->_sections['ads']['iteration'] <= $this->_sections['ads']['total'];
                 $this->_sections['ads']['index'] += $this->_sections['ads']['step'], $this->_sections['ads']['iteration']++):
$this->_sections['ads']['rownum'] = $this->_sections['ads']['iteration'];
$this->_sections['ads']['index_prev'] = $this->_sections['ads']['index'] - $this->_sections['ads']['step'];
$this->_sections['ads']['index_next'] = $this->_sections['ads']['index'] + $this->_sections['ads']['step'];
$this->_sections['ads']['first']      = ($this->_sections['ads']['iteration'] == 1);
$this->_sections['ads']['last']       = ($this->_sections['ads']['iteration'] == $this->_sections['ads']['total']);
?>
        	<li><a href="<?php echo $this->_tpl_vars['adverts'][$this->_sections['ads']['index']]['link']; ?>
"><img src="<?php echo $this->_tpl_vars['adverts'][$this->_sections['ads']['index']]['img']; ?>
" alt="<?php echo ((is_array($_tmp=@$this->_tpl_vars['adverts'][$this->_sections['ads']['index']]['alt'])) ? $this->_run_mod_handler('default', true, $_tmp, 'advert') : smarty_modifier_default($_tmp, 'advert')); ?>
" width="90%" /></a></li>
        <?php endfor; endif; ?>
    </ul>
    <div class="center">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'googlesidebar.htm', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
</div>