<?php /* Smarty version 2.6.18, created on 2009-09-02 21:27:41
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'index.tpl', 9, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "feature.tpl", 'smarty_include_vars' => array('data' => $this->_tpl_vars['data'],'matches' => $this->_tpl_vars['matches'],'bdays' => $this->_tpl_vars['birthdays'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php unset($this->_sections['news']);
$this->_sections['news']['name'] = 'news';
$this->_sections['news']['loop'] = is_array($_loop=$this->_tpl_vars['stories']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['news']['show'] = true;
$this->_sections['news']['max'] = $this->_sections['news']['loop'];
$this->_sections['news']['step'] = 1;
$this->_sections['news']['start'] = $this->_sections['news']['step'] > 0 ? 0 : $this->_sections['news']['loop']-1;
if ($this->_sections['news']['show']) {
    $this->_sections['news']['total'] = $this->_sections['news']['loop'];
    if ($this->_sections['news']['total'] == 0)
        $this->_sections['news']['show'] = false;
} else
    $this->_sections['news']['total'] = 0;
if ($this->_sections['news']['show']):

            for ($this->_sections['news']['index'] = $this->_sections['news']['start'], $this->_sections['news']['iteration'] = 1;
                 $this->_sections['news']['iteration'] <= $this->_sections['news']['total'];
                 $this->_sections['news']['index'] += $this->_sections['news']['step'], $this->_sections['news']['iteration']++):
$this->_sections['news']['rownum'] = $this->_sections['news']['iteration'];
$this->_sections['news']['index_prev'] = $this->_sections['news']['index'] - $this->_sections['news']['step'];
$this->_sections['news']['index_next'] = $this->_sections['news']['index'] + $this->_sections['news']['step'];
$this->_sections['news']['first']      = ($this->_sections['news']['iteration'] == 1);
$this->_sections['news']['last']       = ($this->_sections['news']['iteration'] == $this->_sections['news']['total']);
?>
        	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "newsStory.tpl", 'smarty_include_vars' => array('story' => $this->_tpl_vars['stories'][$this->_sections['news']['index']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endfor; endif; ?>
        <a href="news.php" style="float:right; margin:0 5px 0 0; display:block;">Looking for the news?</a>
        <div class="clear"></div>
        <div class="center"><h1><?php echo ((is_array($_tmp=@$this->_tpl_vars['title'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Information') : smarty_modifier_default($_tmp, 'Information')); ?>
</h1></div>
		<?php if ($this->_tpl_vars['text'] != ''): ?>
        	<?php echo $this->_tpl_vars['text']; ?>

        <?php else: ?>
        	<ul style="list-style:none;" class="center">
            	<?php $_from = $this->_tpl_vars['links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['link']):
?>
                <li><a href="<?php echo $this->_tpl_vars['link']['link']; ?>
"><?php echo $this->_tpl_vars['link']['text']; ?>
</a></li>
            	<?php endforeach; endif; unset($_from); ?>
            </ul>
        <?php endif; ?>
    </div>