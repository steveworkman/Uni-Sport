<?php /* Smarty version 2.6.18, created on 2007-10-22 21:22:14
         compiled from report.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'report.tpl', 10, false),)), $this); ?>
<?php if ($this->_tpl_vars['report']->match_id != ''): ?>
<p>
    <table border="0" cellspacing="3" cellpadding="3" width="100%">
        <tr>
            <td align="center" colspan="2">
            <strong><?php echo $this->_tpl_vars['report']->squadName; ?>
 v <?php echo $this->_tpl_vars['report']->opposition; ?>
 <?php echo $this->_tpl_vars['report']->friendly; ?>
</strong>
            </td>
        </tr>
        <tr>
            <td><?php echo $this->_tpl_vars['report']->home; ?>
 on <?php echo ((is_array($_tmp=$this->_tpl_vars['report']->date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
            <td>at <?php echo ((is_array($_tmp=$this->_tpl_vars['report']->time)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H:%M') : smarty_modifier_date_format($_tmp, '%H:%M')); ?>
</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Squad</strong></td>
        </tr>
        <tr>
            <td colspan="2"><?php $_from = $this->_tpl_vars['squad']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['squad'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['squad']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['squad']):
        $this->_foreach['squad']['iteration']++;
?>
                <a href="<?php echo $this->_tpl_vars['squad']['link']; ?>
"><?php echo $this->_tpl_vars['squad']['name']; ?>
</a><?php if (($this->_foreach['squad']['iteration'] == $this->_foreach['squad']['total'])): ?><?php else: ?>,<?php endif; ?>
                <?php endforeach; endif; unset($_from); ?></td>
        </tr>
        <tr>
            <td><strong>Score</strong></td>
            <td><?php echo $this->_tpl_vars['report']->score; ?>
</td>
        </tr>
        <tr>
            <td width="50%"><strong>Scorers</strong></td>
            <td>
                <?php $_from = $this->_tpl_vars['scorers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['scorers'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['scorers']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['scorers']):
        $this->_foreach['scorers']['iteration']++;
?>
                <a href="<?php echo $this->_tpl_vars['scorers']['link']; ?>
"><?php echo $this->_tpl_vars['scorers']['name']; ?>
</a><?php if (($this->_foreach['scorers']['iteration'] == $this->_foreach['scorers']['total'])): ?><?php else: ?>,<?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </td>
        </tr>
        <?php if ($this->_tpl_vars['ycards'][0] != ''): ?>
        <tr>
            <td><strong>Yellow Cards</strong></td>
            <td><?php $_from = $this->_tpl_vars['ycards']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['ycards'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['ycards']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['ycards']):
        $this->_foreach['ycards']['iteration']++;
?>
                <a href="<?php echo $this->_tpl_vars['ycards']['link']; ?>
"><?php echo $this->_tpl_vars['ycards']['name']; ?>
</a><?php if (($this->_foreach['ycards']['iteration'] == $this->_foreach['ycards']['total'])): ?><?php else: ?>,<?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </td>
        </tr>
       <?php endif; ?>
       <?php if ($this->_tpl_vars['rcards'][0] != ''): ?>
        <tr>
            <td><strong>Red Cards</strong></td>
            <td><?php $_from = $this->_tpl_vars['rcards']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rcards'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rcards']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['rcards']):
        $this->_foreach['rcards']['iteration']++;
?>
                <a href="<?php echo $this->_tpl_vars['rcards']['link']; ?>
"><?php echo $this->_tpl_vars['rcards']['name']; ?>
</a><?php if (($this->_foreach['rcards']['iteration'] == $this->_foreach['rcards']['total'])): ?><?php else: ?>,<?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </td>
        </tr>
        <?php endif; ?>
        <tr>
            <td><strong>Captain</strong></td>
            <td><a href="<?php echo $this->_tpl_vars['report']->captain['link']; ?>
"><?php echo $this->_tpl_vars['report']->captain['name']; ?>
</a></td>
        </tr>
        <tr>
            <td><strong>Man of the Match</strong></td>
            <td><a href="<?php echo $this->_tpl_vars['report']->motm['link']; ?>
"><?php echo $this->_tpl_vars['report']->motm['name']; ?>
</a></td>
        </tr>
        <tr>
            <td><strong>Dick of the Day</strong></td>
            <td><a href="<?php echo $this->_tpl_vars['report']->dotd['link']; ?>
"><?php echo $this->_tpl_vars['report']->dotd['name']; ?>
</a></td>
        </tr>
        <tr>
            <td><strong>Written By</strong></td>
            <td><a href="<?php echo $this->_tpl_vars['report']->author['link']; ?>
"><?php echo $this->_tpl_vars['report']->author['name']; ?>
</a></td>
        </tr>
     </table>
 </p>
 <p>
    <?php echo $this->_tpl_vars['report']->report; ?>

 </p>
 <?php else: ?>
 	<div align="center"><h2>No Match Report</h2></div>
 	<p>
 		Oops, this match does not exist or no match report has been written! Tell the administrator.
 	</p>
 <?php endif; ?>