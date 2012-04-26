{literal}
<script language="javascript">
function del(id)
{
	window.location = "./commit/commitinfo.php?action=delete&id="+id;
}
</script>
{/literal}
<div id="main">
	<div id="content">
    	<div align="center"><h1>Information Pages</h1></div>
        <p>
			This is where the information pages that appear in the left-hand menu side are set.
		</p>
        <form action="./commit/commitinfo.php?action=edit" method="post" name="adform">
        {foreach from=$pages item=page}
        <fieldset>
        	<legend>{$page.title}</legend>
            <ol>
            	<li>
                	<label for="tit_{$page.id}">Title</label>
                    <input name="tit_{$page.id}" type="text" value="{$page.title}"/>
                </li>
                <li>
                	<label for="seq_{$page.id}">Sequence Number</label>
                    <input name="seq_{$page.id}" size="2" type="text" value="{$page.seq}"/>
                </li>
                <li><textarea name="text_{$page.id}" cols="32" rows="10">{$page.text}</textarea></li>
                <li><input name="delete" type="button" value="Delete" onClick="del({$page.id});" /></li>
            </ol>
        </fieldset>
        {foreachelse}
        <div class="error">You have not made any information pages yet. Click the link on the right to create one</div>
        {/foreach}
        	<input type="hidden" value="{$ids}" name="IDs"/>
            <p align="center">
            	<input name="submit" type="submit" value="Submit all changes" />
            </p>
        </form>
    </div>