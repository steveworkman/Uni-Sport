<div class="sidebarContent">
		{if $login == 'false'}
        <h3 id="loginbox" class="header">Login</h3>
        <div class="login" id="fblogin">
        	<div class="error">{$loginerror}</div>
            <a href="http://www.facebook.com/login.php?api_key={$fb_api}&amp;v=1.0&amp;next={$smarty.server.PHP_SELF}&amp;hide_checkbox=1"><img src="http://static.ak.facebook.com/images/devsite/facebook_login.gif" alt="Login with Facebook" title="Login with Facebook" /></a><br/>
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
                <input name="referrer" type="hidden" value="{$smarty.server.PHP_SELF}" /></li>
                </ul>
            </form>
        </div>
        {else}
        <h3 class="header">User Menu</h3>
        <div class="content">
            <ul>
            {foreach from=$login item=link}
            	{if $link.text != ''}
                    {if $link.pretext != ''}
                    <li><span class="red">{$link.pretext}</span><br/> <a href="{$link.link}"><span class="red"><strong>{$link.text}</strong></span></a></li>
                    {elseif $link.sep == 'sep'}
                    </ul>
                    {if $link.hidden == 0}
                    <h3 class="headerShown" id="{$link.id}">{$link.text}</h3>
                    <ul>
                    {else}
                    <h3 class="headerHidden" id="{$link.id}">{$link.text}</h3>
                    <ul style="display:none">
                    {/if}
                    {else}
                    <li><a href="{$link.link}">{$link.text}</a></li>
                    {/if}
                {/if}
            {/foreach}
            </ul>
            <ul>
            	<li><a href="forum/login.php?logout=true&amp;sid={$SID}&amp;referrer={$smarty.server.PHP_SELF}" id="logout"><strong>Log Out</strong></a></li>
            </ul>
        </div>
        {/if} 
    </div>