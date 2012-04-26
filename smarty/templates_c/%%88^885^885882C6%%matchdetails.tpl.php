<?php /* Smarty version 2.6.18, created on 2007-12-07 09:08:13
         compiled from matchdetails.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'matchdetails.tpl', 24, false),)), $this); ?>
<div id="main">
	<div id="content">
		<?php if ($this->_tpl_vars['match']->squad_id != ''): ?>
		<div class="center"><h1><?php echo $this->_tpl_vars['match']->squadName; ?>
 v <?php echo $this->_tpl_vars['match']->opposition; ?>
</h1></div>
		<table border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td><strong>Squad</strong></td>
				<td><?php echo $this->_tpl_vars['match']->squadName; ?>
</td>
			</tr>
			<tr>
				<td><strong>Opposition</strong></td>
				<td><?php echo $this->_tpl_vars['match']->opposition; ?>
</td>
			</tr>
			<tr>
				<td><strong>Home/Away</strong></td>
				<td><?php echo $this->_tpl_vars['match']->home; ?>
</td>
			</tr>
			<tr>
				<td><strong>Friendly?</strong></td>
				<td><?php echo $this->_tpl_vars['match']->friendly; ?>
</td>
			</tr>
			<tr>
				<td><strong>Meet Time</strong></td>
				<td><?php echo ((is_array($_tmp=$this->_tpl_vars['match']->meettime)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H:%M') : smarty_modifier_date_format($_tmp, '%H:%M')); ?>
</td>
			</tr>
			<tr>
				<td><strong>Push Back Time</strong></td>
				<td><?php echo ((is_array($_tmp=$this->_tpl_vars['match']->pushback)) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H:%M') : smarty_modifier_date_format($_tmp, '%H:%M')); ?>
</td>
			</tr>
			<tr>
            <td><strong>Captain</strong></td>
            <td><a href="<?php echo $this->_tpl_vars['match']->captain['link']; ?>
"><?php echo $this->_tpl_vars['match']->captain['name']; ?>
</a></td>
        </tr>
			<tr>
				<td><strong>Squad</strong></td>
				<td><?php $_from = $this->_tpl_vars['squad']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['squad'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['squad']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['squad']):
        $this->_foreach['squad']['iteration']++;
?>
                <a href="<?php echo $this->_tpl_vars['squad']['link']; ?>
"><?php echo $this->_tpl_vars['squad']['name']; ?>
</a><?php if (($this->_foreach['squad']['iteration'] == $this->_foreach['squad']['total'])): ?><?php else: ?>,<?php endif; ?>
                <?php endforeach; endif; unset($_from); ?></td>
			</tr>
		</table>
		<h2>Match Description</h2>
		<p><?php echo $this->_tpl_vars['match']->desc; ?>
</p>
		<?php else: ?>
			<div class="center"><h1>Match Details</h1></div>
			<div class="center"><h2>No Match Selected</h2></div>
			<p>
				Oops, there's no match for that ID! Please tell the administrator.
			</p>
		<?php endif; ?>
	</div>