<?php /* Smarty version 2.6.18, created on 2007-12-28 13:38:23
         compiled from listreports.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'listreports.tpl', 8, false),array('function', 'paginate_prev', 'listreports.tpl', 25, false),array('function', 'paginate_next', 'listreports.tpl', 37, false),array('modifier', 'date_format', 'listreports.tpl', 9, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Match Reports</h1></div>
        <div class="succ"><?php echo $this->_tpl_vars['succ']; ?>
</div>
        <form action="./commit/commitmatchreport.php?Action=arc" method="post">
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
<br />
                    <strong>Score:</strong> <em><?php echo $this->_tpl_vars['match']->score; ?>
</em>  <?php if ($this->_tpl_vars['match']->motm['name'] != ''): ?><strong>MotM:</strong> <em><a href="<?php echo $this->_tpl_vars['match']->motm['link']; ?>
"><?php echo $this->_tpl_vars['match']->motm['name']; ?>
</a></em><?php endif; ?> <?php if ($this->_tpl_vars['match']->dotd['name'] != ''): ?><strong>DotD:</strong>  <em><a href="<?php echo $this->_tpl_vars['match']->dotd['link']; ?>
"><?php echo $this->_tpl_vars['match']->dotd['name']; ?>
</a></em><?php endif; ?></td>
                    <td><a href="memberpages.php?Page=matchreports&Action=edit&id=<?php echo $this->_tpl_vars['match']->id; ?>
"><img src="./img/b_edit.png" alt="Edit Match Report" /></a> <a href="memberpages.php?Page=matchreports&Action=delete&id=<?php echo $this->_tpl_vars['match']->id; ?>
"><img src="./img/b_drop.png" alt="Delete Match Report" /></a> <input type="checkbox" name="<?php echo $this->_tpl_vars['match']->id; ?>
" <?php if ($this->_tpl_vars['match']->arc == 1): ?>checked="checked"<?php endif; ?>/></td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                	<td><?php echo $this->_tpl_vars['error']; ?>
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
" name="next"/>
		</form>
    </div>