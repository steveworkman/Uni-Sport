<?php /* Smarty version 2.6.18, created on 2007-08-22 12:17:01
         compiled from listalbums.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'listalbums.tpl', 22, false),array('function', 'paginate_middle', 'listalbums.tpl', 34, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Pictures</h1></div>
        <?php if (isset ( $this->_tpl_vars['succ'] )): ?>
        <div class="succ"><?php echo $this->_tpl_vars['succ']; ?>
</div>
        <?php endif; ?>
        <p>
        	Select an album to add pictures to or click the link on the right to create a new album!
        </p>
        <fieldset>
        	<legend>Personal Albums</legend>
            <?php $_from = $this->_tpl_vars['useralbums']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['useralbum'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['useralbum']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['album']):
        $this->_foreach['useralbum']['iteration']++;
?>
            <?php if (($this->_foreach['useralbum']['iteration'] <= 1)): ?>
            <table>
            	<tr>
                	<th>Album Name</th><th>Picture Count</th><th>Created On</th><th>Created By</th><th>&nbsp;</th>
                </tr>
            <?php endif; ?>
                <tr>
                    <td><?php echo $this->_tpl_vars['album']['album_name']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['album']['pic_count']; ?>
</td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['album']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                    <td><a href="./viewprofile.php?action=view&uid=<?php echo $this->_tpl_vars['album']['user_id']; ?>
"><?php echo $this->_tpl_vars['album']['username']; ?>
</a></td>
                    <td>
                    	<a href="memberpages.php?Page=picmenu&Action=upload&id=<?php echo $this->_tpl_vars['album']['id']; ?>
"><img src="./img/add.png" alt="Add to this album"/></a>
                    	<a href="memberpages.php?Page=picmenu&Action=edit&id=<?php echo $this->_tpl_vars['album']['id']; ?>
"><img src="./img/b_edit.png" alt="Edit this album"/></a>
                        <a href="memberpages.php?Page=picmenu&Action=delete&id=<?php echo $this->_tpl_vars['album']['id']; ?>
"><img src="./img/b_drop.png" alt="Delete this album"/></a>
                    </td>
                </tr>
            <?php if (($this->_foreach['useralbum']['iteration'] == $this->_foreach['useralbum']['total'])): ?>
            	<tr>
                	<td colspan="4">
                        				<?php echo smarty_function_paginate_middle(array(), $this);?>

                    </td>
                </tr>
            </table>
            <?php endif; ?>
            <?php endforeach; else: ?>
            <p>
            	You don't have any personal albums yet. Click the link on the right to create one!
            </p>
            <?php endif; unset($_from); ?>
        </fieldset>
        <fieldset>
        	<legend>Event Albums</legend>
            <?php $_from = $this->_tpl_vars['eventalbums']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['eventalbum'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['eventalbum']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['album']):
        $this->_foreach['eventalbum']['iteration']++;
?>
            <?php if (($this->_foreach['eventalbum']['iteration'] <= 1)): ?>
            <table>
            	<tr>
                	<th>Album Name</th><th>Picture Count</th><th>Created On</th><th>Created By</th><th>&nbsp;</th>
                </tr>
            <?php endif; ?>
                <tr>
                    <td><?php echo $this->_tpl_vars['album']['album_name']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['album']['pic_count']; ?>
</td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['album']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                    <td>Auto-generated</td>
                    <td>
                    	<a href="memberpages.php?Page=picmenu&Action=upload&id=<?php echo $this->_tpl_vars['album']['id']; ?>
"><img src="./img/add.png" alt="Add to this album"/></a>
                    	<a href="memberpages.php?Page=picmenu&Action=edit&id=<?php echo $this->_tpl_vars['album']['id']; ?>
"><img src="./img/b_edit.png" alt="Edit this album"/></a>
                        <a href="memberpages.php?Page=picmenu&Action=delete&id=<?php echo $this->_tpl_vars['album']['id']; ?>
"><img src="./img/b_drop.png" alt="Delete this album"/></a>
                    </td>
                </tr>
            <?php if (($this->_foreach['eventalbum']['iteration'] == $this->_foreach['eventalbum']['total'])): ?>
            	<tr>
                	<td colspan="4">
                        				<?php echo smarty_function_paginate_middle(array(), $this);?>

                    </td>
                </tr>
            </table>
            <?php endif; ?>
            <?php endforeach; else: ?>
            <p>
            	There are no event albums yet. Click the link on the right to create one!
            </p>
            <?php endif; unset($_from); ?>
        </fieldset>
        <fieldset>
        	<legend>Match Albums</legend>
            <?php $_from = $this->_tpl_vars['matchalbums']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['matchalbum'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['matchalbum']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['album']):
        $this->_foreach['matchalbum']['iteration']++;
?>
            <?php if (($this->_foreach['matchalbum']['iteration'] <= 1)): ?>
            <table>
            	<tr>
                	<th>Album Name</th><th>Picture Count</th><th>Created On</th><th>Created By</th><th>&nbsp;</th>
                </tr>
            <?php endif; ?>
                <tr>
                    <td><?php echo $this->_tpl_vars['album']['album_name']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['album']['pic_count']; ?>
</td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['album']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                    <td>Auto-generated</td>
                    <td>
                    	<a href="memberpages.php?Page=picmenu&Action=upload&id=<?php echo $this->_tpl_vars['album']['id']; ?>
"><img src="./img/add.png" alt="Add to this album"/></a>
                    	<a href="memberpages.php?Page=picmenu&Action=edit&id=<?php echo $this->_tpl_vars['album']['id']; ?>
"><img src="./img/b_edit.png" alt="Edit this album"/></a>
                        <a href="memberpages.php?Page=picmenu&Action=delete&id=<?php echo $this->_tpl_vars['album']['id']; ?>
"><img src="./img/b_drop.png" alt="Delete this album"/></a>
                    </td>
                </tr>
            <?php if (($this->_foreach['matchalbum']['iteration'] == $this->_foreach['matchalbum']['total'])): ?>
            	<tr>
                	<td colspan="4">
                        				<?php echo smarty_function_paginate_middle(array(), $this);?>

                    </td>
                </tr>
            </table>
            <?php endif; ?>
            <?php endforeach; else: ?>
            <p>
            	There are no match albums yet. Click the link on the right to create one!
            </p>
            <?php endif; unset($_from); ?>
        </fieldset>
    </div>