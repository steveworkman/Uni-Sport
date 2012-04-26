<?php /* Smarty version 2.6.18, created on 2009-09-02 20:33:25
         compiled from feature.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'feature.tpl', 13, false),)), $this); ?>
<div id="feature"> 
	<div class="left" style="width:<?php echo $this->_tpl_vars['data']['boxw']; ?>
px">
    <a href="<?php echo $this->_tpl_vars['data']['path']; ?>
" class="thickbox" title="<?php echo $this->_tpl_vars['data']['alt']; ?>
" style="display:block"><img src="<?php echo $this->_tpl_vars['data']['thumb']; ?>
" alt="<?php echo $this->_tpl_vars['data']['alt']; ?>
" title="<?php echo $this->_tpl_vars['data']['alt']; ?>
" width="<?php echo $this->_tpl_vars['data']['imgw']; ?>
" height="<?php echo $this->_tpl_vars['data']['imgh']; ?>
" /></a>
    <p style="font-size:86%">
    <?php echo $this->_tpl_vars['data']['tags']; ?>

	<br/><em>Click to view full screen</em>
    </p>
    </div>
    <h2>Welcome to <?php echo $this->_tpl_vars['clubname']; ?>
</h2> 
        <strong>Upcoming matches:</strong>
        <ul>
        <?php unset($this->_sections['matches']);
$this->_sections['matches']['name'] = 'matches';
$this->_sections['matches']['loop'] = is_array($_loop=$this->_tpl_vars['matches']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['matches']['show'] = true;
$this->_sections['matches']['max'] = $this->_sections['matches']['loop'];
$this->_sections['matches']['step'] = 1;
$this->_sections['matches']['start'] = $this->_sections['matches']['step'] > 0 ? 0 : $this->_sections['matches']['loop']-1;
if ($this->_sections['matches']['show']) {
    $this->_sections['matches']['total'] = $this->_sections['matches']['loop'];
    if ($this->_sections['matches']['total'] == 0)
        $this->_sections['matches']['show'] = false;
} else
    $this->_sections['matches']['total'] = 0;
if ($this->_sections['matches']['show']):

            for ($this->_sections['matches']['index'] = $this->_sections['matches']['start'], $this->_sections['matches']['iteration'] = 1;
                 $this->_sections['matches']['iteration'] <= $this->_sections['matches']['total'];
                 $this->_sections['matches']['index'] += $this->_sections['matches']['step'], $this->_sections['matches']['iteration']++):
$this->_sections['matches']['rownum'] = $this->_sections['matches']['iteration'];
$this->_sections['matches']['index_prev'] = $this->_sections['matches']['index'] - $this->_sections['matches']['step'];
$this->_sections['matches']['index_next'] = $this->_sections['matches']['index'] + $this->_sections['matches']['step'];
$this->_sections['matches']['first']      = ($this->_sections['matches']['iteration'] == 1);
$this->_sections['matches']['last']       = ($this->_sections['matches']['iteration'] == $this->_sections['matches']['total']);
?>
            <li><a href="<?php echo $this->_tpl_vars['matches'][$this->_sections['matches']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['matches'][$this->_sections['matches']['index']]['name']; ?>
 on <?php echo ((is_array($_tmp=$this->_tpl_vars['matches'][$this->_sections['matches']['index']]['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</a></li>
        <?php endfor; else: ?>
            <li><em>There are no upcoming matches</em></li>
        <?php endif; ?>
        </ul>
        <strong>Next Event:</strong>
        <ul>
        <?php unset($this->_sections['events']);
$this->_sections['events']['name'] = 'events';
$this->_sections['events']['loop'] = is_array($_loop=$this->_tpl_vars['events']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['events']['show'] = true;
$this->_sections['events']['max'] = $this->_sections['events']['loop'];
$this->_sections['events']['step'] = 1;
$this->_sections['events']['start'] = $this->_sections['events']['step'] > 0 ? 0 : $this->_sections['events']['loop']-1;
if ($this->_sections['events']['show']) {
    $this->_sections['events']['total'] = $this->_sections['events']['loop'];
    if ($this->_sections['events']['total'] == 0)
        $this->_sections['events']['show'] = false;
} else
    $this->_sections['events']['total'] = 0;
if ($this->_sections['events']['show']):

            for ($this->_sections['events']['index'] = $this->_sections['events']['start'], $this->_sections['events']['iteration'] = 1;
                 $this->_sections['events']['iteration'] <= $this->_sections['events']['total'];
                 $this->_sections['events']['index'] += $this->_sections['events']['step'], $this->_sections['events']['iteration']++):
$this->_sections['events']['rownum'] = $this->_sections['events']['iteration'];
$this->_sections['events']['index_prev'] = $this->_sections['events']['index'] - $this->_sections['events']['step'];
$this->_sections['events']['index_next'] = $this->_sections['events']['index'] + $this->_sections['events']['step'];
$this->_sections['events']['first']      = ($this->_sections['events']['iteration'] == 1);
$this->_sections['events']['last']       = ($this->_sections['events']['iteration'] == $this->_sections['events']['total']);
?>
        	<li><a href="<?php echo $this->_tpl_vars['events'][$this->_sections['events']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['events'][$this->_sections['events']['index']]['name']; ?>
</a></li>
        <?php endfor; else: ?>
        	<li><em>There are no upcoming events</em></li>
        <?php endif; ?>
        </ul>
        <strong>Birthdays:</strong><br/>
        <span class="bday">
        <?php unset($this->_sections['bday']);
$this->_sections['bday']['name'] = 'bday';
$this->_sections['bday']['loop'] = is_array($_loop=$this->_tpl_vars['bdays']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['bday']['show'] = true;
$this->_sections['bday']['max'] = $this->_sections['bday']['loop'];
$this->_sections['bday']['step'] = 1;
$this->_sections['bday']['start'] = $this->_sections['bday']['step'] > 0 ? 0 : $this->_sections['bday']['loop']-1;
if ($this->_sections['bday']['show']) {
    $this->_sections['bday']['total'] = $this->_sections['bday']['loop'];
    if ($this->_sections['bday']['total'] == 0)
        $this->_sections['bday']['show'] = false;
} else
    $this->_sections['bday']['total'] = 0;
if ($this->_sections['bday']['show']):

            for ($this->_sections['bday']['index'] = $this->_sections['bday']['start'], $this->_sections['bday']['iteration'] = 1;
                 $this->_sections['bday']['iteration'] <= $this->_sections['bday']['total'];
                 $this->_sections['bday']['index'] += $this->_sections['bday']['step'], $this->_sections['bday']['iteration']++):
$this->_sections['bday']['rownum'] = $this->_sections['bday']['iteration'];
$this->_sections['bday']['index_prev'] = $this->_sections['bday']['index'] - $this->_sections['bday']['step'];
$this->_sections['bday']['index_next'] = $this->_sections['bday']['index'] + $this->_sections['bday']['step'];
$this->_sections['bday']['first']      = ($this->_sections['bday']['iteration'] == 1);
$this->_sections['bday']['last']       = ($this->_sections['bday']['iteration'] == $this->_sections['bday']['total']);
?>
         	<?php if ($this->_sections['bday']['last']): ?>
            <a href="<?php echo $this->_tpl_vars['bdays'][$this->_sections['bday']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['bdays'][$this->_sections['bday']['index']]['name']; ?>
</a>
            <?php else: ?>
            	<a href="<?php echo $this->_tpl_vars['bdays'][$this->_sections['bday']['index']]['link']; ?>
"><?php echo $this->_tpl_vars['bdays'][$this->_sections['bday']['index']]['name']; ?>
</a>,
            <?php endif; ?>
        <?php endfor; else: ?>
            <em>There are no birthdays today</em>
        <?php endif; ?>
        </span>
</div> 