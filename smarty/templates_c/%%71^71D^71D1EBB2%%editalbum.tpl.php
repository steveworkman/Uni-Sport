<?php /* Smarty version 2.6.18, created on 2007-08-25 17:33:30
         compiled from editalbum.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'editalbum.tpl', 11, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Edit Album</h1></div>
        <form action="commit/commitalbum.php?action=edit" method="post" id="editalbum">
        	<fieldset>
            	<legend>Album Details</legend>
                <ol>
                	<li><label for="name">Album Name</label><input type="text" name="name" value="<?php echo $this->_tpl_vars['album']['album_name']; ?>
" /></li>
                    <li>
                    	<label for="other">Other Details</label>
                        <strong>Created on</strong>: <?php echo ((is_array($_tmp=$this->_tpl_vars['album']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

                        <strong>by</strong> <?php echo $this->_tpl_vars['album']['username']; ?>

                        <strong>Type</strong>: <?php echo $this->_tpl_vars['album']['type_name']; ?>

                    </li>
                    <li>Archive this album<input type="checkbox" name="arc" <?php if ($this->_tpl_vars['album']['arc'] == 1): ?>checked="checked"<?php endif; ?>/></li>
                </ol>
            </fieldset>
        	
            <?php $_from = $this->_tpl_vars['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['pics'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['pics']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['pic']):
        $this->_foreach['pics']['iteration']++;
?>
            <fieldset>
            	<ol>
                    <li>
                    	<label for="pic<?php echo $this->_tpl_vars['pic']['id']; ?>
">Caption:<textarea style="vertical-align:middle;margin-left:5px" name="cap<?php echo $this->_tpl_vars['pic']['id']; ?>
" rows="7" cols="23"><?php echo $this->_tpl_vars['pic']['comment']; ?>
</textarea></label>
                        <a href="<?php echo $this->_tpl_vars['pic']['path']; ?>
" title="<?php echo $this->_tpl_vars['pic']['comment']; ?>
" class="thickbox"><img src="<?php echo $this->_tpl_vars['pic']['thumb']; ?>
" alt="Click for a full view" title="Click for a full view" align="right" /></a>
                       
                    </li>
                    <li class="ac">
                    	<div class="left" style="text-align:left">
                        	In this photo: <input type="text" id="tag<?php echo $this->_tpl_vars['pic']['id']; ?>
" />
                            				<br/>
                            <ul id="list<?php echo $this->_tpl_vars['pic']['id']; ?>
">
                            <?php $_from = $this->_tpl_vars['pic']['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tag']):
?>
                            	<li id="<?php echo $this->_tpl_vars['tag']['id']; ?>
"><?php echo $this->_tpl_vars['tag']['name']; ?>
 <a href="#" class="removeable" id="<?php echo $this->_tpl_vars['tag']['id']; ?>
">[remove]</a></li>
                            <?php endforeach; endif; unset($_from); ?>
                            </ul>
                        </div>
                    	<div class="right" style="text-align:right">
                        	<input type="radio" name="cover" value="<?php echo $this->_tpl_vars['pic']['id']; ?>
" <?php if ($this->_tpl_vars['pic']['id'] == $this->_tpl_vars['album']['cover']): ?>checked="checked"<?php endif; ?>/> Cover photo<br/>
                        	<input type="checkbox" name="feat<?php echo $this->_tpl_vars['pic']['id']; ?>
" <?php if ($this->_tpl_vars['pic']['featured'] == 1): ?>checked="checked"<?php endif; ?>/> Featured photo<br/>
                        	<input type="checkbox" name="del<?php echo $this->_tpl_vars['pic']['id']; ?>
"/> Delete this photo
                            <input type="hidden" name="hidden_tag<?php echo $this->_tpl_vars['pic']['id']; ?>
" id="hidden_tag<?php echo $this->_tpl_vars['pic']['id']; ?>
"/>
                        </div>
                    </li>
                    <?php if (($this->_foreach['pics']['iteration'] == $this->_foreach['pics']['total'])): ?>
                    <li>
                    	<input type="submit" value="Save Changes"/>
                    </li>
            		<?php endif; ?>
            	</ol>
            </fieldset>
            <?php endforeach; else: ?>
            <p>There are no pictures in this album</p>
            <?php endif; unset($_from); ?>
            <input type="hidden" name="pic_ids" id="pic_ids" value="<?php echo $this->_tpl_vars['pic_ids']; ?>
"/>
            <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['album']['album_id']; ?>
"/>
        </form>
    </div>