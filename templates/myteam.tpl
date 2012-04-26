<div id="main">
    <div id="content">
        <div align="center"><h1>{$teamname}</h1>
        <p>
            <strong>Remaining Budget:</strong> &pound;{$budget}m
            <strong>Total Points:</strong> {$points}
            <strong>Ranking:</strong> {$position}
        </p>
        <p>
        <table class="tbl" width="100%">
        <tr>
            <th>Picture</th>
            <th>Nickname</th>
            <th>Position</th>
            <th>Value</th>
            <th>Points</th>
        </tr>
        {foreach from=$players item=player}
        <tr>
        	<td><a href="./viewprofile.php?action=view&uid={$player.id}"><img src="{$player.avatar}" alt="{$player.name}"/></a></td>
            <td><strong>{$player.name}</strong></td>
            <td>{$player.pos}</td>
            <td>{$player.value}</td>
            <td>{$player.points}</td>
        </tr>
        {/foreach}
        </table>
        </p>
        </div>
    </div>