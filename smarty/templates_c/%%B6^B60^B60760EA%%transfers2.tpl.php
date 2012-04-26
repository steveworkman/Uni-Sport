<?php /* Smarty version 2.6.18, created on 2007-08-09 17:22:00
         compiled from transfers2.tpl */ ?>
<script language="javascript" type="text/javascript" src="./ajax/ajax.js"></script>
<script language="javascript" type="text/javascript" src="./ajax/transfers.js"></script>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Transfers</h1></div>
        
        <p>
        Please select a player to replace <strong><?php echo $this->_tpl_vars['pname']; ?>
</strong>
        </p>
        <p>
			You currently have <span style="color:red">&pound;<?php echo $this->_tpl_vars['remaining_cash']; ?>
m</span> to spend.
        <?php if ($this->_tpl_vars['error'] != ''): ?>
        	<br/>
        	<div class="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
        </p>
        <?php else: ?>
        	Therefore you can buy the following players:
        </p>
        <div id="lists" style="width:40%; float:left;">
            <p>
            <form name="fhockey" action="#" method="post" onsubmit="return false;">
            <select name="GKM" size=10 onFocus="getProfile(document.fhockey.GKM[document.fhockey.GKM.selectedIndex].value, <?php echo $this->_tpl_vars['tid']; ?>
, <?php echo $this->_tpl_vars['pid']; ?>
, <?php echo $this->_tpl_vars['pos']; ?>
)" onchange="getProfile(document.fhockey.GKM[document.fhockey.GKM.selectedIndex].value, <?php echo $this->_tpl_vars['tid']; ?>
, <?php echo $this->_tpl_vars['pid']; ?>
, <?php echo $this->_tpl_vars['pos']; ?>
)">
            <?php $_from = $this->_tpl_vars['players']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['player']):
?>
            	<option value="<?php echo $this->_tpl_vars['player']['id']; ?>
"><?php echo $this->_tpl_vars['player']['name']; ?>
 (&pound;<?php echo $this->_tpl_vars['player']['value']; ?>
m)</option>
            <?php endforeach; endif; unset($_from); ?>
            </select>
            </form>
            </p>
            <p>
                <strong><a href="./fhockey.php">Cancel this transfer</a></strong>
            </p>
        </div>
        <div id="profile" style="width:55%; float:right; margin-left: 2px; vertical-align:top;">
        </div>
        <?php endif; ?>
    </div>