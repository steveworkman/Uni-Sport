<?php /* Smarty version 2.6.18, created on 2007-08-06 14:35:43
         compiled from deletereport.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'deletereport.tpl', 5, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Delete Match Report</h1></div>
        <p>
        	<strong>Match: </strong><?php echo $this->_tpl_vars['match']->squadName; ?>
 v <?php echo $this->_tpl_vars['match']->opposition; ?>
 on <?php echo ((is_array($_tmp=$this->_tpl_vars['match']->date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 <?php echo $this->_tpl_vars['match']->home; ?>

        </p>
        <p>
        	<strong>Score: </strong><?php echo $this->_tpl_vars['match']->score; ?>

        </p>
		<p>
        	<strong>Written By: </strong><a href="<?php echo $this->_tpl_vars['match']->author['link']; ?>
"><?php echo $this->_tpl_vars['match']->author['name']; ?>
</a>
        </p>
        <p>
        	<strong>Man of the Match: </strong><a href="<?php echo $this->_tpl_vars['match']->motm['link']; ?>
"><?php echo $this->_tpl_vars['match']->motm['name']; ?>
</a>
        </p>
        <p>
        	<strong>Dick of the Day: </strong><a href="<?php echo $this->_tpl_vars['match']->dotd['link']; ?>
"><?php echo $this->_tpl_vars['match']->dotd['name']; ?>
</a>
        </p>
        <p>
        	<strong>Match Report</strong><br/>
            <?php echo $this->_tpl_vars['match']->report; ?>

        </p>
        <div align="center">
        	<strong>Delete this match report?</strong>
            <form action="./commit/commitmatchreport.php?Action=delete" method="post">
            <input name="yes" type="submit" value="Yes">
            <input name="reportid" type="hidden" value="<?php echo $this->_tpl_vars['match']->id; ?>
"></input>
            <input name="matchid" type="hidden" value="<?php echo $this->_tpl_vars['match']->match_id; ?>
"></input></form>
            <form action="memberpages.php?Page=matchreports" method="post">
            <input name="no" type="submit" value="No"></form>
        </div>
    </div>