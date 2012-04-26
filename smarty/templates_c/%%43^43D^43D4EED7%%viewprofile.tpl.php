<?php /* Smarty version 2.6.18, created on 2007-12-23 18:10:45
         compiled from viewprofile.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'viewprofile.tpl', 7, false),array('modifier', 'date_format', 'viewprofile.tpl', 24, false),array('modifier', 'capitalize', 'viewprofile.tpl', 28, false),array('function', 'mailto', 'viewprofile.tpl', 82, false),)), $this); ?>
<div id="main">
	<div id="content">
        <div align="center"><h1>Member Details</h1></div>
        <?php if (isset ( $this->_tpl_vars['profile']->fb_error )): ?>
        <div class="error"><?php echo $this->_tpl_vars['profile']->fb_error; ?>
</div>
        <?php endif; ?>
        <img src="<?php echo ((is_array($_tmp=@$this->_tpl_vars['profile']->avatar)) ? $this->_run_mod_handler('default', true, $_tmp, './img/avatar.jpg') : smarty_modifier_default($_tmp, './img/avatar.jpg')); ?>
" alt="<?php echo $this->_tpl_vars['profile']->username; ?>
" class="avatar" />
        <div class="left" style="width:72%;" >
        <table style="margin-left:10px; width: 100%;">
            <?php if (isset ( $this->_tpl_vars['profile']->fb_id )): ?>
            <?php if ($this->_tpl_vars['profile']->fb_friend == 1): ?><tr><th colspan="2" class="succ"><?php echo $this->_tpl_vars['profile']->username; ?>
 is your friend!</th></tr><?php else: ?><tr><th colspan="2"><a href="http://www.facebook.com/addfriend.php?id=<?php echo $this->_tpl_vars['profile']->fb_id; ?>
">Add <?php echo $this->_tpl_vars['profile']->username; ?>
 as your friend</a></th></tr><?php endif; ?>
            <?php endif; ?>
            <tr><th colspan="2" align="left">General Details</th></tr>
                <tr>
                    <td>Nickname</td>
                    <td><?php echo $this->_tpl_vars['profile']->username; ?>
</td>
                </tr>
                <tr>
                    <td>Real Name</td>
                    <td><?php echo $this->_tpl_vars['profile']->fname; ?>
 <?php echo $this->_tpl_vars['profile']->lname; ?>
</td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['profile']->dob)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                </tr>
                <tr>
                    <td>Sex</td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['profile']->getSex())) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</td>
                </tr>
                <tr>
                    <td>Quote</td>
                    <td><?php echo $this->_tpl_vars['profile']->quote; ?>
</td>
                </tr>
                <tr>
                    <td>Degree</td>
                    <td><?php echo $this->_tpl_vars['profile']->degree; ?>
</td>
                </tr>
                <tr>
                    <td>Location</td>
                    <td><?php echo $this->_tpl_vars['profile']->location; ?>
</td>
                </tr>
                <tr>
                    <td>Interests</td>
                    <td><?php echo $this->_tpl_vars['profile']->interests; ?>
</td>
                </tr>
                <tr>
                    <td>Occupation</td>
                    <td><?php echo $this->_tpl_vars['profile']->occ; ?>
</td>
                </tr>
                <tr>
                    <td>Favoured Position</td>
                    <td><?php echo $this->_tpl_vars['profile']->side; ?>
 <?php echo $this->_tpl_vars['profile']->position; ?>
</td>
                </tr>
                <tr><td colspan="2">&nbsp;</td></tr>
            <tr><th colspan="2" align="left">Fantasy Hockey Details</th></tr>
                <tr>
                    <td>Value</td>
                    <td>&pound;<?php echo $this->_tpl_vars['profile']->fh_value; ?>
 Million</td>
                </tr>
                <tr>
                    <td>Current Points</td>
                    <td><?php echo $this->_tpl_vars['profile']->fh_points; ?>
</td>
                </tr>
                <tr>
                    <td>Owner of...</td>
                    <td><a href="<?php echo $this->_tpl_vars['profile']->fh_team['link']; ?>
"><?php echo $this->_tpl_vars['profile']->fh_team['name']; ?>
</a></td>
                </tr>
                <tr><td colspan="2">&nbsp;</td></tr>
            <tr><th colspan="2" align="left">Forum Details</th></tr>
                <tr>
                    <td>Date Registered</td>
                    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['profile']->regdate)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>
</td>
                </tr>
                <tr>
                    <td>Post Count</td>
                    <td><?php echo $this->_tpl_vars['profile']->posts; ?>
</td>
                </tr>
                <tr><td colspan="2">&nbsp;</td></tr>
            <tr><th colspan="2" align="left">Contact Details</th></tr>
                <tr>
                    <td><img src="./img/icon_email.gif" border="0" alt="Email Address" title="Email Address" /></td>
                    <td><?php echo smarty_function_mailto(array('address' => $this->_tpl_vars['profile']->email,'encode' => 'javascript'), $this);?>
</td>
                </tr>
                <?php if ($this->_tpl_vars['profile']->website != ''): ?>
                <tr>
                    <td><img src="./img/icon_www.gif" border="0" alt="Website Address" title="Website Address" /></td>
                    <td><a href="<?php echo $this->_tpl_vars['profile']->website; ?>
"><?php echo $this->_tpl_vars['profile']->website; ?>
</a></td>
                </tr>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['profile']->msnm != ''): ?>
                <tr>
                    <td><img src="./img/icon_msnm.gif" border="0" alt="MSN Messenger" title="MSN Messenger" /></td>
                    <td><?php echo $this->_tpl_vars['profile']->msnm; ?>
</td>
                </tr>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['profile']->aim != ''): ?>
                <tr>
                    <td><img src="./img/icon_aim.gif" border="0" alt="AOL Messenger" title="AOL Messenger" /></td>
                    <td><?php echo $this->_tpl_vars['profile']->aim; ?>
</td>
                </tr>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['profile']->yim != ''): ?>
                <tr>
                    <td><img src="./img/icon_yim.gif" border="0" alt="Yahoo! Messenger" title="Yahoo! Messenger" /></td>
                    <td><?php echo $this->_tpl_vars['profile']->yim; ?>
</td>
                </tr>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['profile']->icq != ''): ?>
                <tr>
                    <td><img src="./img/icon_icq.gif" border="0" alt="ICQ" title="ICQ" /></td>
                    <td><?php echo $this->_tpl_vars['profile']->icq; ?>
</td>
                </tr>
                <?php endif; ?>
                <?php if ($this->_tpl_vars['profile']->phone != ''): ?>
                <tr>
                    <td><img src="./img/icon_phone.gif" border="0" alt="Phone" title="Phone" /></td>
                    <td><?php echo $this->_tpl_vars['profile']->phone; ?>
</td>
                </tr>
                <?php endif; ?>
            </table>
			</div>
            <div class="clear">
            <p align="center">
            	<a href="./gallery.php?uid=<?php echo $this->_tpl_vars['profile']->uid; ?>
">See more pictures of me</a>
            </p>
            <?php if (isset ( $this->_tpl_vars['profile']->fb_id )): ?>
             <p align="center">
             	<a href="http://www.facebook.com/profile.php?id=<?php echo $this->_tpl_vars['profile']->fb_id; ?>
">View this profile on Facebook</a><br/>
             	<a href="http://www.facebook.com/profile.php?id=<?php echo $this->_tpl_vars['profile']->fb_id; ?>
"><img src="http://static.ak.facebook.com/images/go_home.gif" alt="Profile provided by Facebook"/></a>
            </p>
            
            <?php endif; ?>
    	</div>
    </div>