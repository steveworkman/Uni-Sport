<?php /* Smarty version 2.6.18, created on 2007-08-18 03:44:43
         compiled from addmember.tpl */ ?>
<div id="main">
	<div id="content">
    	<div align="center"><h1>Add Member</h1></div>
        <p>
        	This page lets you add a member without going throught the tedious process of approving and sending emails out. Simply enter the details below and an email will be sent for them to confirm their email address. The password given is the default issued for this website (hockey).
        </p>
        <div class="error"><?php echo $this->_tpl_vars['error']; ?>
</div>
        <div class="succ"><?php echo $this->_tpl_vars['succ']; ?>
</div>
        	<form name="signup" action="commit/commitmanagemembers.php?action=add" method="post">
                <fieldset>
                	<legend>Member Details</legend>
                    <ol>
                    	<li><label for="nickname">Nickname</label><input type="text" name="nickname" /></li>
                        <li><label for="firstname">First Name</label><input type="text" name="firstname" /></li>
                        <li><label for="lastname">Last Name</label><input type="text" name="lastname" /></li>
                        <li><label for="sex">Sex</label><select name="sex"><option value="0">Female</option><option value="1">Male</option></select></li>
                        <li><label for="email">Email Address</label><input type="text" name="email"/></li>
                    </ol>
                    <p>
                   		<input type="submit" name="submit" value="Submit" />
                    </p>
                </fieldset>
            </form>
    </div>