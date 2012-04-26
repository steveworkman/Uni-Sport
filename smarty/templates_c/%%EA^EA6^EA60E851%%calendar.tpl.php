<?php /* Smarty version 2.6.18, created on 2007-08-15 23:04:33
         compiled from calendar.tpl */ ?>
<div id="main">
	<div id="content">
        <div id="calendar">
        	<h1>Calendar</h1>
            <a id="navleft" href="<?php echo $this->_tpl_vars['backMonth']; ?>
">&lt;&lt; </a><strong><?php echo $this->_tpl_vars['month']; ?>
 <?php echo $this->_tpl_vars['year']; ?>
</strong><a id="navright" href="<?php echo $this->_tpl_vars['fwdMonth']; ?>
"> &gt;&gt;</a>
            <?php echo $this->_tpl_vars['cal']; ?>

        </div>
    </div>