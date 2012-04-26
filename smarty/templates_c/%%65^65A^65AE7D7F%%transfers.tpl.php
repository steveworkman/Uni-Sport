<?php /* Smarty version 2.6.18, created on 2007-08-09 17:21:53
         compiled from transfers.tpl */ ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Transfers</h1></div>
        <?php if ($this->_tpl_vars['error'] == ''): ?>
        <p>
        This screen allows you to change players in your team, provided you have the funds of course. You have <strong><?php echo $this->_tpl_vars['transfers']; ?>
</strong> transfers remaining this season so use them wisely
        </p>
        <p>
		<strong>Remaining Budget:</strong> <span style="color:red">&pound;<?php echo $this->_tpl_vars['budget']; ?>
m</span>
		</p>
        <p>
		Select a player to transfer
		<table class="tbl" width="100%">
            <tr>
                <th>Picture</th>
                <th>Nickname</th>
                <th>Position</th>
                <th>Value</th>
                <th>Points</th>
                <th>&nbsp;</th>
            </tr>
            <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['player']):
?>
            <tr>
                <td><a href="<?php echo $this->_tpl_vars['player']['user_link']; ?>
"><img src="<?php echo $this->_tpl_vars['player']['user_avatar']; ?>
" alt="<?php echo $this->_tpl_vars['player']['user_name']; ?>
"/></a></td>
                <td><a href="<?php echo $this->_tpl_vars['player']['user_link']; ?>
"><?php echo $this->_tpl_vars['player']['user_name']; ?>
</a></td>
                <td><?php echo $this->_tpl_vars['player']['pos']; ?>
</td>
                <td><?php echo $this->_tpl_vars['player']['value']; ?>
</td>
                <td><?php echo $this->_tpl_vars['player']['points']; ?>
</td>
                <td>
                <a href="./fhockey.php?Page=transfers&pg=2&tid=<?php echo $this->_tpl_vars['player']['tid']; ?>
&pid=<?php echo $this->_tpl_vars['player']['uid']; ?>
&pos=<?php echo $this->_tpl_vars['player']['posid']; ?>
">Transfer Me</a>
                </td>
            </tr>
            <?php endforeach; endif; unset($_from); ?>
        </table>
        </p>
        <?php else: ?>
        	<div class="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
        <?php endif; ?>
    </div>