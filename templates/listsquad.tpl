<div id="main">
	<div id="content">
    	<div align="center"><h1>Squad Menu</h1></div>
        <p>
        	To <strong>"archive"</strong> a squad, simply <strong>delete</strong> it
        </p>
        <table>
        	{foreach from=$squads item=squad}
            <tr class="{cycle values="bg1,bg2"}">
            	<td><strong>{$squad.squad_name}</strong><br/>Captained by <a href="{$squad.captain_link}">{$squad.captain_name}</td>
       			<td>
                	<a href="adminpages.php?Page=squads&Action=edit&id={$squad.squad_id}"><img src="./img/b_edit.png" alt="Edit Squad" /></a><a href="adminpages.php?Page=squads&Action=delete&id={$squad.squad_id}"><img src="./img/b_drop.png" alt="Delete Squad" /></a>
                </td>
            </tr>
            {foreachelse}
            <tr>
            	<td colspan="2">
                	You have not created a squad yet. Use the link on the right to create one
                </td>
            </tr>
            {/foreach}
        </table>
    </div>