<?php /* Smarty version 2.6.18, created on 2009-09-02 20:33:24
         compiled from sidebarContent.tpl */ ?>
<div class="sidebarContent">
<?php if ($this->_tpl_vars['obj']->nohide == 0): ?>
	<?php if ($this->_tpl_vars['obj']->hidden == 0): ?>
	<h3 class="headerShown" id="<?php echo $this->_tpl_vars['obj']->id; ?>
"><?php echo $this->_tpl_vars['obj']->title; ?>
</h3>
	<div class="content">
	<?php else: ?>
	<h3 class="headerHidden" id="<?php echo $this->_tpl_vars['obj']->id; ?>
"><?php echo $this->_tpl_vars['obj']->title; ?>
</h3>
	<div class="content" style="display:none">
	<?php endif; ?>
<?php else: ?>
	<h3 class="header"><?php echo $this->_tpl_vars['obj']->title; ?>
</h3>
    <div class="content">
<?php endif; ?>
        <ul>
            <?php if ($this->_tpl_vars['obj']->error == ''): ?>
                <?php $_from = $this->_tpl_vars['obj']->data; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data']):
?>
                    <li><a <?php if ($this->_tpl_vars['data']['id'] != ''): ?>id="<?php echo $this->_tpl_vars['data']['id']; ?>
"<?php endif; ?> href="<?php echo $this->_tpl_vars['data']['link']; ?>
" <?php if ($this->_tpl_vars['data']['class'] != ''): ?>class="<?php echo $this->_tpl_vars['data']['class']; ?>
"<?php endif; ?>><?php if ($this->_tpl_vars['data']['new'] == 1): ?><span class="highlight"><?php endif; ?><?php echo $this->_tpl_vars['data']['text']; ?>
<?php if ($this->_tpl_vars['data']['new'] == 1): ?></span><img src="<?php echo $this->_tpl_vars['NEW_IMG']; ?>
" alt="New" /><?php endif; ?></a></li>
                <?php endforeach; endif; unset($_from); ?>
            <?php else: ?>
                <li><?php echo $this->_tpl_vars['obj']->error; ?>
</li>
            <?php endif; ?>
        </ul>
    </div>
</div>