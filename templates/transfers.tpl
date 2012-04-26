<div id="main">
	<div id="content">
    	<div align="center"><h1>Transfers</h1></div>
        {if $error == ''}
        <p>
        This screen allows you to change players in your team, provided you have the funds of course. You have <strong>{$transfers}</strong> transfers remaining this season so use them wisely
        </p>
        <p>
		<strong>Remaining Budget:</strong> <span style="color:red">&pound;{$budget}m</span>
		</p>
        <p>
		Select a player to transfer
		<table class="tbl" width="100%">
            <tr>
                <th>Picture</th>
                <th>Nickname</th>
                <th>Position</th>
                <th>Value</th>
                <th>Points</th>
                <th>&nbsp;</th>
            </tr>
            {foreach from=$data item=player}
            <tr>
                <td><a href="{$player.user_link}"><img src="{$player.user_avatar}" alt="{$player.user_name}"/></a></td>
                <td><a href="{$player.user_link}">{$player.user_name}</a></td>
                <td>{$player.pos}</td>
                <td>{$player.value}</td>
                <td>{$player.points}</td>
                <td>
                <a href="./fhockey.php?Page=transfers&pg=2&tid={$player.tid}&pid={$player.uid}&pos={$player.posid}">Transfer Me</a>
                </td>
            </tr>
            {/foreach}
        </table>
        </p>
        {else}
        	<div class="error">{$error}</div>
        {/if}
    </div>