<div id="main">
	<div id="content">
    	<div align="center"><h1>Edit Profile</h1></div>
        <form id="userform" action="./commit/commituser.php" method="post">
        	{if isset($profile->fb_id)}
            <fieldset>
            	<legend>Facebook Details</legend>
                <ol>
                	<li>
                    <label for="userid">Nickname</label>
                    {$profile->username}
                    <input type="hidden" name="username" value="{$profile->username}"/>
                    </li>
                    <li>
                    <label for="name">Name</label>{$profile->fname} {$profile->lname}
                    <input name="fname" type="hidden" value="{$profile->fname}" />
                    <input name="lname" type="hidden" value="{$profile->lname}" />
                    <input name="fbid" type="hidden" value="{$profile->fbid}"/>
                    </li>
                    <li>
                    <label for="dob">Date of Birth</label>
                    {$profile->dob|date_format}
                    </li>
                    <li>
                    <label for="sex">Sex</label>
                    {$profile->getSex()|capitalize}
                    </li>
                    <li>
					<label for="quote">Quote</label>
                    {$profile->quote}
					<input type="hidden" name="quote" value="{$profile->quote}"/>
					</li>
                    <li>
					<label for="interests">Interests</label>
                    {$profile->interests}
					<input name="interests" type="hidden" value="{$profile->interests}" />
					</li>
                </ol>
            </fieldset>
            {else}
			<fieldset>
                <legend>General Settings</legend>
                <ol>
                <li>
                <div id="avatar" class="right" style="width:43%">Profile Picture<br />
                    <img src="{$profile->avatar}" alt="{$profile->uid}" id="avatar" />
                    <div id="iframe"><iframe height="40" width="250" scrolling="no" src="uploadavatar.php?id={$profile->uid}" frameborder="0"></iframe></div>
                    Having problems uploading your picture? <a href="memberpages.php?Page=avatar&amp;uid={$profile->uid}">Click Here</a>
                </div>
                </li>
                    <li>
                    <label for="userid">Nickname</label>
                    {$profile->username}
                    <input type="hidden" name="username" value="{$profile->username}"/>
                    </li>
                    <li>
                    <label for="fname">First Name</label>
                    <input name="fname" type="text" value="{$profile->fname}" />
                    </li>
                    <li>
                    <label for="lname">Surname</label>
                    <input name="lname" type="text" value="{$profile->lname}" />
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
                    {html_select_date prefix='dob' time=$profile->dob start_year=1970}
                    </li>
                    <li>
                    <label for="sex">Sex</label>
                    {html_options name=sex options=$sex selected=$profile->male}
                    </li>
                </ol>
            </fieldset>
            {/if}
            <fieldset>
            	<legend>Contact Information</legend>
                <ol>
                	<li>
                    	<label for="email"><img src="./img/icon_email.gif" alt="Email Address" title="Email Address" /></label>
                        <input name="email" type="text" value="{$profile->email}" />
                    </li>
                    <li>
                    	<label for="phone"><img src="./img/icon_phone.gif"alt="Phone Number" title="Phone Number" /><br/><em>(visible to committee only)</em></label>
                        <input name="phone" type="text" value="{$profile->phone}" />
                    </li>
                    <li>
                    	<label for="website"><img src="./img/icon_www.gif" alt="Website Address" title="Website Address" /></label>
                		<input name="website" type="text" value="{$profile->website}" />
                    </li>
                    <li>
                    	<label for="msn"><img src="./img/icon_msnm.gif" alt="MSN Messenger" title="MSN Messenger" /></label>
                		<input name="msn" type="text" value="{$profile->msnm}" />
                    </li>
                    <li>
                    	<label for="yim"><img src="./img/icon_yim.gif" alt="Yahoo! Messenger" title="Yahoo! Messenger" /></label>
               			<input name="yim" type="text" value="{$profile->yim}" />
                    </li>
                    <li>
                    	<label for="aol"><img src="./img/icon_aim.gif" alt="AOL Messenger" title="AOL Messenger" /></label>
                		<input name="aol" type="text" value="{$profile->aim}" />
                    </li>
                    <li>
                    	<label for="icq"><img src="./img/icon_icq.gif" alt="ICQ" title="ICQ" /></label>
                		<input name="icq" type="text" value="{$profile->icq}" />
                    </li>
                </ol>
            </fieldset>
            <fieldset>
            	<legend>Fantasy Hockey Settings</legend>
                <ol>
                	<li>
                        <label for="side">Favoured Playing Position</label>
                        {html_options name=side options=$sides selected=$profile->side_id}
                        {html_options name=pos options=$positions selected=$profile->position_id}
                    </li>
					{if $admin == 1}
					<li>
						<label for="value">Value</label>
						&pound;<input name="value" type="text" value="{$profile->fh_value}" size="3" /> Million
                    </li>
					<li>
						<label for="points">Points</label>
						<input name="points" type="text" value="{$profile->fh_points}" size="3" />
					</li>
					<li>
						<label for="gay">Opt-Out of Fantasy Leage</label>
						<input name="gay" type="checkbox" {$gay}/>
					</li>
					{else}
					<li>
						<label for="value">Value</label>
						&pound;{$profile->value} Million
						<input name="value" type="hidden" value="{$profile->value}" size="3" />
                    </li>
					{/if}
                </ol>
            </fieldset>
            <fieldset>
            	<legend>Other Settings</legend>
            	<ol>
                	{if !isset($profile->fb_id)}
                    <li>
					<label for="quote">Quote</label>
					<textarea name="quote" rows="5" cols="20">{$profile->quote}</textarea>
					</li>
                    <li>
					<label for="interests">Interests</label>
					<input name="interests" type="text" value="{$profile->interests}" />
					</li>
                    {/if}
					<li>
					<label for="sig">Forum Signature</label>
					<textarea name="sig" rows="5" cols="20">{$profile->sig}</textarea>
					</li>
                    <li>
					<label for="degree">Degree</label>
					<input name="degree" type="text" value="{$profile->degree}" />
					</li>
					<li>
					<label for="occupation">Occupation</label>
					<input name="occupation" type="text" value="{$profile->occ}" />
					</li>
					<li>
					<label for="location">Location</label>
					<input name="location" type="text" value="{$profile->location}" />
					</li>
					<li>
					<label for="cookie">Would You Like to Stay Logged in? (cookies required)</label>
					<input name="cookie" type="checkbox" {$cookie}/>
					</li>
					<li>
					<label for="hidden">Hide your email address from the public?</label>
					<input name="hidden" type="checkbox" {$hidden}/>
					</li>
					{if admin == '1'}
                	<li>
					<label for="archived">Archive this user?</label>
					<input name="archived" type="checkbox" {$arc}/>
                	</li>
					{/if}
                    <input name="id" type="hidden" value="{$profile->uid}" />
                    <li>
					<input type="submit" id="Submit" value="Submit" class="button">
                    </li>
                </ol>
            </fieldset>
		</form>
    </div>