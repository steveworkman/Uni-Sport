<?php /* Smarty version 2.6.18, created on 2007-08-18 03:42:53
         compiled from managemembers.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'managemembers.tpl', 8, false),array('function', 'paginate_middle', 'managemembers.tpl', 28, false),array('modifier', 'capitalize', 'managemembers.tpl', 11, false),array('modifier', 'date_format', 'managemembers.tpl', 16, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Manage Members</h1></div>
        <form action="./commit/commitmanagemembers.php" method="post">
        <table>
        	<tr><th>Delete?</th><th>Nickname</th> <th>Real Name</th> <th>Contact</th> <th>DOR</th><th>Archive?</th></tr>
            <?php $_from = $this->_tpl_vars['members']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['member']):
?>
            <tr class="<?php echo smarty_function_cycle(array('values' => "bg1,bg2"), $this);?>
">
            	<td><input name="del_<?php echo $this->_tpl_vars['member']['id']; ?>
" type="checkbox" /></td>
            	<td><a href="<?php echo $this->_tpl_vars['member']['link']; ?>
"><?php echo $this->_tpl_vars['member']['name']; ?>
</a></td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['member']['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['member']['lname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</td>
                <td>
                	<a href="mailto:<?php echo $this->_tpl_vars['member']['email']; ?>
"><img src="./img/email.gif" alt="<?php echo $this->_tpl_vars['member']['email']; ?>
" title="<?php echo $this->_tpl_vars['member']['email']; ?>
"/></a>
                    <img src="./img/phone.gif" alt="<?php echo $this->_tpl_vars['member']['phone']; ?>
" title="<?php echo $this->_tpl_vars['member']['phone']; ?>
"/>
                </td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['member']['regdate'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                <td><input name="arc_<?php echo $this->_tpl_vars['member']['id']; ?>
" type="checkbox" <?php if ($this->_tpl_vars['member']['arc'] == '1'): ?>checked="checked"<?php endif; ?>/></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
            <tr>
				<td><input name="submit" type="submit" value="Delete" /></td>
				<td colspan="4">&nbsp;</td>
				<td><input name="submit" type="submit" value="Archive" /></td>
			</tr>
			<tr>
                <td colspan="6">
                                <?php echo smarty_function_paginate_middle(array(), $this);?>

                </td>
            </tr>
        </table>
        <input type="hidden" value="<?php echo $this->_tpl_vars['ids']; ?>
" name="ids"/>
        <input type="hidden" value="<?php echo $this->_tpl_vars['next']; ?>
" name="next"/>
        </form>
    </div>