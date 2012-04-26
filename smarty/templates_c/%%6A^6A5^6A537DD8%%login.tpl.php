<?php /* Smarty version 2.6.18, created on 2009-09-02 20:33:24
         compiled from login.tpl */ ?>
<div class="sidebarContent">
		<?php if ($this->_tpl_vars['login'] == 'false'): ?>
        <h3 id="loginbox" class="header">Login</h3>
        <div class="login" id="fblogin">
        	<div class="error"><?php echo $this->_tpl_vars['loginerror']; ?>
</div>
            <a href="http://www.facebook.com/login.php?api_key=<?php echo $this->_tpl_vars['fb_api']; ?>
&amp;v=1.0&amp;next=<?php echo $_SERVER['PHP_SELF']; ?>
&amp;hide_checkbox=1"><img src="http://static.ak.facebook.com/images/devsite/facebook_login.gif" alt="Login with Facebook" title="Login with Facebook" /></a><br/>
            <ul><li style="font-size:80%;"><a href="#" id="changelogin">Show/Hide old login</a></li></ul>
        </div>
        <div class="nodisplay" id="oldlogin">
        	<form action="forum/login.php" method="post">
            	<ul>
                <li><label for="username">Username</label>
                <input id="username" type="text" name="username" /></li>
                <li><label for="password">Password</label>
                <input id="password" type="password" name="password" /></li>
                <li><input type="submit" name="submit" value="Login" />
                <input name="login" type="hidden" value="login" />
                <input name="referrer" type="hidden" value="<?php echo $_SERVER['PHP_SELF']; ?>
" /></li>
                </ul>
            </form>
        </div>
        <?php else: ?>
        <h3 class="header">User Menu</h3>
        <div class="content">
            <ul>
            <?php $_from = $this->_tpl_vars['login']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['link']):
?>
            	<?php if ($this->_tpl_vars['link']['text'] != ''): ?>
                    <?php if ($this->_tpl_vars['link']['pretext'] != ''): ?>
                    <li><span class="red"><?php echo $this->_tpl_vars['link']['pretext']; ?>
</span><br/> <a href="<?php echo $this->_tpl_vars['link']['link']; ?>
"><span class="red"><strong><?php echo $this->_tpl_vars['link']['text']; ?>
</strong></span></a></li>
                    <?php elseif ($this->_tpl_vars['link']['sep'] == 'sep'): ?>
                    </ul>
                    <?php if ($this->_tpl_vars['link']['hidden'] == 0): ?>
                    <h3 class="headerShown" id="<?php echo $this->_tpl_vars['link']['id']; ?>
"><?php echo $this->_tpl_vars['link']['text']; ?>
</h3>
                    <ul>
                    <?php else: ?>
                    <h3 class="headerHidden" id="<?php echo $this->_tpl_vars['link']['id']; ?>
"><?php echo $this->_tpl_vars['link']['text']; ?>
</h3>
                    <ul style="display:none">
                    <?php endif; ?>
                    <?php else: ?>
                    <li><a href="<?php echo $this->_tpl_vars['link']['link']; ?>
"><?php echo $this->_tpl_vars['link']['text']; ?>
</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
            </ul>
            <ul>
            	<li><a href="forum/login.php?logout=true&amp;sid=<?php echo $this->_tpl_vars['SID']; ?>
&amp;referrer=<?php echo $_SERVER['PHP_SELF']; ?>
" id="logout"><strong>Log Out</strong></a></li>
            </ul>
        </div>
        <?php endif; ?> 
    </div>