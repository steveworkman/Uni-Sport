<?php /* Smarty version 2.6.18, created on 2007-12-23 16:50:41
         compiled from writereport.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'writereport.tpl', 10, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Write Match Report</h1></div>
        <form name="reports" action="./commit/commitmatchreport.php?Action=add" method="post" onSubmit="submitForm();">
        	<p align="center">
            <strong>Match</strong><br />
            <select id="match" name="matches">
            	<?php $_from = $this->_tpl_vars['matches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['match']):
?>
                    <?php if ($this->_tpl_vars['match']->match_id == $this->_tpl_vars['match_id']): ?>
                    <option value="<?php echo $this->_tpl_vars['match']->match_id; ?>
" selected="selected"><?php echo $this->_tpl_vars['match']->squadName; ?>
 v <?php echo $this->_tpl_vars['match']->opposition; ?>
 on <?php echo ((is_array($_tmp=$this->_tpl_vars['match']->date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 <?php echo $this->_tpl_vars['match']->home; ?>
</option>
                    <?php else: ?>
                    <option value="<?php echo $this->_tpl_vars['match']->match_id; ?>
"><?php echo $this->_tpl_vars['match']->squadName; ?>
 v <?php echo $this->_tpl_vars['match']->opposition; ?>
 on <?php echo ((is_array($_tmp=$this->_tpl_vars['match']->date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 <?php echo $this->_tpl_vars['match']->home; ?>
</option>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            </p>
            <?php if ($this->_tpl_vars['error'] == ''): ?>
            <div id="reportDetails">
            	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "reportdetails.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
            <?php else: ?>
            <p>
            <strong><?php echo $this->_tpl_vars['error']; ?>
</strong>
            </p>
            <?php endif; ?>
			</form>
     </div>