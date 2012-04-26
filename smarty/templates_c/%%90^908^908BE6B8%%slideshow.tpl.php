<?php /* Smarty version 2.6.18, created on 2007-12-27 23:46:24
         compiled from slideshow.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'slideshow.tpl', 32, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1><?php echo $this->_tpl_vars['album']['album_name']; ?>
</h1></div>
    	<?php if (isset ( $this->_tpl_vars['error'] )): ?>
        <p>
        	<?php echo $this->_tpl_vars['error']; ?>

        </p>
        <?php else: ?>
        <div align="right" style="padding-right:5px"><a href="./gallery.php">Back to Gallery</a></div>
        <p>
            <div id="currpic">
            	<a href="<?php echo $this->_tpl_vars['currpath']; ?>
" title="<?php echo $this->_tpl_vars['curralt']; ?>
" class="thickbox"><img src="<?php echo $this->_tpl_vars['currpath']; ?>
" alt="<?php echo $this->_tpl_vars['curralt']; ?>
" width="<?php echo $this->_tpl_vars['imgwidth']; ?>
" <?php if (! empty ( $this->_tpl_vars['imgheight'] )): ?>height="<?php echo $this->_tpl_vars['imgheight']; ?>
"<?php endif; ?> title="<?php echo $this->_tpl_vars['curralt']; ?>
"/></a>
            </div>
            <p id="comment" style="font-size:86%;">
            	<?php echo $this->_tpl_vars['curralt']; ?>

            </p>
            <p id="tags" style="font-size:86%">
            	<?php echo $this->_tpl_vars['currtags']; ?>

            </p>
            <p style="font-size:86%">
            	Tag people in this photo: <form onsubmit="return false;"><input type="text" id="taginput"/></form>
            </p>
            <ul id="mycarousel" class="jcarousel-skin-ie7"></ul>
            <div class="center">
            <table width="100%">
                <tr>
                    <td>Title: <?php echo $this->_tpl_vars['album']['album_name']; ?>
</td>
                    <td>Created by: <?php if ($this->_tpl_vars['album']['user_id'] == -1): ?><?php echo $this->_tpl_vars['album']['username']; ?>
<?php else: ?><a href="./viewprofile.php?action=view&uid=<?php echo $this->_tpl_vars['album']['user_id']; ?>
"><?php echo $this->_tpl_vars['album']['username']; ?>
</a><?php endif; ?></td>
                </tr>
                <tr>
                    <td>Type: <?php echo $this->_tpl_vars['album']['type_name']; ?>
</td>
                    <td>Date: <?php echo ((is_array($_tmp=$this->_tpl_vars['album']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                </tr>
            </table>
            </div>
        </p>
        <form>
        	<?php if (isset ( $this->_tpl_vars['user_id'] )): ?><input type="hidden" id="user_id" value="<?php echo $this->_tpl_vars['user_id']; ?>
"/>
            <?php else: ?><input type="hidden" id="album_id" value="<?php echo $this->_tpl_vars['album']['album_id']; ?>
"/><?php endif; ?>
            <input type="hidden" id="pic_id" value="<?php echo $this->_tpl_vars['currpicid']; ?>
"/>
        </form>
        <?php endif; ?>
    </div>