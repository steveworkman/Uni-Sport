<?php /* Smarty version 2.6.18, created on 2007-12-28 13:33:39
         compiled from listnews.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'listnews.tpl', 7, false),array('function', 'paginate_prev', 'listnews.tpl', 24, false),array('function', 'paginate_next', 'listnews.tpl', 36, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div class="center"><h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1></div>
        <form action="<?php echo $this->_tpl_vars['formLink']; ?>
" method="post">
        	<table width="100%" border="0" cellpadding="2" cellspacing="2">
            	<?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['story']):
?>
                <tr class="<?php echo smarty_function_cycle(array('values' => "bg1,bg2"), $this);?>
">
                	<td><strong><?php echo $this->_tpl_vars['story']['headline']; ?>
</strong><br/><em>By <a href="./viewprofile.php?action=view&amp;uid=<?php echo $this->_tpl_vars['story']['author_id']; ?>
"><?php echo $this->_tpl_vars['story']['author']; ?>
</a></em>
                    </td>
                    <td><a href="adminpages.php?Page=<?php echo $this->_tpl_vars['page']; ?>
&Action=edit&id=<?php echo $this->_tpl_vars['story']['id']; ?>
"><img src="./img/b_edit.png" alt="Edit Story"/></a> <a href="adminpages.php?Page=<?php echo $this->_tpl_vars['page']; ?>
&Action=delete&id=<?php echo $this->_tpl_vars['story']['id']; ?>
"><img src="./img/b_drop.png" alt="Delete Story"/></a> <input type="checkbox" name="<?php echo $this->_tpl_vars['story']['id']; ?>
" <?php if ($this->_tpl_vars['story']['arc'] == 1): ?>checked="checked"<?php endif; ?>/></td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                	<td colspan="2"><?php echo $this->_tpl_vars['error']; ?>
</td>
                </tr>
                <?php endif; unset($_from); ?>
                <tr>
                	<td>&nbsp;</td>
                    <td align="center"><input type="submit" name="Submit" value="Archive" /></td>
				</tr>
                <tr>
                	<td colspan="2">
                    					<?php echo smarty_function_paginate_prev(array(), $this);?>

					<?php $_from = $this->_tpl_vars['paginate']['page']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['pag'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pag']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['pagId'] => $this->_tpl_vars['page']):
        $this->_foreach['pag']['iteration']++;
?>
						<?php if ($this->_tpl_vars['page']['is_current']): ?>
						<a class="current" href="<?php echo $this->_tpl_vars['paginate']['url']; ?>
&amp;next=<?php echo $this->_tpl_vars['page']['item_start']; ?>
"><?php echo $this->_tpl_vars['page']['number']; ?>
</a>
						<?php elseif ($this->_tpl_vars['pagId'] >= $this->_tpl_vars['paginate']['page_current']-2 && $this->_tpl_vars['pagId'] <= $this->_tpl_vars['paginate']['page_current']+2): ?>
	    				<a href="<?php echo $this->_tpl_vars['paginate']['url']; ?>
&amp;next=<?php echo $this->_tpl_vars['page']['item_start']; ?>
"><?php echo $this->_tpl_vars['page']['number']; ?>
</a>
						<?php elseif (($this->_foreach['pag']['iteration'] <= 1)): ?>
						<a href="<?php echo $this->_tpl_vars['paginate']['url']; ?>
&amp;next=<?php echo $this->_tpl_vars['page']['item_start']; ?>
"><?php echo $this->_tpl_vars['page']['number']; ?>
</a>...
						<?php elseif (($this->_foreach['pag']['iteration'] == $this->_foreach['pag']['total'])): ?>
						...<a href="<?php echo $this->_tpl_vars['paginate']['url']; ?>
&amp;next=<?php echo $this->_tpl_vars['page']['item_start']; ?>
"><?php echo $this->_tpl_vars['page']['number']; ?>
</a>
						<?php endif; ?>
					<?php endforeach; endif; unset($_from); ?>
					<?php echo smarty_function_paginate_next(array(), $this);?>

                    </td>
                </tr>
            </table>
            <input type="hidden" value="<?php echo $this->_tpl_vars['ids']; ?>
" name="IDs"/>
            <input type="hidden" value="<?php echo $this->_tpl_vars['next']; ?>
" name="next" />
		</form>
        
    </div>