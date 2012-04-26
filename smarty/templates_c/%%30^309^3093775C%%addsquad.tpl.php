<?php /* Smarty version 2.6.18, created on 2007-08-30 18:57:57
         compiled from addsquad.tpl */ ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1></div>
        <?php if (isset ( $this->_tpl_vars['error'] )): ?>
        <div class="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
        <?php endif; ?>
        <form name="squadForm" action="<?php echo $this->_tpl_vars['formLink']; ?>
" method="post">
            <fieldset>
                <legend>Squad Details</legend>
                <ol>
                    <li>
                        <label for="name">Squad Name:</label>
                        <input name="name" type="text" value="<?php echo $this->_tpl_vars['squadData']['squad_name']; ?>
" />
                    </li>
                    <li>
                        <label for="desc">Description</label>
                        <textarea name="desc" cols="25" rows="10"><?php echo $this->_tpl_vars['squadData']['squad_desc']; ?>
</textarea>
                    </li>
                </ol>
            </fieldset>
            <fieldset>
                <legend>Squad</legend>
                <a href="#" id="addplayer">Click to add another player</a>
                <ol id="squadlist">
                	<?php unset($this->_sections['squad']);
$this->_sections['squad']['name'] = 'squad';
$this->_sections['squad']['loop'] = is_array($_loop=$this->_tpl_vars['playernum']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['squad']['start'] = (int)1;
$this->_sections['squad']['show'] = true;
$this->_sections['squad']['max'] = $this->_sections['squad']['loop'];
$this->_sections['squad']['step'] = 1;
if ($this->_sections['squad']['start'] < 0)
    $this->_sections['squad']['start'] = max($this->_sections['squad']['step'] > 0 ? 0 : -1, $this->_sections['squad']['loop'] + $this->_sections['squad']['start']);
else
    $this->_sections['squad']['start'] = min($this->_sections['squad']['start'], $this->_sections['squad']['step'] > 0 ? $this->_sections['squad']['loop'] : $this->_sections['squad']['loop']-1);
if ($this->_sections['squad']['show']) {
    $this->_sections['squad']['total'] = min(ceil(($this->_sections['squad']['step'] > 0 ? $this->_sections['squad']['loop'] - $this->_sections['squad']['start'] : $this->_sections['squad']['start']+1)/abs($this->_sections['squad']['step'])), $this->_sections['squad']['max']);
    if ($this->_sections['squad']['total'] == 0)
        $this->_sections['squad']['show'] = false;
} else
    $this->_sections['squad']['total'] = 0;
if ($this->_sections['squad']['show']):

            for ($this->_sections['squad']['index'] = $this->_sections['squad']['start'], $this->_sections['squad']['iteration'] = 1;
                 $this->_sections['squad']['iteration'] <= $this->_sections['squad']['total'];
                 $this->_sections['squad']['index'] += $this->_sections['squad']['step'], $this->_sections['squad']['iteration']++):
$this->_sections['squad']['rownum'] = $this->_sections['squad']['iteration'];
$this->_sections['squad']['index_prev'] = $this->_sections['squad']['index'] - $this->_sections['squad']['step'];
$this->_sections['squad']['index_next'] = $this->_sections['squad']['index'] + $this->_sections['squad']['step'];
$this->_sections['squad']['first']      = ($this->_sections['squad']['iteration'] == 1);
$this->_sections['squad']['last']       = ($this->_sections['squad']['iteration'] == $this->_sections['squad']['total']);
?>
                    <li>
                    	<label for="sel<?php echo $this->_sections['squad']['index']; ?>
">Player <?php echo $this->_sections['squad']['index']; ?>
</label>
                        <input type="text" id="sel<?php echo $this->_sections['squad']['index']; ?>
" name="sel<?php echo $this->_sections['squad']['index']; ?>
" value="<?php echo $this->_tpl_vars['squad'][$this->_sections['squad']['index']]['name']; ?>
" />
                        <input type="hidden" id="<?php echo $this->_sections['squad']['index']; ?>
" name="<?php echo $this->_sections['squad']['index']; ?>
" value="<?php echo $this->_tpl_vars['squad'][$this->_sections['squad']['index']]['id']; ?>
" />
                    </li>
                    <?php endfor; endif; ?>
                    <?php unset($this->_sections['hidden']);
$this->_sections['hidden']['name'] = 'hidden';
$this->_sections['hidden']['loop'] = is_array($_loop=$this->_tpl_vars['remain']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['hidden']['start'] = (int)$this->_tpl_vars['remstart'];
$this->_sections['hidden']['show'] = true;
$this->_sections['hidden']['max'] = $this->_sections['hidden']['loop'];
$this->_sections['hidden']['step'] = 1;
if ($this->_sections['hidden']['start'] < 0)
    $this->_sections['hidden']['start'] = max($this->_sections['hidden']['step'] > 0 ? 0 : -1, $this->_sections['hidden']['loop'] + $this->_sections['hidden']['start']);
else
    $this->_sections['hidden']['start'] = min($this->_sections['hidden']['start'], $this->_sections['hidden']['step'] > 0 ? $this->_sections['hidden']['loop'] : $this->_sections['hidden']['loop']-1);
if ($this->_sections['hidden']['show']) {
    $this->_sections['hidden']['total'] = min(ceil(($this->_sections['hidden']['step'] > 0 ? $this->_sections['hidden']['loop'] - $this->_sections['hidden']['start'] : $this->_sections['hidden']['start']+1)/abs($this->_sections['hidden']['step'])), $this->_sections['hidden']['max']);
    if ($this->_sections['hidden']['total'] == 0)
        $this->_sections['hidden']['show'] = false;
} else
    $this->_sections['hidden']['total'] = 0;
if ($this->_sections['hidden']['show']):

            for ($this->_sections['hidden']['index'] = $this->_sections['hidden']['start'], $this->_sections['hidden']['iteration'] = 1;
                 $this->_sections['hidden']['iteration'] <= $this->_sections['hidden']['total'];
                 $this->_sections['hidden']['index'] += $this->_sections['hidden']['step'], $this->_sections['hidden']['iteration']++):
$this->_sections['hidden']['rownum'] = $this->_sections['hidden']['iteration'];
$this->_sections['hidden']['index_prev'] = $this->_sections['hidden']['index'] - $this->_sections['hidden']['step'];
$this->_sections['hidden']['index_next'] = $this->_sections['hidden']['index'] + $this->_sections['hidden']['step'];
$this->_sections['hidden']['first']      = ($this->_sections['hidden']['iteration'] == 1);
$this->_sections['hidden']['last']       = ($this->_sections['hidden']['iteration'] == $this->_sections['hidden']['total']);
?>
                    <li id="list<?php echo $this->_sections['hidden']['index']; ?>
" class="nodisplay">
                    	<label for="sel<?php echo $this->_sections['hidden']['index']; ?>
">Player <?php echo $this->_sections['hidden']['index']; ?>
</label>
                        <input type="text" id="sel<?php echo $this->_sections['hidden']['index']; ?>
" name="sel<?php echo $this->_sections['hidden']['index']; ?>
"/>
                        <input type="hidden" id="<?php echo $this->_sections['hidden']['index']; ?>
" name="<?php echo $this->_sections['hidden']['index']; ?>
"/>
                    </li>
                    <?php endfor; endif; ?>
                </ol>
                <ol>
                	<li><input type="submit" value="<?php echo $this->_tpl_vars['buttonText']; ?>
" id="submit"/></li>
                </ol>
            </fieldset>
            <input name="captain" type="hidden" value="<?php echo $this->_tpl_vars['USR_ID']; ?>
"/>
            <input name="playernum" type="hidden" id="playernum" value="<?php echo $this->_tpl_vars['playernum']; ?>
"/>
            <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['squadData']['squad_id']; ?>
"/>
        </form>
        
    </div>