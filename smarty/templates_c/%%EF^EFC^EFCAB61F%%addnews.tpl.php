<?php /* Smarty version 2.6.18, created on 2007-08-18 02:55:12
         compiled from addnews.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'addnews.tpl', 13, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1></div>
        <form id="userform" action="<?php echo $this->_tpl_vars['formLink']; ?>
" method="post">
        	<fieldset>
            	<legend>News Story</legend>
                <div class="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
                <ol>
                	<li><label for="head"><em>Headline</em></label>
                	<input name="head" type="text" value="<?php echo $this->_tpl_vars['article']['headline']; ?>
"></input>
                    </li>
                	<li><label for="category"><em>Category</em></label>
                	<?php echo smarty_function_html_options(array('name' => 'category','options' => $this->_tpl_vars['cats'],'selected' => $this->_tpl_vars['article']['cat_id']), $this);?>

                	</li>
                	<li><label for="text"><em>Story</em></label>
                	<textarea name="text" cols="50" rows="20"><?php echo $this->_tpl_vars['article']['text']; ?>
</textarea>
                    </li>
                    <li>
                	<input name="Submit" type="submit" value="Submit" />
                    </li>
                </ol>
          	</fieldset>	
            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['article']['id']; ?>
"/>
            <input type="hidden" name="author_id" value="<?php echo $this->_tpl_vars['article']['author_id']; ?>
"/>
            <input type="hidden" name="date" value="<?php echo $this->_tpl_vars['article']['date']; ?>
" />
        </form>
    </div>