<?php /* Smarty version 2.6.18, created on 2007-08-18 00:42:12
         compiled from checkmatches.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'checkmatches.tpl', 10, false),array('function', 'html_options', 'checkmatches.tpl', 16, false),)), $this); ?>

<div id="main">
	<div id="content">
    	<div align="center"><h1>Check Matches</h1></div>
        <?php $_from = $this->_tpl_vars['matches']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['match']):
?>
        <form action="./commit/commitavailable.php" method="post" >
            <table width="100%">
            <tr>
              <td><h2><?php echo $this->_tpl_vars['match']->squadName; ?>
 vs <?php echo $this->_tpl_vars['match']->opposition; ?>
</h2>
              <strong>On</strong> <em><?php echo ((is_array($_tmp=$this->_tpl_vars['match']->date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</em> <strong>Captain:</strong> <em><a href="<?php echo $this->_tpl_vars['match']->captain['link']; ?>
"><?php echo $this->_tpl_vars['match']->captain['name']; ?>
</a></em> 
              <strong>Meet:</strong> <em><?php echo ((is_array($_tmp=$this->_tpl_vars['match']->meettime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H:%M') : smarty_modifier_date_format($_tmp, '%H:%M')); ?>
</em> <strong>PushBack:</strong> <em><?php echo ((is_array($_tmp=$this->_tpl_vars['match']->pushback)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H:%M') : smarty_modifier_date_format($_tmp, '%H:%M')); ?>
</em></td>
                <td align="center"><a href="squadstatus.php?id=<?php echo $this->_tpl_vars['match']->match_id; ?>
&height=300&width=300" class="thickbox"> Squad Status</a><br /></td>
            </tr>
                <tr><td><?php echo $this->_tpl_vars['match']->desc; ?>
</td>
                <td align="center">
                    <?php echo smarty_function_html_options(array('name' => 'available','options' => $this->_tpl_vars['availabilities'],'selected' => $this->_tpl_vars['match']->availability), $this);?>

                  <input type="submit" name="submit" value="Confirm" /></td>
                </tr>
                
              </table>		 
                    <input name="match" type="hidden" value="<?php echo $this->_tpl_vars['match']->match_id; ?>
" />
                    <input name="squad" type="hidden" value="<?php echo $this->_tpl_vars['match']->squad_id; ?>
" />
                    <input name="user" type="hidden" value="<?php echo $this->_tpl_vars['USR_ID']; ?>
" />
        </form>
        <hr size="4" noshade>
        <?php endforeach; else: ?>
            <?php echo $this->_tpl_vars['error']; ?>

        <?php endif; unset($_from); ?>
    </div>