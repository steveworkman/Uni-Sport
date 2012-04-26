<?php /* Smarty version 2.6.18, created on 2007-08-16 17:53:07
         compiled from listadverts.tpl */ ?>
<?php echo '
<script language="javascript">
function del(id)
{
	window.location = "./commit/commitads.php?action=delete&id="+id;
}
</script>
'; ?>

<div id="main">
	<div id="content">
    	<div align="center"><h1>Adverts</h1></div>
        <form action="./commit/commitads.php?action=edit" method="post" name="adform">
        	<?php $_from = $this->_tpl_vars['adverts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ad']):
?>
            <fieldset>
            	<legend><?php echo $this->_tpl_vars['ad']['alt']; ?>
</legend>
                <ol>
                	<li><label for="alt_<?php echo $this->_tpl_vars['ad']['id']; ?>
">Title</label><input name="alt_<?php echo $this->_tpl_vars['ad']['id']; ?>
" type="text" value="<?php echo $this->_tpl_vars['ad']['alt']; ?>
"/></li>
                    <li><label for="hyp_<?php echo $this->_tpl_vars['ad']['id']; ?>
">Hyperlink</label><input name="hyp_<?php echo $this->_tpl_vars['ad']['id']; ?>
" type="text" value="<?php echo $this->_tpl_vars['ad']['link']; ?>
"/></li>
                    <li><label for="seq_<?php echo $this->_tpl_vars['ad']['id']; ?>
">Sequence Number</label><input name="seq_<?php echo $this->_tpl_vars['ad']['id']; ?>
" type="text" value="<?php echo $this->_tpl_vars['ad']['seq']; ?>
"/></li>
                    <li>
                    	<div id="avatar">
                        	<div id="pic_<?php echo $this->_tpl_vars['ad']['id']; ?>
" class="indent"><img src="<?php echo $this->_tpl_vars['ad']['src']; ?>
" alt="<?php echo $this->_tpl_vars['ad']['alt']; ?>
" name="ad<?php echo $this->_tpl_vars['ad']['id']; ?>
" /></div>
							<div id="iframe_<?php echo $this->_tpl_vars['ad']['id']; ?>
">
                            	<iframe height="40" width="370" scrolling="no" src="uploadpic.php?id=<?php echo $this->_tpl_vars['ad']['id']; ?>
" frameborder="0"></iframe>
                            </div>
                        </div>
                    </li>
                    <li><input name="delete" type="button" value="Delete" onClick="del(<?php echo $this->_tpl_vars['ad']['id']; ?>
);" /></li>
                </ol>
            </fieldset>
            <?php endforeach; else: ?>
            <p>
            	You've not added any adverts yet. Use the link on the left to add one.
            </p>
            <?php endif; unset($_from); ?>
            <p align="center">
            	<input name="submit" type="submit" value="Submit all changes" />
            </p>
            <input type="hidden" value="<?php echo $this->_tpl_vars['ids']; ?>
" name="IDs"/>
        </form>
    </div>