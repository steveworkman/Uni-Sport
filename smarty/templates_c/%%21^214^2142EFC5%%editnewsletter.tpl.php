<?php /* Smarty version 2.6.18, created on 2007-08-07 20:24:57
         compiled from editnewsletter.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'editnewsletter.tpl', 12, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center">
        	<h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1>
            <form action="<?php echo $this->_tpl_vars['formLink']; ?>
" method="post">
            <fieldset>
                <legend>Edit</legend>
                <ol>
                    <li><label for="title"><em>Newsletter Title</em></label>
                    <input name="title" type="text" size="55" value="<?php echo $this->_tpl_vars['data']['title']; ?>
" /></li>
                    <li>Uploaded by <a href="./viewprofile.php?action=view&amp;uid=<?php echo $this->_tpl_vars['data']['author_id']; ?>
"><?php echo $this->_tpl_vars['data']['author']; ?>
</a>
                    on <?php echo ((is_array($_tmp=$this->_tpl_vars['data']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</li>
                </ol>
                <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['data']['id']; ?>
" />
				<a href="<?php echo $this->_tpl_vars['data']['path']; ?>
">View Newsletter</a><br />
				<input name="submit" type="submit" value="Submit Changes" />
            </fieldset>
            </form>
        </div>
    </div>