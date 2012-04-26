<div id="main">
	<div id="content">
    	<div class="center"><h1>Add Album</h1></div>
        {if isset($error)}
        <div class="error">{$error}</div>
        {/if}
        <p>
        	This is the first step in creating a picture album. Give it a name and a type then click next!<br/>
            Remember: Albums of the type 'Event' or 'Match' can be edited by anyone
        </p>
        <form action="./commit/commitalbum.php?action=add" method="post">
        <fieldset>
        	<legend>Album Details</legend>
            <ol>
            	<li><label for="name">Album Name</label><input type="text" name="name"/></li>
                <li><label for="type">Album Type</label>{html_options name="type" options=$types}</li>
                <li><input type="submit" value="Next" /></li>
            </ol>
        </fieldset>
        </form>
    </div>