<?php /* Smarty version 2.6.18, created on 2009-09-02 20:33:24
         compiled from sidebar.tpl */ ?>
<div id="sidebar1">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "login.tpl", 'smarty_include_vars' => array('login' => $this->_tpl_vars['login'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php unset($this->_sections['sbcontent']);
$this->_sections['sbcontent']['name'] = 'sbcontent';
$this->_sections['sbcontent']['loop'] = is_array($_loop=$this->_tpl_vars['content']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sbcontent']['show'] = true;
$this->_sections['sbcontent']['max'] = $this->_sections['sbcontent']['loop'];
$this->_sections['sbcontent']['step'] = 1;
$this->_sections['sbcontent']['start'] = $this->_sections['sbcontent']['step'] > 0 ? 0 : $this->_sections['sbcontent']['loop']-1;
if ($this->_sections['sbcontent']['show']) {
    $this->_sections['sbcontent']['total'] = $this->_sections['sbcontent']['loop'];
    if ($this->_sections['sbcontent']['total'] == 0)
        $this->_sections['sbcontent']['show'] = false;
} else
    $this->_sections['sbcontent']['total'] = 0;
if ($this->_sections['sbcontent']['show']):

            for ($this->_sections['sbcontent']['index'] = $this->_sections['sbcontent']['start'], $this->_sections['sbcontent']['iteration'] = 1;
                 $this->_sections['sbcontent']['iteration'] <= $this->_sections['sbcontent']['total'];
                 $this->_sections['sbcontent']['index'] += $this->_sections['sbcontent']['step'], $this->_sections['sbcontent']['iteration']++):
$this->_sections['sbcontent']['rownum'] = $this->_sections['sbcontent']['iteration'];
$this->_sections['sbcontent']['index_prev'] = $this->_sections['sbcontent']['index'] - $this->_sections['sbcontent']['step'];
$this->_sections['sbcontent']['index_next'] = $this->_sections['sbcontent']['index'] + $this->_sections['sbcontent']['step'];
$this->_sections['sbcontent']['first']      = ($this->_sections['sbcontent']['iteration'] == 1);
$this->_sections['sbcontent']['last']       = ($this->_sections['sbcontent']['iteration'] == $this->_sections['sbcontent']['total']);
?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'sidebarContent.tpl', 'smarty_include_vars' => array('obj' => $this->_tpl_vars['content'][$this->_sections['sbcontent']['index']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endfor; endif; ?>
     <div class="sidebarContent">
     <?php if ($this->_tpl_vars['profile']->hidden == 0): ?>
        <h3 class="headerShown" id="miniprofile">Random Profile</h3>
        <div class="content">
     <?php else: ?>
     	<h3 class="headerHidden" id="miniprofile">Random Profile</h3>
        <div class="content" style="display:none">
     <?php endif; ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'miniprofile.tpl', 'smarty_include_vars' => array('profile' => $this->_tpl_vars['profile'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <a href="<?php echo $this->_tpl_vars['viewmemberslink']; ?>
">View all our members</a>
        </div>
     </div>
</div>