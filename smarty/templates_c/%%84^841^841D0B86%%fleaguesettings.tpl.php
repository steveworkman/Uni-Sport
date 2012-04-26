<?php /* Smarty version 2.6.18, created on 2007-08-16 12:55:15
         compiled from fleaguesettings.tpl */ ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Fantasy League Settings</h1></div>
        <form action="./commit/commitfhockey.php" method="post">
        <fieldset>
        	<legend>Controls</legend>
            <ol>
            	<li>
                	<input type="submit" name="pos" value="<?php echo $this->_tpl_vars['pos']; ?>
" />
        			<input type="hidden" name="position" value="<?php echo $this->_tpl_vars['lockpos']; ?>
" />
                </li>
                <li>
                	<input type="submit" name="sign" value="<?php echo $this->_tpl_vars['sign']; ?>
" />
        			<input type="hidden" name="signup" value="<?php echo $this->_tpl_vars['locksign']; ?>
" />
                </li>
            </ol>
        </fieldset>
        </form>
    </div>