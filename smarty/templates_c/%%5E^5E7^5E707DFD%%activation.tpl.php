<?php /* Smarty version 2.6.18, created on 2007-08-30 18:23:47
         compiled from activation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'activation.tpl', 14, false),array('modifier', 'capitalize', 'activation.tpl', 16, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Activation</h1></div>
        <form action="./commit/commitactivation.php" method="post">
            <p>
                The following people are awaiting activation
            </p>
            <table>
                <th colspan="5">Accounts Awaiting Activation</th>
                <tr>
                    <th>NickName</th><th>Real Name</th><th>Email</th><th>Approve Account</th><th>Deny Account</th>
                </tr>
                <?php $_from = $this->_tpl_vars['inactive']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?>
                <tr class="<?php echo smarty_function_cycle(array('values' => "bg1,bg2"), $this);?>
">
                    <td><?php echo $this->_tpl_vars['member']['name']; ?>
</td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['member']['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['member']['lname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</td>
                    <td><a href="mailto:<?php echo $this->_tpl_vars['member']['email']; ?>
"><img src="./img/email.gif" alt="<?php echo $this->_tpl_vars['member']['email']; ?>
" title="<?php echo $this->_tpl_vars['member']['email']; ?>
"/></a></td>
                    <td><input type="checkbox" name="a<?php echo $this->_tpl_vars['member']['id']; ?>
"/></td>
                    <td><input type="checkbox" name="d<?php echo $this->_tpl_vars['member']['id']; ?>
"/></td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="5">There are no accounts awaiting activation</td>
                </tr>
                <?php endif; unset($_from); ?>
                <tr>
                </tr>
            </table>
            <input type="hidden" value="<?php echo $this->_tpl_vars['pid']; ?>
" name="Activates"/>
            <p>
                <input type="submit" value="Submit" />
            </p>
        </form>
    </div>