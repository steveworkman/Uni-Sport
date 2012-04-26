<?php /* Smarty version 2.6.18, created on 2007-08-15 23:11:30
         compiled from squadstatus.tpl */ ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Squad Status</h1></div>
        <table>
        	<tr>
            	<th>Name</th>
                <th>Available</th>
            </tr>
            <?php $_from = $this->_tpl_vars['squad']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['player']):
?>
            <tr>
            	<td><a href="<?php echo $this->_tpl_vars['player']['link']; ?>
"><?php echo $this->_tpl_vars['player']['name']; ?>
</a></td>
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
    </div>