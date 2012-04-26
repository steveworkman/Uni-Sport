<div id="main">
	<div id="content">
    	<div align="center"><h1>Match Reports</h1></div>
        <div class="succ">{$succ}</div>
        <form action="./commit/commitmatchreport.php?Action=arc" method="post">
        	<table width="100%" border="0" cellpadding="2" cellspacing="2">
            	{foreach from=$matches item=match}
                <tr class="{cycle values="bg1,bg2"}">
                	<td><strong>{$match->squadName}</strong> v <strong>{$match->opposition}</strong> on {$match->date|date_format} {$match->home}<br />
                    <strong>Score:</strong> <em>{$match->score}</em>  {if $match->motm.name != ''}<strong>MotM:</strong> <em><a href="{$match->motm.link}">{$match->motm.name}</a></em>{/if} {if $match->dotd.name != ''}<strong>DotD:</strong>  <em><a href="{$match->dotd.link}">{$match->dotd.name}</a></em>{/if}</td>
                    <td><a href="memberpages.php?Page=matchreports&Action=edit&id={$match->id}"><img src="./img/b_edit.png" alt="Edit Match Report" /></a> <a href="memberpages.php?Page=matchreports&Action=delete&id={$match->id}"><img src="./img/b_drop.png" alt="Delete Match Report" /></a> <input type="checkbox" name="{$match->id}" {if $match->arc == 1}checked="checked"{/if}/></td>
                </tr>
                {foreachelse}
                <tr>
                	<td>{$error}</td>
                </tr>
                {/foreach}
                <tr>
                	<td>&nbsp;</td>
                    <td align="center"><input type="submit" name="Submit" value="Archive" /></td>
				</tr>
                <tr>
                	<td colspan="2">
                    {* display pagination info *}
					{paginate_prev}
					{foreach name="pag" from=$paginate.page item=page key=pagId}
						{if $page.is_current}
						<a class="current" href="{$paginate.url}&amp;next={$page.item_start}">{$page.number}</a>
						{elseif $pagId >= $paginate.page_current-2 && $pagId <= $paginate.page_current+2}
	    				<a href="{$paginate.url}&amp;next={$page.item_start}">{$page.number}</a>
						{elseif $smarty.foreach.pag.first}
						<a href="{$paginate.url}&amp;next={$page.item_start}">{$page.number}</a>...
						{elseif $smarty.foreach.pag.last}
						...<a href="{$paginate.url}&amp;next={$page.item_start}">{$page.number}</a>
						{/if}
					{/foreach}
					{paginate_next}
                    </td>
                </tr>
            </table>
            <input type="hidden" value="{$ids}" name="IDs"/>
            <input type="hidden" value="{$next}" name="next"/>
		</form>
    </div>