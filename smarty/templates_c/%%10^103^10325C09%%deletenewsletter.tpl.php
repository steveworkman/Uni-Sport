<?php /* Smarty version 2.6.18, created on 2007-08-07 20:50:38
         compiled from deletenewsletter.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'deletenewsletter.tpl', 8, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
        <p>
        	<strong>Title: </strong><?php echo $this->_tpl_vars['data']['title']; ?>

        </p>
		<p>
        	<strong>Uploaded by: </strong><a href="./viewprofile.php?action=view&amp;uid=<?php echo $this->_tpl_vars['data']['author_id']; ?>
"><?php echo $this->_tpl_vars['data']['author']; ?>
</a> on <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

        </p>
        <p>
        	<a href="<?php echo $this->_tpl_vars['data']['path']; ?>
">View Newsletter</a>
        </p>
        <p>
            Would you like to delete this newsletter?<br />
            <form action="./commit/commitnewsletter.php?Action=delete" method="post">
                <input name="yes" type="submit" value="Yes" />
                <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['data']['id']; ?>
"/>
            </form>
            <form action="./adminpages.php?Page=newslettermenu" method="post">
                <input name="no" type="submit" value="No"/>
            </form>
        </p>
        </div>
    </div>