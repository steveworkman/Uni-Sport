{if $report->match_id != ''}
<p>
    <table border="0" cellspacing="3" cellpadding="3" width="100%">
        <tr>
            <td align="center" colspan="2">
            <strong>{$report->squadName} v {$report->opposition} {$report->friendly}</strong>
            </td>
        </tr>
        <tr>
            <td>{$report->home} on {$report->date|date_format}</td>
            <td>at {$report->time|date_format:'%H:%M'}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>Squad</strong></td>
        </tr>
        <tr>
            <td colspan="2">{foreach from=$squad item=squad name=squad}
                <a href="{$squad.link}">{$squad.name}</a>{if $smarty.foreach.squad.last}{else},{/if}
                {/foreach}</td>
        </tr>
        <tr>
            <td><strong>Score</strong></td>
            <td>{$report->score}</td>
        </tr>
        <tr>
            <td width="50%"><strong>Scorers</strong></td>
            <td>
                {foreach from=$scorers item=scorers name=scorers}
                <a href="{$scorers.link}">{$scorers.name}</a>{if $smarty.foreach.scorers.last}{else},{/if}
                {/foreach}
            </td>
        </tr>
        {if $ycards[0] != ''}
        <tr>
            <td><strong>Yellow Cards</strong></td>
            <td>{foreach from=$ycards item=ycards name=ycards}
                <a href="{$ycards.link}">{$ycards.name}</a>{if $smarty.foreach.ycards.last}{else},{/if}
                {/foreach}
            </td>
        </tr>
       {/if}
       {if $rcards[0] != ''}
        <tr>
            <td><strong>Red Cards</strong></td>
            <td>{foreach from=$rcards item=rcards name=rcards}
                <a href="{$rcards.link}">{$rcards.name}</a>{if $smarty.foreach.rcards.last}{else},{/if}
                {/foreach}
            </td>
        </tr>
        {/if}
        <tr>
            <td><strong>Captain</strong></td>
            <td><a href="{$report->captain.link}">{$report->captain.name}</a></td>
        </tr>
        <tr>
            <td><strong>Man of the Match</strong></td>
            <td><a href="{$report->motm.link}">{$report->motm.name}</a></td>
        </tr>
        <tr>
            <td><strong>Dick of the Day</strong></td>
            <td><a href="{$report->dotd.link}">{$report->dotd.name}</a></td>
        </tr>
        <tr>
            <td><strong>Written By</strong></td>
            <td><a href="{$report->author.link}">{$report->author.name}</a></td>
        </tr>
     </table>
 </p>
 <p>
    {$report->report}
 </p>
 {else}
 	<div align="center"><h2>No Match Report</h2></div>
 	<p>
 		Oops, this match does not exist or no match report has been written! Tell the administrator.
 	</p>
 {/if}