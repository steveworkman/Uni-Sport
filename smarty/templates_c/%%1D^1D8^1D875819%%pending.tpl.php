<?php /* Smarty version 2.6.18, created on 2007-08-16 15:46:35
         compiled from pending.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'pending.tpl', 13, false),)), $this); ?>
<form action="./commit/commitactivation.php&action=pending" method="post">
    <p>
        The following people are waiting account approval
    </p>
    <table>
        <th colspan="5">Pending Accounts</th>
        <tr>
            <th>NickName</th><th>Real Name</th><th>Email</th><th>Approve Account</th><th>Deny Account</th>
        </tr>
        <?php $_from = $this->_tpl_vars['pending']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?>
        <tr>
            <td><?php echo $this->_tpl_vars['member']['name']; ?>
</td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['member']['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['member']['lname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</td>
            <td><a href="mailto:<?php echo $this->_tpl_vars['member']['email']; ?>
"><img src="./img/email.gif" alt="<?php echo $this->_tpl_vars['member']['email']; ?>
" title="<?php echo $this->_tpl_vars['member']['email']; ?>
"/></a></td>
            <td><input type="checkbox" name="p<?php echo $this->_tpl_vars['member']['id']; ?>
"/></td>
            <td><input type="checkbox" name="d<?php echo $this->_tpl_vars['member']['id']; ?>
"/></td>
        </tr>
        <?php endforeach; else: ?>
        <tr>
            <td colspan="5">There are no accounts pending activation</td>
        </tr>
        <?php endif; unset($_from); ?>
        <tr>
        </tr>
    </table>
    <input type="hidden" value="<?php echo $this->_tpl_vars['pid']; ?>
" name="Pendings"/>
    <p>
    	<input type="submit" value="Submit" />
    </p>
</form>