{literal}
<script language="javascript" type="text/javascript">
function checkAll()
{
	for (var i = 0; i < document.logform.elements.length; i++)
	{
    	if (document.logform.elements[i].type == "checkbox") {
        	document.logform.elements[i].checked = "true";
    	}
	}
}
</script>
{/literal}

<div id="main">
	<div id="content">
    	<div align="center"><h1>Security Log</h1></div>
        <table cellpadding="2" cellspacing="2">
			<th>User</th><th>IP</th><th>Time Stamp</th><th>Action</th><th>Mark as Read</th>
            <form name="logform" action="./commit/commitlog.php" method="post">
            {foreach from=$logs item=log}
            <tr class="{cycle values="bg1,bg2"}">
                <td><a href="{$log.userlink}">{$log.username}</a></td>
                <td>{$log.ip}</td>
                <td>{$log.timestamp|date_format:'%B %e, %Y %H:%M:%S'}</td>
                <td>{$log.action}</td>
                <td align="center"><input type="checkbox" name="{$log.id}" /></td>
            </tr>
            {foreachelse}
            <tr>
            	<td colspan="5">
                	There are no unread security logs
                </td>
            </tr>
            {/foreach}
            <tr>
				<td colspan="3">&nbsp;</td>
				<td align="center"><input type="button" value="Check All" name="checkall" onclick="checkAll();" /></td>
				<td align="center"><input type="submit" value="Submit" name="Submit" /></td>
			</tr>
			<input type="hidden" value="{$ids}" name="IDs"/>
			</form>
		</table>
    </div>