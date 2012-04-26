<?php /* Smarty version 2.6.18, created on 2007-08-18 03:09:07
         compiled from deleteevent.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'deleteevent.tpl', 11, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1></div>
        <p>
        	<strong>Title: </strong><?php echo $this->_tpl_vars['event']['name']; ?>

        </p>
		<p>
        	<strong>Created By: </strong><a href="./viewprofile.php?action=view&amp;uid=<?php echo $this->_tpl_vars['event']['author_id']; ?>
"><?php echo $this->_tpl_vars['event']['author']; ?>
</a>
        </p>
        <p>
        	<strong>Date: </strong><?php echo ((is_array($_tmp=$this->_tpl_vars['event']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

        </p>
        <p>
        	<strong>Time: </strong><?php echo ((is_array($_tmp=$this->_tpl_vars['event']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%I:%M %p') : smarty_modifier_date_format($_tmp, '%I:%M %p')); ?>

        </p>
        <p>
        	<strong>Description</strong><br/>
            <?php echo $this->_tpl_vars['event']['desc']; ?>

        </p>
        <div align="center">
        	<p>
        	Would you like to delete this event<br />
            <form action="./commit/commitevent.php?Action=delete" method="post">
                <input name="yes" type="submit" value="Yes" />
                <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['event']['id']; ?>
"/>
            </form>
            <form action="./adminpages.php?Page=events" method="post">
                <input name="no" type="submit" value="No"/>
            </form>
            </p>
        </div>
    </div>