<?php /* Smarty version 2.6.18, created on 2007-08-25 18:28:59
         compiled from editprofile.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'editprofile.tpl', 22, false),array('modifier', 'capitalize', 'editprofile.tpl', 26, false),array('function', 'html_select_date', 'editprofile.tpl', 74, false),array('function', 'html_options', 'editprofile.tpl', 78, false),)), $this); ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Edit Profile</h1></div>
        <form id="userform" action="./commit/commituser.php" method="post">
        	<?php if (isset ( $this->_tpl_vars['profile']->fb_id )): ?>
            <fieldset>
            	<legend>Facebook Details</legend>
                <ol>
                	<li>
                    <label for="userid">Nickname</label>
                    <?php echo $this->_tpl_vars['profile']->username; ?>

                    <input type="hidden" name="username" value="<?php echo $this->_tpl_vars['profile']->username; ?>
"/>
                    </li>
                    <li>
                    <label for="name">Name</label><?php echo $this->_tpl_vars['profile']->fname; ?>
 <?php echo $this->_tpl_vars['profile']->lname; ?>

                    <input name="fname" type="hidden" value="<?php echo $this->_tpl_vars['profile']->fname; ?>
" />
                    <input name="lname" type="hidden" value="<?php echo $this->_tpl_vars['profile']->lname; ?>
" />
                    <input name="fbid" type="hidden" value="<?php echo $this->_tpl_vars['profile']->fbid; ?>
"/>
                    </li>
                    <li>
                    <label for="dob">Date of Birth</label>
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['profile']->dob)) ? $this->_run_mod_handler('date_format', true, $_tmp) : smarty_modifier_date_format($_tmp)); ?>

                    </li>
                    <li>
                    <label for="sex">Sex</label>
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['profile']->getSex())) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>

                    </li>
                    <li>
					<label for="quote">Quote</label>
                    <?php echo $this->_tpl_vars['profile']->quote; ?>

					<input type="hidden" name="quote" value="<?php echo $this->_tpl_vars['profile']->quote; ?>
"/>
					</li>
                    <li>
					<label for="interests">Interests</label>
                    <?php echo $this->_tpl_vars['profile']->interests; ?>

					<input name="interests" type="hidden" value="<?php echo $this->_tpl_vars['profile']->interests; ?>
" />
					</li>
                </ol>
            </fieldset>
            <?php else: ?>
			<fieldset>
                <legend>General Settings</legend>
                <ol>
                <li>
                <div id="avatar" class="right" style="width:43%">Profile Picture<br />
                    <img src="<?php echo $this->_tpl_vars['profile']->avatar; ?>
" alt="<?php echo $this->_tpl_vars['profile']->uid; ?>
" id="avatar" />
                    <div id="iframe"><iframe height="40" width="250" scrolling="no" src="uploadavatar.php?id=<?php echo $this->_tpl_vars['profile']->uid; ?>
" frameborder="0"></iframe></div>
                    Having problems uploading your picture? <a href="memberpages.php?Page=avatar&amp;uid=<?php echo $this->_tpl_vars['profile']->uid; ?>
">Click Here</a>
                </div>
                </li>
                    <li>
                    <label for="userid">Nickname</label>
                    <?php echo $this->_tpl_vars['profile']->username; ?>

                    <input type="hidden" name="username" value="<?php echo $this->_tpl_vars['profile']->username; ?>
"/>
                    </li>
                    <li>
                    <label for="fname">First Name</label>
                    <input name="fname" type="text" value="<?php echo $this->_tpl_vars['profile']->fname; ?>
" />
                    </li>
                    <li>
                    <label for="lname">Surname</label>
                    <input name="lname" type="text" value="<?php echo $this->_tpl_vars['profile']->lname; ?>
" />
                    </li>
                    <li>
                    <label for="pass">New Password</label>
                    <input type="password" name="pass" />
                    </li>
                    <li>
                    <label for="repeatpass">Repeat Password</label>
                    <input type="password" name="repeatpass" />
                    </li>
                    <li>
                    <label for="dob">Date of Birth</label>
                    <?php echo smarty_function_html_select_date(array('prefix' => 'dob','time' => $this->_tpl_vars['profile']->dob,'start_year' => 1970), $this);?>

                    </li>
                    <li>
                    <label for="sex">Sex</label>
                    <?php echo smarty_function_html_options(array('name' => 'sex','options' => $this->_tpl_vars['sex'],'selected' => $this->_tpl_vars['profile']->male), $this);?>

                    </li>
                </ol>
            </fieldset>
            <?php endif; ?>
            <fieldset>
            	<legend>Contact Information</legend>
                <ol>
                	<li>
                    	<label for="email"><img src="./img/icon_email.gif" alt="Email Address" title="Email Address" /></label>
                        <input name="email" type="text" value="<?php echo $this->_tpl_vars['profile']->email; ?>
" />
                    </li>
                    <li>
                    	<label for="phone"><img src="./img/icon_phone.gif"alt="Phone Number" title="Phone Number" /><br/><em>(visible to committee only)</em></label>
                        <input name="phone" type="text" value="<?php echo $this->_tpl_vars['profile']->phone; ?>
" />
                    </li>
                    <li>
                    	<label for="website"><img src="./img/icon_www.gif" alt="Website Address" title="Website Address" /></label>
                		<input name="website" type="text" value="<?php echo $this->_tpl_vars['profile']->website; ?>
" />
                    </li>
                    <li>
                    	<label for="msn"><img src="./img/icon_msnm.gif" alt="MSN Messenger" title="MSN Messenger" /></label>
                		<input name="msn" type="text" value="<?php echo $this->_tpl_vars['profile']->msnm; ?>
" />
                    </li>
                    <li>
                    	<label for="yim"><img src="./img/icon_yim.gif" alt="Yahoo! Messenger" title="Yahoo! Messenger" /></label>
               			<input name="yim" type="text" value="<?php echo $this->_tpl_vars['profile']->yim; ?>
" />
                    </li>
                    <li>
                    	<label for="aol"><img src="./img/icon_aim.gif" alt="AOL Messenger" title="AOL Messenger" /></label>
                		<input name="aol" type="text" value="<?php echo $this->_tpl_vars['profile']->aim; ?>
" />
                    </li>
                    <li>
                    	<label for="icq"><img src="./img/icon_icq.gif" alt="ICQ" title="ICQ" /></label>
                		<input name="icq" type="text" value="<?php echo $this->_tpl_vars['profile']->icq; ?>
" />
                    </li>
                </ol>
            </fieldset>
            <fieldset>
            	<legend>Fantasy Hockey Settings</legend>
                <ol>
                	<li>
                        <label for="side">Favoured Playing Position</label>
                        <?php echo smarty_function_html_options(array('name' => 'side','options' => $this->_tpl_vars['sides'],'selected' => $this->_tpl_vars['profile']->side_id), $this);?>

                        <?php echo smarty_function_html_options(array('name' => 'pos','options' => $this->_tpl_vars['positions'],'selected' => $this->_tpl_vars['profile']->position_id), $this);?>

                    </li>
					<?php if ($this->_tpl_vars['admin'] == 1): ?>
					<li>
						<label for="value">Value</label>
						&pound;<input name="value" type="text" value="<?php echo $this->_tpl_vars['profile']->fh_value; ?>
" size="3" /> Million
                    </li>
					<li>
						<label for="points">Points</label>
						<input name="points" type="text" value="<?php echo $this->_tpl_vars['profile']->fh_points; ?>
" size="3" />
					</li>
					<li>
						<label for="gay">Opt-Out of Fantasy Leage</label>
						<input name="gay" type="checkbox" <?php echo $this->_tpl_vars['gay']; ?>
/>
					</li>
					<?php else: ?>
					<li>
						<label for="value">Value</label>
						&pound;<?php echo $this->_tpl_vars['profile']->value; ?>
 Million
						<input name="value" type="hidden" value="<?php echo $this->_tpl_vars['profile']->value; ?>
" size="3" />
                    </li>
					<?php endif; ?>
                </ol>
            </fieldset>
            <fieldset>
            	<legend>Other Settings</legend>
            	<ol>
                	<?php if (! isset ( $this->_tpl_vars['profile']->fb_id )): ?>
                    <li>
					<label for="quote">Quote</label>
					<textarea name="quote" rows="5" cols="20"><?php echo $this->_tpl_vars['profile']->quote; ?>
</textarea>
					</li>
                    <li>
					<label for="interests">Interests</label>
					<input name="interests" type="text" value="<?php echo $this->_tpl_vars['profile']->interests; ?>
" />
					</li>
                    <?php endif; ?>
					<li>
					<label for="sig">Forum Signature</label>
					<textarea name="sig" rows="5" cols="20"><?php echo $this->_tpl_vars['profile']->sig; ?>
</textarea>
					</li>
                    <li>
					<label for="degree">Degree</label>
					<input name="degree" type="text" value="<?php echo $this->_tpl_vars['profile']->degree; ?>
" />
					</li>
					<li>
					<label for="occupation">Occupation</label>
					<input name="occupation" type="text" value="<?php echo $this->_tpl_vars['profile']->occ; ?>
" />
					</li>
					<li>
					<label for="location">Location</label>
					<input name="location" type="text" value="<?php echo $this->_tpl_vars['profile']->location; ?>
" />
					</li>
					<li>
					<label for="cookie">Would You Like to Stay Logged in? (cookies required)</label>
					<input name="cookie" type="checkbox" <?php echo $this->_tpl_vars['cookie']; ?>
/>
					</li>
					<li>
					<label for="hidden">Hide your email address from the public?</label>
					<input name="hidden" type="checkbox" <?php echo $this->_tpl_vars['hidden']; ?>
/>
					</li>
					<?php if (admin == '1'): ?>
                	<li>
					<label for="archived">Archive this user?</label>
					<input name="archived" type="checkbox" <?php echo $this->_tpl_vars['arc']; ?>
/>
                	</li>
					<?php endif; ?>
                    <input name="id" type="hidden" value="<?php echo $this->_tpl_vars['profile']->uid; ?>
" />
                    <li>
					<input type="submit" id="Submit" value="Submit" class="button">
                    </li>
                </ol>
            </fieldset>
		</form>
    </div>