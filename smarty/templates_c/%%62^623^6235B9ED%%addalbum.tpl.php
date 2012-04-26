<?php /* Smarty version 2.6.18, created on 2007-08-23 20:08:42
         compiled from addalbum.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'addalbum.tpl', 16, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Add Album</h1></div>
        <?php if (isset ( $this->_tpl_vars['error'] )): ?>
        <div class="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
        <?php endif; ?>
        <p>
        	This is the first step in creating a picture album. Give it a name and a type then click next!<br/>
            Remember: Albums of the type 'Event' or 'Match' can be edited by anyone
        </p>
        <form action="./commit/commitalbum.php?action=add" method="post">
        <fieldset>
        	<legend>Album Details</legend>
            <ol>
            	<li><label for="name">Album Name</label><input type="text" name="name"/></li>
                <li><label for="type">Album Type</label><?php echo smarty_function_html_options(array('name' => 'type','options' => $this->_tpl_vars['types']), $this);?>
</li>
                <li><input type="submit" value="Next" /></li>
            </ol>
        </fieldset>
        </form>
    </div>