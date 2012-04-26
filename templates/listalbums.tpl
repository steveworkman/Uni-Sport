<div id="main">
	<div id="content">
    	<div align="center"><h1>Pictures</h1></div>
        {if isset($succ)}
        <div class="succ">{$succ}</div>
        {/if}
        <p>
        	Select an album to add pictures to or click the link on the right to create a new album!
        </p>
        <fieldset>
        	<legend>Personal Albums</legend>
            {foreach name=useralbum from=$useralbums item=album}
            {if $smarty.foreach.useralbum.first}
            <table>
            	<tr>
                	<th>Album Name</th><th>Picture Count</th><th>Created On</th><th>Created By</th><th>&nbsp;</th>
                </tr>
            {/if}
                <tr>
                    <td>{$album.album_name}</td>
                    <td>{$album.pic_count}</td>
                    <td>{$album.date|date_format}</td>
                    <td><a href="./viewprofile.php?action=view&uid={$album.user_id}">{$album.username}</a></td>
                    <td>
                    	<a href="memberpages.php?Page=picmenu&Action=upload&id={$album.id}"><img src="./img/add.png" alt="Add to this album"/></a>
                    	<a href="memberpages.php?Page=picmenu&Action=edit&id={$album.id}"><img src="./img/b_edit.png" alt="Edit this album"/></a>
                        <a href="memberpages.php?Page=picmenu&Action=delete&id={$album.id}"><img src="./img/b_drop.png" alt="Delete this album"/></a>
                    </td>
                </tr>
            {if $smarty.foreach.useralbum.last}
            	<tr>
                	<td colspan="4">
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
            {/if}
            {foreachelse}
            <p>
            	You don't have any personal albums yet. Click the link on the right to create one!
            </p>
            {/foreach}
        </fieldset>
        <fieldset>
        	<legend>Event Albums</legend>
            {foreach name=eventalbum from=$eventalbums item=album}
            {if $smarty.foreach.eventalbum.first}
            <table>
            	<tr>
                	<th>Album Name</th><th>Picture Count</th><th>Created On</th><th>Created By</th><th>&nbsp;</th>
                </tr>
            {/if}
                <tr>
                    <td>{$album.album_name}</td>
                    <td>{$album.pic_count}</td>
                    <td>{$album.date|date_format}</td>
                    <td>Auto-generated</td>
                    <td>
                    	<a href="memberpages.php?Page=picmenu&Action=upload&id={$album.id}"><img src="./img/add.png" alt="Add to this album"/></a>
                    	<a href="memberpages.php?Page=picmenu&Action=edit&id={$album.id}"><img src="./img/b_edit.png" alt="Edit this album"/></a>
                        <a href="memberpages.php?Page=picmenu&Action=delete&id={$album.id}"><img src="./img/b_drop.png" alt="Delete this album"/></a>
                    </td>
                </tr>
            {if $smarty.foreach.eventalbum.last}
            	<tr>
                	<td colspan="4">
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
            {/if}
            {foreachelse}
            <p>
            	There are no event albums yet. Click the link on the right to create one!
            </p>
            {/foreach}
        </fieldset>
        <fieldset>
        	<legend>Match Albums</legend>
            {foreach name=matchalbum from=$matchalbums item=album}
            {if $smarty.foreach.matchalbum.first}
            <table>
            	<tr>
                	<th>Album Name</th><th>Picture Count</th><th>Created On</th><th>Created By</th><th>&nbsp;</th>
                </tr>
            {/if}
                <tr>
                    <td>{$album.album_name}</td>
                    <td>{$album.pic_count}</td>
                    <td>{$album.date|date_format}</td>
                    <td>Auto-generated</td>
                    <td>
                    	<a href="memberpages.php?Page=picmenu&Action=upload&id={$album.id}"><img src="./img/add.png" alt="Add to this album"/></a>
                    	<a href="memberpages.php?Page=picmenu&Action=edit&id={$album.id}"><img src="./img/b_edit.png" alt="Edit this album"/></a>
                        <a href="memberpages.php?Page=picmenu&Action=delete&id={$album.id}"><img src="./img/b_drop.png" alt="Delete this album"/></a>
                    </td>
                </tr>
            {if $smarty.foreach.matchalbum.last}
            	<tr>
                	<td colspan="4">
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
            {/if}
            {foreachelse}
            <p>
            	There are no match albums yet. Click the link on the right to create one!
            </p>
            {/foreach}
        </fieldset>
    </div>