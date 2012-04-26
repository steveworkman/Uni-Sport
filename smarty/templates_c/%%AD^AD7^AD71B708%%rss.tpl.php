<?php /* Smarty version 2.6.18, created on 2007-08-31 10:56:24
         compiled from rss.tpl */ ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>RSS Feeds</h1></div>
        <h2>What is RSS?</h2>
        <p>
            RSS stands for Really Simple Syndication and is a quick and easy way of keeping up with events happening on your favorite websites. 
            RSS feeds can be read by RSS Readers (external pieces of software) or by modern internet browsers (like Mozilla FireFox) and supply 
            a list of links that are dynamically updated by the website as new content is added.
        </p>
        <h2>How do I get these feeds?</h2>
        <p>
            Point your RSS Reader to one of the links below and it will start picking up the feed. For FireFox, Opera, IE7 and Safari users, click the orange button in the address bar and select the correct feed.
        </p>
        <h2>What feeds do you supply?</h2>
        <p>
        	<?php $_from = $this->_tpl_vars['feeds']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['rss'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['rss']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['feed']):
        $this->_foreach['rss']['iteration']++;
?>
            <?php if (($this->_foreach['rss']['iteration'] <= 1)): ?><?php echo $this->_tpl_vars['clubname']; ?>
 currently supplies the following feeds:
            <ul style="list-style:none; padding-left:10px">
            <?php endif; ?>
            	<li><a href="<?php echo $this->_tpl_vars['feed']['link']; ?>
" title="<?php echo $this->_tpl_vars['feed']['title']; ?>
"><?php echo $this->_tpl_vars['feed']['title']; ?>
</a></li>
            <?php if (($this->_foreach['rss']['iteration'] == $this->_foreach['rss']['total'])): ?>
            </ul>
            <?php endif; ?>
            <?php endforeach; else: ?>
            There are no feeds available for this site
            <?php endif; unset($_from); ?>
        </p>
    </div>