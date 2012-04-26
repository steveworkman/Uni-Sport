<?php /* Smarty version 2.6.18, created on 2007-08-18 03:12:26
         compiled from reportdetails.tpl */ ?>
<?php if ($this->_tpl_vars['error'] == ''): ?>
<p align="center">
    <strong>Score</strong><br />
    <strong>Home</strong>: <input name="hscore" type="text" size="3" value="<?php echo $this->_tpl_vars['match']->hscore; ?>
"/>
    <strong>Opposition</strong>: <input name="oscore" type="text" size="3" value="<?php echo $this->_tpl_vars['match']->oscore; ?>
"/>
</p>
<fieldset style="width:50%">
    <legend>Scorers</legend>
    <table>
    <tr>
        <td width="50%">
            <select name="members" size=10>
                <?php $_from = $this->_tpl_vars['squad']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['player']):
?>
                <option value="<?php echo $this->_tpl_vars['player']['id']; ?>
"><?php echo $this->_tpl_vars['player']['name']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        </td>
        <td width="15%"><input type="button" name="add" value="&gt;"  onClick="addItScorer();" />
            <input name="Remove" type="button" value="&lt;" onClick="removeItScorer();" />
        </td>
        <td width="35%">
            <select name="squ" size=10 multiple id="squ">
           		<?php $_from = $this->_tpl_vars['scorers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['player']):
?>
                <option value="<?php echo $this->_tpl_vars['player']['id']; ?>
"><?php echo $this->_tpl_vars['player']['name']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        </td>
    </tr>
    </table>
</fieldset>
<div style="width:50%; float:left">
<fieldset>
	<legend>Yellow Cards</legend>
    <table>
    <tr>
        <td width="50%">
            <select name="members2" size=10>
                <?php $_from = $this->_tpl_vars['ycardsquad']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['player']):
?>
                <option value="<?php echo $this->_tpl_vars['player']['id']; ?>
"><?php echo $this->_tpl_vars['player']['name']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        </td>
        <td width="15%">
            <input type="button" name="add" value="&gt;"  onClick="addItYCard();" />
            <input name="Remove" type="button" value="&lt;" onClick="removeItYCard();" />
        </td>
        <td width="35%">
            <select name="ycard" size=10 multiple id="ycard">
            	<?php $_from = $this->_tpl_vars['ycards']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['player']):
?>
                <option value="<?php echo $this->_tpl_vars['player']['id']; ?>
"><?php echo $this->_tpl_vars['player']['name']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        </td>
	</tr>
    </table>
</fieldset>
</div>
<div style="width:50%; float:right">
<fieldset>
	<legend>Red Cards</legend>
    <table>
    <tr>
        <td width="50%">
            <select name="members3" size=10>
                <?php $_from = $this->_tpl_vars['rcardsquad']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['player']):
?>
                <option value="<?php echo $this->_tpl_vars['player']['id']; ?>
"><?php echo $this->_tpl_vars['player']['name']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        </td>
        <td width="15%">
            <input type="button" name="add" value="&gt;"  onClick="addItRCard();" />
            <input name="Remove" type="button" value="&lt;" onClick="removeItRCard();" />
        </td>
        <td width="35%">
            <select name="rcard" size=10 multiple id="rcard">
            	<?php $_from = $this->_tpl_vars['rcards']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['player']):
?>
                <option value="<?php echo $this->_tpl_vars['player']['id']; ?>
"><?php echo $this->_tpl_vars['player']['name']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        </td>
    </tr>
    </table>
</fieldset>
</div>
<p align="center" style="clear:both">
    <strong>Man of the Match:</strong>
    <select name="motm">
        <option value="0">-------</option>
        <?php $_from = $this->_tpl_vars['squad']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['player']):
?>
            <?php if ($this->_tpl_vars['match']->motm['id'] == $this->_tpl_vars['player']['id']): ?>
            <option value="<?php echo $this->_tpl_vars['player']['id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['player']['name']; ?>
</option>
            <?php else: ?>
            <option value="<?php echo $this->_tpl_vars['player']['id']; ?>
"><?php echo $this->_tpl_vars['player']['name']; ?>
</option>
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <strong>Dick of the Day:</strong>
    <select name="dotd">
        <option value="0">-------</option>
        <?php $_from = $this->_tpl_vars['squad']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['player']):
?>
        	<?php if ($this->_tpl_vars['match']->dotd['id'] == $this->_tpl_vars['player']['id']): ?>
            <option value="<?php echo $this->_tpl_vars['player']['id']; ?>
" selected="selected"><?php echo $this->_tpl_vars['player']['name']; ?>
</option>
            <?php else: ?>
            <option value="<?php echo $this->_tpl_vars['player']['id']; ?>
"><?php echo $this->_tpl_vars['player']['name']; ?>
</option>
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    </select><br /><br />
    <strong>Match Report</strong><br />
    <textarea name="report" cols="40" rows="15"><?php echo $this->_tpl_vars['match']->report; ?>
</textarea><br />
    
    <input name="scorers" type="hidden" value = " " />
    <input name="ycards" type="hidden" value = " " />
    <input name="rcards" type="hidden" value = " " />
    <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['match']->match_id; ?>
"/>
    <input name="reportid" type="hidden" value="<?php echo $this->_tpl_vars['match']->id; ?>
"/>
    <input name="submit" type="submit" value="Submit" />
</p>
<?php else: ?>
<p>
	<?php echo $this->_tpl_vars['error']; ?>

</p>
<?php endif; ?>