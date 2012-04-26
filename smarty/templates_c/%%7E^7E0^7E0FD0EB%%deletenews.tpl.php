<?php /* Smarty version 2.6.18, created on 2007-08-18 03:11:58
         compiled from deletenews.tpl */ ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1><?php echo $this->_tpl_vars['pageTitle']; ?>
</h1></div>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "newsStory.tpl", 'smarty_include_vars' => array('story' => $this->_tpl_vars['article'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <div align="center">
        	<p>
        	Would you like to delete this news article?<br />
            <form action="./commit/commit<?php echo $this->_tpl_vars['page']; ?>
.php?Action=delete" method="post">
                <input name="yes" type="submit" value="Yes" />
                <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['article']['id']; ?>
"/>
            </form>
            <form action="./adminpages.php?Page=<?php echo $this->_tpl_vars['page']; ?>
" method="post">
                <input name="no" type="submit" value="No"/>
            </form>
            </p>
        </div>
    </div>