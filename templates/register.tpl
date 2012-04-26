<div id="main">
	<div id="content">
		<div align="center"><h1>Registration</h1></div>
  		{if isset($succ)}
        <center><h2>Registration Successful</h2></center>
        <p>
        Your registration has been submitted to an administrator for approval. If successful you shall recieve an email instructing you as to how to activate your account. For any further questions please email {mailto address=$boardemail encode=javascript}.
        </p>
        {else}
		<p>
			To register for this site, you <strong>must</strong> have a <a href="http://www.facebook.com">Facebook</a> account. Enter your details into the form and once confirmed by our administrators you can get started straight away.
		</p>
		<p>
			Old Boys/Birds can sign up to the website's email lists through this form. You will be able to upload pictures and use the forums.
		</p>
        <p>
        	Remember, the email address you give here <strong>must</strong> be the same as your facebook email address
        </p>
        <form name="signup" action="commit/commitregistration.php" method="post">
            <fieldset>
            	<legend>Details</legend>
                <ol>
                    <li><label for="username">Nickname</label><input type="text" name="username" /></li>
                	<li><label for="usrgrp">Membership Type</label><select name="usrgrp">
                        <option value="0">Member</option>
                        <option value="1">Old Boy/Bird</option>
                        </select>
                    </li>
                	<li><label for="email">Email Address</label><input type="text" name="email" /></li>
                	<li><label for="email2">Confirm Email Address</label><input type="text" name="email2" /></li>
                    <li><label for="fbid">Facebook ID</label><input type="text" name="fbid" value="{$fbid}"/></li>
                    <li><em style="font-size:80%" class="red">Your Facebook ID can be found by logging on to Facebook and going to your profile. Look at the web address, it should read &quot;profile.php?id=xxxxxxxx&quot; where xxxxxxxx is your ID</em></li>
                	<li>Please read this site's <a href="tnc.php">Terms and Conditions</a></li>
                    <li>
                    	<strong>I Agree</strong> <input name="agree" type="radio" value="1" />
         			 	<strong>I Do Not Agree</strong> <input name="agree" type="radio" value="0" checked="checked" />
                    </li>
                    <li><input name="submit" type="submit" value="Submit" /></li>
            	</ol>
            </fieldset>
        </form>
        {/if}
</div>