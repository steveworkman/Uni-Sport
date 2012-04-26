<div id="main">
	<div id="content">
    	<div align="center"><h1>{$pageTitle}</h1></div>
        <form action="{$formLink}" method="post">
        	<table width="100%" border="0" cellpadding="2" cellspacing="2">
            	{foreach from=$data item=nl}
                <tr class="{cycle values="bg1,bg2"}">
                	<td><strong>{$nl.title}</strong><br/>
                    <em>Uploaded by <a href="./viewprofile.php?action=view&amp;uid={$nl.author_id}">{$nl.author}</a></em>
                    </td>
                    <td><a href="adminpages.php?Page=newslettermenu&Action=edit&id={$nl.id}"><img src="./img/b_edit.png" alt="Edit Newsletter"/></a> <a href="adminpages.php?Page=newslettermenu&Action=delete&id={$nl.id}"><img src="./img/b_drop.png" alt="Delete Newsletter"/></a> <input type="checkbox" name="{$nl.id}" {if $nl.arc == 1}checked="checked"{/if}/></td></td>
                </tr>
                {foreachelse}
                <tr>
                	<td colspan="2">You have not uploaded any newsletters yet</td>
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
		</form>
    </div>