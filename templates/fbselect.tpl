<div id="main">
	<div id="content">
    	{if isset($succ)}
        <div align="center"><h1>Success</h1></div>
        <p>{$succ}</p>
        {elseif isset($inactive)}
        <div align="center"><h1>Account Pending</h1></div>
        <p>Your account is still pending activation by the administrators. Please wait until you recieve an e-mail confirming your registration before trying to log in again</p>
        {else}
    	<div align="center"><h1>Unknown User</h1></div>
        <p>
        	Thank you for logging in to {$clubname} online with your Facebook username. Facebook provides this club with the ability to notify you in even more ways and provides a better social aspect to this website.
        </p>
        <p>
        	This site detected that there is no user associated with your Facebook account. You must do this before continuing to use the website. You can either select your name from the list below or create a new user.
        </p>
        <form action="./commit/commitfbselect.php" method="post">
            <fieldset>
                <legend>Select a User</legend>
                <ol>
                    <li>{html_options name=user options=$users}</li>
                    <li><input type="submit" value="Confirm Selection"/></li>
                </ol>
            </fieldset>
        	<input type="hidden" name="uid" value="{$uid}"/>
        </form>
        <p>
        	If your name is not in that list, you can create a new user by <a href="register.php?uid={$uid}">registering</a>
        </p>
        {/if}
    </div>