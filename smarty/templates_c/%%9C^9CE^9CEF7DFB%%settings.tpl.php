<?php /* Smarty version 2.6.18, created on 2007-08-16 12:40:19
         compiled from settings.tpl */ ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Site Settings</h1></div>
        <form method="post" action="./commit/commitsettings.php">
        <fieldset>
        	<legend>Settings</legend>
            <ol>
                <li>
                	<label for="club">Club Name</label>
                    <input name="club" type="text" size="32" value="<?php echo $this->_tpl_vars['clubname']; ?>
" />
                </li>
                <li>
                	<label for="keys">Site Keywords</label>
                    <textarea name="keys" cols="30"><?php echo $this->_tpl_vars['keywords']; ?>
</textarea>
                </li>
                <li>
                	<label for="desc">Site Description</label>
                    <textarea name="desc" cols="30"><?php echo $this->_tpl_vars['desc']; ?>
</textarea>
                </li>
            </ol>
            <p align="center">
            	<input name="submit" type="submit" value="Submit" />
            </p>
        </fieldset>
        </form>
    </div>