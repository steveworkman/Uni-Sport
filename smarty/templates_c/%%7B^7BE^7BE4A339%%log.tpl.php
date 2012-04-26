<?php /* Smarty version 2.6.18, created on 2007-08-18 00:40:20
         compiled from log.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'log.tpl', 22, false),array('modifier', 'date_format', 'log.tpl', 25, false),)), $this); ?>
<?php echo '
<script language="javascript" type="text/javascript">
function checkAll()
{
	for (var i = 0; i < document.logform.elements.length; i++)
	{
    	if (document.logform.elements[i].type == "checkbox") {
        	document.logform.elements[i].checked = "true";
    	}
	}
}
</script>
'; ?>


<div id="main">
	<div id="content">
    	<div align="center"><h1>Security Log</h1></div>
        <table cellpadding="2" cellspacing="2">
			<th>User</th><th>IP</th><th>Time Stamp</th><th>Action</th><th>Mark as Read</th>
            <form name="logform" action="./commit/commitlog.php" method="post">
            <?php $_from = $this->_tpl_vars['logs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['log']):
?>
            <tr class="<?php echo smarty_function_cycle(array('values' => "bg1,bg2"), $this);?>
">
                <td><a href="<?php echo $this->_tpl_vars['log']['userlink']; ?>
"><?php echo $this->_tpl_vars['log']['username']; ?>
</a></td>
                <td><?php echo $this->_tpl_vars['log']['ip']; ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['log']['timestamp'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%B %e, %Y %H:%M:%S') : smarty_modifier_date_format($_tmp, '%B %e, %Y %H:%M:%S')); ?>
</td>
                <td><?php echo $this->_tpl_vars['log']['action']; ?>
</td>
                <td align="center"><input type="checkbox" name="<?php echo $this->_tpl_vars['log']['id']; ?>
" /></td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
            	<td colspan="5">
                	There are no unread security logs
                </td>
            </tr>
            <?php endif; unset($_from); ?>
            <tr>
				<td colspan="3">&nbsp;</td>
				<td align="center"><input type="button" value="Check All" name="checkall" onclick="checkAll();" /></td>
				<td align="center"><input type="submit" value="Submit" name="Submit" /></td>
			</tr>
			<input type="hidden" value="<?php echo $this->_tpl_vars['ids']; ?>
" name="IDs"/>
			</form>
		</table>
    </div>