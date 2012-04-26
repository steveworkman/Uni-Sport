<?php /* Smarty version 2.6.18, created on 2007-07-23 13:49:51
         compiled from readreports.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'readreports.tpl', 9, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center">
        	<h1>Match Reports</h1>
            <p>
            	<strong>Select a match report</strong>
                <form id="reportForm" name="reports" action="readreports.php" method="post">
                    <select name="reports" id="reportSelect">
                        <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['matchValues'],'output' => $this->_tpl_vars['matchOptions'],'selected' => $this->_tpl_vars['matchesSelect']), $this);?>

                    </select>
                </form>
            </p>
         </div>
         <div id="report">
            <?php if ($this->_tpl_vars['report'] != ''): ?>
            	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "report.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php endif; ?>
        </div>
    </div>