<div id="content" style="width:90%">
	<fieldset>
    	<legend>Squad Status</legend>
        <table>
        	<tr>
            	<th>Name</th>
                <th>Available</th>
            </tr>
        	{foreach from=$players item=player}
            <tr>
            	<td>{$player.name}</td>
                <td>
                	{if $player.available == '0'}
                    <span class="red">No</span>
                    {elseif $player.available == '1'}
                    <span class="brightGreen">Yes</span>
                    {else}
                    <span class="blue">Unknown</span>
                    {/if}
                </td>
            </tr>
            {/foreach}
        </table>
    </fieldset>
</div>