<?php /* Smarty version 2.6.18, created on 2007-12-27 15:02:29
         compiled from deletehelp.tpl */ ?>
<div id="main">
	<div id="content">
    	<div class="center"><h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1></div>
        <div class="center">
			<p>
        	<strong><?php echo $this->_tpl_vars['help']['name']; ?>
</strong>
	        </p>
	        <p>
	        	<strong>Description: </strong><?php echo $this->_tpl_vars['help']['text']; ?>

	        </p>
        	<p>
        	Would you like to delete this help page?<br />
            <form action="<?php echo $this->_tpl_vars['formLink']; ?>
" method="post">
                <input name="yes" type="submit" value="Yes" />
                <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['help']['id']; ?>
"/>
            </form>
            <form action="./adminpages.php?Page=help" method="post">
                <input name="no" type="submit" value="No"/>
            </form>
            </p>
        </div>
    </div>