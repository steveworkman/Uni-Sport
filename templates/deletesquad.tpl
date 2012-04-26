<div id="main">
	<div id="content">
    	<div align="center"><h1>Delete Squad</h1></div>
        <p>
        	<strong>{$squad.squad_name}</strong>
        </p>
		<p>
        	<strong>Captained By: </strong><a href="{$squad.captain_link}">{$squad.captain_name}</a>
        </p>
        <p>
        	<strong>Description: </strong>{$squad.squad_desc}
        </p>
        <p>
        	<strong>Squad: </strong>
            {foreach from=$team item=player name=player}
                <a href="{$player.link}">{$player.name}</a>{if $smarty.foreach.player.last} {else},{/if}
            {/foreach}
        </p>
        <div align="center">
        	<p>
                Would you like to delete this squad?<br />
                <em>Remember, deleting a squad only archives it. No match reports will be lost by the deletion of a squad</em>
                <form action="./commit/commitsquad.php?Action=delete" method="post">
                	<input name="yes" type="submit" value="Yes" />
                	<input name="id" type="hidden" value="{$squad.squad_id}" />
                </form>
                <form action="adminpages.php?Page=squads" method="post">
                	<input name="no" type="submit" value="No" />
                </form>
            </p>
        </div>
    </div>