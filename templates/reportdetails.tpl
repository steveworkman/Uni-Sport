{if $error == ''}
<p align="center">
    <strong>Score</strong><br />
    <strong>Home</strong>: <input name="hscore" type="text" size="3" value="{$match->hscore}"/>
    <strong>Opposition</strong>: <input name="oscore" type="text" size="3" value="{$match->oscore}"/>
</p>
<fieldset style="width:50%">
    <legend>Scorers</legend>
    <table>
    <tr>
        <td width="50%">
            <select name="members" size=10>
                {foreach from=$squad item=player}
                <option value="{$player.id}">{$player.name}</option>
                {/foreach}
            </select>
        </td>
        <td width="15%"><input type="button" name="add" value="&gt;"  onClick="addItScorer();" />
            <input name="Remove" type="button" value="&lt;" onClick="removeItScorer();" />
        </td>
        <td width="35%">
            <select name="squ" size=10 multiple id="squ">
           		{foreach from=$scorers item=player}
                <option value="{$player.id}">{$player.name}</option>
                {/foreach}
            </select>
        </td>
    </tr>
    </table>
</fieldset>
<div style="width:50%; float:left">
<fieldset>
	<legend>Yellow Cards</legend>
    <table>
    <tr>
        <td width="50%">
            <select name="members2" size=10>
                {foreach from=$ycardsquad item=player}
                <option value="{$player.id}">{$player.name}</option>
                {/foreach}
            </select>
        </td>
        <td width="15%">
            <input type="button" name="add" value="&gt;"  onClick="addItYCard();" />
            <input name="Remove" type="button" value="&lt;" onClick="removeItYCard();" />
        </td>
        <td width="35%">
            <select name="ycard" size=10 multiple id="ycard">
            	{foreach from=$ycards item=player}
                <option value="{$player.id}">{$player.name}</option>
                {/foreach}
            </select>
        </td>
	</tr>
    </table>
</fieldset>
</div>
<div style="width:50%; float:right">
<fieldset>
	<legend>Red Cards</legend>
    <table>
    <tr>
        <td width="50%">
            <select name="members3" size=10>
                {foreach from=$rcardsquad item=player}
                <option value="{$player.id}">{$player.name}</option>
                {/foreach}
            </select>
        </td>
        <td width="15%">
            <input type="button" name="add" value="&gt;"  onClick="addItRCard();" />
            <input name="Remove" type="button" value="&lt;" onClick="removeItRCard();" />
        </td>
        <td width="35%">
            <select name="rcard" size=10 multiple id="rcard">
            	{foreach from=$rcards item=player}
                <option value="{$player.id}">{$player.name}</option>
                {/foreach}
            </select>
        </td>
    </tr>
    </table>
</fieldset>
</div>
<p align="center" style="clear:both">
    <strong>Man of the Match:</strong>
    <select name="motm">
        <option value="0">-------</option>
        {foreach from=$squad item=player}
            {if $match->motm.id == $player.id}
            <option value="{$player.id}" selected="selected">{$player.name}</option>
            {else}
            <option value="{$player.id}">{$player.name}</option>
            {/if}
        {/foreach}
    </select>
    <strong>Dick of the Day:</strong>
    <select name="dotd">
        <option value="0">-------</option>
        {foreach from=$squad item=player}
        	{if $match->dotd.id == $player.id}
            <option value="{$player.id}" selected="selected">{$player.name}</option>
            {else}
            <option value="{$player.id}">{$player.name}</option>
            {/if}
        {/foreach}
    </select><br /><br />
    <strong>Match Report</strong><br />
    <textarea name="report" cols="40" rows="15">{$match->report}</textarea><br />
    
    <input name="scorers" type="hidden" value = " " />
    <input name="ycards" type="hidden" value = " " />
    <input name="rcards" type="hidden" value = " " />
    <input name="id" type="hidden" value="{$match->match_id}"/>
    <input name="reportid" type="hidden" value="{$match->id}"/>
    <input name="submit" type="submit" value="Submit" />
</p>
{else}
<p>
	{$error}
</p>
{/if}