<?php /* Smarty version 2.6.18, created on 2007-08-18 00:20:36
         compiled from checkstatus.tpl */ ?>
<div id="content" style="width:90%">
	<fieldset>
    	<legend>Squad Status</legend>
        <table>
        	<tr>
            	<th>Name</th>
                <th>Available</th>
            </tr>
        	<?php $_from = $this->_tpl_vars['players']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['player']):
?>
            <tr>
            	<td><?php echo $this->_tpl_vars['player']['name']; ?>
</td>
                <td>
                	<?php if ($this->_tpl_vars['player']['available'] == '0'): ?>
                    <span class="red">No</span>
                    <?php elseif ($this->_tpl_vars['player']['available'] == '1'): ?>
                    <span class="brightGreen">Yes</span>
                    <?php else: ?>
                    <span class="blue">Unknown</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </table>
    </fieldset>
</div>