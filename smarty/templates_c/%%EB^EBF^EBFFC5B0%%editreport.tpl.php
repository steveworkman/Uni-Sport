<?php /* Smarty version 2.6.18, created on 2007-08-06 14:30:16
         compiled from editreport.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'editreport.tpl', 7, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Edit Match Report</h1></div>
        <form name="reports" action="./commit/commitmatchreport.php?Action=edit" method="post" onSubmit="submitForm()">
        	<p align="center">
                <strong>Match</strong><br />
                <em><?php echo $this->_tpl_vars['match']->squadName; ?>
 v <?php echo $this->_tpl_vars['match']->opposition; ?>
 <?php echo $this->_tpl_vars['match']->friendly; ?>
 on <?php echo ((is_array($_tmp=$this->_tpl_vars['match']->date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 <?php echo $this->_tpl_vars['match']->home; ?>
</em>
            </p>
        	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "reportdetails.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>