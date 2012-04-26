<?php /* Smarty version 2.6.18, created on 2007-08-31 11:56:34
         compiled from albums.tpl */ ?>
<?php if (isset ( $this->_tpl_vars['error'] )): ?>
<div class="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
<?php else: ?>
<table class="gallery">
	<tr>
    	<?php unset($this->_sections['toprow']);
$this->_sections['toprow']['loop'] = is_array($_loop=3) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['toprow']['name'] = 'toprow';
$this->_sections['toprow']['show'] = true;
$this->_sections['toprow']['max'] = $this->_sections['toprow']['loop'];
$this->_sections['toprow']['step'] = 1;
$this->_sections['toprow']['start'] = $this->_sections['toprow']['step'] > 0 ? 0 : $this->_sections['toprow']['loop']-1;
if ($this->_sections['toprow']['show']) {
    $this->_sections['toprow']['total'] = $this->_sections['toprow']['loop'];
    if ($this->_sections['toprow']['total'] == 0)
        $this->_sections['toprow']['show'] = false;
} else
    $this->_sections['toprow']['total'] = 0;
if ($this->_sections['toprow']['show']):

            for ($this->_sections['toprow']['index'] = $this->_sections['toprow']['start'], $this->_sections['toprow']['iteration'] = 1;
                 $this->_sections['toprow']['iteration'] <= $this->_sections['toprow']['total'];
                 $this->_sections['toprow']['index'] += $this->_sections['toprow']['step'], $this->_sections['toprow']['iteration']++):
$this->_sections['toprow']['rownum'] = $this->_sections['toprow']['iteration'];
$this->_sections['toprow']['index_prev'] = $this->_sections['toprow']['index'] - $this->_sections['toprow']['step'];
$this->_sections['toprow']['index_next'] = $this->_sections['toprow']['index'] + $this->_sections['toprow']['step'];
$this->_sections['toprow']['first']      = ($this->_sections['toprow']['iteration'] == 1);
$this->_sections['toprow']['last']       = ($this->_sections['toprow']['iteration'] == $this->_sections['toprow']['total']);
?>
        <td><?php if (isset ( $this->_tpl_vars['albums'][$this->_sections['toprow']['index']]['id'] )): ?><a href="gallery.php?Page=gallery&album_id=<?php echo $this->_tpl_vars['albums'][$this->_sections['toprow']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['albums'][$this->_sections['toprow']['index']]['cover']; ?>
" alt="<?php echo $this->_tpl_vars['albums'][$this->_sections['toprow']['index']]['album_name']; ?>
" id="<?php echo $this->_tpl_vars['albums'][$this->_sections['toprow']['index']]['id']; ?>
" width="150px" /></a><br/><a href="gallery.php?Page=gallery&album_id=<?php echo $this->_tpl_vars['albums'][$this->_sections['toprow']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['albums'][$this->_sections['toprow']['index']]['album_name']; ?>
 (<?php echo $this->_tpl_vars['albums'][$this->_sections['toprow']['index']]['pic_count']; ?>
)</a><?php else: ?>&nbsp;<?php endif; ?></td>
        <?php endfor; endif; ?>
    </tr>
    <tr>
    	<?php unset($this->_sections['bottomrow']);
$this->_sections['bottomrow']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['bottomrow']['name'] = 'bottomrow';
$this->_sections['bottomrow']['start'] = (int)3;
$this->_sections['bottomrow']['show'] = true;
$this->_sections['bottomrow']['max'] = $this->_sections['bottomrow']['loop'];
$this->_sections['bottomrow']['step'] = 1;
if ($this->_sections['bottomrow']['start'] < 0)
    $this->_sections['bottomrow']['start'] = max($this->_sections['bottomrow']['step'] > 0 ? 0 : -1, $this->_sections['bottomrow']['loop'] + $this->_sections['bottomrow']['start']);
else
    $this->_sections['bottomrow']['start'] = min($this->_sections['bottomrow']['start'], $this->_sections['bottomrow']['step'] > 0 ? $this->_sections['bottomrow']['loop'] : $this->_sections['bottomrow']['loop']-1);
if ($this->_sections['bottomrow']['show']) {
    $this->_sections['bottomrow']['total'] = min(ceil(($this->_sections['bottomrow']['step'] > 0 ? $this->_sections['bottomrow']['loop'] - $this->_sections['bottomrow']['start'] : $this->_sections['bottomrow']['start']+1)/abs($this->_sections['bottomrow']['step'])), $this->_sections['bottomrow']['max']);
    if ($this->_sections['bottomrow']['total'] == 0)
        $this->_sections['bottomrow']['show'] = false;
} else
    $this->_sections['bottomrow']['total'] = 0;
if ($this->_sections['bottomrow']['show']):

            for ($this->_sections['bottomrow']['index'] = $this->_sections['bottomrow']['start'], $this->_sections['bottomrow']['iteration'] = 1;
                 $this->_sections['bottomrow']['iteration'] <= $this->_sections['bottomrow']['total'];
                 $this->_sections['bottomrow']['index'] += $this->_sections['bottomrow']['step'], $this->_sections['bottomrow']['iteration']++):
$this->_sections['bottomrow']['rownum'] = $this->_sections['bottomrow']['iteration'];
$this->_sections['bottomrow']['index_prev'] = $this->_sections['bottomrow']['index'] - $this->_sections['bottomrow']['step'];
$this->_sections['bottomrow']['index_next'] = $this->_sections['bottomrow']['index'] + $this->_sections['bottomrow']['step'];
$this->_sections['bottomrow']['first']      = ($this->_sections['bottomrow']['iteration'] == 1);
$this->_sections['bottomrow']['last']       = ($this->_sections['bottomrow']['iteration'] == $this->_sections['bottomrow']['total']);
?>
        <td><?php if (isset ( $this->_tpl_vars['albums'][$this->_sections['bottomrow']['index']]['id'] )): ?><a href="gallery.php?Page=gallery&album_id=<?php echo $this->_tpl_vars['albums'][$this->_sections['bottomrow']['index']]['id']; ?>
"><img src="<?php echo $this->_tpl_vars['albums'][$this->_sections['bottomrow']['index']]['cover']; ?>
" alt="<?php echo $this->_tpl_vars['albums'][$this->_sections['bottomrow']['index']]['album_name']; ?>
" id="<?php echo $this->_tpl_vars['albums'][$this->_sections['bottomrow']['index']]['id']; ?>
" width="150px" /></a><br/><a href="gallery.php?Page=gallery&album_id=<?php echo $this->_tpl_vars['albums'][$this->_sections['bottomrow']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['albums'][$this->_sections['bottomrow']['index']]['album_name']; ?>
 (<?php echo $this->_tpl_vars['albums'][$this->_sections['bottomrow']['index']]['pic_count']; ?>
)</a><?php else: ?>&nbsp;<?php endif; ?></td>
        <?php endfor; endif; ?>
    </tr>
</table>
<?php endif; ?>