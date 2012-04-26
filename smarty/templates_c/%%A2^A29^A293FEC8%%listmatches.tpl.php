<?php /* Smarty version 2.6.18, created on 2007-08-18 03:14:34
         compiled from listmatches.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'listmatches.tpl', 6, false),array('function', 'paginate_middle', 'listmatches.tpl', 18, false),array('modifier', 'date_format', 'listmatches.tpl', 7, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Matches</h1></div>
        <table width="100%" border="0" cellpadding="2" cellspacing="2">
            <?php $_from = $this->_tpl_vars['matches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['match']):
?>
            <tr class="<?php echo smarty_function_cycle(array('values' => "bg1,bg2"), $this);?>
">
                <td><strong><?php echo $this->_tpl_vars['match']->squadName; ?>
</strong> v <strong><?php echo $this->_tpl_vars['match']->opposition; ?>
</strong> on <?php echo ((is_array($_tmp=$this->_tpl_vars['match']->date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 <?php echo $this->_tpl_vars['match']->home; ?>
</td>
                <td><a href="adminpages.php?Page=matches&Action=edit&id=<?php echo $this->_tpl_vars['match']->match_id; ?>
"><img src="./img/b_edit.png" alt="Edit Match" /></a> <a href="adminpages.php?Page=matches&Action=delete&id=<?php echo $this->_tpl_vars['match']->match_id; ?>
"><img src="./img/b_drop.png" alt="Delete Match" /></a> <a href="squadstatus.php?id=<?php echo $this->_tpl_vars['match']->match_id; ?>
&height=300&width=300" class="thickbox"><img src="./img/b_select.png" alt="Squad Status" /></a></td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
                <td><?php echo $this->_tpl_vars['error']; ?>
</td>
            </tr>
            <?php endif; unset($_from); ?>
            <tr>
                <td colspan="2">
                                <?php echo smarty_function_paginate_middle(array(), $this);?>

                </td>
            </tr>
        </table>
    </div>