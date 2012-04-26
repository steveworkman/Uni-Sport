<div id="main">
	<div id="content">
    	<div align="center"><h1>Matches</h1></div>
        <table width="100%" border="0" cellpadding="2" cellspacing="2">
            {foreach from=$matches item=match}
            <tr class="{cycle values="bg1,bg2"}">
                <td><strong>{$match->squadName}</strong> v <strong>{$match->opposition}</strong> on {$match->date|date_format} {$match->home}</td>
                <td><a href="adminpages.php?Page=matches&Action=edit&id={$match->match_id}"><img src="./img/b_edit.png" alt="Edit Match" /></a> <a href="adminpages.php?Page=matches&Action=delete&id={$match->match_id}"><img src="./img/b_drop.png" alt="Delete Match" /></a> <a href="squadstatus.php?id={$match->match_id}&height=300&width=300" class="thickbox"><img src="./img/b_select.png" alt="Squad Status" /></a></td>
            </tr>
            {foreachelse}
            <tr>
                <td>{$error}</td>
            </tr>
            {/foreach}
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
    </div>