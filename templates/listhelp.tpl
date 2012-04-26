<div id="main">
	<div id="content">
    	<div class="center"><h1>Help Menu</h1></div>
		<table width="100%" border="0" cellpadding="2" cellspacing="2">
			{foreach from=$data item=help}
			<tr class="{cycle values="bg1,bg2"}">
				<td><strong>{$help.name}</strong><br/>
				<em>{$help.text|truncate:30}</em>
				</td>
				<td><a href="adminpages.php?Page=help&amp;action=edit&amp;id={$help.id}"><img src="./img/b_edit.png" alt="Edit Help Page"/></a> <a href="adminpages.php?Page=help&amp;action=delete&amp;id={$help.id}"><img src="./img/b_drop.png" alt="Delete Help Page"/></a></td>
			</tr>
			{foreachelse}
			<tr>
				<td colspan="2">{$error}</td>
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