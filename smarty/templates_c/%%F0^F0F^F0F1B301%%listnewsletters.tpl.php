<?php /* Smarty version 2.6.18, created on 2007-08-18 03:09:19
         compiled from listnewsletters.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'listnewsletters.tpl', 7, false),array('function', 'paginate_middle', 'listnewsletters.tpl', 25, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1></div>
        <form action="<?php echo $this->_tpl_vars['formLink']; ?>
" method="post">
        	<table width="100%" border="0" cellpadding="2" cellspacing="2">
            	<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['nl']):
?>
                <tr class="<?php echo smarty_function_cycle(array('values' => "bg1,bg2"), $this);?>
">
                	<td><strong><?php echo $this->_tpl_vars['nl']['title']; ?>
</strong><br/>
                    <em>Uploaded by <a href="./viewprofile.php?action=view&amp;uid=<?php echo $this->_tpl_vars['nl']['author_id']; ?>
"><?php echo $this->_tpl_vars['nl']['author']; ?>
</a></em>
                    </td>
                    <td><a href="adminpages.php?Page=newslettermenu&Action=edit&id=<?php echo $this->_tpl_vars['nl']['id']; ?>
"><img src="./img/b_edit.png" alt="Edit Newsletter"/></a> <a href="adminpages.php?Page=newslettermenu&Action=delete&id=<?php echo $this->_tpl_vars['nl']['id']; ?>
"><img src="./img/b_drop.png" alt="Delete Newsletter"/></a> <input type="checkbox" name="<?php echo $this->_tpl_vars['nl']['id']; ?>
" <?php if ($this->_tpl_vars['nl']['arc'] == 1): ?>checked="checked"<?php endif; ?>/></td></td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                	<td colspan="2">You have not uploaded any newsletters yet</td>
                </tr>
                <?php endif; unset($_from); ?>
                <tr>
                	<td>&nbsp;</td>
                    <td align="center"><input type="submit" name="Submit" value="Archive" /></td>
				</tr>
                <tr>
                	<td colspan="2">
                        				<?php echo smarty_function_paginate_middle(array(), $this);?>

                    </td>
                </tr>
            </table>
            <input type="hidden" value="<?php echo $this->_tpl_vars['ids']; ?>
" name="IDs"/>
		</form>
    </div>