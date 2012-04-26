<div id="main">
	<div id="content">
    	<div align="center"><h1>League Table</h1></div>
        	{if $error == ''}
        	<table width="100%">
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Manager</th>
                    <th>Points</th>
                </tr>
                {foreach from=$data item=team}
                <tr>
                	<td><strong>{$team.rank}</strong></td>
                    <td><a href="{$team.team_link}">{$team.team_name}</a></td>
                    <td><a href="{$team.user_link}">{$team.user_name}</a></td>
                    <td>{$team.points}</td>
                </tr>
                {/foreach}
                <tr>
                	<td colspan="4">&nbsp;</td>
                </tr>
                <tr>
                	<td colspan="4">
                    {* display pagination info *}
    				{paginate_middle}
                    </td>
                </tr>
            </table>
            {else}
            <p>
            	<div class="error">{$error}</div>
            </p>
            {/if}
    </div>