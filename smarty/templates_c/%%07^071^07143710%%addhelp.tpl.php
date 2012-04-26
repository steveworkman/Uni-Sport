<?php /* Smarty version 2.6.18, created on 2007-12-27 14:57:21
         compiled from addhelp.tpl */ ?>
<div id="main">
	<div id="content">
    	<div class="center"><h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1></div>
        <form id="userform" action="<?php echo $this->_tpl_vars['formLink']; ?>
" method="post">
        	<fieldset>
            	<legend>Help Page</legend>
                <div class="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
                <ol>
                	<li><label for="head"><em>Title</em></label>
                	<input name="name" type="text" value="<?php echo $this->_tpl_vars['help']['name']; ?>
"></input>
                    </li>
                	<li><label for="text"><em>Description</em></label>
                	<textarea name="text" cols="50" rows="20"><?php echo $this->_tpl_vars['help']['text']; ?>
</textarea>
                    </li>
					<li><label for="youtube"><em>Youtube Link</em></label>
                	<input name="youtube" type="text" value="<?php echo $this->_tpl_vars['help']['youtube_link']; ?>
" />
                    </li>
                    <li>
                	<input name="Submit" type="submit" value="Submit" />
                    </li>
                </ol>
          	</fieldset>	
            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['help']['id']; ?>
"/>
        </form>
    </div>