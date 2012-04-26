<?php /* Smarty version 2.6.18, created on 2007-08-17 13:51:06
         compiled from avatar.tpl */ ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Upload Avatar</h1></div>
        <div class="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
        <form method="post" action="./commit/commitavatar.php" enctype="multipart/form-data" />
        	<fieldset>
            	<legend>Avatar</legend>
                <ol>
                	<li><img src="<?php echo $this->_tpl_vars['avatar']; ?>
" alt="<?php echo $this->_tpl_vars['name']; ?>
" /><br/><input name="image" type="file" /></li>
                    <li><input name="submit" type="submit" value="Upload Picture" /></li>
                </ol>
                <input name="uid" type="hidden" value="<?php echo $this->_tpl_vars['id']; ?>
" />
            </fieldset>
		</form>
    </div>