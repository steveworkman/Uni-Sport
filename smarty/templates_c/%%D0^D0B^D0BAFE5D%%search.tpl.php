<?php /* Smarty version 2.6.18, created on 2007-08-30 17:23:06
         compiled from search.tpl */ ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Search Results</h1></div>
        <?php if (! isset ( $this->_tpl_vars['nostr'] )): ?>
        <?php $_from = $this->_tpl_vars['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['list']):
?>
        <h2><?php echo $this->_tpl_vars['list'][0]; ?>
</h2>
        <p>
        	<?php $_from = $this->_tpl_vars['list'][1]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['search'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['search']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['search']['iteration']++;
?>
            <?php if (($this->_foreach['search']['iteration'] <= 1)): ?><ul style="list-style:none; margin-left:10px"><?php endif; ?>
            <li><a href="<?php echo $this->_tpl_vars['item']['link']; ?>
"><?php echo $this->_tpl_vars['item']['name']; ?>
</a>
            <?php if (($this->_foreach['search']['iteration'] == $this->_foreach['search']['total'])): ?></ul><?php endif; ?>
            <?php endforeach; else: ?>
            There are no results for that search. Please try again
            <?php endif; unset($_from); ?>
        </p>
        <?php endforeach; else: ?>
        <p>
        	No results in this category
        </p>
        <?php endif; unset($_from); ?>
        <?php else: ?>
        <p class="center">
        	You've not entered a query, please use the box below to do so.
        </p>
        <p>
        	<form action="search.php" method="get" class="center">
            <input type="text" name="search"/>
            <input type="submit" value="Search"/>
            </form>
        </p>
        <?php endif; ?>
    </div>