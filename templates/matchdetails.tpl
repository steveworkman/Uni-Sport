<div id="main">
	<div id="content">
		{if $match->squad_id != ''}
		<div class="center"><h1>{$match->squadName} v {$match->opposition}</h1></div>
		<table border="0" cellspacing="2" cellpadding="2">
			<tr>
				<td><strong>Squad</strong></td>
				<td>{$match->squadName}</td>
			</tr>
			<tr>
				<td><strong>Opposition</strong></td>
				<td>{$match->opposition}</td>
			</tr>
			<tr>
				<td><strong>Home/Away</strong></td>
				<td>{$match->home}</td>
			</tr>
			<tr>
				<td><strong>Friendly?</strong></td>
				<td>{$match->friendly}</td>
			</tr>
			<tr>
				<td><strong>Meet Time</strong></td>
				<td>{$match->meettime|date_format:'%H:%M'}</td>
			</tr>
			<tr>
				<td><strong>Push Back Time</strong></td>
				<td>{$match->pushback|date_format:'%H:%M'}</td>
			</tr>
			<tr>
            <td><strong>Captain</strong></td>
            <td><a href="{$match->captain.link}">{$match->captain.name}</a></td>
        </tr>
			<tr>
				<td><strong>Squad</strong></td>
				<td>{foreach from=$squad item=squad name=squad}
                <a href="{$squad.link}">{$squad.name}</a>{if $smarty.foreach.squad.last}{else},{/if}
                {/foreach}</td>
			</tr>
		</table>
		<h2>Match Description</h2>
		<p>{$match->desc}</p>
		{else}
			<div class="center"><h1>Match Details</h1></div>
			<div class="center"><h2>No Match Selected</h2></div>
			<p>
				Oops, there's no match for that ID! Please tell the administrator.
			</p>
		{/if}
	</div>