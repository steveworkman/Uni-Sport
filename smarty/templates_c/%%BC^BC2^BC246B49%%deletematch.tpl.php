<?php /* Smarty version 2.6.18, created on 2007-08-16 01:07:14
         compiled from deletematch.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'deletematch.tpl', 5, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Delete Match</h1></div>
        <p>
        	<strong>Match: </strong><?php echo $this->_tpl_vars['match']->squadName; ?>
 v <?php echo $this->_tpl_vars['match']->opposition; ?>
 on <?php echo ((is_array($_tmp=$this->_tpl_vars['match']->date)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
 <?php echo $this->_tpl_vars['match']->home; ?>
 <?php if ($this->_tpl_vars['match']->friendly == 'Yes'): ?>(Friendly)<?php endif; ?>
        </p>
        <p>
        	<strong>Match Details</strong><br/>
            <?php echo $this->_tpl_vars['match']->desc; ?>

        </p>
        <div align="center">
        	<strong>Delete this match?</strong>
            <form action="./commit/commitmatch.php?Action=delete" method="post">
				<input name="id" type="hidden" value="<?php echo $this->_tpl_vars['match']->match_id; ?>
"/>
				<input name="yes" type="submit" value="Yes"/>
            </form>
			<form action="adminpages.php?Page=matches" method="post">
				<input name="no" type="submit" value="No"/>
            </form>
        </div>
    </div>