<?php /* Smarty version 2.6.18, created on 2007-08-18 04:00:16
         compiled from listinfopages.tpl */ ?>
<?php echo '
<script language="javascript">
function del(id)
{
	window.location = "./commit/commitinfo.php?action=delete&id="+id;
}
</script>
'; ?>

<div id="main">
	<div id="content">
    	<div align="center"><h1>Information Pages</h1></div>
        <p>
			This is where the information pages that appear in the left-hand menu side are set.
		</p>
        <form action="./commit/commitinfo.php?action=edit" method="post" name="adform">
        <?php $_from = $this->_tpl_vars['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page']):
?>
        <fieldset>
        	<legend><?php echo $this->_tpl_vars['page']['title']; ?>
</legend>
            <ol>
            	<li>
                	<label for="tit_<?php echo $this->_tpl_vars['page']['id']; ?>
">Title</label>
                    <input name="tit_<?php echo $this->_tpl_vars['page']['id']; ?>
" type="text" value="<?php echo $this->_tpl_vars['page']['title']; ?>
"/>
                </li>
                <li>
                	<label for="seq_<?php echo $this->_tpl_vars['page']['id']; ?>
">Sequence Number</label>
                    <input name="seq_<?php echo $this->_tpl_vars['page']['id']; ?>
" size="2" type="text" value="<?php echo $this->_tpl_vars['page']['seq']; ?>
"/>
                </li>
                <li><textarea name="text_<?php echo $this->_tpl_vars['page']['id']; ?>
" cols="32" rows="10"><?php echo $this->_tpl_vars['page']['text']; ?>
</textarea></li>
                <li><input name="delete" type="button" value="Delete" onClick="del(<?php echo $this->_tpl_vars['page']['id']; ?>
);" /></li>
            </ol>
        </fieldset>
        <?php endforeach; else: ?>
        <div class="error">You have not made any information pages yet. Click the link on the right to create one</div>
        <?php endif; unset($_from); ?>
        	<input type="hidden" value="<?php echo $this->_tpl_vars['ids']; ?>
" name="IDs"/>
            <p align="center">
            	<input name="submit" type="submit" value="Submit all changes" />
            </p>
        </form>
    </div>