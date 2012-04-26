{literal}
<script language="javascript">
function del(id)
{
	window.location = "./commit/commitads.php?action=delete&id="+id;
}
</script>
{/literal}
<div id="main">
	<div id="content">
    	<div align="center"><h1>Adverts</h1></div>
        <form action="./commit/commitads.php?action=edit" method="post" name="adform">
        	{foreach from=$adverts item=ad}
            <fieldset>
            	<legend>{$ad.alt}</legend>
                <ol>
                	<li><label for="alt_{$ad.id}">Title</label><input name="alt_{$ad.id}" type="text" value="{$ad.alt}"/></li>
                    <li><label for="hyp_{$ad.id}">Hyperlink</label><input name="hyp_{$ad.id}" type="text" value="{$ad.link}"/></li>
                    <li><label for="seq_{$ad.id}">Sequence Number</label><input name="seq_{$ad.id}" type="text" value="{$ad.seq}"/></li>
                    <li>
                    	<div id="avatar">
                        	<div id="pic_{$ad.id}" class="indent"><img src="{$ad.src}" alt="{$ad.alt}" name="ad{$ad.id}" /></div>
							<div id="iframe_{$ad.id}">
                            	<iframe height="40" width="370" scrolling="no" src="uploadpic.php?id={$ad.id}" frameborder="0"></iframe>
                            </div>
                        </div>
                    </li>
                    <li><input name="delete" type="button" value="Delete" onClick="del({$ad.id});" /></li>
                </ol>
            </fieldset>
            {foreachelse}
            <p>
            	You've not added any adverts yet. Use the link on the left to add one.
            </p>
            {/foreach}
            <p align="center">
            	<input name="submit" type="submit" value="Submit all changes" />
            </p>
            <input type="hidden" value="{$ids}" name="IDs"/>
        </form>
    </div>