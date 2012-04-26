<?php /* Smarty version 2.6.18, created on 2007-08-09 17:21:48
         compiled from myteam.tpl */ ?>
<div id="main">
    <div id="content">
        <div align="center"><h1><?php echo $this->_tpl_vars['teamname']; ?>
</h1>
        <p>
            <strong>Remaining Budget:</strong> &pound;<?php echo $this->_tpl_vars['budget']; ?>
m
            <strong>Total Points:</strong> <?php echo $this->_tpl_vars['points']; ?>

            <strong>Ranking:</strong> <?php echo $this->_tpl_vars['position']; ?>

        </p>
        <p>
        <table class="tbl" width="100%">
        <tr>
            <th>Picture</th>
            <th>Nickname</th>
            <th>Position</th>
            <th>Value</th>
            <th>Points</th>
        </tr>
        <?php $_from = $this->_tpl_vars['players']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['player']):
?>
        <tr>
        	<td><a href="./viewprofile.php?action=view&uid=<?php echo $this->_tpl_vars['player']['id']; ?>
"><img src="<?php echo $this->_tpl_vars['player']['avatar']; ?>
" alt="<?php echo $this->_tpl_vars['player']['name']; ?>
"/></a></td>
            <td><strong><?php echo $this->_tpl_vars['player']['name']; ?>
</strong></td>
            <td><?php echo $this->_tpl_vars['player']['pos']; ?>
</td>
            <td><?php echo $this->_tpl_vars['player']['value']; ?>
</td>
            <td><?php echo $this->_tpl_vars['player']['points']; ?>
</td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        </table>
        </p>
        </div>
    </div>