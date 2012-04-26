<?php /* Smarty version 2.6.18, created on 2007-08-24 16:45:57
         compiled from gallery.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'gallery.tpl', 8, false),array('modifier', 'default', 'gallery.tpl', 12, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Picture Albums</h1></div>
        <div id="pics">
            <p>
                <form action="#" method="get" style="padding-left:10px;">
                Showing <select id="showing">
                            <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['showing'],'selected' => $this->_tpl_vars['type']), $this);?>

                        </select>
                        <input type="hidden" id="selnext" value="<?php echo $this->_tpl_vars['next']; ?>
"/>
                        <input type="hidden" id="increment" value="<?php echo $this->_tpl_vars['increment']; ?>
"/>
                        <input type="hidden" id="currindex" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['next'])) ? $this->_run_mod_handler('default', true, $_tmp, 1) : smarty_modifier_default($_tmp, 1)); ?>
"/>
                </form>
            </p>
            <div id="gallery">
        	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'albums.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            </div>
            <div class="left" id="prev"><a href="gallery.php?type=<?php echo $this->_tpl_vars['type']; ?>
&next=<?php echo $this->_tpl_vars['previd']; ?>
"><?php echo $this->_tpl_vars['paginate']['prev_text']; ?>
</a></div>
			<div class="right" id="next"><a href="gallery.php?type=<?php echo $this->_tpl_vars['type']; ?>
&next=<?php echo $this->_tpl_vars['nextid']; ?>
"><?php echo $this->_tpl_vars['paginate']['next_text']; ?>
</a></div>
        </div>
    </div>