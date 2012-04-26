<div id="main">
	<div id="content">
    	<div class="center"><h1>{$pageTitle}</h1></div>
        <form action="{$formLink}" method="post">
        	<table width="100%" border="0" cellpadding="2" cellspacing="2">
            	{foreach from=$data item=story}
                <tr class="{cycle values="bg1,bg2"}">
                	<td><strong>{$story.headline}</strong><br/><em>By <a href="./viewprofile.php?action=view&amp;uid={$story.author_id}">{$story.author}</a></em>
                    </td>
                    <td><a href="adminpages.php?Page={$page}&Action=edit&id={$story.id}"><img src="./img/b_edit.png" alt="Edit Story"/></a> <a href="adminpages.php?Page={$page}&Action=delete&id={$story.id}"><img src="./img/b_drop.png" alt="Delete Story"/></a> <input type="checkbox" name="{$story.id}" {if $story.arc == 1}checked="checked"{/if}/></td>
                </tr>
                {foreachelse}
                <tr>
                	<td colspan="2">{$error}</td>
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
            <input type="hidden" value="{$next}" name="next" />
		</form>
        
    </div>