<?php /* Smarty version 2.6.18, created on 2007-08-18 03:15:57
         compiled from listsquad.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'listsquad.tpl', 9, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Squad Menu</h1></div>
        <p>
        	To <strong>"archive"</strong> a squad, simply <strong>delete</strong> it
        </p>
        <table>
        	<?php $_from = $this->_tpl_vars['squads']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['squad']):
?>
            <tr class="<?php echo smarty_function_cycle(array('values' => "bg1,bg2"), $this);?>
">
            	<td><strong><?php echo $this->_tpl_vars['squad']['squad_name']; ?>
</strong><br/>Captained by <a href="<?php echo $this->_tpl_vars['squad']['captain_link']; ?>
"><?php echo $this->_tpl_vars['squad']['captain_name']; ?>
</td>
       			<td>
                	<a href="adminpages.php?Page=squads&Action=edit&id=<?php echo $this->_tpl_vars['squad']['squad_id']; ?>
"><img src="./img/b_edit.png" alt="Edit Squad" /></a><a href="adminpages.php?Page=squads&Action=delete&id=<?php echo $this->_tpl_vars['squad']['squad_id']; ?>
"><img src="./img/b_drop.png" alt="Delete Squad" /></a>
                </td>
            </tr>
            <?php endforeach; else: ?>
            <tr>
            	<td colspan="2">
                	You have not created a squad yet. Use the link on the right to create one
                </td>
            </tr>
            <?php endif; unset($_from); ?>
        </table>
    </div>