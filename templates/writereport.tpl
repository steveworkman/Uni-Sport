<div id="main">
	<div id="content">
    	<div align="center"><h1>Write Match Report</h1></div>
        <form name="reports" action="./commit/commitmatchreport.php?Action=add" method="post" onSubmit="submitForm();">
        	<p align="center">
            <strong>Match</strong><br />
            <select id="match" name="matches">
            	{foreach from=$matches item=match}
                    {if $match->match_id == $match_id}
                    <option value="{$match->match_id}" selected="selected">{$match->squadName} v {$match->opposition} on {$match->date|date_format} {$match->home}</option>
                    {else}
                    <option value="{$match->match_id}">{$match->squadName} v {$match->opposition} on {$match->date|date_format} {$match->home}</option>
                    {/if}
                {/foreach}
            </select>
            </p>
            {if $error == ''}
            <div id="reportDetails">
            	{include file="reportdetails.tpl"}
            </div>
            {else}
            <p>
            <strong>{$error}</strong>
            </p>
            {/if}
			</form>
     </div>
